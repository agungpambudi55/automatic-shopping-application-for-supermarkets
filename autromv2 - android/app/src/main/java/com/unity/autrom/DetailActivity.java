package com.unity.autrom;

import android.app.Dialog;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.provider.Settings;
import android.support.design.widget.FloatingActionButton;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.NumberPicker;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.unity.autrom.App.AppConfig;
import com.squareup.picasso.Picasso;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class DetailActivity extends AppCompatActivity implements NumberPicker.OnValueChangeListener {

    private TextView textViewNama, textViewHarga, textViewStock, textViewExp, textViewId, textViewQty;
    private ImageView imageViewProduk;
    private FloatingActionButton fab;

    static Dialog dialog;
    ProgressDialog pDialog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail);
        getSupportActionBar().hide();

        pDialog = new ProgressDialog(getApplicationContext());

        String deviceId = Settings.Secure.getString(this.getContentResolver(),
                Settings.Secure.ANDROID_ID);
        String id1 = deviceId.substring(10, 13);
        String id2 = deviceId.substring(14);
        String idDevice = id1 + id2;

        imageViewProduk = (ImageView) findViewById(R.id.imageView_product);
        textViewNama = (TextView) findViewById(R.id.nama_produk);
        textViewHarga = (TextView) findViewById(R.id.harga);
        textViewStock = (TextView) findViewById(R.id.stock);
        textViewExp = (TextView) findViewById(R.id.exp);
        textViewId = (TextView) findViewById(R.id.id_troli);
        textViewQty = (TextView) findViewById(R.id.kuantitas);

        Intent intent = getIntent();
        final String id_produk = intent.getStringExtra("id");
        String nama = intent.getStringExtra("nama");
        String harga = intent.getStringExtra("harga");
        String exp = intent.getStringExtra("expired");
        String stock = intent.getStringExtra("stock");
        String gambar = intent.getStringExtra("url_gambar");


        textViewId.setText(idDevice);
        textViewNama.setText(nama);
        textViewHarga.setText(harga);
        textViewStock.setText(stock);
        textViewExp.setText(exp);
        Picasso.with(this).load(gambar).into(imageViewProduk);

        fab = (FloatingActionButton) findViewById(R.id.add_cart);

        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                show(id_produk);
            }
        });

    }

    @Override
    public void onValueChange(NumberPicker picker, int oldVal, int newVal) {

        Log.i("value is",""+newVal);

    }
    public void show(final String id_produk) {

        final Dialog d = new Dialog(DetailActivity.this);
        d.setTitle("Kuantitas Produk");
        d.setContentView(R.layout.dialog_kuantitas);
        Button b1 = (Button) d.findViewById(R.id.button1);
        Button b2 = (Button) d.findViewById(R.id.button2);
        final NumberPicker np = (NumberPicker) d.findViewById(R.id.numberPicker1);
        np.setMaxValue(100);
        np.setMinValue(1);
        np.setWrapSelectorWheel(false);
        np.setOnValueChangedListener(this);
        b1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                textViewQty.setText(String.valueOf(np.getValue()));

                String idtroli =  textViewId.getText().toString().trim();
                String idproduk = id_produk;
                String qty = textViewQty.getText().toString().trim();

                addCart(idtroli, idproduk, qty);

                d.dismiss();
            }
        });
        b2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                d.dismiss();
            }
        });
        d.show();
    }

    private void addCart(final String idtroli, final String idproduk, final String qty) {

        StringRequest strRequest = new StringRequest(Request.Method.POST,
                AppConfig.URL_ADD_CART,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        pDialog.dismiss();

                        Log.d(AppConfig.LOG, "Res : "+ idtroli);

                        try{
                            JSONObject jObj = new JSONObject(response);
                            boolean error = jObj.getBoolean("error");

                            if (!error){

                                //JSONObject cart = jObj.getJSONObject("Cart");
                                //String idtroli = jObj.getString("id_troli");
                                //String idproduk = jObj.getString("id_produk");
                                //String jumlah = jObj.getString("jumlah");

                                Intent intent = new Intent(DetailActivity.this, CartActivity.class);
                                intent.putExtra("id_troli", idtroli);
                                startActivity(intent);

                            }else {
                                String message = jObj.getString("message");
                                Toast.makeText(getApplicationContext(), message, Toast.LENGTH_LONG).show();
                            }

                        } catch (JSONException e) {
                            e.printStackTrace();
                            Toast.makeText(getApplicationContext(), e.getMessage(), Toast.LENGTH_LONG).show();
                        }

                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        pDialog.dismiss();
                        Toast.makeText(getApplicationContext(), error.getMessage(), Toast.LENGTH_LONG).show();
                    }
                }
        ){
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<String, String>();
                params.put("id_troli", idtroli);
                params.put("id_produk", idproduk);
                params.put("jumlah", qty);

                return params;
            }
        };

        Volley.newRequestQueue(getApplicationContext()).add(strRequest);

    }
}
