<?php
include('config.php');

$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = '072ioqcw4uT17+qwjIDmsn4XlTguP6hRKZjWyJf2nu5tFaheu0baLx26OQ3K5II9RyHunNm6/KGAVw+uDgy6GQEAeKsAhLGAIpJCYMLvxVW4aCCAL4XClCPZUtKmZzjBM5mOHHi5w8jFzTfgnDVFc1GUYhWQfeY8sLGRXgo3xvw=';
$channelSecret = '157d1d03926e37e516f42f5e9a44af73';
$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$link = URL .'api/apiparent/show_subjgrade.php?system=school&id=0001&student=01658&card=1959900766962&action=subjgrade';

$result1 = file_get_contents($link);
$request_array1  = (json_decode($result1, true));

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array



//echo $request_array1[0]['data'][0]['GPA_ALL'];
$val = strval($request_array1['data'][0]['GPA_ALL']);
print_r($request_array1['data'][0]['GPA_ALL']);

$val1 = strval($request_array1['data'][0]['CREDIT_ALL']);
print_r($request_array1['data'][0]['CREDIT_ALL']);
//$val = "0";

$jsonFlex = [
        "type"=> "flex",
        "altText"=> "ผลการเรียน",
        "contents"=> [
          "type"=> "bubble",
          "hero"=> [
            "type"=> "image",
            "url"=> "https://i.dlpng.com/static/png/351060_preview.png",
            "size"=> "full",
            "aspectRatio"=> "3:1",
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
                "text"=> "ผลการเรียน",
                "size"=> "xl",
                "size"=> "xl",
                "weight"=>  "bold",
                "color"=>  "#226068"
            ],
              [
                "type"=>  "box",
                "layout"=>  "vertical",
                "spacing"=>  "sm",
                "contents"=>  [
                  [
                    "type"=>  "box",
                    "layout"=>  "baseline",
                    "contents"=>  [
                      [
                        "type"=>  "text",
                        "text"=>  "ผลการเรียนรวม",
                        "flex"=>  0,
                        "margin"=>  "sm",
                        "weight"=>  "regular",
                        "color"=>  "#226068"
                    ],
                      [
                        "type"=>  "text",
                        "text"=>  $val,
                        "size"=>  "xl",
                        "align"=>  "end",
                        "weight"=>  "bold",
                        "color"=>  "#1084EA"
                    ]
                    ]
                    ],
                  [
                    "type"=> "separator",
                    "margin"=>  "md"
                ],
                  [
                    "type"=>  "box",
                    "layout"=>  "baseline",
                    "contents"=>  [
                      [
                        "type"=>  "text",
                        "text"=>  $val1."รวมหน่วยกิจ",
                        "flex"=>  0,
                        "margin"=>  "sm",
                        "weight"=>  "regular",
                        "color"=>  "#226068"
                    ],
                      [
                        "type"=>  "text",
                        "text"=>  "หน่วยกิจ",
                        "size"=>  "sm",
                        "align"=>  "end",
                        "weight"=>  "regular",
                        "color"=>  "#226068"
                    ]
                    ]


                     
                ]
                ]
            ]
            ]
            ],
          "footer"=>  [
            "type"=>  "box",
            "layout"=>  "vertical",
            "contents"=>  [
              [
                "type"=>  "button",
                "action"=>  [
                  "type"=>  "uri",
                  "label"=>  "ผลการเรียนแต่ละเทอม",
                  "uri"=>  "http://405965027.student.yru.ac.th/tes5line/grade1.php"
            ],
                "color"=>  "#519BDC",
                "style"=>  "primary"
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