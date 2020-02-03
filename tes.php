<?php

$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'm7uuiyQihjxD2Po3jFwWxjslOwuw1T/ODORXy1vPsFQ2XuUHVVj5Sk9sHQNhdNjMRyHunNm6/KGAVw+uDgy6GQEAeKsAhLGAIpJCYMLvxVU3EgejzBxajVyv30+aa3gPxAtxAgL7ertukDN7srPvXFGUYhWQfeY8sLGRXgo3xvw= ';//copy Channel access token ตอนที่ตั้งค่ามาใส่ 
$channelSecret = '1e9a50e53936e05409b5095cabc4ac2b';


$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$content = file_get_contents('php://input');   // Get request content
$request_array = json_decode($content , true);   // Decode JSON to Array

$jsontemplate = [

        "type"=> "template",
        "altText"=>  "this is a carousel template",
        "template"=>  [
          "type"=>  "carousel",
          "actions"=>  [],
          "columns"=>  [
            [
              "thumbnailImageUrl"=>  "https://tv.bectero.com/wp-content/uploads/2019/01/gold-full-01.jpg",
              "title"=>  "ราคาทอง",
              "text"=>  "ดูรายเอียดเพิ่มเติม",
              "actions"=>  [
                [
                  "type"=>  "uri",
                  "label"=>  "คลิกดูราคาทอง",
                  "uri"=>  "https://xn--42cah7d0cxcvbbb9x.com/"
                ]
              ]
                ],
            [
              "thumbnailImageUrl"=>  "https://sites.google.com/site/kchnanthwimutkul/_/rsrc/1499710187784/cheux-pheling-pheux-kar-khmnakhm/sthankarn-kar-chi-cheux-pheling-pheux-kar-khmnakhm/3-kar-kahnd-rakha-naman-cheux-pheling/3-แบรนด์น้ำมันต่างชาติ-ปรับทัพรีแบรนด์ครั้งใหญ่.jpg",
              "title"=>  "ราคาน้ำมัน",
              "text"=>  "ดูรายละเอียดราคาน้ำมัน",
              "actions"=>  [
                [
                  "type"=>  "uri",
                  "label"=>  "คลิกดูราคาน้ำมัน",
                  "uri"=>  "https://www.pttor.com/oilprice-province.aspx"
                ]
              ]
                ],
            [
              "thumbnailImageUrl"=>  "https://www.songkhlatoday.com/wp-content/uploads/2019/09/1.jpg",
              "title"=>  "พยากรณ์อากาศ",
              "text"=>  "ฝน ฟ้า อากาศ",
              "actions"=>  [
                [
                  "type"=>  "uri",
                  "label"=>  "คลิกดู ฝน ฟ้า อากาศ",
                  "uri"=>  "https://www.tmd.go.th/"
                ]
              ]
                ],
            [
              "thumbnailImageUrl"=>  "https://www.isranews.org/images/stories/2012/sep/thairath_logo1.jpg",
              "title"=>  "ข่าวสาร",
              "text"=>  "ข่าวประจำวัน",
              "actions"=>  [
                [
                  "type"=>  "uri",
                  "label"=>  "คลิกเลย",
                  "uri"=>  "https://www.thairath.co.th/news"
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
            'messages' => [$jsontemplate]
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