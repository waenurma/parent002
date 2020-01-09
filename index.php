<?php
//echo 'ทำไงดี';

$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'exRwq1i1noogIKE8x9QpmYH8PlQQdSvCjBEeoQfy+sCbKkLHNV3Kol5ZxfuCebtuRyHunNm6/KGAVw+uDgy6GQEAeKsAhLGAIpJCYMLvxVWVX2b4o8DN0z03MVgp1TC2JsjIEQPXRqWxua9JrPIVfwdB04t89/1O/w1cDnyilFU=';
$channelSecret = 'aa79f5f6f04e775f836bf54644526aed';
$content = file_get_contents('php://input'); // Get request content
$arrJson = json_decode($content, true);
$arrPostData = array();

$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);
//ส่งidผู้ใช้
if ($arrJson['events'][0]['message']['text'] == "สวัสดี") {
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "สวัสดี ID คุณคือ" . $arrJson['events'][0]['source']['userId'];

//ส่งบัตรปชช
} else if ($arrJson['events'][0]['message']['text'] == "1959900506758") {
    $arrPostData = array();
    $data = $arrJson['events'][0]['message']['text'];

    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = strlen($data); //เป็นการนับ

//เลขสมาชิก
} else if ($arrJson['events'][0]['message']['text'] == "1234567890") {
    $arrPostData = array();
    $data = $arrJson['events'][0]['message']['text'];
    $cutstring = substr($data, 5, 10); //เป็นการตัดข้อความ

    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = $cutstring;

    //ตอบตรงคำถาม
} else if ($arrJson['events'][0]['message']['text'] == "ทำอะไรได้บ้าง") {
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "ฉันทำอะไรไม่ได้เลย คุณต้องสอนฉันอีกเยอะ";

    //ตอบกลับที่เราพิมพ์

} else if ($arrJson['events'][0]['message']['text'] == "เหมืนเดิม") {
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = $arrJson['events'][0]['message']['text'];

    //ถ้าข้อความไม่ตรงเงือนไขทั้งหมดจะตอบเงือนไขสุดท้าย

} else {
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "กรอกข้อมูลไม่ถูกต้องกรุณา กรอกข้อมูลใหม่!!!";

}
// -----------------------------------------------------------------------------------------------------

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $API_URL);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $POST_HEADER);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);
