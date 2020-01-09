?php
    $accessToken = "";//copy Channel access token ตอนที่ตั้งค่ามาใส่

    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);

    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";

    //รับข้อความจากผู้ใช้
    $message = $arrayJson['events'][0]['message']['text'];
#ตัวอย่าง Message Type "Video"
    if($message == "video"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "video";
        $arrayPostData['messages'][0]['originalContentUrl'] = "";//ใส่ url ของ video ที่ต้องการส่ง
        $arrayPostData['messages'][0]['previewImageUrl'] = "";//ใส่รูป preview ของ video
        replyMsg($arrayHeader,$arrayPostData);
    }
    ?>
