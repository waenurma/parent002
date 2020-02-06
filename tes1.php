<?php
$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'm7uuiyQihjxD2Po3jFwWxjslOwuw1T/ODORXy1vPsFQ2XuUHVVj5Sk9sHQNhdNjMRyHunNm6/KGAVw+uDgy6GQEAeKsAhLGAIpJCYMLvxVU3EgejzBxajVyv30+aa3gPxAtxAgL7ertukDN7srPvXFGUYhWQfeY8sLGRXgo3xvw= ';//copy Channel access token ตอนที่ตั้งค่ามาใส่ 
$channelSecret = '1e9a50e53936e05409b5095cabc4ac2b';


$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$content = file_get_contents('php://input');   // Get request content
$request_array = json_decode($content , true);   // Decode JSON to Array

$jsonbubble = [ 

 "type"=> "bubble",
 "body"=> [
   "type"=> "box",
   "layout"=> "vertical",
   "contents"=> [
     [
       "type"=> "image",
       "url"=> "https://sites.google.com/site/kchnanthwimutkul/_/rsrc/1499710187784/cheux-pheling-pheux-kar-khmnakhm/sthankarn-kar-chi-cheux-pheling-pheux-kar-khmnakhm/3-kar-kahnd-rakha-naman-cheux-pheling/3-แบรนด์น้ำมันต่างชาติ-ปรับทัพรีแบรนด์ครั้งใหญ่.jpg",
       "size"=>"full"
     ]
   ]
     ],
 "footer"=> [
   "type"=> "box",
   "layout"=> "vertical",
   "contents"=> [
     [
       "type"=> "spacer",
       "size"=> "xl"
     ],
     [
        "type"=> "button",
        "style"=> "primary",
        "action"=> [
          "type"=> "uri",
          "label"=> "Primary style button",
          "uri"=> "https://example.com"
       ],
      
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
            'messages' => [$jsonbubble]
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