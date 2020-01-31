<?php
$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'm7uuiyQihjxD2Po3jFwWxjslOwuw1T/ODORXy1vPsFQ2XuUHVVj5Sk9sHQNhdNjMRyHunNm6/KGAVw+uDgy6GQEAeKsAhLGAIpJCYMLvxVU3EgejzBxajVyv30+aa3gPxAtxAgL7ertukDN7srPvXFGUYhWQfeY8sLGRXgo3xvw= ';//copy Channel access token ตอนที่ตั้งค่ามาใส่ 
$channelSecret = '1e9a50e53936e05409b5095cabc4ac2b';


$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$content = file_get_contents('php://input');   // Get request content
$request_array = json_decode($content , true);   // Decode JSON to Array

$jsontemplate = [ 
    
        "type"=> "template",
        "altText"=>  "this is a buttons template",
        "template"=>  [
          "type"=>  "buttons",
          "actions"=>  [
            [
              "type"=>  "uri",
              "label"=> "คาบเรียนรายวัน",
              "uri"=> "http://405965027.student.yru.ac.th/tes5line/homework.php"
            ],
            [
              "type"=>  "uri",
              "label"=>  "ตารางเรียนรายสัปดาห์",
              "uri"=>  "http://405965027.student.yru.ac.th/tes5line/homework.php"
            ]
          ],
          "thumbnailImageUrl"=>  "https://2.bp.blogspot.com/-FwV3GEvNP_0/WiavzB4v2mI/AAAAAAAAARY/lEFa5WR58KcYNucUbwKbUOlctPWsUsroQCLcBGAs/s1600/635817379401360517-School-building-icon.jpg",
          "title"=>  "ตารางเรียน",
          "text"=>  "ชื่อ-สกุล"
        ]
        ];
if ( sizeof($request_array['events']) > 0 ) {
    foreach ($request_array['events'] as $event) {
        error_log(json_encode($event));
        $reply_message = '';
        $reply_token = $event['replyToken'];

        $data = [
            'replyToken' => $reply_token,
            'messages' => [$jsontemplate ]
        ];

        print_r($data);

        $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
        
        $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);

        echo "Result: ".$send_result."\r\n";
        
    }
}

echo "OK";


function send_reply_message($url, $post_header, $post_body)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}






?>