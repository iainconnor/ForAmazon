<?php

	define("REGISTRATION_ID", "amzn1.adm-registration.v2.Y29tLmFtYXpvbi5EZXZpY2VNZXNzYWdpbmcuUmVnaXN0cmF0aW9uSWRFbmNyeXB0aW9uS2V5ITEhOEhKeWJFM29xZHh1N3pML1d6N2dTRFJ5WlFoM3lXbWt5Ym16UDhWR1ZIQ1ZpNmRweE9qQzhTZFlvRi8yYWxwb0VQQTZuN0JsK1pJcUlKRmVWYnE5V2lYWCszbzdaR1Y5MlFHSytYeE02VjIwWWRKc1JmQ3NWczg5VmNtL0gwRWN3Q3hZU0gzNVZvTjFPZ1pWK3NzMkN3WEZlL2VWTDBOajhpUEdkMWQzNTRnc3lEN1Y0TFl0eEZDaGQxT0RCemZHQ1NVMnltSmJRYzFVVVc1amNvZlFNTDJ2QWthdTZVWFA1dUtuSTl4aDJqLzcyUWRlcWgxMFNHc043VjJ4eXIzTVFuT1dqQ3BZd21Nd3RKWmhhd1RzRDV4elJvZkFBVC9GcnZEV2grWFVlSUk9IVVlTWs2VlE5eHBXcytpb1I0SEtzNHc9PQ");
	define("CLIENT_ID", "amzn1.application-oa2-client.671f7012b77a4ea385afd0a8b780a4bc");
	define("CLIENT_SECRET", "**REMOVED**");

	function getAccessToken($clientId, $clientSecret) {
		$headers = array(
            'Content-Type: application/x-www-form-urlencoded'
        );

        $fields = array(
        	'grant_type' => 'client_credentials',
        	'scope' => 'messaging:push',
        	'client_id' => $clientId,
        	'client_secret' => $clientSecret
        );

		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.amazon.com/auth/O2/token");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));

        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Problem occurred: ' . curl_error($ch));
        }

        curl_close($ch);
        return json_decode($result);
	}

	function sendMessage($registrationId, $message, $token) {
		$headers = array(
            'Content-Type: application/json',
            'X-Amzn-Type-Version: com.amazon.device.messaging.ADMMessage@1.0',
            'Accept: application/json',
            'X-Amzn-Accept-Type: com.amazon.device.messaging.ADMSendResult@1.0',
            'Authorization: Bearer ' . $token->access_token
        );

        $fields = array(
        	"data" => $message,
		    "consolidationKey" => "Some Key",
		    "expiresAfter" => 86400
        );

		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.amazon.com/messaging/registrations/$registrationId/messages");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Problem occurred: ' . curl_error($ch));
        }

        curl_close($ch);
        var_dump($result);
	}

	$token = getAccessToken(CLIENT_ID, CLIENT_SECRET);
	sendMessage(REGISTRATION_ID, array("foo" => "bar"), $token);
