<?php
    
$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'exRwq1i1noogIKE8x9QpmYH8PlQQdSvCjBEeoQfy+sCbKkLHNV3Kol5ZxfuCebtuRyHunNm6/KGAVw+uDgy6GQEAeKsAhLGAIpJCYMLvxVWVX2b4o8DN0z03MVgp1TC2JsjIEQPXRqWxua9JrPIVfwdB04t89/1O/w1cDnyilFU='; 
$channelSecret = 'aa79f5f6f04e775f836bf54644526aed';


$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array
$jsonFlex = [
  {
    "type": "flex",
    "altText": "Flex Message",
    "contents": {
      "type": "bubble",
      "hero": {
        "type": "image",
        "url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/01_1_cafe.png",
        "size": "full",
        "aspectRatio": "20:13",
        "aspectMode": "cover",
        "action": {
          "type": "uri",
          "label": "Line",
          "uri": "https://linecorp.com/"
        }
      },
      "body": {
        "type": "box",
        "layout": "vertical",
        "contents": [
          {
            "type": "text",
            "text": "ผลการเรียน",
            "size": "xl",
            "weight": "bold"
          }
        ]
      },
      "footer": {
        "type": "box",
        "layout": "vertical",
        "flex": 0,
        "spacing": "sm",
        "contents": [
          {
            "type": "button",
            "action": {
              "type": "uri",
              "label": "ผลการเรียน 1/63",
              "uri": "https://linecorp.com"
            },
            "height": "sm",
            "style": "link"
          },
          {
            "type": "button",
            "action": {
              "type": "uri",
              "label": "ผลการเรียน 2/63",
              "uri": "https://linecorp.com"
            },
            "height": "sm",
            "style": "link"
          },
          {
            "type": "spacer",
            "size": "xs"
          }
        ]
      }
    }
  }


 
if ( sizeof($request_array['events']) > 0 ) {
  foreach ($request_array['events'] as $event) {
      error_log(json_encode($event));
      $reply_message = "ผลการเรียน";
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