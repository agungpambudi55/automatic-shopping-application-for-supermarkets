package com.unity.autrom;

import android.content.Intent;
import android.graphics.Color;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.MenuItem;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.miguelcatalan.materialsearchview.MaterialSearchView;
import com.unity.autrom.App.AppConfig;


public class MapProductActivity extends AppCompatActivity {

    private Toolbar toolbar;
    private MaterialSearchView searchView;
    private TextView textViewA;
    private LinearLayout layouta1, layouta2, layouta3, layouta4, layouta5, layouta6, layouta7, layouta8, layouta9, layouta10;
    private LinearLayout layoutb1, layoutb2, layoutb3, layoutb4, layoutb5, layoutb6, layoutb7, layoutb8, layoutb9, layoutb10;
    private LinearLayout layoutc1, layoutc2, layoutc3, layoutc4, layoutc5, layoutc6, layoutc7, layoutc8, layoutc9, layoutc10;
    private LinearLayout layoutd1, layoutd2, layoutd3, layoutd4, layoutd5, layoutd6, layoutd7, layoutd8, layoutd9, layoutd10;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_map_product);
        setTitle("Lokasi Produk");

        getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        textViewA = (TextView) findViewById(R.id.result);
        layouta1 = (LinearLayout) findViewById(R.id.a1);
        layouta2 = (LinearLayout) findViewById(R.id.a2);
        layouta3 = (LinearLayout) findViewById(R.id.a3);
        layouta4 = (LinearLayout) findViewById(R.id.a4);
        layouta5 = (LinearLayout) findViewById(R.id.a5);
        layouta6 = (LinearLayout) findViewById(R.id.a6);
        layouta7 = (LinearLayout) findViewById(R.id.a7);
        layouta8 = (LinearLayout) findViewById(R.id.a8);
        layouta9 = (LinearLayout) findViewById(R.id.a9);
        layouta10 = (LinearLayout) findViewById(R.id.a10);
        layoutb1 = (LinearLayout) findViewById(R.id.b1);
        layoutb2 = (LinearLayout) findViewById(R.id.b2);
        layoutb3 = (LinearLayout) findViewById(R.id.b3);
        layoutb4 = (LinearLayout) findViewById(R.id.b4);
        layoutb5 = (LinearLayout) findViewById(R.id.b5);
        layoutb6 = (LinearLayout) findViewById(R.id.b6);
        layoutb7 = (LinearLayout) findViewById(R.id.b7);
        layoutb8 = (LinearLayout) findViewById(R.id.b8);
        layoutb9 = (LinearLayout) findViewById(R.id.b9);
        layoutb10 = (LinearLayout) findViewById(R.id.b10);
        layoutc1 = (LinearLayout) findViewById(R.id.c1);
        layoutc2 = (LinearLayout) findViewById(R.id.c2);
        layoutc3 = (LinearLayout) findViewById(R.id.c3);
        layoutc4 = (LinearLayout) findViewById(R.id.c4);
        layoutc5 = (LinearLayout) findViewById(R.id.c5);
        layoutc6 = (LinearLayout) findViewById(R.id.c6);
        layoutc7 = (LinearLayout) findViewById(R.id.c7);
        layoutc8 = (LinearLayout) findViewById(R.id.c8);
        layoutc9 = (LinearLayout) findViewById(R.id.c9);
        layoutc10 = (LinearLayout) findViewById(R.id.c10);
        layoutd1 = (LinearLayout) findViewById(R.id.d1);
        layoutd2 = (LinearLayout) findViewById(R.id.d2);
        layoutd3 = (LinearLayout) findViewById(R.id.d3);
        layoutd4 = (LinearLayout) findViewById(R.id.d4);
        layoutd5 = (LinearLayout) findViewById(R.id.d5);
        layoutd6 = (LinearLayout) findViewById(R.id.d6);
        layoutd7 = (LinearLayout) findViewById(R.id.d7);
        layoutd8 = (LinearLayout) findViewById(R.id.d8);
        layoutd9 = (LinearLayout) findViewById(R.id.d9);
        layoutd10 = (LinearLayout) findViewById(R.id.d10);


        Intent intent = getIntent();
        String blok = intent.getStringExtra("blok");
        String sekat = intent.getStringExtra("sekat");

        String lokasi = blok + sekat;

        Log.d(AppConfig.LOG, "lokasi "+ lokasi);

        switch (lokasi){
            case "A1":
                layouta1.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "A2":
                layouta2.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "A3":
                layouta3.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "A4":
                layouta4.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "A5":
                layouta5.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "A6":
                layouta6.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "A7":
                layouta7.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "A8":
                layouta8.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "A9":
                layouta9.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "A10":
                layouta10.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "B1":
                layoutb1.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "B2":
                layoutb2.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "B3":
                layoutb3.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "B4":
                layoutb4.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "B5":
                layoutb5.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "B6":
                layoutb6.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "B7":
                layoutb7.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "B8":
                layoutb8.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "B9":
                layoutb9.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "B10":
                layoutb10.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "C1":
                layoutc1.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "C2":
                layoutc2.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "C3":
                layoutc3.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "C4":
                layoutc4.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "C5":
                layoutc5.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "C6":
                layoutc6.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "C7":
                layoutc7.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "C8":
                layoutc8.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "C9":
                layoutc9.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "C10":
                layoutc10.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "D1":
                layoutd1.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "D2":
                layoutd2.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "D3":
                layoutd3.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "D4":
                layoutd4.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "D5":
                layoutd5.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "D6":
                layoutd6.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "D7":
                layoutd7.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "D8":
                layoutd8.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "D9":
                layoutd9.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            case "D10":
                layoutd10.setBackgroundColor(Color.parseColor("#ff5722"));
                break;
            default:
                break;
        }

    }

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
        }
        return super.onOptionsItemSelected(item);
    }


}
