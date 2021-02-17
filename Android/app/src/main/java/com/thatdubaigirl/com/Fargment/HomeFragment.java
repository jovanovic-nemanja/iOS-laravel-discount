package com.thatdubaigirl.com.Fargment;

import android.app.ProgressDialog;
import android.os.Bundle;

import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.RecyclerView;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;
import cz.msebera.android.httpclient.Header;
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

import com.google.gson.JsonArray;
import com.loopj.android.http.AsyncHttpClient;
import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;
import com.thatdubaigirl.com.Activity.DiscountsList;
import com.thatdubaigirl.com.Adapter.Adapter_Home_Offer_List;
import com.thatdubaigirl.com.Adapter.Adapter_Offer_List;
import com.thatdubaigirl.com.Model.Categori_Model;
import com.thatdubaigirl.com.R;
import com.thatdubaigirl.com.Utils.Api;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class HomeFragment extends Fragment {
    RecyclerView rlyofferlist;
    ArrayList<Categori_Model> productlist = new ArrayList<>();
    String Path_img;
    Adapter_Home_Offer_List adapter_home_offer_list;
    ProgressDialog dialog;
    SwipeRefreshLayout pullToRefresh;

    public HomeFragment() {
    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.fragment_home, container, false);
        dialog = new ProgressDialog(getActivity());
        dialog.setMessage("Loading...");
        dialog.setCancelable(false);
        rlyofferlist = v.findViewById(R.id.rlyofferlist);
        pullToRefresh = v.findViewById(R.id.pullToRefresh);
        getDiscountlists();
        pullToRefresh.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                getDiscountlists(); // your code
                pullToRefresh.setRefreshing(false);
            }
        });
        return v;
    }

    /*get getDiscountlists APi*/
//    public void getDiscountlists() {
//        dialog.show();
//        Retrofit retrofit = new Retrofit.Builder()
//                .baseUrl(getString(R.string.commn_url))
//                .addConverterFactory(GsonConverterFactory.create())
//                .build();
//        Api loginservice = retrofit.create(Api.class);
//        Call<Categori_Model> call = loginservice.getDiscountlists("", "");
//        call.enqueue(new Callback<Categori_Model>() {
//            @Override
//            public void onResponse(Call<Categori_Model> call, Response<Categori_Model> response) {
//                if (response.code() == 200) {
//                    dialog.dismiss();
//                    Log.e("adffadada", "" + response.toString());
//                    if (response.body().getStatus().equalsIgnoreCase("success")) {
//                        productlist = response.body().getData();
//                        Path_img = response.body().getPath();
//                        if (productlist.size() > 0) {
//                            adapter_home_offer_list = new Adapter_Home_Offer_List(getActivity(), productlist, Path_img);
//                            rlyofferlist.setAdapter(adapter_home_offer_list);
//                            adapter_home_offer_list.notifyDataSetChanged();
//                            rlyofferlist.setVisibility(View.VISIBLE);
//                        } else {
//                            rlyofferlist.setVisibility(View.GONE);
//                        }
//
//                    } else {
//
//                    }
//                }
//            }
//
//            @Override
//            public void onFailure(Call<Categori_Model> call, Throwable t) {
//                dialog.dismiss();
//            }
//
//        });
//    }

    public void getDiscountlists() {
        productlist = new ArrayList<>();
        AsyncHttpClient client = new AsyncHttpClient();
        final RequestParams requestParams = new RequestParams();
        requestParams.put("category_id", "");
        requestParams.put("vendor_name", "");
        client.get(getString(R.string.commn_url) + "getDiscountlists?", requestParams, new JsonHttpResponseHandler() {
            @Override
            public void onStart() {
                dialog.show();
            }

            @Override
            public void onSuccess(int statusCode, Header[] headers, JSONObject response) {
                dialog.dismiss();
                try {
                    Log.e("datatattatat", "" + response.toString());
                    if (response.getString("status").equalsIgnoreCase("success")) {
                        JSONArray jsonArray = response.getJSONArray("data");
                        for (int i = 0; i < jsonArray.length(); i++) {
                            JSONObject j = jsonArray.getJSONObject(i);
                            Categori_Model m = new Categori_Model();
                            m.setId(j.getString("id"));
                            m.setTitle(j.getString("title"));
                            m.setDescription(j.getString("description"));
                            m.setCategory_id(j.getString("category_id"));
                            m.setDiscount_photo(j.getString("discount_photo"));
                            m.setVendor_id(j.getString("vendor_id"));
                            m.setCoupon(j.getString("coupon"));
                            m.setSign_date(j.getString("sign_date"));
                            m.setStatus(j.getString("status"));
                            m.setVendorname(j.getString("vendorname"));
                            m.setLocation(j.getString("location"));
                            m.setPhoto(j.getString("photo"));
                            m.setEmail(j.getString("email"));
                            m.setPhone(j.getString("phone"));
                            m.setInstagram_id(j.getString("instagram_id"));
                            m.setWebsite_link(j.getString("website_link"));
                            m.setCategory_name(j.getString("category_name"));
                            m.setAvg_marks(j.getString("avg_marks"));
                            m.setCount_reviews(j.getString("count_reviews"));
                            if (j.getString("status").equalsIgnoreCase("2")) {
                                productlist.add(m);
                            } else {
                                productlist.remove(m);
                            }

                        }
                        Path_img = response.getString("path");
                        Log.e("safgsfgsahsa", "" + productlist.size() + "   " + Path_img);
                        if (productlist.size() > 0) {
                            adapter_home_offer_list = new Adapter_Home_Offer_List(getActivity(), productlist, Path_img);
                            rlyofferlist.setAdapter(adapter_home_offer_list);
                            adapter_home_offer_list.notifyDataSetChanged();
                            rlyofferlist.setVisibility(View.VISIBLE);
                        } else {
                            rlyofferlist.setVisibility(View.GONE);
                        }

                    } else {
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        });
    }


}