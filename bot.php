<?php
 
$strAccessToken = "exRwq1i1noogIKE8x9QpmYH8PlQQdSvCjBEeoQfy+sCbKkLHNV3Kol5ZxfuCebtuRyHunNm6/KGAVw+uDgy6GQEAeKsAhLGAIpJCYMLvxVWVX2b4o8DN0z03MVgp1TC2JsjIEQPXRqWxua9JrPIVfwdB04t89/1O/w1cDnyilFU=";//copy Channel access token ตอนที่ตั้งค่ามาใส่;
 
$content = file_get_contents('php://input');
$arrJson = json_decode($content, true);
 
$strUrl = "https://api.line.me/v2/bot/message/reply";
if(!is_null($events)){
    // ถ้ามีค่า สร้างตัวแปรเก็บ replyToken ไว้ใช้งาน
    $replyToken = $events['events'][0]['replyToken'];
    $userID = $events['events'][0]['source']['userId'];
    $sourceType = $events['events'][0]['source']['type'];        
    $is_postback = NULL;
    $is_message = NULL;
    if(isset($events['events'][0]) && array_key_exists('message',$events['events'][0])){
        $is_message = true;
        $typeMessage = $events['events'][0]['message']['type'];
        $userMessage = $events['events'][0]['message']['text'];     
        $idMessage = $events['events'][0]['message']['id'];             
    }
    if(isset($events['events'][0]) && array_key_exists('postback',$events['events'][0])){
        $is_postback = true;
        $dataPostback = NULL;
        parse_str($events['events'][0]['postback']['data'],$dataPostback);;
        $paramPostback = NULL;
        if(array_key_exists('params',$events['events'][0]['postback'])){
            if(array_key_exists('date',$events['events'][0]['postback']['params'])){
                $paramPostback = $events['events'][0]['postback']['params']['date'];
            }
            if(array_key_exists('time',$events['events'][0]['postback']['params'])){
                $paramPostback = $events['events'][0]['postback']['params']['time'];
            }
            if(array_key_exists('datetime',$events['events'][0]['postback']['params'])){
                $paramPostback = $events['events'][0]['postback']['params']['datetime'];
            }                       
        }
    }   
    if(!is_null($is_postback)){
        $textReplyMessage = "ข้อความจาก Postback Event Data = ";
        if(is_array($dataPostback)){
            $textReplyMessage.= json_encode($dataPostback);
        }
        if(!is_null($paramPostback)){
            $textReplyMessage.= " \r\nParams = ".$paramPostback;
        }
        $replyData = new TextMessageBuilder($textReplyMessage);     
    }
    if(!is_null($is_message)){
        switch ($typeMessage){
            case 'text':
                $userMessage = strtolower($userMessage); // แปลงเป็นตัวเล็ก สำหรับทดสอบ
                switch ($userMessage) {
                    case "t":
                        $textReplyMessage = "Bot ตอบกลับคุณเป็นข้อความ";
                        $replyData = new TextMessageBuilder($textReplyMessage);
                        break;
                    case "i":
                        $picFullSize = 'https://www.mywebsite.com/imgsrc/photos/f/simpleflower';
                        $picThumbnail = 'https://www.mywebsite.com/imgsrc/photos/f/simpleflower/240';
                        $replyData = new ImageMessageBuilder($picFullSize,$picThumbnail);
                        break;
                    case "v":
                        $picThumbnail = 'https://www.mywebsite.com/imgsrc/photos/f/sampleimage/240';
                        $videoUrl = "https://www.ninenik.com/line/simplevideo.mp4";             
                        $replyData = new VideoMessageBuilder($videoUrl,$picThumbnail);
                        break;
                    case "a":
                        $audioUrl = "https://www.ninenik.com/line/S_6988827932080.wav";
                        $replyData = new AudioMessageBuilder($audioUrl,20000);
                        break;
                    case "l":
                        $placeName = "ที่ตั้งร้าน";
                        $placeAddress = "แขวง พลับพลา เขต วังทองหลาง กรุงเทพมหานคร ประเทศไทย";
                        $latitude = 13.780401863217657;
                        $longitude = 100.61141967773438;
                        $replyData = new LocationMessageBuilder($placeName, $placeAddress, $latitude ,$longitude);              
                        break;
                    case "m":
                        $textReplyMessage = "Bot ตอบกลับคุณเป็นข้อความ";
                        $textMessage = new TextMessageBuilder($textReplyMessage);
                                         
                        $picFullSize = 'https://www.mywebsite.com/imgsrc/photos/f/simpleflower';
                        $picThumbnail = 'https://www.mywebsite.com/imgsrc/photos/f/simpleflower/240';
                        $imageMessage = new ImageMessageBuilder($picFullSize,$picThumbnail);
                                         
                        $placeName = "ที่ตั้งร้าน";
                        $placeAddress = "แขวง พลับพลา เขต วังทองหลาง กรุงเทพมหานคร ประเทศไทย";
                        $latitude = 13.780401863217657;
                        $longitude = 100.61141967773438;
                        $locationMessage = new LocationMessageBuilder($placeName, $placeAddress, $latitude ,$longitude);        
     
                        $multiMessage =     new MultiMessageBuilder;
                        $multiMessage->add($textMessage);
                        $multiMessage->add($imageMessage);
                        $multiMessage->add($locationMessage);
                        $replyData = $multiMessage;                                     
                        break;                  
                    case "s":
                        $stickerID = 22;
                        $packageID = 2;
                        $replyData = new StickerMessageBuilder($packageID,$stickerID);
                        break;      
                    case "im":
                        $imageMapUrl = 'https://www.mywebsite.com/imgsrc/photos/w/sampleimagemap';
                        $replyData = new ImagemapMessageBuilder(
                            $imageMapUrl,
                            'This is Title',
                            new BaseSizeBuilder(699,1040),
                            array(
                                new ImagemapMessageActionBuilder(
                                    'test image map',
                                    new AreaBuilder(0,0,520,699)
                                    ),
                                new ImagemapUriActionBuilder(
                                    'http://www.ninenik.com',
                                    new AreaBuilder(520,0,520,699)
                                    )
                            )); 
                        break;          
                    case "tm":
                        $replyData = new TemplateMessageBuilder('Confirm Template',
                            new ConfirmTemplateBuilder(
                                    'Confirm template builder',
                                    array(
                                        new MessageTemplateActionBuilder(
                                            'Yes',
                                            'Text Yes'
                                        ),
                                        new MessageTemplateActionBuilder(
                                            'No',
                                            'Text NO'
                                        )
                                    )
                            )
                        );
                        break;          
                    case "t_b":
                        // กำหนด action 4 ปุ่ม 4 ประเภท
                        $actionBuilder = array(
                            new MessageTemplateActionBuilder(
                                'Message Template',// ข้อความแสดงในปุ่ม
                                'This is Text' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                            ),
                            new UriTemplateActionBuilder(
                                'Uri Template', // ข้อความแสดงในปุ่ม
                                'https://www.ninenik.com'
                            ),
                            new DatetimePickerTemplateActionBuilder(
                                'Datetime Picker', // ข้อความแสดงในปุ่ม
                                http_build_query(array(
                                    'action'=>'reservation',
                                    'person'=>5
                                )), // ข้อมูลที่จะส่งไปใน webhook ผ่าน postback event
                                'datetime', // date | time | datetime รูปแบบข้อมูลที่จะส่ง ในที่นี้ใช้ datatime
                                substr_replace(date("Y-m-d H:i"),'T',10,1), // วันที่ เวลา ค่าเริ่มต้นที่ถูกเลือก
                                substr_replace(date("Y-m-d H:i",strtotime("+5 day")),'T',10,1), //วันที่ เวลา มากสุดที่เลือกได้
                                substr_replace(date("Y-m-d H:i"),'T',10,1) //วันที่ เวลา น้อยสุดที่เลือกได้
                            ),      
                            new PostbackTemplateActionBuilder(
                                'Postback', // ข้อความแสดงในปุ่ม
                                http_build_query(array(
                                    'action'=>'buy',
                                    'item'=>100
                                )) // ข้อมูลที่จะส่งไปใน webhook ผ่าน postback event
    //                          'Postback Text'  // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                            ),      
                        );
                        $imageUrl = 'https://www.mywebsite.com/imgsrc/photos/w/simpleflower';
                        $replyData = new TemplateMessageBuilder('Button Template',
                            new ButtonTemplateBuilder(
                                    'button template builder', // กำหนดหัวเรื่อง
                                    'Please select', // กำหนดรายละเอียด
                                    $imageUrl, // กำหนด url รุปภาพ
                                    $actionBuilder  // กำหนด action object
                            )
                        );              
                        break;      
                    case "t_f":
                        $replyData = new TemplateMessageBuilder('Confirm Template',
                            new ConfirmTemplateBuilder(
                                    'Confirm template builder', // ข้อความแนะนหรือบอกวิธีการ หรือคำอธิบาย
                                    array(
                                        new MessageTemplateActionBuilder(
                                            'Yes', // ข้อความสำหรับปุ่มแรก
                                            'YES'  // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                        ),
                                        new MessageTemplateActionBuilder(
                                            'No', // ข้อความสำหรับปุ่มแรก
                                            'NO' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                        )
                                    )
                            )
                        );
                        break;      
                    case "t_c":
                        // กำหนด action 4 ปุ่ม 4 ประเภท
                        $actionBuilder = array(
                            new MessageTemplateActionBuilder(
                                'Message Template',// ข้อความแสดงในปุ่ม
                                'This is Text' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                            ),
                            new UriTemplateActionBuilder(
                                'Uri Template', // ข้อความแสดงในปุ่ม
                                'https://www.ninenik.com'
                            ),
                            new PostbackTemplateActionBuilder(
                                'Postback', // ข้อความแสดงในปุ่ม
                                http_build_query(array(
                                    'action'=>'buy',
                                    'item'=>100
                                )), // ข้อมูลที่จะส่งไปใน webhook ผ่าน postback event
                                'Postback Text'  // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                            ),      
                        );
                        $replyData = new TemplateMessageBuilder('Carousel',
                            new CarouselTemplateBuilder(
                                array(
                                    new CarouselColumnTemplateBuilder(
                                        'Title Carousel',
                                        'Description Carousel',
                                        'https://www.mywebsite.com/imgsrc/photos/f/sampleimage/700',
                                        $actionBuilder
                                    ),
                                    new CarouselColumnTemplateBuilder(
                                        'Title Carousel',
                                        'Description Carousel',
                                        'https://www.mywebsite.com/imgsrc/photos/f/sampleimage/700',
                                        $actionBuilder
                                    ),
                                    new CarouselColumnTemplateBuilder(
                                        'Title Carousel',
                                        'Description Carousel',
                                        'https://www.mywebsite.com/imgsrc/photos/f/sampleimage/700',
                                        $actionBuilder
                                    ),                                          
                                )
                            )
                        );
                        break;      
                    case "t_ic":
                        $replyData = new TemplateMessageBuilder('Image Carousel',
                            new ImageCarouselTemplateBuilder(
                                array(
                                    new ImageCarouselColumnTemplateBuilder(
                                        'https://www.mywebsite.com/imgsrc/photos/f/sampleimage/700',
                                        new UriTemplateActionBuilder(
                                            'Uri Template', // ข้อความแสดงในปุ่ม
                                            'https://www.ninenik.com'
                                        )
                                    ),
                                    new ImageCarouselColumnTemplateBuilder(
                                        'https://www.mywebsite.com/imgsrc/photos/f/sampleimage/700',
                                        new UriTemplateActionBuilder(
                                            'Uri Template', // ข้อความแสดงในปุ่ม
                                            'https://www.ninenik.com'
                                        )
                                    )                                       
                                )
                            )
                        );
                        break;                                                                                                                                                                                                  
                    default:
                        $textReplyMessage = " คุณไม่ได้พิมพ์ ค่า ตามที่กำหนด";
                        $replyData = new TextMessageBuilder($textReplyMessage);         
                        break;                                      
                }
                break;
            default:
                $textReplyMessage = json_encode($events);
                $replyData = new TextMessageBuilder($textReplyMessage);         
                break;  
        }
    }
}
$response = $bot->replyMessage($replyToken,$replyData);
if ($response->isSucceeded()) {
    echo 'Succeeded!';
    return;
}
 
// Failed
echo $response->getHTTPStatus() . ' ' . $response->getRawBody();

 
// $arrHeader = array();
// $arrHeader[] = "Content-Type: application/json";
// $arrHeader[] = "Authorization: Bearer {$strAccessToken}";
 
// if($arrJson['events'][0]['message']['text'] == "สวัสดี"){
//   $arrPostData = array();
//   $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
//   $arrPostData['messages'][0]['type'] = "text";
//   $arrPostData['messages'][0]['text'] = "สวัสดีจ้าาาา มีอะไรให้เราช่วยไหมค่ะ ";  //.$arrJson['events'][0]['source']['userId'];

// }else if($arrJson['events'][0]['message']['text'] == "สวัสดีค่ะ"){
//   $arrPostData = array();
//   $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
//   $arrPostData['messages'][0]['type'] = "text";
//   $arrPostData['messages'][0]['text'] = "สวัสดีจ้าาาา มีอะไรให้เราช่วยไหมค่ะ";

// }else if($arrJson['events'][0]['message']['text'] == "สวัสดีคะ"){
//     $arrPostData = array();
//     $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
//     $arrPostData['messages'][0]['type'] = "text";
//     $arrPostData['messages'][0]['text'] = "สวัสดีจ้าาาา มีอะไรให้เราช่วยไหมค่ะ";

// }else if($arrJson['events'][0]['message']['text'] == "สวัสดีคับ"){
//     $arrPostData = array();
//     $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
//     $arrPostData['messages'][0]['type'] = "text";
//     $arrPostData['messages'][0]['text'] = "สวัสดีจ้าาาา มีอะไรให้เราช่วยไหมค่ะ";

// }else if($arrJson['events'][0]['message']['text'] == "สวัสดีครับ"){
//     $arrPostData = array();
//     $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
//     $arrPostData['messages'][0]['type'] = "text";
//     $arrPostData['messages'][0]['text'] = "สวัสดีจ้าาาา มีอะไรให้เราช่วยไหมค่ะ";


// //////////////////ขอบคุณ
// }else if($arrJson['events'][0]['message']['text'] == "ขอบคุณ"){
//   $arrPostData = array();
//   $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
//   $arrPostData['messages'][0]['type'] = "text";
//   $arrPostData['messages'][0]['text'] = "ยินดีจร้าาา";
//   $arrPostData['messages'][1]['type'] = "sticker";
//   $arrPostData['messages'][1]['packageId'] = "1";
//   $arrPostData['messages'][1]['stickerId'] = "4";

// }else if($arrJson['events'][0]['message']['text'] == "ขอบคุณค่ะ"){
//     $arrPostData = array();
//     $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
//     $arrPostData['messages'][0]['type'] = "text";
//     $arrPostData['messages'][0]['text'] = "ยินดีจร้าาา";
//     $arrPostData['messages'][1]['type'] = "sticker";
//     $arrPostData['messages'][1]['packageId'] = "1";
//     $arrPostData['messages'][1]['stickerId'] = "4";

// }else if($arrJson['events'][0]['message']['text'] == "ขอบคุณคะ"){
//     $arrPostData = array();
//     $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
//     $arrPostData['messages'][0]['type'] = "text";
//     $arrPostData['messages'][0]['text'] = "ยินดีจร้าาา";
//     $arrPostData['messages'][1]['type'] = "sticker";
//     $arrPostData['messages'][1]['packageId'] = "1";
//     $arrPostData['messages'][1]['stickerId'] = "4";


// }else if($arrJson['events'][0]['message']['text'] == "ขอบคุณจ่ะ"){
//     $arrPostData = array();
//     $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
//     $arrPostData['messages'][0]['type'] = "text";
//     $arrPostData['messages'][0]['text'] = "ยินดีจร้าาา";
//     $arrPostData['messages'][1]['type'] = "sticker";
//     $arrPostData['messages'][1]['packageId'] = "1";
//     $arrPostData['messages'][1]['stickerId'] = "4";

// }else if($arrJson['events'][0]['message']['text'] == "ขอบคุณครับ"){
//     $arrPostData = array();
//     $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
//     $arrPostData['messages'][0]['type'] = "text";
//     $arrPostData['messages'][0]['text'] = "ยินดีจร้าาา";
//     $arrPostData['messages'][1]['type'] = "sticker";
//     $arrPostData['messages'][1]['packageId'] = "1";
//     $arrPostData['messages'][1]['stickerId'] = "4";    

// }else if($arrJson['events'][0]['message']['text'] == "ขอบคุณคับ"){
//     $arrPostData = array();
//     $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
//     $arrPostData['messages'][0]['type'] = "text";
//     $arrPostData['messages'][0]['text'] = "ยินดีจร้าาา";
//     $arrPostData['messages'][1]['type'] = "sticker";
//     $arrPostData['messages'][1]['packageId'] = "1";
//     $arrPostData['messages'][1]['stickerId'] = "4";    

// }else if($arrJson['events'][0]['message']['text'] == "ใจจ่ะ"){
//     $arrPostData = array();
//     $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
//     $arrPostData['messages'][0]['type'] = "text";
//     $arrPostData['messages'][0]['text'] = "ยินดีจร้าาา";
//     $arrPostData['messages'][1]['type'] = "sticker";
//     $arrPostData['messages'][1]['packageId'] = "1";
//     $arrPostData['messages'][1]['stickerId'] = "4";

// }else if($arrJson['events'][0]['message']['text'] == "ขอบใจคับ"){
//     $arrPostData = array();
//     $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
//     $arrPostData['messages'][0]['type'] = "text";
//     $arrPostData['messages'][0]['text'] = "ยินดีจร้าาา";
//     $arrPostData['messages'][1]['type'] = "sticker";
//     $arrPostData['messages'][1]['packageId'] = "1";
//     $arrPostData['messages'][1]['stickerId'] = "4";    

// }else if($arrJson['events'][0]['message']['text'] == "ขอบใจครับ"){
//     $arrPostData = array();
//     $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
//     $arrPostData['messages'][0]['type'] = "text";
//     $arrPostData['messages'][0]['text'] = "ยินดีจร้าาา";
//     $arrPostData['messages'][1]['type'] = "sticker";
//     $arrPostData['messages'][1]['packageId'] = "1";
//     $arrPostData['messages'][1]['stickerId'] = "4";     


// //////////////////เมนู6เมนู

// }else if($arrJson['events'][0]['message']['text'] == "ตารางเรียน"){
//     $arrPostData = array();
//     $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
//     $arrPostData['messages'][0]['type'] = "text";
//     $arrPostData['messages'][0]['text'] = "กรุณาตรวจสอบบนสมาร์ทโฟน";

// }else if($arrJson['events'][0]['message']['text'] == "ผลการเรียน"){
//     $arrPostData = array();
//     $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
//     $arrPostData['messages'][0]['type'] = "text";
//     $arrPostData['messages'][0]['text'] = "กรุณาตรวจสอบบนสมาร์ทโฟน";
    

// }else if($arrJson['events'][0]['message']['text'] == "การเรียนการสอน"){
//     $arrPostData = array();
//     $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
//     $arrPostData['messages'][0]['type'] = "text";
//     $arrPostData['messages'][0]['text'] = "การเรียนการสอนตรงนี้จะทำให้ลิงค์หน้าเว็บสามารถดูเนื้อหาที่เรียน";

// }else if($arrJson['events'][0]['message']['text'] == "การบ้าน"){
//     $arrPostData = array();
//     $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
//     $arrPostData['messages'][0]['type'] = "text";
//     $arrPostData['messages'][0]['text'] = "การบ้านตรงนี้จะทำให้ลิงค์หน้าเว็บสามารถดูการบ้าน";

// }else if($arrJson['events'][0]['message']['text'] == "ค่าใช้จ่าย"){
//     $arrPostData = array();
//     $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
//     $arrPostData['messages'][0]['type'] = "text";
//     $arrPostData['messages'][0]['text'] = "จะทำแบบลิงค์แล้วดูยอดที่ต้องชำระหรือค่าเทอมค่าใช้จ่ายต่างๆ";

// }else if($arrJson['events'][0]['message']['text'] == "กิจกรรม"){
//     $arrPostData = array();
//     $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
//     $arrPostData['messages'][0]['type'] = "text";
//     $arrPostData['messages'][0]['text'] = "จะเป็นแบบลิงค์ไปแล้วแสดงว่ามีกิจกรรมอะไรบ้าง";


//     /////ดักคำแปลกๆ
// }else{
//   $arrPostData = array();
//   $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
//   $arrPostData['messages'][0]['type'] = "text";
//   $arrPostData['messages'][0]['text'] = "ฉันไม่เข้าใจคำสั่ง";
// }
 
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL,$strUrl);
// curl_setopt($ch, CURLOPT_HEADER, false);
// curl_setopt($ch, CURLOPT_POST, true);
// curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
// curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
// curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// $result = curl_exec($ch);
// curl_close ($ch);
 
?>