<?php

include('config.php');

$API_URL = 'https://api.line.me/v2/bot/message';
$channelSecret = '157d1d03926e37e516f42f5e9a44af73';
$ACCESS_TOKEN = '072ioqcw4uT17+qwjIDmsn4XlTguP6hRKZjWyJf2nu5tFaheu0baLx26OQ3K5II9RyHunNm6/KGAVw+uDgy6GQEAeKsAhLGAIpJCYMLvxVW4aCCAL4XClCPZUtKmZzjBM5mOHHi5w8jFzTfgnDVFc1GUYhWQfeY8sLGRXgo3xvw=';
$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$link = URL .'api/apiparent/show_subjgrade.php?system=school&id=0001&student=01658&card=1959900766962&action=subjgrade';

$result1 = file_get_contents($link);
$request_array1  = (json_decode($result1, true));

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array
//echo $request_array1[0]['data'][0]['GPA_ALL'];
$val = strval($request_array1['data'][0]['GPA_ALL']);
print_r($request_array1['data'][0]['GPA_ALL']);
//$val = "0";
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
          "text" => "เกรดเฉลี่ยรวม",
          "size" => "lg",
          "align" => "start",
          "weight" => "bold",
          "color" => "#009813"
        ],
        [
          "type" => "text",
          "text" => $val,
          "flex"=> 0,
          "margin"=> "xxl",
          "size"=> "md",
          "align"=> "start",
          "weight"=> "regular",
          "color"=> "#000000",
          "wrap"=> true
        ],
        [
          "type" => "text",
          "text" => "ชื่อ-นามสกุล",
          "flex"=> 0,
          "margin"=> "lg",
          "size"=> "md",
          "align"=> "start",
          "weight"=> "regular",
          "color"=> "#000000",
          "wrap"=> true
        ],

      ]
    ],


    "footer" => [
      "type" => "box",
      "layout" => "horizontal",
      "contents" => [
        [
          "type" => "text",
          "text" => "ผลการเรียนรวม",
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

if ($request_array ) {
    foreach ($request_array['events'] as $event) {
        error_log(json_encode($event));
        $reply_message = '';
        $reply_token = $event['replyToken'];


        $data = [
            'replyToken' => $reply_token,
            'messages' => [$jsonFlex]
        ];

        //print_r($data);

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