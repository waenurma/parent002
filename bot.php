<?php
 
    $strAccessToken = '072ioqcw4uT17+qwjIDmsn4XlTguP6hRKZjWyJf2nu5tFaheu0baLx26OQ3K5II9RyHunNm6/KGAVw+uDgy6GQEAeKsAhLGAIpJCYMLvxVW4aCCAL4XClCPZUtKmZzjBM5mOHHi5w8jFzTfgnDVFc1GUYhWQfeY8sLGRXgo3xvw=';
    $channelSecret = '157d1d03926e37e516f42f5e9a44af73';
    $content = file_get_contents('php://input');
    $arrJson = json_decode($content, true);
    $strUrl = "https://api.line.me/v2/bot/message/reply";

    $arrHeader = array();
    $arrHeader[] = "Content-Type: application/json";
    $arrHeader[] = "Authorization: Bearer {$strAccessToken}";

if($arrJson['events'][0]['message']['text'] == "ID"||$arrJson['events'][0]['message']['text'] == "id"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "สวัสดี ID คุณคือ ".$arrJson['events'][0]['source']['userId'];
   
}else if($arrJson['events'][0]['message']['text'] == "สวัสดี" ||$arrJson['events'][0]['message']['text'] == "สวัสดีค่ะ" || $arrJson['events'][0]['message']['text'] == "สวัสดีคะ"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "สวัสดีจ้าาาา มีอะไรให้เราช่วยไหมค่ะ ";  //.$arrJson['events'][0]['source']['userId'];

}else if($arrJson['events'][0]['message']['text'] == "สวัสดีคับ" ||$arrJson['events'][0]['message']['text'] == "สวัสดีครับ"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "สวัสดีจ้าาาา มีอะไรให้เราช่วยไหมค่ะ";

}else if($arrJson['events'][0]['message']['text'] == "สวัสดีจ่ะ"|| $arrJson['events'][0]['message']['text'] == "สวัสดีจร้า"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "สวัสดีจ้าาาา มีอะไรให้เราช่วยไหมค่ะ";

//////////////////ขอบคุณ
}else if($arrJson['events'][0]['message']['text'] == "ขอบคุณ" ||$arrJson['events'][0]['message']['text'] == "ขอบคุณค่ะ"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "ยินดีจร้าาา";
    $arrPostData['messages'][1]['type'] = "sticker";
    $arrPostData['messages'][1]['packageId'] = "1";
    $arrPostData['messages'][1]['stickerId'] = "4";

}else if($arrJson['events'][0]['message']['text'] == "ขอบคุณคะ"||$arrJson['events'][0]['message']['text'] == "ขอบคุณจ่ะ"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "ยินดีจร้าาา";
    $arrPostData['messages'][1]['type'] = "sticker";
    $arrPostData['messages'][1]['packageId'] = "1";
    $arrPostData['messages'][1]['stickerId'] = "4";

}else if($arrJson['events'][0]['message']['text'] == "ขอบคุณครับ" || $arrJson['events'][0]['message']['text'] == "ขอบคุณคับ"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "ยินดีจร้าาา";
    $arrPostData['messages'][1]['type'] = "sticker";
    $arrPostData['messages'][1]['packageId'] = "1";
    $arrPostData['messages'][1]['stickerId'] = "4";    

}else if($arrJson['events'][0]['message']['text'] == "ใจจ่ะ"||$arrJson['events'][0]['message']['text'] == "ขอบใจคับ"||$arrJson['events'][0]['message']['text'] == "ขอบใจครับ"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "ยินดีจร้าาา";
    $arrPostData['messages'][1]['type'] = "sticker";
    $arrPostData['messages'][1]['packageId'] = "1";
    $arrPostData['messages'][1]['stickerId'] = "4";

}else if($arrJson['events'][0]['message']['text'] == "ขอบใจจ่ะ" ||$arrJson['events'][0]['message']['text'] == "ขอบใจจร้า" || $arrJson['events'][0]['message']['text'] == "ใจจร้า"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "ยินดีจร้าาา";
    $arrPostData['messages'][1]['type'] = "sticker";
    $arrPostData['messages'][1]['packageId'] = "1";
    $arrPostData['messages'][1]['stickerId'] = "4"; 


//-----------------------เมนู--------------------------
}else if($arrJson['events'][0]['message']['text'] == "ตารางเรียน" ){
    require "timetable.php";

}else if($arrJson['events'][0]['message']['text'] == "การบ้าน" ){
    require "homework.php";

}else if($arrJson['events'][0]['message']['text'] == "เป๋าตังค์" ||$arrJson['events'][0]['message']['text'] == "ค่าใช้จ่าย" ){
    require "vollet.php";
   ////ผลเรียนแบบflexตัวใหญ่
}else if($arrJson['events'][0]['message']['text'] == "เกรด"||$arrJson['events'][0]['message']['text'] == "ผลการเรียน" ){
    require "flex.php";
}else if($arrJson['events'][0]['message']['text'] == "a" ){
    require "test.php";


 /////--------------ทั่วไป ข่าว ทอง ราคาน้ำมัน   อากาศ----------------------
}else if($arrJson['events'][0]['message']['text'] == "ทอง"||$arrJson['events'][0]['message']['text'] == "ราคาทอง"  ){
    require "gold.php";

}else if($arrJson['events'][0]['message']['text'] == "น้ำมัน"||$arrJson['events'][0]['message']['text'] == "ราคาน้ำมัน"  ){
    require "oil.php";

}else if($arrJson['events'][0]['message']['text'] == "ข่าว"||$arrJson['events'][0]['message']['text'] == "ข่าวสาร"  ){
    require "news.php";   

}else if($arrJson['events'][0]['message']['text'] == "ฝนฟ้าอากาศ"||$arrJson['events'][0]['message']['text'] == "พยากรณ์อากาศ"  ){
    require "weather.php";   


   //////////////////////////////////////ดักคำแปลกๆ/////////////////////////////////////////////////
}else{
    $a=array("ถามอย่างนี้ บอทตั้งตัวไม่ทันเลยว่าจะตอบคำนี้ว่าไง","ขอโทษครับ บอทยังไม่เข้าใจคำถาม","ลองพิมพ์ใหม่อีกครั้ง หรือเลือกเมนูด้านล่างได้นะครับ 🙇","บอทไม่มีคำตอบสำหรับคำถามนี้ ","ไม่แน่ใจว่าเข้าใจถูกมั๊ย","นั้นคงอยู่นอกเหนือความสามารถของบอทตอนนี้"); //บอทไม่มีคำตอบสำหรับคำถามนี มีอะไรอย่างอื่นให้บอทช่วยไหม?
    $random_keys=array_rand($a,2);
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = $a[$random_keys[0]];
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