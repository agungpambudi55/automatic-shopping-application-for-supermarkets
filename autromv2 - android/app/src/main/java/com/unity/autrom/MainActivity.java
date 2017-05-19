package com.unity.autrom;

import android.app.Dialog;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.provider.Settings;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.Gravity;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.LinearLayout;
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
import com.synnapps.carouselview.CarouselView;
import com.synnapps.carouselview.ImageClickListener;
import com.synnapps.carouselview.ImageListener;
import com.synnapps.carouselview.ViewListener;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class MainActivity extends AppCompatActivity implements NumberPicker.OnValueChangeListener  {

    CarouselView carouselView;
    CarouselView customCarouselView;

    private LinearLayout btn_scan;
    private LinearLayout btn_cart;
    private LinearLayout btn_map;
    private TextView textViewid;

    private ProgressDialog proggresDialog;

    String barcode;

    int[] sampleImages = {R.drawable.promo, R.drawable.promo2, R.drawable.promo3};


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        getSupportActionBar().hide();

        String deviceId = Settings.Secure.getString(this.getContentResolver(),
                Settings.Secure.ANDROID_ID);
        String id1 = deviceId.substring(10,13);
        String id2 = deviceId.substring(14);
        String id  = id1 + id2 ;
        //Toast.makeText(this, id, Toast.LENGTH_SHORT).show();

        textViewid = (TextView) findViewById(R.id.id_troli);
        textViewid.setText(id);

        proggresDialog = new ProgressDialog(getApplicationContext());

        carouselView = (CarouselView) findViewById(R.id.carouselView);
        customCarouselView = (CarouselView) findViewById(R.id.customCarouselView);

        carouselView.setPageCount(sampleImages.length);

        customCarouselView.setPageCount(sampleImages.length);
        customCarouselView.setSlideInterval(4000);

        carouselView.setImageListener(imageListener);
        customCarouselView.setViewListener(viewListener);
        carouselView.setImageClickListener(new ImageClickListener() {
            @Override
            public void onClick(int position) {
                //Toast.makeText(MainActivity.this, "Clicked item: "+ position, Toast.LENGTH_SHORT).show();
                switch (position){
                    case 0:
                        Intent intent =  new Intent(MainActivity.this, PromoActivity.class);
                        startActivity(intent);
                        break;
                    case 1:
                        Intent intent1 =  new Intent(MainActivity.this, PromoSatuActivity.class);
                        startActivity(intent1);
                        break;
                    case 2:
                        Intent intent2 =  new Intent(MainActivity.this, PromoDuaActivity.class);
                        startActivity(intent2);
                        break;
                    default:
                        break;
                }
            }
        });

        btn_scan = (LinearLayout) findViewById(R.id.imageView_scan);
        btn_cart = (LinearLayout) findViewById(R.id.imageView_cart);
        btn_map = (LinearLayout) findViewById(R.id.imageView_map);

        btn_scan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                ScanDialog dialog = new ScanDialog(MainActivity.this, new ScanDialog.DialogEvent() {
                    @Override
                    public void OnTextMax(String text) {
                        barcode = text;
                        //Toast.makeText(getApplicationContext(), input, Toast.LENGTH_LONG).show();
                        searchProduct(barcode);
                    }
                });
                dialog.show();
            }
        });

        btn_cart.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(MainActivity.this, CartActivity.class);
                startActivity(intent);
            }
        });

        btn_map.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                showDialogMap();

            }
        });

    }

    private void showDialogMap() {

        final Dialog d = new Dialog(MainActivity.this);
        d.setTitle("Autrom");
        d.setContentView(R.layout.dialog_search);
        final TextView lokasi = (TextView) d.findViewById(R.id.lokasi);
        Button cari = (Button) d.findViewById(R.id.cari);
        cari.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                String data =  lokasi.getText().toString().trim();

                searchProduk(data);

                d.dismiss();
            }
        });
        d.show();
    }

    private void searchProduk(final String data) {

        final StringRequest stringRequest = new StringRequest(Request.Method.POST,
                AppConfig.URL_LOKASI_PRODUK,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        proggresDialog.dismiss();

                        try{
                            JSONObject jObj = new JSONObject(response);
                            Boolean error = jObj.getBoolean("error");

                            if(!error){
                                JSONObject produk = jObj.getJSONObject("product");
                                String blok = produk.getString("lokasi_block");
                                String sekat = produk.getString("lokasi_sekat");

                                Intent intent = new Intent(MainActivity.this, MapProductActivity.class);
                                intent.putExtra("blok", blok);
                                intent.putExtra("sekat", sekat);
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
                        proggresDialog.dismiss();
                        Toast.makeText(getApplicationContext(), error.getMessage(), Toast.LENGTH_LONG).show();
                    }
                }
        ){
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<String, String>();
                params.put("nama_produk", data);

                return params;
            }
        };

        Volley.newRequestQueue(getApplicationContext()).add(stringRequest);

    }

    private void searchProduct(String barcode) {

        String url = AppConfig.URL_SEARCH_PRODUK + "?barcode=" + barcode;

        StringRequest stringRequest = new StringRequest(Request.Method.GET,
                url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        proggresDialog.dismiss();

                        Log.d(AppConfig.LOG, "Response new : "+response);

                        try{
                            JSONObject jObj = new JSONObject(response);
                            boolean error = jObj.getBoolean("error");

                            if (!error){

                                JSONObject product = jObj.getJSONObject("product");

                                String id_produk = product.getString("id_produk");
                                String nama = product.getString("nama_produk");
                                String harga = product.getString("harga");
                                String exp = product.getString("exp");
                                String stock = product.getString("stok_barang");
                                String gambar = product.getString("gambar");
                                String url = "http://192.168.43.82/autrom/image/";
                                String url_gambar = url + gambar;

                                Log.d(AppConfig.LOG, "Response S : "+nama+ "  " +harga+ "  " +exp+ "  "+gambar);

                                Intent intent = new Intent(MainActivity.this, DetailActivity.class);
                                intent.putExtra("id", id_produk);
                                intent.putExtra("nama", nama);
                                intent.putExtra("harga", harga);
                                intent.putExtra("expired", exp);
                                intent.putExtra("stock", stock);
                                intent.putExtra("url_gambar", url_gambar);
                                startActivity(intent);

                            }
                            else{
                                String message = jObj.getString("product");
                                Toast.makeText(getApplicationContext(), message, Toast.LENGTH_LONG).show();
                            }

                        } catch (JSONException e) {
                            e.printStackTrace();
                            String message = "Data tidak ditemukan";
                            Toast.makeText(getApplicationContext(), message, Toast.LENGTH_LONG).show();
                        }

                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        proggresDialog.dismiss();
                        Toast.makeText(getApplicationContext(), error.getMessage(), Toast.LENGTH_LONG).show();
                    }
                }
        );

        Volley.newRequestQueue(this).add(stringRequest);

    }

    // To set simple images
    ImageListener imageListener = new ImageListener() {
        @Override
        public void setImageForPosition(int position, ImageView imageView) {

            //Picasso.with(getApplicationContext()).load(sampleNetworkImageURLs[position]).placeholder(sampleImages[0]).error(sampleImages[3]).fit().centerCrop().into(imageView);

            imageView.setImageResource(sampleImages[position]);
        }
    };

    // To set custom views
    ViewListener viewListener = new ViewListener() {
        @Override
        public View setViewForPosition(int position) {

            View customView = getLayoutInflater().inflate(R.layout.view_custom, null);

            ImageView fruitImageView = (ImageView) customView.findViewById(R.id.fruitImageView);

            fruitImageView.setImageResource(sampleImages[position]);

            carouselView.setIndicatorGravity(Gravity.CENTER_HORIZONTAL|Gravity.BOTTOM);

            return customView;
        }
    };

    @Override
    public void onValueChange(NumberPicker picker, int oldVal, int newVal) {

        Log.i("value is",""+newVal);

    }
}
