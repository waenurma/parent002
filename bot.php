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

  // สร้างตัวแปรเก็ยค่าประเภทของ Message จากทั้งหมด 7 ประเภท
  $typeMessage = $eventObj->getMessageType();  
  //  text | image | sticker | location | audio | video | file  
  // เก็บค่า id ของข้อความ
  $idMessage = $eventObj->getMessageId();          
  // ถ้าเป็นข้อความ
  if($typeMessage=='text'){
      $userMessage = $eventObj->getText(); // เก็บค่าข้อความที่ผู้ใช้พิมพ์
  }
  // ถ้าเป็น image
  if($typeMessage=='image'){

  }               
  // ถ้าเป็น audio

  if($typeMessage=='audio'){

  }       
  // ถ้าเป็น video
  if($typeMessage=='video'){

  }   
  // ถ้าเป็น file
  if($typeMessage=='file'){
      $FileName = $eventObj->getFileName();
      $FileSize = $eventObj->getFileSize();
  }               
  // ถ้าเป็น image หรือ audio หรือ video หรือ file และต้องการบันทึกไฟล์
  if(preg_match('/image|audio|video|file/',$typeMessage)){            
      $responseMedia = $bot->getMessageContent($idMessage);
      if ($responseMedia->isSucceeded()) {
          // คำสั่ง getRawBody() ในกรณีนี้ จะได้ข้อมูลส่งกลับมาเป็น binary 
          // เราสามารถเอาข้อมูลไปบันทึกเป็นไฟล์ได้
          $dataBinary = $responseMedia->getRawBody(); // return binary
          // ดึงข้อมูลประเภทของไฟล์ จาก header
          $fileType = $responseMedia->getHeader('Content-Type');    
          switch ($fileType){
              case (preg_match('/^application/',$fileType) ? true : false):
//                      $fileNameSave = $FileName; // ถ้าต้องการบันทึกเป็นชื่อไฟล์เดิม
                  $arr_ext = explode(".",$FileName);
                  $ext = array_pop($arr_ext);
                  $fileNameSave = time().".".$ext;                            
                  break;                  
              case (preg_match('/^image/',$fileType) ? true : false):
                  list($typeFile,$ext) = explode("/",$fileType);
                  $ext = ($ext=='jpeg' || $ext=='jpg')?"jpg":$ext;
                  $fileNameSave = time().".".$ext;
                  break;
              case (preg_match('/^audio/',$fileType) ? true : false):
                  list($typeFile,$ext) = explode("/",$fileType);
                  $fileNameSave = time().".".$ext;                        
                  break;
              case (preg_match('/^video/',$fileType) ? true : false):
                  list($typeFile,$ext) = explode("/",$fileType);
                  $fileNameSave = time().".".$ext;                                
                  break;                                                      
          }

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