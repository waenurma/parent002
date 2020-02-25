
<?php

$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = '072ioqcw4uT17+qwjIDmsn4XlTguP6hRKZjWyJf2nu5tFaheu0baLx26OQ3K5II9RyHunNm6/KGAVw+uDgy6GQEAeKsAhLGAIpJCYMLvxVW4aCCAL4XClCPZUtKmZzjBM5mOHHi5w8jFzTfgnDVFc1GUYhWQfeY8sLGRXgo3xvw=';
$channelSecret = '157d1d03926e37e516f42f5e9a44af73';

$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$content = file_get_contents('php://input');   // Get request content
$request_array = json_decode($content , true);   // Decode JSON to Array

// $jsonimage_carousel = [
    
//         "type"=> "template",
//         "altText"=> "รูปภาพบราวนี่ที่สามารถคลิกได้",
//         "template"=> [
//           "type"=> "image_carousel",
//           "columns"=> [
//             //รูปภาพ->คลิกแล้วจะส่งเป็นข้อความ
            
//             [
//               "imageUrl"=> "https://vignette.wikia.nocookie.net/line/images/b/bb/2015-brown.png",
//               "action"=>[
//                 "type"=> "message",
//                 "label"=> "Brown",
//                 "text"=> "Brown was selected"
//               ]
//               ],
//                //รูปภาพ->คลิกแล้วลิงค์ไปยังหน้าอื่น
//             [
//               "imageUrl"=> "https://vignette.wikia.nocookie.net/line/images/1/10/2015-cony.png",
//               "action"=> [
//                 "type"=> "uri",
//                 "label"=> "คลิกเลย",
//                 "uri"=> "https://developers.line.biz"
//               ]
//             ]
//           ]
//         ]
//         ];

$jsonFlex = [
  "type" => "flex",
  "altText" => "Hello Flex Message",
  "contents" => [
    "type" => "bubble",
    "direction" => "ltr",
    "header" => [
      "type" => "box",
      "layout" => "vertical",
      "contents" => [
        [
          "type" => "text",
          "text" => "Purchase",
          "size" => "lg",
          "align" => "start",
          "weight" => "bold",
          "color" => "#009813"
        ],
        [
          "type" => "text",
          "text" => "฿ 100.00",
          "size" => "3xl",
          "weight" => "bold",
          "color" => "#000000"
        ],
        [
          "type" => "text",
          "text" => "Rabbit Line Pay",
          "size" => "lg",
          "weight" => "bold",
          "color" => "#000000"
        ],
        [
          "type" => "text",
          "text" => "2019.02.14 21:47 (GMT+0700)",
          "size" => "xs",
          "color" => "#B2B2B2"
        ],
        [
          "type" => "text",
          "text" => "Payment complete.",
          "margin" => "lg",
          "size" => "lg",
          "color" => "#000000"
        ]
      ]
    ],
    "body" => [
      "type" => "box",
      "layout" => "vertical",
      "contents" => [
        [
          "type" => "separator",
          "color" => "#C3C3C3"
        ],
        [
          "type" => "box",
          "layout" => "baseline",
          "margin" => "lg",
          "contents" => [
            [
              "type" => "text",
              "text" => "Merchant",
              "align" => "start",
              "color" => "#C3C3C3"
            ],
            [
              "type" => "text",
              "text" => "BTS 01",
              "align" => "end",
              "color" => "#000000"
            ]
          ]
        ],
        [
          "type" => "box",
          "layout" => "baseline",
          "margin" => "lg",
          "contents" => [
            [
              "type" => "text",
              "text" => "New balance",
              "color" => "#C3C3C3"
            ],
            [
              "type" => "text",
              "text" => "฿ 45.57",
              "align" => "end"
            ]
          ]
        ],
        [
          "type" => "separator",
          "margin" => "lg",
          "color" => "#C3C3C3"
        ]
      ]
    ],
    "footer" => [
      "type" => "box",
      "layout" => "horizontal",
      "contents" => [
        [
          "type" => "text",
          "text" => "View Details",
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




