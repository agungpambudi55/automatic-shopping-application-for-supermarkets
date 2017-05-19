package com.unity.autrom.Adapter;

import android.app.ProgressDialog;
import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.unity.autrom.App.AppConfig;
import com.unity.autrom.ListItem.ListItem;
import com.unity.autrom.R;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class MyAdapter extends RecyclerView.Adapter<MyAdapter.ViewHolder> {

    private final MyAdapter adapter;
    private List<ListItem> listItems;
    private Context context;
    private ProgressDialog progressDialog;

    public MyAdapter(List<ListItem> listItems, Context context) {
        this.listItems = listItems;
        this.context = context;
        progressDialog = new ProgressDialog(context);
        this.adapter = this;
    }

    @Override
    public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.list_item, parent, false);
        return new ViewHolder(view);
    }

    @Override
    public void onBindViewHolder(ViewHolder holder, final int position) {

        final ListItem listItem = listItems.get(position);

        holder.textViewName.setText(listItem.getProduct_name());
        holder.textViewQty.setText(listItem.getQty());

        Integer qty = Integer.valueOf(listItem.getQty());
        Integer harga = Integer.valueOf(listItem.getPrice());
        Integer hargatotal = null;
        Integer totalpembayaran = null;
        if ( qty > 1){
            hargatotal = harga * qty;
        }else {
            hargatotal = harga;
        }


        holder.textViewPrice.setText(""+ hargatotal);

        holder.imageViewDelete.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                final String id = ""+listItem.getId_cart();

                Log.d(AppConfig.LOG, "id "+ id);

                StringRequest stringRequest = new StringRequest(Request.Method.POST,
                        AppConfig.URL_DEL_CART,
                        new Response.Listener<String>() {
                            @Override
                            public void onResponse(String response) {
                                progressDialog.dismiss();
                                try {
                                    JSONObject jObj = new JSONObject(response);
                                    boolean error = jObj.getBoolean("error");
                                    if (!error){

                                        String message = jObj.getString("message");
                                        Toast.makeText(context, message, Toast.LENGTH_LONG).show();

                                        listItems.remove(listItem);
                                        adapter.notifyDataSetChanged();

                                    }else {

                                        String message = jObj.getString("message");
                                        Toast.makeText(context, message, Toast.LENGTH_LONG).show();

                                    }
                                } catch (JSONException e) {
                                    e.printStackTrace();
                                    Toast.makeText(context, e.getMessage(), Toast.LENGTH_LONG).show();
                                }
                            }
                        },
                        new Response.ErrorListener() {
                            @Override
                            public void onErrorResponse(VolleyError error) {
                                progressDialog.dismiss();
                                Toast.makeText(context, error.getMessage(), Toast.LENGTH_LONG).show();

                            }
                        }
                ){
                    @Override
                    protected Map<String, String> getParams() throws AuthFailureError {
                        Map<String, String> params = new HashMap<String, String>();
                        params.put("id_transaksi_sementara", id);
                        return params;
                    }
                };

                Volley.newRequestQueue(context).add(stringRequest);
            }
        });

    }

    @Override
    public int getItemCount() {
        return listItems.size();
    }

    public class ViewHolder extends RecyclerView.ViewHolder{

        public TextView textViewName;
        public TextView textViewPrice;
        public ImageView imageViewDelete;
        public TextView textViewQty;

        public ViewHolder(View itemView) {
            super(itemView);

            textViewName  = (TextView) itemView.findViewById(R.id.text_name);
            textViewPrice = (TextView) itemView.findViewById(R.id.text_price);
            imageViewDelete = (ImageView) itemView.findViewById(R.id.btn_delete);
            textViewQty = (TextView) itemView.findViewById(R.id.text_qty);

        }
    }
}
