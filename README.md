* I've created a simplifed version of the app here -- https://github.com/iainconnor/ForAmazon/tree/master/Android%20App -- (note that I've removed my keystore information from the gradle build file)
* A signed APK of that test file is available here -- https://github.com/iainconnor/ForAmazon/blob/master/APK/app-release.apk
* I've extracted that APK and double checked that the MD5 is correct;
	keytool -printcert -file CERT.RSA
	Owner: CN=Varun Mehra, OU=Urlaubspiraten, O=Urlaubspiraten, L=Winnipeg, ST=Manitoba, C=CA
	Issuer: CN=Varun Mehra, OU=Urlaubspiraten, O=Urlaubspiraten, L=Winnipeg, ST=Manitoba, C=CA
	Serial number: 5081888a
	Valid from: Fri Oct 19 12:06:18 CDT 2012 until: Tue Oct 13 12:06:18 CDT 2037
	Certificate fingerprints:
		 MD5:  8A:7A:20:BF:96:38:BC:70:1A:F2:F4:38:E8:65:F5:38
		 SHA1: D1:FD:0E:57:14:D6:0A:4B:0B:4F:D9:D5:5D:18:24:28:D5:E5:81:D9
		 SHA256: 61:DF:E3:2B:01:BA:D5:55:1F:D5:D3:B0:0F:CC:B1:F8:CA:3D:0B:EE:51:91:02:F8:14:7E:68:0F:78:31:9B:85
		 Signature algorithm name: SHA1withRSA
		 Version: 3
* When I run that application on one of my test devices, I get in the logged output;
	I/PUSH﹕ REG amzn1.adm-registration.v2.Y29tLmFtYXpvbi5EZXZpY2VNZXNzYWdpbmcuUmVnaXN0cmF0aW9uSWRFbmNyeXB0aW9uS2V5ITEhOEhKeWJFM29xZHh1N3pML1d6N2dTRFJ5WlFoM3lXbWt5Ym16UDhWR1ZIQ1ZpNmRweE9qQzhTZFlvRi8yYWxwb0VQQTZuN0JsK1pJcUlKRmVWYnE5V2lYWCszbzdaR1Y5MlFHSytYeE02VjIwWWRKc1JmQ3NWczg5VmNtL0gwRWN3Q3hZU0gzNVZvTjFPZ1pWK3NzMkN3WEZlL2VWTDBOajhpUEdkMWQzNTRnc3lEN1Y0TFl0eEZDaGQxT0RCemZHQ1NVMnltSmJRYzFVVVc1amNvZlFNTDJ2QWthdTZVWFA1dUtuSTl4aDJqLzcyUWRlcWgxMFNHc043VjJ4eXIzTVFuT1dqQ3BZd21Nd3RKWmhhd1RzRDV4elJvZkFBVC9GcnZEV2grWFVlSUk9IVVlTWs2VlE5eHBXcytpb1I0SEtzNHc9PQ
* I've written a small test script to attempt sending a push to that application, which I've uploaded here -- https://github.com/iainconnor/ForAmazon/blob/master/Push%20Script/test-amazon.php -- (note that I've removed my client secret)
* If I run that test script, I receive the following message;
	php ./test-amazon.php
	string(50) "{"message":null,"reason":"InvalidRegistrationId"}"
* To ensure I'm not getting a false positive, if I swap out the client id, client secret, and the registration id to one generated by any of our other applications, things work flawlessly. With any other set, I receive a valid message;
	./test-amazon.php
	string(558) "{"registrationID":"amzn1.adm-registration.v2.Y29tLmFtYXpvbi5EZXZpY2VNZXNzYWdpbmcuUmVnaXN0cmF0aW9uSWRFbmNyeXB0aW9uS2V5ITEhanJmRjdaT3ZMLzFuWVUzb0JYcWpOODZNYVBNUmlBN3Nva2hkbmFMeDBiMjdjYkl1dmJmczRJUW9nTnBtbStiL21lTkhQNGJRNXUzcXpNMkRPcTVNeW1uN3hEc3Jqc1FKaFY1blJ6Z1c3U2ZsZWdCSGdRYXNWUm1PdXhyd3ZvS2o0M0Q0MmxlZ1pXVDZGSG5kNEZEekNJbHp1R093OXVadDRxUXJoYlNSR2xTRkx2RE9YZnd5ODFxV0RPdit5L1BxanZmc3A5WFVpa0hWYllzVUxUM2RYcFRxRk9tWnhld2FpMHlqZGExektoZStkQm15Q2s1TFlEZVM0QUw1Tk5lb3lFQnM2ci9ORWF0YzdYMldzaHRZa2JRYXlLT2Z2RU92VGsyWFM5YkhIb0U9ITVQQ3EzaVRWODNaYzZGb0JRKzcyNEE9PQ"}"
