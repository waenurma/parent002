 <?php
    
    $accessToken = "exRwq1i1noogIKE8x9QpmYH8PlQQdSvCjBEeoQfy+sCbKkLHNV3Kol5ZxfuCebtuRyHunNm6/KGAVw+uDgy6GQEAeKsAhLGAIpJCYMLvxVWVX2b4o8DN0z03MVgp1TC2JsjIEQPXRqWxua9JrPIVfwdB04t89/1O/w1cDnyilFU=";//copy Channel access token ตอนที่ตั้งค่ามาใส่
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
   

    //เชื่อมdb
    // $host = 'ec2-54-235-180-123.compute-1.amazonaws.com';
    // $dbname = 'dejm5cvd928n89'; 
    // $user = 'wammqrjxsobuvm'; 
    // $pass = '817d802129e8aebb1a07b4d7ba1b59f84d01696ed5eddbe84b51ea4d998f8df5'; 
    // $connection = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass); 
    // $result = $connection->query("SELECT * FROM `subjaect`"); 
    // if($result !== null) { 
    //     echo $result->rowCount(); 
    // }
    
    /*Return HTTP Request 200*/
    http_response_code(200);

    //รับข้อความจากผู้ใช้
    $message = $arrayJson['events'][0]['message']['text'];
    $arrayPostData= array();
    $jsonFlex = [
        "type" => "flex",
        "altText" => "ผลการเรียน",
        "contents" => [
          "type" => "bubble",
          "direction" => "ltr",
          "header" => [
            "type" => "box",
            "layout" => "vertical",
            "contents" => [
              [
                "type" => "text",
                "text" => "Purchase",
                "size" => "lg",
                "align" => "start",
                "weight" => "bold",
                "color" => "#009813"
              ],
              [
                "type" => "text",
                "text" => "฿ 100.00",
                "size" => "3xl",
                "weight" => "bold",
                "color" => "#000000"
              ],
              [
                "type" => "text",
                "text" => "Rabbit Line Pay",
                "size" => "lg",
                "weight" => "bold",
                "color" => "#000000"
              ],
              [
                "type" => "text",
                "text" => "2019.02.14 21:47 (GMT+0700)",
                "size" => "xs",
                "color" => "#B2B2B2"
              ],
              [
                "type" => "text",
                "text" => "Payment complete.",
                "margin" => "lg",
                "size" => "lg",
                "color" => "#000000"
              ]
            ]
          ],
          "body" => [
            "type" => "box",
            "layout" => "vertical",
            "contents" => [
              [
                "type" => "separator",
                "color" => "#C3C3C3"
              ],
              [
                "type" => "box",
                "layout" => "baseline",
                "margin" => "lg",
                "contents" => [
                  [
                    "type" => "text",
                    "text" => "Merchant",
                    "align" => "start",
                    "color" => "#C3C3C3"
                  ],
                  [
                    "type" => "text",
                    "text" => "BTS 01",
                    "align" => "end",
                    "color" => "#000000"
                  ]
                ]
              ],
              [
                "type" => "box",
                "layout" => "baseline",
                "margin" => "lg",
                "contents" => [
                  [
                    "type" => "text",
                    "text" => "New balance",
                    "color" => "#C3C3C3"
                  ],
                  [
                    "type" => "text",
                    "text" => "฿ 45.57",
                    "align" => "end"
                  ]
                ]
              ],
              [
                "type" => "separator",
                "margin" => "lg",
                "color" => "#C3C3C3"
              ]
            ]
          ],
          "footer" => [
            "type" => "box",
            "layout" => "horizontal",
            "contents" => [
              [
                "type" => "text",
                "text" => "View Details",
                "size" => "lg",
                "align" => "start",
                "color" => "#0084B6",
                "action" => [
                  "type" => "uri",
                  "label" => "View Details",
                  "uri" => "https://google.co.th/"
                ]
              ]
            ]
          ]
        ]
      ];
    if ( sizeof($request_array['events']) > 0 ) {
        foreach ($request_array['events'] as $event) {
            error_log(json_encode($event));
            $reply_message = '';
            $reply_token = $event['replyToken'];
            $data = [
                'replyToken' => $reply_token,
                'messages' => [$jsonFlex]
            ];
            print_r($data);
            $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
            $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);
            echo "Result: ".$send_result."\r\n";
            
        }
    }
    echo "OK";

    
 #ตัวอย่าง Message Type "Text"
     if($message == "สวัสดี"){
         $arrayPostData= array();
         $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
         $arrayPostData['messages'][0]['type'] = "text";
         $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา มีอะไรให้เราช่วยไหมค่ะ";
         replyMsg($arrayHeader,$arrayPostData);
     }

     else if($message == "สวัสดีคับ"){
        $arrayPostData= array();
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา มีอะไรให้เราช่วยไหมค่ะ";
        replyMsg($arrayHeader,$arrayPostData);
    }

    else if($message == "สวัสดีครับ"){
        $arrayPostData= array();
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา มีอะไรให้เราช่วยไหมค่ะ";
        replyMsg($arrayHeader,$arrayPostData);
    }

    else if($message == "สวัสดีค่ะ"){
        $arrayPostData= array();
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา มีอะไรให้เราช่วยไหมค่ะ";
        replyMsg($arrayHeader,$arrayPostData);
    }

    else if($message == "สวัสดีคะ"){
        $arrayPostData= array();
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา มีอะไรให้เราช่วยไหมค่ะ";
        replyMsg($arrayHeader,$arrayPostData);
    }
    else if($message == "หวัดดี"){
        $arrayPostData= array();
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา มีอะไรให้เราช่วยไหมค่ะ";
        replyMsg($arrayHeader,$arrayPostData);
    }

    #ตัวอย่าง Message Type "Text + Sticker ใน 1 ครั้ง"
    // message  "ขอบคุณ"
    else if($message == "ขอบคุณ"){
        $arrayPostData= array();
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "ยินดีจร้าาา";
        $arrayPostData['messages'][1]['type'] = "sticker";
        $arrayPostData['messages'][1]['packageId'] = "1";
        $arrayPostData['messages'][1]['stickerId'] = "4";
        replyMsg($arrayHeader,$arrayPostData);  
    }

    else if($message == "ขอบคุณคะ"){
        $arrayPostData= array();
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "ยินดีจร้าาา";
        $arrayPostData['messages'][1]['type'] = "sticker";
        $arrayPostData['messages'][1]['packageId'] = "1";
        $arrayPostData['messages'][1]['stickerId'] = "4";
        replyMsg($arrayHeader,$arrayPostData);
       
    }

    else if($message == "ขอบคุณค่ะ"){
        $arrayPostData= array();
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "ยินดีจร้าาา";
        $arrayPostData['messages'][1]['type'] = "sticker";
        $arrayPostData['messages'][1]['packageId'] = "1";
        $arrayPostData['messages'][1]['stickerId'] = "4";
        replyMsg($arrayHeader,$arrayPostData);
       
    }
    else if($message == "ขอบคุณคับ"){
        $arrayPostData= array();
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "ยินดีจร้าาา";
        $arrayPostData['messages'][1]['type'] = "sticker";
        $arrayPostData['messages'][1]['packageId'] = "1";
        $arrayPostData['messages'][1]['stickerId'] = "4";
        replyMsg($arrayHeader,$arrayPostData);
       
    }
    else if($message == "ขอบคุณครับ"){
        $arrayPostData= array();
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "ยินดีจร้าาา";
        $arrayPostData['messages'][1]['type'] = "sticker";
        $arrayPostData['messages'][1]['packageId'] = "1";
        $arrayPostData['messages'][1]['stickerId'] = "4";
        replyMsg($arrayHeader,$arrayPostData);
       
    }
    //message  "ตารางเรียน"
    else if($message == "ตารางเรียน"){
        $arrayPostData= array();
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "กรุณาตรวจสอบบนสมาร์ทโฟน";
        replyMsg($arrayHeader,$arrayPostData);
       
    }
    // message  "ผลการเรียน"
    else if($message == "ผลการเรียน"){
        $arrayPostData= array();
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "กรุณาตรวจสอบบนสมาร์ทโฟน";
        replyMsg($arrayHeader,$arrayPostData);
       
       
    }
    // message  "การเรียนการสอน"
    else if($message == "การเรียนการสอน"){
        $arrayPostData= array();
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "การเรียนการสอนตรงนี้จะทำให้ลิงค์หน้าเว็บสามารถดูเนื้อหาที่เรียน";
        replyMsg($arrayHeader,$arrayPostData);
       
    }
    // message  "การบ้าน"
    else if($message == "การบ้าน"){
        $arrayPostData= array();
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "การบ้านตรงนี้จะทำให้ลิงค์หน้าเว็บสามารถดูการบ้าน";
        replyMsg($arrayHeader,$arrayPostData);
       
    }
    // message  "ค่าใช้จ่าย"
    else if($message == "ค่าใช้จ่าย"){
        $arrayPostData= array();
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "จะทำแบบลิงค์แล้วดูยอดที่ต้องชำระหรือค่าเทอมค่าใช้จ่ายต่างๆ";
        replyMsg($arrayHeader,$arrayPostData);
       
    }
    // message  "กิจกรรม"
    else if($message == "กิจกรรม"){
        $arrayPostData= array();
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "จะเป็นแบบลิงค์ไปแล้วแสดงว่ามีกิจกรรมอะไรบ้าง";
        replyMsg($arrayHeader,$arrayPostData);
       
    }
    // message ดักจับคำที่แปลกๆ
    else{
        $arrayPostData = array();
        $arrayPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "กรอกข้อมูลไม่ถูกต้อง!!";
        replyMsg($arrayHeader,$arrayPostData);
    }









//      #ตัวอย่าง Message Type "Sticker"
//      else if($message == "ฝันดี"){
//          $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
//          $arrayPostData['messages'][0]['type'] = "sticker";
//          $arrayPostData['messages'][0]['packageId'] = "2";
//          $arrayPostData['messages'][0]['stickerId'] = "46";
//          replyMsg($arrayHeader,$arrayPostData);
//      }
//      #ตัวอย่าง Message Type "Image"
//      else if($message == "รูปน้องแมว"){
//          $image_url = "https://i.pinimg.com/originals/cc/22/d1/cc22d10d9096e70fe3dbe3be2630182b.jpg";
//          $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
//          $arrayPostData['messages'][0]['type'] = "image";
//          $arrayPostData['messages'][0]['originalContentUrl'] = $image_url;
//          $arrayPostData['messages'][0]['previewImageUrl'] = $image_url;
//          replyMsg($arrayHeader,$arrayPostData);
//      }
//      #ตัวอย่าง Message Type "Location"
//      else if($message == "พิกัดสยามพารากอน"){
//          $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
//          $arrayPostData['messages'][0]['type'] = "location";
//          $arrayPostData['messages'][0]['title'] = "สยามพารากอน";
//          $arrayPostData['messages'][0]['address'] =   "13.7465354,100.532752";
//          $arrayPostData['messages'][0]['latitude'] = "13.7465354";
//          $arrayPostData['messages'][0]['longitude'] = "100.532752";
//          replyMsg($arrayHeader,$arrayPostData);
//      }
    

//      #ตัวอย่าง Message Type "Video"
//      else if($message == "video"){
//         $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
//         $arrayPostData['messages'][0]['type'] = "video";
//         $arrayPostData['messages'][0]['originalContentUrl'] = "https://www.youtube.com/watch?v=8xeqzvFtw3g";//ใส่ url ของ video ที่ต้องการส่ง
//         $arrayPostData['messages'][0]['previewImageUrl'] = "https://i.pinimg.com/originals/cc/22/d1/cc22d10d9096e70fe3dbe3be2630182b.jpg";//ใส่รูป preview ของ video
//         replyMsg($arrayHeader,$arrayPostData);
//     }
//     //ดัก
//     else{
//     $arrPostData = array();
//     $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
//     $arrPostData['messages'][0]['type'] = "text";
//     $arrPostData['messages'][0]['text'] = "กรอกข้อมูลไม่ถูกต้อง!!";
//   }

 function replyMsg($arrayHeader,$arrayPostData){
    $strUrl = "https://api.line.me/v2/bot/message/reply";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);    
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
    }

?>