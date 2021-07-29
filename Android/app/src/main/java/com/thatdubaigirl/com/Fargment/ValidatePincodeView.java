package com.thatdubaigirl.com.Fargment;

import android.app.Activity;
import android.app.Dialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.text.Editable;
import android.text.TextUtils;
import android.text.TextWatcher;
import android.util.DisplayMetrics;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.FrameLayout;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.core.content.ContextCompat;

import com.google.android.material.bottomsheet.BottomSheetBehavior;
import com.google.android.material.bottomsheet.BottomSheetDialog;
import com.google.android.material.bottomsheet.BottomSheetDialogFragment;
import com.thatdubaigirl.com.Model.PinCodeResponse;
import com.thatdubaigirl.com.R;
import com.thatdubaigirl.com.Utils.Api;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class ValidatePincodeView extends BottomSheetDialogFragment {

    private EditText pincodeEditText;
    private Button submitBtn;
    private ProgressDialog dialog;

    private String discountID;
    private onValidateListener onValidateListener;
    public interface onValidateListener{
        void onValidate(Boolean status);
    }

    public ValidatePincodeView(String discountID,onValidateListener callback) {
        this.discountID = discountID;
        this.onValidateListener = callback;
    }

    @NonNull @Override public Dialog onCreateDialog(Bundle savedInstanceState) {
        Dialog dialog = super.onCreateDialog(savedInstanceState);
        dialog.setOnShowListener(new DialogInterface.OnShowListener() {
            @Override public void onShow(DialogInterface dialogInterface) {
                BottomSheetDialog bottomSheetDialog = (BottomSheetDialog) dialogInterface;
                setupFullHeight(bottomSheetDialog);
            }
        });
        return  dialog;
    }


    private void setupFullHeight(BottomSheetDialog bottomSheetDialog) {
        FrameLayout bottomSheet = (FrameLayout) bottomSheetDialog.findViewById(R.id.design_bottom_sheet);
        BottomSheetBehavior behavior = BottomSheetBehavior.from(bottomSheet);
        ViewGroup.LayoutParams layoutParams = bottomSheet.getLayoutParams();

        int windowHeight = getWindowHeight();
        if (layoutParams != null) {
            layoutParams.height = windowHeight;
        }
        bottomSheet.setLayoutParams(layoutParams);
        behavior.setState(BottomSheetBehavior.STATE_EXPANDED);
    }

    private int getWindowHeight() {
        // Calculate window height for fullscreen use
        DisplayMetrics displayMetrics = new DisplayMetrics();
        ((Activity) getContext()).getWindowManager().getDefaultDisplay().getMetrics(displayMetrics);
        return displayMetrics.heightPixels;
    }

    @Override
    public View onCreateView(LayoutInflater inflater,ViewGroup container, Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.activity_discount_input_view,container,false);
        pincodeEditText = rootView.findViewById(R.id.edpincode);
        submitBtn = rootView.findViewById(R.id.submitBtn);
        pincodeEditText.addTextChangedListener(pinCodeWatcher);
        enableSubmitBtn(false);
        submitBtn.setOnClickListener(v->{
            validatePinCode();
        });

        rootView.findViewById(R.id.backBtn).setOnClickListener(v->{
            dismiss();
        });

        dialog = new ProgressDialog(getContext());
        dialog.setMessage("Loading...");
        dialog.setCancelable(false);


        return rootView;
    }

    TextWatcher pinCodeWatcher = new TextWatcher() {
        @Override
        public void beforeTextChanged(CharSequence s, int start, int count, int after) {

        }

        @Override
        public void onTextChanged(CharSequence s, int start, int before, int count) {
            if(!TextUtils.isEmpty(s)){
                enableSubmitBtn(true);
            }else{
                enableSubmitBtn(false);
            }
        }

        @Override
        public void afterTextChanged(Editable s) {

        }
    };

    private void enableSubmitBtn(Boolean status){
       submitBtn.setEnabled(status);
        if (status){
            submitBtn.setTextColor(ContextCompat.getColor(getContext(),R.color.white));
            submitBtn.setAlpha(1);
        }else{
            submitBtn.setTextColor(getContext().getResources().getColor(R.color.gray));
            submitBtn.setAlpha(0.5f);

        }
    }

    private void validatePinCode() {
        dialog.show();

        SharedPreferences sp = PreferenceManager.getDefaultSharedPreferences(getActivity());
        String userID = sp.getString("user_id","");
        String pinCode = pincodeEditText.getText().toString();


        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl(getString(R.string.commn_url))
                .addConverterFactory(GsonConverterFactory.create())
                .build();
        Api service = retrofit.create(Api.class);
        Call<PinCodeResponse> call= service.validatePinCode(discountID,userID,pinCode);
        call.enqueue(new Callback<PinCodeResponse>() {
            @Override
            public void onResponse(Call<PinCodeResponse> call, Response<PinCodeResponse> response) {
                dialog.dismiss();
                if(response.body() == null){
                    Toast.makeText(getActivity(), "Please try again", Toast.LENGTH_SHORT).show();
                    dismiss();
                    return;
                }
                if (!response.body().getStatus().equalsIgnoreCase("failed")){
                    if(onValidateListener!=null){
                        dismiss();
                        onValidateListener.onValidate(true);

                    }
                }else{
                    Toast.makeText(getActivity(), "" + response.body().getMsg(), Toast.LENGTH_SHORT).show();

                }
            }

            @Override
            public void onFailure(Call<PinCodeResponse> call, Throwable t) {
                dialog.dismiss();
                Toast.makeText(getActivity(), "Please check your internet", Toast.LENGTH_SHORT).show();

            }
        });
    }
}
