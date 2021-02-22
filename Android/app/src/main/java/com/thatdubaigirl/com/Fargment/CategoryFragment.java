package com.thatdubaigirl.com.Fargment;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;

import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.GridLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import com.thatdubaigirl.com.Activity.DiscountsList;
import com.thatdubaigirl.com.Activity.Login;
import com.thatdubaigirl.com.Activity.PlayVideo;
import com.thatdubaigirl.com.Adapter.Adapter_Offer_List;
import com.thatdubaigirl.com.Adapter.Cat_Adapter;
import com.thatdubaigirl.com.Model.Categori_Model;
import com.thatdubaigirl.com.Model.Common_Model;
import com.thatdubaigirl.com.R;
import com.thatdubaigirl.com.Utils.Api;
import com.thatdubaigirl.com.Utils.Const;

import java.util.ArrayList;

public class CategoryFragment extends Fragment {

    RecyclerView recyclerviewTopcat;
    ArrayList<Categori_Model> categori_models;
    ArrayList<Categori_Model> productlist;
    ProgressDialog dialog;
    String path_img,Path_img;
    SwipeRefreshLayout pullToRefresh;
    public CategoryFragment() {
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {

        View v = inflater.inflate(R.layout.fragment_category, container, false);
        dialog = new ProgressDialog(getActivity());
        dialog.setMessage("Loading...");
        dialog.setCancelable(false);
        recyclerviewTopcat = v.findViewById(R.id.recyclerviewTopcat);
        pullToRefresh = v.findViewById(R.id.pullToRefresh);

        if (Const.catgeory_page.equalsIgnoreCase("0")) {
            categories();
            getDiscountlists11();
        } else {
            Cat_Adapter mAdapter = new Cat_Adapter(getActivity(), Const.Categori_Model, Const.path_img);
            recyclerviewTopcat.setLayoutManager(new GridLayoutManager(getActivity(), 2));
            recyclerviewTopcat.setAdapter(mAdapter);
        }
        pullToRefresh.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                categories();// your code
                pullToRefresh.setRefreshing(false);
            }
        });
        return v;
    }

    /*get categories APi*/
    public void categories() {
        categori_models = new ArrayList<>();
        dialog.show();
        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl(getString(R.string.commn_url))
                .addConverterFactory(GsonConverterFactory.create())
                .build();
        Api loginservice = retrofit.create(Api.class);
        Call<Categori_Model> call = loginservice.categories();
        call.enqueue(new Callback<Categori_Model>() {
            @Override
            public void onResponse(Call<Categori_Model> call, Response<Categori_Model> response) {
                if (response.code() == 200) {
                    dialog.dismiss();
                    Log.e("adffadada", "" + response.toString());
                    if (response.body().getStatus().equalsIgnoreCase("success")) {
                        categori_models = response.body().getData();
                        path_img = response.body().getPath();
                        Cat_Adapter mAdapter = new Cat_Adapter(getActivity(), categori_models, path_img);
                        recyclerviewTopcat.setLayoutManager(new GridLayoutManager(getActivity(), 2));
                        recyclerviewTopcat.setAdapter(mAdapter);
                        Const.catgeory_page = "1";
                        Const.Categori_Model = categori_models;
                        Const.path_img = path_img;
                    } else {
                    }
                }
            }

            @Override
            public void onFailure(Call<Categori_Model> call, Throwable t) {
                dialog.dismiss();
            }

        });
    }

    public void getDiscountlists11() {
        productlist = new ArrayList<>();
        dialog.show();
        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl(getString(R.string.commn_url))
                .addConverterFactory(GsonConverterFactory.create())
                .build();
        Api loginservice = retrofit.create(Api.class);
        Call<Categori_Model> call = loginservice.getDiscountlists("", "");
        call.enqueue(new Callback<Categori_Model>() {
            @Override
            public void onResponse(Call<Categori_Model> call, Response<Categori_Model> response) {
                if (response.code() == 200) {
                    dialog.dismiss();
                    Log.e("adffadada", "" + response.toString());
                    if (response.body().getStatus().equalsIgnoreCase("success")) {
                        productlist = response.body().getData();
                        Path_img = response.body().getPath();
                        Const.product_list = productlist;
                    } else {

                    }
                }
            }

            @Override
            public void onFailure(Call<Categori_Model> call, Throwable t) {
                dialog.dismiss();
            }

        });
    }

}