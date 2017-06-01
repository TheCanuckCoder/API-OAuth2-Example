<?php
$fields_string = '';
$fields = array(
	'grant_type' => 'client_credentials'
);
foreach($fields as $key=>$value) {
	$fields_string .= $key . '=' . $value . '&';
}
rtrim($fields_string, '&');
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,'http://courses.dev/OAuth2/token.php');
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,5);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_USERPWD, "testclient:testpass");
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
$buffer = curl_exec($ch);
curl_close($ch);
$response = json_decode($buffer);
print_r($response);

echo '<br><br>';

$fields_string = '';
$fields = array(
	'access_token' => $response->access_token
);
foreach($fields as $key=>$value) {
	$fields_string .= $key . '=' . $value . '&';
}
rtrim($fields_string, '&');
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,'http://courses.dev/OAuth2/resource.php');
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,5);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
$buffer = curl_exec($ch);
curl_close($ch);
print_r($buffer);