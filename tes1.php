
<?php
 ////////อันนี้แบบมีบัททอน/////////////
$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'm7uuiyQihjxD2Po3jFwWxjslOwuw1T/ODORXy1vPsFQ2XuUHVVj5Sk9sHQNhdNjMRyHunNm6/KGAVw+uDgy6GQEAeKsAhLGAIpJCYMLvxVU3EgejzBxajVyv30+aa3gPxAtxAgL7ertukDN7srPvXFGUYhWQfeY8sLGRXgo3xvw= ';//copy Channel access token ตอนที่ตั้งค่ามาใส่ 
$channelSecret = '1e9a50e53936e05409b5095cabc4ac2b';


$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$content = file_get_contents('php://input');   // Get request content
$request_array = json_decode($content , true);   // Decode JSON to Array

$jsonflex = [
    
        "type"=> "flex",
        "altText"=> "Flex Message",
        "contents"=> [
          "type"=> "bubble",
          "hero"=> [
            "type"=> "image",
            "url"=>"https://1.bp.blogspot.com/-hhxkuymydsU/XbFqiXeZAVI/AAAAAAAAUns/Ek_-UucXj-Q2Wg1-d9dgmDQnxazm4aNBgCPcBGAYYCw/w680/gold1.jpg",
            "size"=> "full",
            "aspectRatio"=> "20:13",
            "aspectMode"=> "cover",
            "action"=> [
              "type"=> "uri",
              "label"=> "Action",
              "uri"=> "https://linecorp.com"
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
                  "label"=> "Add to Cart",
                  "uri"=> "https://linecorp.com"
                ],
                "color"=> "#F3F131",
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
            'messages' => [$jsonflex]
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