<?php

$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = '072ioqcw4uT17+qwjIDmsn4XlTguP6hRKZjWyJf2nu5tFaheu0baLx26OQ3K5II9RyHunNm6/KGAVw+uDgy6GQEAeKsAhLGAIpJCYMLvxVW4aCCAL4XClCPZUtKmZzjBM5mOHHi5w8jFzTfgnDVFc1GUYhWQfeY8sLGRXgo3xvw=';
$channelSecret = '157d1d03926e37e516f42f5e9a44af73';

$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$content = file_get_contents('php://input');   // Get request content
$request_array = json_decode($content , true);   // Decode JSON to Array

$jsonFlex = [
    "type"=> "flex",
    "altText"=> "Flex Message",
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
            "color"=> "#23731C"
          ],
          [
            "type"=> "text",
            "text"=> "ตรวจเช็ครายละเอียดค่าใช้จ่าย",
            "margin"=> "md",
            "align"=> "center",
            "color"=> "#5D5858"
          ],
         
          [
            "type"=> "text",
            "text"=> "____________________________",
            "margin"=> "lg",
            "align"=> "start",
            "weight"=> "regular",
            "color"=> "#53AB58"
          ],
          [
            "type"=> "box",
            "layout"=> "vertical",
            "spacing"=> "sm",
            "contents"=> [
              [
                "type"=> "box",
                "layout"=> "baseline",
                "contents"=> [
                  [
                    "type"=> "text",
                    "text"=> "จำนวนเงิน",
                    "flex"=> 0,
                    "margin"=> "xl",
                    "weight"=> "regular",
                    "color"=> "#5D4D4D"
                  ],
                  [
                    "type"=> "text",
                    "text"=> "xxx.xx",
                    "margin"=> "xxl",
                    "size"=> "sm",
                    "align"=> "center",
                    "color"=> "#0F0E0E"
                  ],
                  [
                    "type"=> "text",
                    "text"=> "บาท",
                    "size"=> "sm",
                    "align"=> "end",
                    "color"=> "#0F0E0E"
                  ]
                ]
                  ],
              [
                "type"=> "box",
                "layout"=> "baseline",
                "contents"=> [
                  [
                    "type"=> "text",
                    "text"=> "ยอดเงินคงเหลือ",
                    "flex"=> 0,
                    "margin"=> "lg",
                    "weight"=> "regular",
                    "color"=> "#4D3B3B"
                  ],
                  [
                    "type"=> "text",
                    "text"=> "xxx.xx",
                    "margin"=> "xl",
                    "size"=> "sm",
                    "align"=> "center",
                    "color"=> "#201B1B"
                  ],
                  [
                    "type"=> "text",
                    "text"=> "บาท",
                    "size"=> "sm",
                    "align"=> "end",
                    "color"=> "#201B1B"
                  ]
                ]
              ]
            ]
                  ],
          [
            "type"=> "filler"
          ],
          [
            "type"=> "text",
            "text"=> "____________________________",
            "align"=> "start",
            "gravity"=> "center",
            "weight"=> "regular",
            "color"=> "#53AB58"
          ],
         
        ]
              ],
      "footer"=> [
        "type"=> "box",
        "layout"=> "vertical",
        "contents"=> [
          [
            "type"=> "spacer",
            "size"=> "sm"
          ],
          [
            "type"=> "spacer",
            "size"=> "xl"
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
