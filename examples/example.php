<?php
include(dirname(__DIR__).'/php_http_client/client.php');

$myfile = fopen(dirname(__DIR__).'/.env', "r");
$env = fgets($myfile);
$env = explode('=', $env);
$api_key = $env[1];
$api_key = trim(preg_replace('/\s+/', ' ', $api_key));
$headers = array(
    'Content-Type: application/json',
    'Authorization: Bearer '.$api_key
);
$client = new Client("https://e9sk3d3bfaikbpdq7.stoplight-proxy.io", $headers, "3", null);

# GET Collection
$query_params = array('limit' => 100, 'offset' => 0);
$request_headers = array('X-Mock: 200');
$response = $client->api_keys()->get(null, $query_params, $request_headers);
echo $response->status_code();
echo $response->response_body();
echo $response->response_headers();

# POST
$request_body = array(
        'name' => 'My PHP API Key',
        'scopes' => array(
            'mail.send',
            'alerts.create',
            'alerts.read'
        )
);
$response = $client->api_keys()->post($request_body);
echo $response->status_code();
echo $response->response_body();
echo $response->response_headers();
$response_body = json_decode($response->response_body());
$api_key_id = $response_body->api_key_id;

# GET Single
$response = $client->version('3')->api_keys()->_($api_key_id)->get();
echo $response->status_code();
echo $response->response_body();
echo $response->response_headers();

# PATCH
$request_body = array(
        'name' => 'A New Hope'
);
$response = $client->api_keys()->_($api_key_id)->patch($request_body);
echo $response->status_code();
echo $response->response_body();
echo $response->response_headers();

# PUT
$request_body = array(
        'name' => 'A New Hope',
        'scopes' => array(
            'user.profile.read',
            'user.profile.update'
        )
);
$response = $client->api_keys()->_($api_key_id)->put($request_body);
echo $response->status_code();
echo $response->response_body();
echo $response->response_headers();

# DELETE
$response = $client->api_keys()->_($api_key_id)->delete();
echo $response->status_code();
echo $response->response_body();
echo $response->response_headers();

?>