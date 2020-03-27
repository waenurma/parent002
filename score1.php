
<?php

$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = '072ioqcw4uT17+qwjIDmsn4XlTguP6hRKZjWyJf2nu5tFaheu0baLx26OQ3K5II9RyHunNm6/KGAVw+uDgy6GQEAeKsAhLGAIpJCYMLvxVW4aCCAL4XClCPZUtKmZzjBM5mOHHi5w8jFzTfgnDVFc1GUYhWQfeY8sLGRXgo3xvw=';
$channelSecret = '157d1d03926e37e516f42f5e9a44af73';

$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$content = file_get_contents('php://input');   // Get request content
$request_array = json_decode($content , true);   // Decode JSON to Array
$id_line =$arrJson['events'][0]['source']['userId'];
$jsontemplate = [
  "type"=> "flex",
  "altText"=> "คะแนนแต่ละรายวิชา",
  "contents"=> [
    "type"=> "bubble",
    "hero"=> [
      "type"=> "image",
      "url"=> "https://img.kapook.com/u/natthida/education/5347238.jpg",
      "align"=> "center",
      "size"=> "full",
      "aspectRatio"=> "16:9",
      "aspectMode"=> "cover",
      "action"=> [
        "type"=> "uri",
        "label"=> "Action",
        "uri"=> "https://linecorp.com"
      ]
      ],
    "body"=> [
      "type"=> "box",
      "layout"=> "vertical",
      "spacing"=> "md",
      "action"=> [
        "type"=> "uri",
        "label"=> "Action",
        "uri"=> "https://linecorp.com"
      ],
      "contents"=> [
        [
          "type"=> "text",
          "text"=> "คะแนน",
          "size"=> "xl",
          "weight"=> "bold"
        ],
        [
          "type"=> "text",
          "text"=> "สามารถคลิกดูรายละเอียดเพิ่มเติมด้านล่าง",
          "size"=> "xxs",
          "color"=> "#AAAAAA",
          "wrap"=> true
        ]
      ]
        ],
    "footer"=> [
      "type"=> "box",
      "layout"=> "vertical",
      "contents"=> [
        [
          "type"=> "button",
          "action"=> [
            "type"=> "uri",
            "label"=> "รายละเอียดคะแนน",
            "uri"=> "http://localhost/tesline7/kn1.php"
          ],
          "color"=> "#A2A9AC",
          "style"=> "secondary"
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

