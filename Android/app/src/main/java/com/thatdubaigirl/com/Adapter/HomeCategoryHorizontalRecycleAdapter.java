package com.thatdubaigirl.com.Adapter;

import android.app.Activity;
import android.app.ProgressDialog;
import android.graphics.Color;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.squareup.picasso.Picasso;
import com.thatdubaigirl.com.Activity.DiscountsList;
import com.thatdubaigirl.com.Model.Categori_Model;
import com.thatdubaigirl.com.R;
import com.thatdubaigirl.com.Utils.Api;

import java.util.ArrayList;
import java.util.List;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.DefaultItemAnimator;
import androidx.recyclerview.widget.GridLayoutManager;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

import static com.thatdubaigirl.com.Activity.DiscountsList.subcatlist;
import static com.thatdubaigirl.com.Activity.DiscountsList.tab_value;

//public class HomeCategoryHorizontalRecycleAdapter extends RecyclerView.Adapter<HomeCategoryHorizontalRecycleAdapter.MyViewHolder> {
//
//    Activity context;
//    private ArrayList<Categori_Model> productlist = new ArrayList<>();
//    Adapter_Offer_List adapter_offer_list;
//    private List<Categori_Model> OfferList;
//    int myPos = tab_value;
//    ProgressDialog dialog;
//    String Path_img;
//
//
//    public class MyViewHolder extends RecyclerView.ViewHolder {
//        TextView title;
//        LinearLayout linear;
//        View view1;
//
//        public MyViewHolder(View view) {
//            super(view);
//            title = (TextView) view.findViewById(R.id.title);
//            linear = (LinearLayout) view.findViewById(R.id.linear);
//            view1 = view.findViewById(R.id.view);
//        }
//    }
//
//    public HomeCategoryHorizontalRecycleAdapter(Activity context, List<Categori_Model> offerList) {
//        this.OfferList = offerList;
//        this.context = context;
//    }
//
//    @Override
//    public HomeCategoryHorizontalRecycleAdapter.MyViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
//        View itemView = LayoutInflater.from(parent.getContext())
//                .inflate(R.layout.item_category_horizontal_list, parent, false);
//
//        dialog = new ProgressDialog(context);
//        dialog.setMessage("Loading...");
//        return new HomeCategoryHorizontalRecycleAdapter.MyViewHolder(itemView);
//    }
//
//    @Override
//    public void onBindViewHolder(@NonNull MyViewHolder holder, final int position) {
//        final Categori_Model lists = OfferList.get(position);
//        holder.title.setText(lists.getCategory_name());
//
//        if (myPos == position) {
//            holder.view1.setVisibility(View.VISIBLE);
//
//        } else {
//            holder.view1.setVisibility(View.GONE);
//        }
//
//        holder.linear.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View view) {
//                myPos = position;
//                notifyDataSetChanged();
//            }
//        });
//        holder.itemView.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View view) {
//                myPos = position;
//                notifyDataSetChanged();
//
//            }
//        });
//        holder.title.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View view) {
//                myPos = position;
//                notifyDataSetChanged();
//                getDiscountlists(OfferList.get(position).getId());
//            }
//        });
//    }
//    /*get getDiscountlists APi*/
//    public void getDiscountlists(String category_id) {
////        productlist.clear();
////        dialog.show();
//        Retrofit retrofit = new Retrofit.Builder()
//                .baseUrl(context.getString(R.string.commn_url))
//                .addConverterFactory(GsonConverterFactory.create())
//                .build();
//        Api loginservice = retrofit.create(Api.class);
//        Call<Categori_Model> call = loginservice.getDiscountlists(category_id,"");
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
//                            adapter_offer_list = new Adapter_Offer_List(context, productlist, Path_img);
//                            subcatlist.setAdapter(adapter_offer_list);
//                            subcatlist.setVisibility(View.VISIBLE);
//                            adapter_offer_list.notifyDataSetChanged();
//                        } else {
//                            subcatlist.setVisibility(View.GONE);
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
//
//    @Override
//    public int getItemCount() {
//        return OfferList.size();
//    }
//
//
//}


