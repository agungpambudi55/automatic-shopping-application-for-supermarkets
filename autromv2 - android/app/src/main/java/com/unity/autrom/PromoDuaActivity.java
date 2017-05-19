package com.unity.autrom;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;

public class PromoDuaActivity extends AppCompatActivity {

    private Button btn_lokasi;
    private ImageView imageViewlokasi, imageViewlokasi2;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_promo_dua);
        setTitle("Promo");

        getSupportActionBar().setDisplayHomeAsUpEnabled(true);


        btn_lokasi = (Button) findViewById(R.id.lihat_lokasi);
        imageViewlokasi = (ImageView) findViewById(R.id.promo1);
        imageViewlokasi2 = (ImageView) findViewById(R.id.promo2);

        btn_lokasi.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                Intent i = new Intent(PromoDuaActivity.this, MapProductActivity.class);
                i.putExtra("blok", "D");
                i.putExtra("sekat", "5");
                startActivity(i);
            }
        });

        imageViewlokasi.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(PromoDuaActivity.this, MapProductActivity.class);
                i.putExtra("blok", "C");
                i.putExtra("sekat", "7");
                startActivity(i);
            }
        });

        imageViewlokasi2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(PromoDuaActivity.this, MapProductActivity.class);
                i.putExtra("blok", "D");
                i.putExtra("sekat", "6");
                startActivity(i);
            }
        });

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
        }else if (id == android.R.id.icon_frame){
            return true;
        }
        return super.onOptionsItemSelected(item);
    }
}
