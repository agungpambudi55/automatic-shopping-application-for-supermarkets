package com.unity.autrom;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.provider.Settings;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.MenuItem;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.unity.autrom.Adapter.MyAdapter;
import com.unity.autrom.App.AppConfig;
import com.unity.autrom.ListItem.ListItem;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class CartActivity extends AppCompatActivity {

    private RecyclerView recyclerView;
    private RecyclerView.Adapter adapter;
    private TextView textViewTotalHarga, textViewBack, textViewNotif;

    private List<ListItem> listItems;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cart);
        setTitle("Keranjang belanja");

        textViewBack = (TextView) findViewById(R.id.back);
        textViewNotif = (TextView) findViewById(R.id.notif);
        textViewTotalHarga = (TextView) findViewById(R.id.total_price);

        getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        textViewBack.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(CartActivity.this, MainActivity.class);
                startActivity(intent);
            }
        });

        recyclerView = (RecyclerView) findViewById(R.id.recyclerView);
        recyclerView.setHasFixedSize(true);
        recyclerView.setLayoutManager(new LinearLayoutManager(this));

        listItems = new ArrayList<>();

        loadRecyclerViewData();

    }

    private void loadRecyclerViewData(){
        final ProgressDialog progressDialog = new ProgressDialog(getApplicationContext());

        String deviceId = Settings.Secure.getString(this.getContentResolver(),
                Settings.Secure.ANDROID_ID);
        String id1 = deviceId.substring(10, 13);
        String id2 = deviceId.substring(14);
        String idDevice = id1 + id2;

        String url = "";
        url = AppConfig.URL_LIST_CART + "?id_troli=" + idDevice;

        StringRequest stringRequest = new StringRequest(Request.Method.GET,
                url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        progressDialog.dismiss();

                        try {
                            JSONObject jObj = new JSONObject(response);
                            boolean error = jObj.getBoolean("error");

                            Log.d(AppConfig.LOG,"response : "+response);

                            if (!error){

                                JSONArray product = jObj.getJSONArray("product");
                                Log.d(AppConfig.LOG,"response : "+response);

                                Integer totalpembayaran = 0;
                                for (int i=0; i<product.length(); i++){
                                    JSONObject o = product.getJSONObject(i);
                                    ListItem item = new ListItem(
                                            o.getInt("id_transaksi_sementara"),
                                            o.getString("nama_produk"),
                                            o.getString("harga"),
                                            o.getString("jumlah")
                                    );
                                    Integer qty = Integer.valueOf(item.getQty());
                                    Integer harga = Integer.valueOf(item.getPrice());
                                    Integer hargatotal = null;
                                    if ( qty > 1){
                                        hargatotal = harga * qty;
                                    }else {
                                        hargatotal = harga;
                                    }

                                    totalpembayaran = hargatotal + totalpembayaran;

                                    Log.d(AppConfig.LOG, "total" + i+" : "+ totalpembayaran);

                                    listItems.add(item);
                                }

                                adapter = new MyAdapter(listItems, getApplicationContext());
                                recyclerView.setAdapter(adapter);


                                textViewTotalHarga.setText("" + totalpembayaran);

                            }else {

                                String message = jObj.getString("cart");
                                Toast.makeText(getApplicationContext(), message, Toast.LENGTH_LONG).show();

                            }

                        } catch (JSONException e) {
                            e.printStackTrace();

                            textViewNotif.setVisibility(View.GONE);
                            Toast.makeText(getApplicationContext(), "Data tidak ditemukan", Toast.LENGTH_LONG).show();
                        }

                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        progressDialog.dismiss();
                        textViewNotif.setVisibility(View.GONE);

                        Toast.makeText(getApplicationContext(),"Error Response", Toast.LENGTH_LONG).show();
                    }
                }
        );

        Volley.newRequestQueue(getApplicationContext()).add(stringRequest);

    }

//    @Override
//    public boolean onCreateOptionsMenu(Menu menu) {
//        MenuInflater inflater = getMenuInflater();
//        inflater.inflate(R.menu.menu_main, menu);
//
//        return super.onCreateOptionsMenu(menu);
//    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();


        //noinspection SimplifiableIfStatement
        if (id == android.R.id.home) {
            // finish the activity
            onBackPressed();
            return true;
        }else if (id == android.R.id.icon_frame){
            return true;
        }
        return super.onOptionsItemSelected(item);
    }

}
