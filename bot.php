<?php

$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'exRwq1i1noogIKE8x9QpmYH8PlQQdSvCjBEeoQfy+sCbKkLHNV3Kol5ZxfuCebtuRyHunNm6/KGAVw+uDgy6GQEAeKsAhLGAIpJCYMLvxVWVX2b4o8DN0z03MVgp1TC2JsjIEQPXRqWxua9JrPIVfwdB04t89/1O/w1cDnyilFU=';
$channelSecret = 'aa79f5f6f04e775f836bf54644526aed';

$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php://input'); // Get request content
//$request_array = json_decode($request, true); // Decode JSON to Array
