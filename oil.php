<?php

$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = '072ioqcw4uT17+qwjIDmsn4XlTguP6hRKZjWyJf2nu5tFaheu0baLx26OQ3K5II9RyHunNm6/KGAVw+uDgy6GQEAeKsAhLGAIpJCYMLvxVW4aCCAL4XClCPZUtKmZzjBM5mOHHi5w8jFzTfgnDVFc1GUYhWQfeY8sLGRXgo3xvw=';
$channelSecret = '157d1d03926e37e516f42f5e9a44af73';

$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$content = file_get_contents('php://input');   // Get request content
$request_array = json_decode($content , true);   // Decode JSON to Array

$jsontemplate = [

        "type"=> "template",
        "altText"=> "ราคาน้ำมัน",
        "template"=> [
          "type"=> "buttons",
          "actions"=> [
            [
              "type"=> "uri",
              "label"=> "คลิกดูราคาน้ำมัน",
              "uri"=> "https://www.pttor.com/oilprice-province.aspx"
            ]
          ],
          "thumbnailImageUrl"=> "https://sites.google.com/site/kchnanthwimutkul/_/rsrc/1499710187784/cheux-pheling-pheux-kar-khmnakhm/sthankarn-kar-chi-cheux-pheling-pheux-kar-khmnakhm/3-kar-kahnd-rakha-naman-cheux-pheling/3-แบรนด์น้ำมันต่างชาติ-ปรับทัพรีแบรนด์ครั้งใหญ่.jpg",
          "title"=> "ราคาน้ำมัน",
          "text"=> "ดูรายละเอียดราคาน้ำมัน"
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