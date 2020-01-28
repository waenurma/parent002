<?php
 
$strAccessToken = "m7uuiyQihjxD2Po3jFwWxjslOwuw1T/ODORXy1vPsFQ2XuUHVVj5Sk9sHQNhdNjMRyHunNm6/KGAVw+uDgy6GQEAeKsAhLGAIpJCYMLvxVU3EgejzBxajVyv30+aa3gPxAtxAgL7ertukDN7srPvXFGUYhWQfeY8sLGRXgo3xvw=";//copy Channel access token ตอนที่ตั้งค่ามาใส่;
$channelSecret = '1e9a50e53936e05409b5095cabc4ac2b';
$content = file_get_contents('php://input');
$arrJson = json_decode($content, true);
$strUrl = "https://api.line.me/v2/bot/message/reply";

$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";
 
if($arrJson['events'][0]['message']['text'] == "สวัสดี"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "สวัสดีจ้าาาา $text มีอะไรให้เราช่วยไหมค่ะ ";  //.$arrJson['events'][0]['source']['userId'];

}else if($arrJson['events'][0]['message']['text'] == "สวัสดีค่ะ"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "สวัสดีจ้าาาา มีอะไรให้เราช่วยไหมค่ะ";

}else if($arrJson['events'][0]['message']['text'] == "สวัสดีคะ"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "สวัสดีจ้าาาา มีอะไรให้เราช่วยไหมค่ะ";

}else if($arrJson['events'][0]['message']['text'] == "สวัสดีคับ"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "สวัสดีจ้าาาา มีอะไรให้เราช่วยไหมค่ะ";

}else if($arrJson['events'][0]['message']['text'] == "สวัสดีครับ"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "สวัสดีจ้าาาา มีอะไรให้เราช่วยไหมค่ะ";

}else if($arrJson['events'][0]['message']['text'] == "สวัสดีจ่ะ"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "สวัสดีจ้าาาา มีอะไรให้เราช่วยไหมค่ะ";

}else if($arrJson['events'][0]['message']['text'] == "สวัสดีจ่ะ"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "สวัสดีจ้าาาา มีอะไรให้เราช่วยไหมค่ะ";


//////////////////ขอบคุณ
}else if($arrJson['events'][0]['message']['text'] == "ขอบคุณ"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "ยินดีจร้าาา";
  $arrPostData['messages'][1]['type'] = "sticker";
  $arrPostData['messages'][1]['packageId'] = "1";
  $arrPostData['messages'][1]['stickerId'] = "4";

}else if($arrJson['events'][0]['message']['text'] == "ขอบคุณค่ะ"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "ยินดีจร้าาา";
    $arrPostData['messages'][1]['type'] = "sticker";
    $arrPostData['messages'][1]['packageId'] = "1";
    $arrPostData['messages'][1]['stickerId'] = "4";

}else if($arrJson['events'][0]['message']['text'] == "ขอบคุณคะ"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "ยินดีจร้าาา";
    $arrPostData['messages'][1]['type'] = "sticker";
    $arrPostData['messages'][1]['packageId'] = "1";
    $arrPostData['messages'][1]['stickerId'] = "4";


}else if($arrJson['events'][0]['message']['text'] == "ขอบคุณจ่ะ"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "ยินดีจร้าาา";
    $arrPostData['messages'][1]['type'] = "sticker";
    $arrPostData['messages'][1]['packageId'] = "1";
    $arrPostData['messages'][1]['stickerId'] = "4";

}else if($arrJson['events'][0]['message']['text'] == "ขอบคุณครับ"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "ยินดีจร้าาา";
    $arrPostData['messages'][1]['type'] = "sticker";
    $arrPostData['messages'][1]['packageId'] = "1";
    $arrPostData['messages'][1]['stickerId'] = "4";    

}else if($arrJson['events'][0]['message']['text'] == "ขอบคุณคับ"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "ยินดีจร้าาา";
    $arrPostData['messages'][1]['type'] = "sticker";
    $arrPostData['messages'][1]['packageId'] = "1";
    $arrPostData['messages'][1]['stickerId'] = "4";    

}else if($arrJson['events'][0]['message']['text'] == "ใจจ่ะ"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "ยินดีจร้าาา";
    $arrPostData['messages'][1]['type'] = "sticker";
    $arrPostData['messages'][1]['packageId'] = "1";
    $arrPostData['messages'][1]['stickerId'] = "4";

}else if($arrJson['events'][0]['message']['text'] == "ขอบใจคับ"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "ยินดีจร้าาา";
    $arrPostData['messages'][1]['type'] = "sticker";
    $arrPostData['messages'][1]['packageId'] = "1";
    $arrPostData['messages'][1]['stickerId'] = "4";    

}else if($arrJson['events'][0]['message']['text'] == "ขอบใจครับ"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "ยินดีจร้าาา";
    $arrPostData['messages'][1]['type'] = "sticker";
    $arrPostData['messages'][1]['packageId'] = "1";
    $arrPostData['messages'][1]['stickerId'] = "4";     

}else if($arrJson['events'][0]['message']['text'] == "ขอบใจจ่ะ"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "ยินดีจร้าาา";
    $arrPostData['messages'][1]['type'] = "sticker";
    $arrPostData['messages'][1]['packageId'] = "1";
    $arrPostData['messages'][1]['stickerId'] = "4"; 

}else if($arrJson['events'][0]['message']['text'] == "ขอบใจจร้า"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "ยินดีจร้าาา";
    $arrPostData['messages'][1]['type'] = "sticker";
    $arrPostData['messages'][1]['packageId'] = "1";
    $arrPostData['messages'][1]['stickerId'] = "4";    
//////////////////เมนู6เมนู

}else if($arrJson['events'][0]['message']['text'] == "ตารางเรียน"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "กรุณาตรวจสอบบนสมาร์ทโฟน";

}else if($arrJson['events'][0]['message']['text'] == "ผลการเรียน"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "กรุณาตรวจสอบบนสมาร์ทโฟน";
    
    
    
    // $replyjson['type'] = 'text'
    // $replyjson['text'] = '1234'
    // json_encode($replyjson)

}else if($arrJson['events'][0]['message']['text'] == "การเรียนการสอน"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "การเรียนการสอนตรงนี้จะทำให้ลิงค์หน้าเว็บสามารถดูเนื้อหาที่เรียน";

}else if($arrJson['events'][0]['message']['text'] == "การบ้าน"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "การบ้านตรงนี้จะทำให้ลิงค์หน้าเว็บสามารถดูการบ้าน";

}else if($arrJson['events'][0]['message']['text'] == "ค่าใช้จ่าย"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "จะทำแบบลิงค์แล้วดูยอดที่ต้องชำระหรือค่าเทอมค่าใช้จ่ายต่างๆ";

}else if($arrJson['events'][0]['message']['text'] == "กิจกรรม"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "จะเป็นแบบลิงค์ไปแล้วแสดงว่ามีกิจกรรมอะไรบ้าง";



    /////ดักคำแปลกๆ
}else{
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "ฉันไม่เข้าใจคำสั่ง";
}


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
exit;               


?>