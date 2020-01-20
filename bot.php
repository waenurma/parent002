 <?php
    
    $accessToken = "exRwq1i1noogIKE8x9QpmYH8PlQQdSvCjBEeoQfy+sCbKkLHNV3Kol5ZxfuCebtuRyHunNm6/KGAVw+uDgy6GQEAeKsAhLGAIpJCYMLvxVWVX2b4o8DN0z03MVgp1TC2JsjIEQPXRqWxua9JrPIVfwdB04t89/1O/w1cDnyilFU=";//copy Channel access token ตอนที่ตั้งค่ามาใส่
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    $strUrl = "https://api.line.me/v2/bot/message/reply";
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

    if($arrJson['events'][0]['message']['text'] == "สวัสดี"){
        $arrPostData = array();
        $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
        $arrPostData['messages'][0]['type'] = "text";
        $arrPostData['messages'][0]['text'] = "สวัสดี ID คุณคือ ".$arrJson['events'][0]['source']['userId'];
      }else if($arrJson['events'][0]['message']['text'] == "ชื่ออะไร"){
        $arrPostData = array();
        $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
        $arrPostData['messages'][0]['type'] = "text";
        $arrPostData['messages'][0]['text'] = "ฉันยังไม่มีชื่อนะ";
      }else if($arrJson['events'][0]['message']['text'] == "ทำอะไรได้บ้าง"){
        $arrPostData = array();
        $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
        $arrPostData['messages'][0]['type'] = "text";
        $arrPostData['messages'][0]['text'] = "ฉันทำอะไรไม่ได้เลย คุณต้องสอนฉันอีกเยอะ";
      }else{
        $arrPostData = array();
        $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
        $arrPostData['messages'][0]['type'] = "text";
        $arrPostData['messages'][0]['text'] = "ฉันไม่เข้าใจคำสั่ง";
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