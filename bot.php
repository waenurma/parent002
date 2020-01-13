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

// rich menu


// รายการ Rich Menu ทั้งหมด
$respRichMenu = $bot->getRichMenuList();
$result = json_decode($respRichMenu->getRawBody(),TRUE);                                 
// สร้างตัวแปร สำหรับเก็บ rich menu แต่ละรายการไว้ในแต่ละคอลัมน์
$columnTemplate = array();
foreach($result['richmenus'] as $itemRichMenu){
    $_txtShow = ($itemRichMenu['richMenuId']==$defaultRichMenu)?"ยกเลิก":"กำหนดเป็น";
    $_action = ($itemRichMenu['richMenuId']==$defaultRichMenu)?"c_default_richmenu":"s_default_richmenu";
    $imgRichLayout = substr(str_replace('Rich Menu ','',$itemRichMenu['name']),0,1);
    array_push($columnTemplate, 
        new CarouselColumnTemplateBuilder(
                $itemRichMenu['name'], // ชื่อ rich menu
                'เลือกการจัดการ',
                '[เปลี่ยนส่วนนี้เป็น path url ของเรา]rich-menu/rich-menu-pattern-0'.$imgRichLayout.'.png', // ไม่แสดงรูป มีมี url รูป
                // ตัวอย่าง 'https://www.mywebsite.com/linebot/rich-menu/rich-menu-pattern-0'.$imgRichLayout.'.png', 
                array(                                  
                    new PostbackTemplateActionBuilder(
                        $_txtShow.' Default', // ข้อความแสดงในปุ่ม
                        http_build_query(array(
                            'action'=>$_action,          
                            'richMenuName'=>$itemRichMenu['name'],                    
                            'richMenuId'=>$itemRichMenu['richMenuId']
                        )), // ข้อมูลที่จะส่งไปใน webhook ผ่าน postback event
                        'กำหนด Default Rich Menu'  // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                    ),          
                    new PostbackTemplateActionBuilder(
                        'แสดงที่ Default', // ข้อความแสดงในปุ่ม
                        http_build_query(array(
                            'action'=>'g_default_richmenu',      
                            'richMenuName'=>$itemRichMenu['name'],            
                            'richMenuId'=>$itemRichMenu['richMenuId']
                        )), // ข้อมูลที่จะส่งไปใน webhook ผ่าน postback event
                        'แสดง Default Rich Menu'  // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                    ),                                                                                          
                    new PostbackTemplateActionBuilder(
                        'อัพโหลดรูป Rich Menu นี้', // ข้อความแสดงในปุ่ม
                        http_build_query(array(
                            'action'=>'upload_richmenu',         
                            'richMenuName'=>$itemRichMenu['name'],                    
                            'richMenuId'=>$itemRichMenu['richMenuId']
                        )), // ข้อมูลที่จะส่งไปใน webhook ผ่าน postback event
                        'อัพโหลดรูป Rich Menu'  // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                    )                       
                )       
        )   // end CarouselColumnTemplateBuilder            
    ); // end array push function
}   // end foreach                      
 
// ใช้ Carousel Template วนลูปแสดงรายการ rich menu ที่ได้สร้างไว้
$replyData = new TemplateMessageBuilder('Carousel',
    new CarouselTemplateBuilder(
        $columnTemplate
    )
);                                          
 

// $moreResult = "";
//         // ส่วนทำงานสำหรับเชื่อม Rich Menu ไปยังผู้ใช้นั้นๆ
//         if(isset($dataPostback['action']) && $dataPostback['action']=="more_richmenu"){
//             $respRichMenu = $bot->linkRichMenu($userId,$dataPostback['richmenuid']);
//             $moreResult = $respRichMenu->getRawBody();
//             $result = json_decode($respRichMenu->getRawBody(),TRUE); 
//         }       
//         // ส่วนทำงานสำหรับยกเลิกการเชื่อมกับ Rich Menu ของ ผู้ใช้
//         if(isset($dataPostback['action']) && $dataPostback['action']=="back_richmenu"){
//             $respRichMenu = $bot->unlinkRichMenu($userId);
//             $moreResult = $respRichMenu->getRawBody();
//             $result = json_decode($respRichMenu->getRawBody(),TRUE); 
//         }               
//         // ส่วนทำงานสำหรับลบ Rich Menu
//         if(isset($dataPostback['action']) && $dataPostback['action']=="delete_richmenu"){
//             $respRichMenu = $bot->deleteRichMenu($dataPostback['richMenuId']);
//             $moreResult = $respRichMenu->getRawBody();
//             $result = json_decode($respRichMenu->getRawBody(),TRUE); 
//         }
//         // ส่วนทำงานสำหรับดูข้อมูลของ Rich Menu นั้นๆ
//         if(isset($dataPostback['action']) && $dataPostback['action']=="get_richmenu"){
//             $respRichMenu = $bot->getRichMenu($dataPostback['richMenuId']);
//             $moreResult = $respRichMenu->getRawBody();
//             $result = json_decode($respRichMenu->getRawBody(),TRUE); 
//         }
//         // ส่วนทำงานสำหรับกำหนดเป็น เมนูหลัก
//         if(isset($dataPostback['action']) && $dataPostback['action']=="s_default_richmenu"){
//             $respRichMenu = $httpClient->post("https://api.line.me/v2/bot/user/all/richmenu/".$dataPostback['richMenuId'],array());
//             $moreResult = $respRichMenu->getRawBody();
//             $result = json_decode($respRichMenu->getRawBody(),TRUE); 
//         }   
//         // ส่วนทำงานสำหรับยกเลิกเมนูหลัก    
//         if(isset($dataPostback['action']) && $dataPostback['action']=="c_default_richmenu"){
//             $respRichMenu = $httpClient->delete("https://api.line.me/v2/bot/user/all/richmenu");
//             $moreResult = $respRichMenu->getRawBody();
//             $result = json_decode($respRichMenu->getRawBody(),TRUE); 
//         }           
//         // ส่วนทำงานดึงข้อมูลเมนูหลัก หรือ Rich Menu ที่เป็นเมนูหลัก ถ้ามี
//         if(isset($dataPostback['action']) && $dataPostback['action']=="g_default_richmenu"){
//             $respRichMenu = $httpClient->get("https://api.line.me/v2/bot/user/all/richmenu");
//             $moreResult = $respRichMenu->getRawBody();
//             $result = json_decode($respRichMenu->getRawBody(),TRUE); 
//         }       
//         // ส่วนทำงานอัพโหลดรูปให้กับ Rich Menu  
//         if(isset($dataPostback['action']) && $dataPostback['action']=="upload_richmenu"){
//             $richMenuImg = str_replace('Rich Menu ','',$dataPostback['richMenuName']);
//             if(!file_exists("rich-menu/rich-menu-0".$richMenuImg.".png")){
//                 $richMenuImg = substr(str_replace('Rich Menu ','',$dataPostback['richMenuName']),0,1);
//             }
//             $respRichMenu = $bot->uploadRichMenuImage($dataPostback['richMenuId'],"rich-menu/rich-menu-0".$richMenuImg.".png","image/png");
//             $moreResult = $respRichMenu->getRawBody();
//             $result = json_decode($respRichMenu->getRawBody(),TRUE); 
//         }                   




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