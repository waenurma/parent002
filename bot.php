<?php

$strAccessToken = 'exRwq1i1noogIKE8x9QpmYH8PlQQdSvCjBEeoQfy+sCbKkLHNV3Kol5ZxfuCebtuRyHunNm6/KGAVw+uDgy6GQEAeKsAhLGAIpJCYMLvxVWVX2b4o8DN0z03MVgp1TC2JsjIEQPXRqWxua9JrPIVfwdB04t89/1O/w1cDnyilFU=';
$content = file_get_contents('php://input');
$arrJson = json_decode($content, true);
$strUrl = "https://api.line.me/v2/bot/message/reply";
$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";


/*Return HTTP Request 200*/
http_response_code(200);


// ---------------------------------------------------ส่ง user id---------------------------------------

if($arrJson['events'][0]['message']['text'] == "สวัสดี"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "สวัสดี ID คุณคือ ".$arrJson['events'][0]['source']['userId'];

//---------------------------------------------บัตรประชาชน---------------------------------------------

}else if($arrJson['events'][0]['message']['text'] == "1959900506758"){
  $arrPostData = array();
  $data=$arrJson['events'][0]['message']['text'];

  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = strlen($data); //เป็นการนับ
  


// ---------------------------------------------เลขสมาชิก---------------------------------------------

}else if($arrJson['events'][0]['message']['text'] == "1234567890"){
    $arrPostData = array();
    $data=$arrJson['events'][0]['message']['text'];
    $cutstring=substr($data, 5 ,10 ); //เป็นการตัดข้อความ


    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = $cutstring; 
    
  //-------------------------------------------------ตอบตรงคำถาม------------------------------------------

}else if($arrJson['events'][0]['message']['text'] == "ทำอะไรได้บ้าง"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "ฉันทำอะไรไม่ได้เลย คุณต้องสอนฉันอีกเยอะ";


// --------------------------------------------ตอบกลับที่เราพิมพ์------------------------------------------

}else if($arrJson['events'][0]['message']['text'] == "เหมืนเดิม"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = $arrJson['events'][0]['message']['text'];

// --------------------------ถ้าข้อความไม่ตรงเงือนไขทั้งหมดจะตอบเงือนไขสุดท้าย----------------------------------

}else{
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "กรอกข้อมูลไม่ถูกต้องกรุณา กรอกข้อมูลใหม่!!!";
}



//rich-menu
case (preg_match('/^create-/',$userMessage) ? true : false): // เมื่อพิมพ์คำว่า create- เข้ามา
  $respRichMenu = $bot->createRichMenu(
      new RichMenuBuilder(
          new RichMenuSizeBuilder(1686,2500), // ขนาด rich menu ปกติจะไม่เปลี่ยน แปลง
          true, // เปิดให้แสดง * จะไม่แสดงทันที 
          "Rich Menu 1", // ชื่อ rich menu
          "เมนู", // ข้อความที่จะแสดงที่แถบเมนู
          array( // array ของ action แต่ละบริเวณ
              new RichMenuAreaBuilder( // action ที่ 1
                  new RichMenuAreaBoundsBuilder(0,0,1250,1686),// พื้นที่ A (x,y,width,height)
                  new MessageTemplateActionBuilder('m','Area A') // เปลี่ยนเฉพาะตัวที่ 2 ตามต้องการ 'Area A'
              ),
              new RichMenuAreaBuilder( // action ที่ 2
                  new RichMenuAreaBoundsBuilder(1250,0,1250,1686), // พื้นที่ B (x,y,width,height)
                  new UriTemplateActionBuilder('u','http://niik.in') // เปลี่ยนเฉพาะตัวที่ 2 ตามต้องการ 'http://niik.in'
              ),                                                                                  
          )
      )
  );          
  // ให้ bot แจ้งกลับเกี่ยวกับ สถานะการสร้าง
  $textReplyMessage = " การสร้าง Rich Menu ".$respRichMenu->getRawBody();
  $replyData = new TextMessageBuilder($textReplyMessage);                                                     
  break;



// ส่วนของการส่งการแจ้งเตือนผ่านฟังก์ชั่น cURL
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
