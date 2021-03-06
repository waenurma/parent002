<?php

$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = '072ioqcw4uT17+qwjIDmsn4XlTguP6hRKZjWyJf2nu5tFaheu0baLx26OQ3K5II9RyHunNm6/KGAVw+uDgy6GQEAeKsAhLGAIpJCYMLvxVW4aCCAL4XClCPZUtKmZzjBM5mOHHi5w8jFzTfgnDVFc1GUYhWQfeY8sLGRXgo3xvw=';
$channelSecret = '157d1d03926e37e516f42f5e9a44af73';

$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$content = file_get_contents('php://input');   // Get request content
$request_array = json_decode($content , true);   // Decode JSON to Array

$jsonFlex = [
  "type"=> "flex",
  "altText"=> "เป๋าตังค์",
  "contents"=> [
    "type"=> "bubble",
    "hero"=> [ 
      "type"=> "image",
      "url"=> "https://miro.medium.com/max/1200/1*vSlyXXDKQ8RSu1VC0HPbaA.png",
      "size"=> "full",
      "aspectRatio"=> "2:1",
      "aspectMode"=> "cover",
      "action"=> [
        "type"=> "uri",
        "label"=> "Line",
        "uri"=> "https://linecorp.com/"
      ]
      ],
    "body"=> [
      "type"=> "box",
      "layout"=> "vertical",
      "contents"=> [
        [
          "type"=> "text",
          "text"=> "เป๋าตังค์",
          "size"=> "xl",
          "align"=> "center",
          "weight"=>"bold"
        ],
        [
          "type"=> "separator",
          "margin"=> "sm",
          "color"=> "#B9B5B5"
        ],
        [
          "type"=> "box",
          "layout"=> "vertical",
          "spacing"=> "sm",
          "margin"=> "lg",
          "contents"=> [
            [
              "type"=> "box",
              "layout"=> "baseline",
              "spacing"=> "sm",
              "margin"=> "xs",
              "contents"=> [
                [
                  "type"=> "text",
                  "text"=> "ยอดเงินที่ใช้ได้  ",
                  "flex"=> 1,
                  "size"=> "lg",
                  "align"=> "start",
                  "color"=> "#372E2E"
                ],
                [
                  "type"=> "text",
                  "text"=> "00.00 บาท",
                  "size"=> "lg",
                  "align"=> "end",
                  "weight"=> "bold",
                  "color"=> "#372E2E"
                ]
              ]
                ],
            [
              "type"=> "separator",
              "margin"=> "lg",
              "color"=> "#B9B5B5"
            ]
          ]
        ]
      ]
            ],
    "footer"=> [
      "type"=> "box",
      "layout"=> "vertical",
      "flex"=> 0,
      "spacing"=> "sm",
      "contents"=> [
        [
          "type"=> "button",
          "action"=> [
            "type"=> "uri",
            "label"=> "เช็ครายการใช้จ่าย",
            "uri"=> "http://405965027.student.yru.ac.th/tes5line/paitang.php"
          ],
          "color"=> "#5CA19B",
          "height"=> "md",
          "style"=> "primary"
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

