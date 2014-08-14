package com.tippingcanoe.piratinviaggio;

import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.content.IntentFilter;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.util.AttributeSet;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import com.amazon.device.messaging.ADM;

public class MyActivity extends ActionBarActivity {

	private BroadcastReceiver msgReceiver = new BroadcastReceiver() {
		@Override
		public void onReceive ( Context context, Intent intent ) {
			Log.i("PUSH", "Received");
		}
	};

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_my);

	    final ADM adm = new ADM(this);
	    if (adm.getRegistrationId() == null)
		    adm.startRegister();
	    else
		    Log.v("PUSH", "Already reg " + adm.getRegistrationId());
    }



	@Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.my, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();
        if (id == R.id.action_settings) {
            return true;
        }
        return super.onOptionsItemSelected(item);
    }

	@Override
	protected void onPause () {
		super.onPause();
		unregisterReceiver(msgReceiver);
	}

	@Override
	protected void onResume () {
		super.onResume();
		IntentFilter intentFilter = new IntentFilter("com.tippingcanoe.piratinviaggio.ON_MESSAGE");
		intentFilter.addCategory("com.tippingcanoe.piratinviaggio");
		registerReceiver(msgReceiver, intentFilter);
	}
}
