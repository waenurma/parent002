<?php
/////////การมาเรียน

$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = '072ioqcw4uT17+qwjIDmsn4XlTguP6hRKZjWyJf2nu5tFaheu0baLx26OQ3K5II9RyHunNm6/KGAVw+uDgy6GQEAeKsAhLGAIpJCYMLvxVW4aCCAL4XClCPZUtKmZzjBM5mOHHi5w8jFzTfgnDVFc1GUYhWQfeY8sLGRXgo3xvw=';
$channelSecret = '157d1d03926e37e516f42f5e9a44af73';

$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$content = file_get_contents('php://input');   // Get request content
$request_array = json_decode($content , true);   // Decode JSON to Array

$jsonFlex = [
    "type"=> "flex",
    "altText"=> "เช็คการมาเรียน",
    "contents"=> [
      "type"=> "bubble",
      "body"=> [
        "type"=> "box",
        "layout"=> "vertical",
        "spacing"=> "md",
        "contents"=> [
          [
            "type"=> "text",
            "text"=> "การมาเรียน",
            "size"=> "xl",
            "gravity"=> "center",
            "weight"=> "bold",
            "wrap"=> true
          ],
          [
            "type"=> "box",
            "layout"=> "baseline",
            "margin"=> "md",
            "contents"=> [
              [
                "type"=> "text",
                "text"=> "คลิกตรวจสอบเพิ่มเติมได้ที่เมนูด้านล่าง",
                "flex"=> 0,
                "margin"=> "md",
                "size"=> "sm",
                "color"=> "#999999"
              ]
            ]
              ],
          [
            "type"=> "box",
            "layout"=>"vertical",
            "spacing"=> "sm",
            "margin"=> "lg",
            "contents"=> [
              [
                "type"=> "box",
                "layout"=> "baseline",
                "spacing"=> "sm",
                "contents"=> [
                  [
                    "type"=> "text",
                    "text"=> "มาเรียน",
                    "flex"=> 1,
                    "size"=> "sm",
                    "color"=> "#AAAAAA"
                  ],
                  [
                    "type"=> "text",
                    "text"=> "45 ครั้ง",
                    "flex"=> 4,
                    "size"=> "sm",
                    "align"=> "end",
                    "color"=> "#666666",
                    "wrap"=> true
                  ]
                ]
                  ],
              [
                "type"=> "box",
                "layout"=> "baseline",
                "spacing"=> "sm",
                "contents"=> [
                  [
                    "type"=> "text",
                    "text"=> "มาสาย",
                    "flex"=> 1,
                    "size"=> "sm",
                    "color"=> "#AAAAAA"
                  ],
                  [
                    "type"=> "text",
                    "text"=> "5 ครั้ง",
                    "flex"=> 4,
                    "size"=> "sm",
                    "align"=> "end",
                    "color"=> "#666666",
                    "wrap"=> true
                  ]
                ]
                  ],
              [
                "type"=> "box",
                "layout"=> "baseline",
                "spacing"=> "sm",
                "contents"=> [
                  [
                    "type"=> "text",
                    "text"=> "ขาดเรียน",
                    "flex"=> 0,
                    "size"=> "sm",
                    "color"=> "#AAAAAA"
                  ],
                  [
                    "type"=> "text",
                    "text"=> "- ครั้ง",
                    "flex"=> 4,
                    "size"=> "sm",
                    "align"=> "end",
                    "color"=> "#666666",
                    "wrap"=> true
                  ]
                ]
              ]
            ]
          ]
        ]
        ],
      "footer"=> [
        "type"=> "box",
        "layout"=> "horizontal",
        "flex"=> 1,
        "contents"=> [
          [
            "type"=> "button",
            "action"=> [
              "type"=> "uri",
              "label"=> "ตรวจสอบเพิ่มเติม",
              "uri"=> "https://linecorp.com"
            ],
            "margin"=> "xxl"
          ]
        ]
    ],
      "styles"=> [
        "footer"=> [
          "separatorColor"=> "#FFFFFF"
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
    