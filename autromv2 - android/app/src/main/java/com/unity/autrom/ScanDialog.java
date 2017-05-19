package com.unity.autrom;

import android.app.Dialog;
import android.content.Context;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.widget.EditText;

public class ScanDialog extends Dialog {

    public interface DialogEvent{
        public void OnTextMax(String text);
    }

    private EditText scanNumber;
    private DialogEvent event;

    public ScanDialog(Context context, DialogEvent event) {
        super(context);
        setTitle("Autrom");
        this.event = event;
    }

    public ScanDialog(Context context, int themeResId) {
        super(context, themeResId);
    }

    protected ScanDialog(Context context, boolean cancelable, OnCancelListener cancelListener) {
        super(context, cancelable, cancelListener);
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.dialog_scan);

        scanNumber = (EditText) findViewById(R.id.scan_code);
        scanNumber.addTextChangedListener(new TextWatcher() {
            @Override
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {

            }

            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {

            }

            @Override
            public void afterTextChanged(Editable s) {
//                if (scanNumber.getText().toString().length() == 12){
//                    if (event != null)
//                        event.OnTextMax(scanNumber.getText().toString());
//                    dismiss();
//                }else

                if ((scanNumber.getText().toString().length() == 13) || (scanNumber.getText().toString().length() == 12) ){
                    if (event != null)
                        event.OnTextMax(scanNumber.getText().toString());
                    dismiss();
                }
            }
        });


    }
}
