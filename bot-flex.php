<?php
    
    $accessToken = "exRwq1i1noogIKE8x9QpmYH8PlQQdSvCjBEeoQfy+sCbKkLHNV3Kol5ZxfuCebtuRyHunNm6/KGAVw+uDgy6GQEAeKsAhLGAIpJCYMLvxVWVX2b4o8DN0z03MVgp1TC2JsjIEQPXRqWxua9JrPIVfwdB04t89/1O/w1cDnyilFU=";//copy Channel access token ตอนที่ตั้งค่ามาใส่
    $API_URL = 'https://api.line.me/v2/bot/message';
    $channelSecret = 'aa79f5f6f04e775f836bf54644526aed';
    $POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);
    $request = file_get_contents('php://input');   // Get request content
    $request_array = json_decode($request, true);   // Decode JSON to Array

    $jsonButtons = [
      "type" => "template",
      "altText" => "ผลการเรียน",
      "template" => [
        "type"=> "buttons",
        "actions"=> [
        [
            "type" => "massage",
            "label" => "Action 1",
            "text" => "ผลการเรียน 1/63"
        ],
          [
            "type" => "message",
            "label" => "Action 2",
            "text" => "ผลการเรียน 2/63"
          ],
        
        "thumbnailImageUrl" > "SPECIFY_YOUR_IMAGE_URL",
        "title" => "ผลการเรียน",
        "text" => "ชื่อ-นามสกุล"
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
              'messages' => [$jsonButtons]
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