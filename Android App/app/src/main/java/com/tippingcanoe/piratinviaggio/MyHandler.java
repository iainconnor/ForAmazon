/*
 * [ADMMessenger]
 *
 * (c) 2012, Amazon.com, Inc. or its affiliates. All Rights Reserved.
 */

package com.tippingcanoe.piratinviaggio;

import java.util.HashMap;
import java.util.Map;
import java.util.Set;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.content.Context;
import android.app.Notification;
import android.app.Notification.Builder;
import android.app.NotificationManager;
import android.app.PendingIntent;

import com.amazon.device.messaging.ADMConstants;
import com.amazon.device.messaging.ADMMessageHandlerBase;
import com.amazon.device.messaging.ADMMessageReceiver;

public class MyHandler extends ADMMessageHandlerBase {

	public static class MessageAlertReceiver extends ADMMessageReceiver
	{
		public MessageAlertReceiver()
		{
			super(MyHandler.class);
		}
	}

	public MyHandler()
	{
		super(MyHandler.class.getName());
	}

	public MyHandler(final String className)
	{
		super(className);
	}

	@Override
	protected void onMessage(final Intent intent)
	{
		Log.i("PUSH", "Message");
	}

	@Override
	protected void onRegistrationError(final String string)
	{
		Log.e("PUSH", "RegError " + string);
	}

	@Override
	protected void onRegistered(final String registrationId)
	{
		Log.i("PUSH", "REG " + registrationId);
	}

	@Override
	protected void onUnregistered(final String registrationId)
	{
		Log.i("PUSH", "UNREG " + registrationId);
	}
}
