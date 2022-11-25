<?php
require('connect.php');

$LINEData = file_get_contents('php://input');
$jsonData = json_decode($LINEData, true);

$replyToken = $jsonData["events"][0]["replyToken"];
$userID = $jsonData["events"][0]["source"]["userId"];
$text = $jsonData["events"][0]["message"]["text"];
$timestamp = $jsonData["events"][0]["timestamp"];

function sendMessage($encodeJson, $lineData)
{
  $ch = curl_init();
  curl_setopt_array($ch, array(
    CURLOPT_URL => $lineData["URL"],
    CURLINFO_HEADER_OUT => true,
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $encodeJson,
    CURLOPT_HTTPHEADER =>
    array(
      // 'Content-Type: application/json',
      // 'Authorization: Bearer ' . $lineData["AccessToken"]
      "Authorization: Bearer " . $lineData['AccessToken'],
      "cache-control: no-cache",
      "Content-Type: application/json; charset=UTF-8",
    ),

  ));
  $result = curl_exec($ch);
  curl_close($ch);
  return $result;
}

$mysql->query("INSERT INTO `LOG`(`UserID`, `Text`, `Timestamp`) VALUES ('$userID','$text','$timestamp')");

$replyText["type"] = "text";
if ($text) {
  $messageFromUser = trim($text);
  $checkRegister = explode("รหัส:", $messageFromUser);
  $needToRegister = $checkRegister && $checkRegister[1];
  $idForRegister = $checkRegister[1];
  $getUser = $mysql->query("SELECT * FROM `Customer` WHERE `UserID`='$userID'");
  $getUserNum = $getUser->num_rows;
  $getCustomer = $mysql->query("SELECT * FROM `Customer` WHERE `CustomerID`='$idForRegister'");
  $getCustomerNum = $getCustomer->num_rows;

  if ($needToRegister) {
    if ($getUserNum < 1) {
      if ($getCustomerNum < 1) {
        $replyText["text"] = "รหัสพนักงานไม่ตรงกับที่มีในระบบ กรุณาลงทะเบียนใหม่อีกครั้ง";
      } else {
        $mysql->query("UPDATE `customer` SET `UserID`='$userID' WHERE `CustomerID`='$idForRegister'");
        $replyText["text"] = "Line ID นี้ได้ลงทะเบียนด้วยรหัส $idForRegister เรียบร้อยแล้ว";
      }
    } else {
      $replyText["text"] = "ไม่สามารถลงทะเบียนซ้ำได้";
    }
  } else {
    switch ($messageFromUser) {
      case "register":
        $replyText["text"] = 'กรุณากรอกรหัสพนักงาน เช่น "รหัส:OGN0123"';
        break;
      case "salary":
        if ($getUserNum < 1) {
          $replyText["text"] = "กรุณาลงทะเบียนก่อนใช้งาน";
        } else {
          while ($row = $getUser->fetch_assoc()) {
            $Name = $row['Name'];
            $Surname = $row['Surname'];
            $CustomerID = $row['CustomerID'];
          }
          $flexDataJson = '{
            "type": "flex",
            "altText": "Flex Message",
            "contents": {
              "type": "carousel",
              "contents": [
                {
                  "type": "bubble",
                  "hero": {
                    "type": "image",
                    "url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/01_5_carousel.png",
                    "size": "full",
                    "aspectRatio": "20:13",
                    "aspectMode": "cover"
                  },
                  "body": {
                    "type": "box",
                    "layout": "vertical",
                    "spacing": "sm",
                    "contents": [
                      {
                        "type": "text",
                        "text": "'.$Name.'",
                        "size": "xl",
                        "weight": "bold",
                        "wrap": true
                      },
                      {
                        "type": "box",
                        "layout": "baseline",
                        "contents": [
                          {
                            "type": "text",
                            "text": "$49",
                            "flex": 0,
                            "size": "xl",
                            "weight": "bold",
                            "wrap": true
                          },
                          {
                            "type": "text",
                            "text": ".99",
                            "flex": 0,
                            "size": "sm",
                            "weight": "bold",
                            "wrap": true
                          }
                        ]
                      }
                    ]
                  },
                  "footer": {
                    "type": "box",
                    "layout": "vertical",
                    "spacing": "sm",
                    "contents": [
                      {
                        "type": "button",
                        "action": {
                          "type": "uri",
                          "label": "Add to Cart",
                          "uri": "https://linecorp.com"
                        },
                        "style": "primary"
                      },
                      {
                        "type": "button",
                        "action": {
                          "type": "uri",
                          "label": "Add to whishlist",
                          "uri": "https://linecorp.com"
                        }
                      }
                    ]
                  }
                },
                {
                  "type": "bubble",
                  "hero": {
                    "type": "image",
                    "url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/01_6_carousel.png",
                    "size": "full",
                    "aspectRatio": "20:13",
                    "aspectMode": "cover"
                  },
                  "body": {
                    "type": "box",
                    "layout": "vertical",
                    "spacing": "sm",
                    "contents": [
                      {
                        "type": "text",
                        "text": "Metal Desk Lamp",
                        "size": "xl",
                        "weight": "bold",
                        "wrap": true
                      },
                      {
                        "type": "box",
                        "layout": "baseline",
                        "flex": 1,
                        "contents": [
                          {
                            "type": "text",
                            "text": "$11",
                            "flex": 0,
                            "size": "xl",
                            "weight": "bold",
                            "wrap": true
                          },
                          {
                            "type": "text",
                            "text": ".99",
                            "flex": 0,
                            "size": "sm",
                            "weight": "bold",
                            "wrap": true
                          }
                        ]
                      },
                      {
                        "type": "text",
                        "text": "Temporarily out of stock",
                        "flex": 0,
                        "margin": "md",
                        "size": "xxs",
                        "color": "#FF5551",
                        "wrap": true
                      }
                    ]
                  },
                  "footer": {
                    "type": "box",
                    "layout": "vertical",
                    "spacing": "sm",
                    "contents": [
                      {
                        "type": "button",
                        "action": {
                          "type": "uri",
                          "label": "Add to Cart",
                          "uri": "https://linecorp.com"
                        },
                        "flex": 2,
                        "color": "#AAAAAA",
                        "style": "primary"
                      },
                      {
                        "type": "button",
                        "action": {
                          "type": "uri",
                          "label": "Add to wish list",
                          "uri": "https://linecorp.com"
                        }
                      }
                    ]
                  }
                },
                {
                  "type": "bubble",
                  "body": {
                    "type": "box",
                    "layout": "vertical",
                    "spacing": "sm",
                    "contents": [
                      {
                        "type": "button",
                        "action": {
                          "type": "uri",
                          "label": "See more",
                          "uri": "https://linecorp.com"
                        },
                        "flex": 1,
                        "gravity": "center"
                      }
                    ]
                  }
                }
              ]
            }
          }';
        }
        break;
        // case "slips":
        //   break;
      default:
        $replyText["text"] = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse tenetur molestias, nam rem maxime facilis perferendis saepe culpa assumenda, facere voluptatem nisi nobis id eum error delectus necessitatibus at minima!";
    }
  }
}



// $lineData['URL'] = "https://api.line.me/v2/bot/message/reply";
$lineData['URL'] = "https://api.line.me/v2/bot/message/push";
$lineData['AccessToken'] = "QyIKS6V+lZOMRnUG2U9X1SVWzXeJZe+pOHjSwtfQOEkiVFPzNRFm0zvSWjtLyOGnDDCGpQ9dFbR/eZ7iw7mWEGrAVjJ5+8PAxZEsCB2+CNPp10pjrVjwbKeRzC5aMEKfl1kGJlr4nguXsoVVhMGfaQdB04t89/1O/w1cDnyilFU=";

$replyJson["replyToken"] = $replyToken;
$replyJson["to"] = $userID;

if (isset($flexDataJson)) {
  $flexDataJsonDecode = json_decode($flexDataJson, true);
  $replyJson["messages"][] = $flexDataJsonDecode;
} else if ($replyText["text"]) {
  $replyJson["messages"][] = $replyText;
}
$encodeJson = json_encode($replyJson);

$results = sendMessage($encodeJson, $lineData);
echo $results;
http_response_code(200);
