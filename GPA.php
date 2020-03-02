<?php

$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = '072ioqcw4uT17+qwjIDmsn4XlTguP6hRKZjWyJf2nu5tFaheu0baLx26OQ3K5II9RyHunNm6/KGAVw+uDgy6GQEAeKsAhLGAIpJCYMLvxVW4aCCAL4XClCPZUtKmZzjBM5mOHHi5w8jFzTfgnDVFc1GUYhWQfeY8sLGRXgo3xvw=';
$channelSecret = '157d1d03926e37e516f42f5e9a44af73';

$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$content = file_get_contents('php://input');   // Get request content
$request_array = json_decode($content , true);   // Decode JSON to Array

$jsonFlex = [
        "type"=> "flex",
        "altText"=> "ผลการเรียน",
        "contents"=> [
          "type"=> "bubble",
          "hero"=> [
            "type"=> "image",
            "url"=> "https://i.dlpng.com/static/png/351060_preview.png",
            "size"=> "full",
            "aspectRatio"=> "20:13",
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
                "text"=> "ประกาศผลการเรียน",
                "size"=> "xl",
                "weight"=> "bold"
              ],
              [
                "type"=> "box",
                "layout"=> "vertical",
                "spacing"=> "sm",
                "margin"=> "xs",
                "contents"=> [
                  [
                    "type"=> "box",
                    "layout"=> "baseline",
                    "spacing"=> "sm",
                    "contents"=> [
                      [
                        "type"=> "text",
                        "text"=> "รายละเอียดผลการเรียน",
                        "flex"=> 1,
                        "size"=> "sm",
                        "color"=> "#AAAAAA"
                      ]
                    ]
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
                  "label"=> "ผลการเรียน 1/62",
                  "uri"=> "https://linecorp.com"
                ],
                "height"=> "sm",
                "style"=> "link"
              ],
              [
                "type"=> "button",
                "action"=> [
                  "type"=> "uri",
                  "label"=> "ผลการเรียน 2/62",
                  "uri"=> "https://linecorp.com"
                ],
                "height"=> "sm",
                "style"=> "link"
            ],
              [
                "type"=> "button",
                "action"=> [
                  "type"=> "uri",
                  "label"=> "ผลการเรียนทั้งหมด",
                  "uri"=> "https://linecorp.com"
                ]
                ],
              [
                "type"=> "spacer",
                "size"=> "sm"
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

