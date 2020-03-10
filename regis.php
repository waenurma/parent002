<?php

$strAccessToken = '072ioqcw4uT17+qwjIDmsn4XlTguP6hRKZjWyJf2nu5tFaheu0baLx26OQ3K5II9RyHunNm6/KGAVw+uDgy6GQEAeKsAhLGAIpJCYMLvxVW4aCCAL4XClCPZUtKmZzjBM5mOHHi5w8jFzTfgnDVFc1GUYhWQfeY8sLGRXgo3xvw=';
$channelSecret = '157d1d03926e37e516f42f5e9a44af73';
$content = file_get_contents('php://input');
$arrJson = json_decode($content, true);
$strUrl = "https://api.line.me/v2/bot/message/reply";

$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";

/*Return HTTP Request 200*/
http_response_code(200);
// --------------------------------------------ส่ง user id--------------------------------------------
if($arrJson['events'][0]['message']['text'] == "สวัสดี"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "สวัสดี ID คุณคือ ".$arrJson['events'][0]['source']['userId'];
// ---------------------------------------------บัตรประชาชน---------------------------------------------
}else if($arrJson['events'][0]['message']['text'] == $arrJson['events'][0]['message']['text']  && strlen($arrJson['events'][0]['message']['text'])== "13"){
  $data=$arrJson['events'][0]['message']['text'];   
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "รหัสบัตรประชาชน คือ".  $data; 
  // $arrPostData['messages'][1]['type'] = "text";
  // $arrPostData['messages'][1]['text'] = "123456789";
  // strlen($data); การนับจำนวน
  
  
// ---------------------------------------------ลงทะเบียน---------------------------------------------
}else if($arrJson['events'][0]['message']['text'] == "ลงทะเบียน"){
  $arrPostData = array();
  $data=$arrJson['events'][0]['message']['text'];
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] ="กรุณากรอกข้อมูลเลขสมาชิก 10 หลัก 
  หรือข้อมูลเลขบัตรประชาชน 13 หลัก ค่ะ";

    
// ---------------------------------------------ลูบสุดท้าย---------------------------------------------
}else{
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "กรอกข้อมูลไม่ถูกต้อง!!! 
กรุณากรอกข้อมูลกรอกข้อมูลเลขสมาชิกหรือเลขบัตรประชาชนอีกครั้ง";
}
// ----------------------------------------------------------------------------------------------------
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$strUrl);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close ($ch);
 
?>