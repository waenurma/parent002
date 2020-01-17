<?php
    
    $accessToken = "exRwq1i1noogIKE8x9QpmYH8PlQQdSvCjBEeoQfy+sCbKkLHNV3Kol5ZxfuCebtuRyHunNm6/KGAVw+uDgy6GQEAeKsAhLGAIpJCYMLvxVWVX2b4o8DN0z03MVgp1TC2JsjIEQPXRqWxua9JrPIVfwdB04t89/1O/w1cDnyilFU=";//copy Channel access token ตอนที่ตั้งค่ามาใส่
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
    
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
   // ---------------------------------------------เลขสมาชิก---------------------------------------------
}else if($arrJson['events'][0]['message']['text'] == $arrJson['events'][0]['message']['text']   && strlen($arrJson['events'][0]['message']['text'])== "10"){
    $data=$arrJson['events'][0]['message']['text'];
    $T_data=substr($data, 0 ,3 ); //เป็นการตัดข้อความ เลือกใช้ตำเเหน่งไหนที่ต้องการ
    $F_data=substr($data, 5 ,10 ); 
    
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "เลขสมาชิกของคุณ คือ".  $T_data.$F_data;
    
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