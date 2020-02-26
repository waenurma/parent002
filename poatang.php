<?php

$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = '072ioqcw4uT17+qwjIDmsn4XlTguP6hRKZjWyJf2nu5tFaheu0baLx26OQ3K5II9RyHunNm6/KGAVw+uDgy6GQEAeKsAhLGAIpJCYMLvxVW4aCCAL4XClCPZUtKmZzjBM5mOHHi5w8jFzTfgnDVFc1GUYhWQfeY8sLGRXgo3xvw=';
$channelSecret = '157d1d03926e37e516f42f5e9a44af73';

$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$content = file_get_contents('php://input');   // Get request content
$request_array = json_decode($content , true);   // Decode JSON to Array

$jsonFlex = [
    "type"=> "flex",
    "altText"=> "เช็คยอดเงินค่าใช้จ่าย",
    "contents"=> [
      "type"=> "bubble",
      "hero"=> [
        "type"=> "image",
        "url"=> "https://miro.medium.com/max/1200/1*vSlyXXDKQ8RSu1VC0HPbaA.png",
        "size"=> "full",
        "aspectRatio"=> "20:13",
        "aspectMode"=> "cover",
        "backgroundColor"=> "#BFB1B1"
      
      ],
      "body"=> [
        "type"=> "box",
        "layout"=> "vertical",
        "spacing"=> "md",
        
        "contents"=> [
          [
            "type"=> "text",
            "text"=> "เป๋าตังค์",
            "size"=> "lg",
            "align"=> "center",
            "weight"=> "bold",
            "color"=>"#0084B6"
          ],
          [
            "type"=> "text",
            "text"=> "ตรวจเช็ครายละเอียดค่าใช้จ่าย",
            "margin"=> "sm",
            "align"=> "center",
            "color"=> "#5D5858"
          ],
         
  
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
                      "label"=> "ยอดเงินที่ใช้ได้",
                      "uri"=> "https://linecorp.com"
                  ],
                    "color"=> "#5FC1DF",
                    "margin"=> "xl",
                    "height"=> "sm",
                    "style"=> "primary"
                ],
                  [
                    "type"=> "button",
                    "action"=> [
                      "type"=> "uri",
                      "label"=> "เช็ครายการใช้จ่าย",
                      "uri"=> "https://linecorp.com"
                    ],
                    "color"=> "#5FC1DF",
                    "margin"=> "sm",
                    "height"=> "sm",
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

