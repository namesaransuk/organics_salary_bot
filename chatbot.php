<?php
require('connect.php');
require('sendMessage.php');

$LINEData = file_get_contents('php://input');
$jsonData = json_decode($LINEData, true);

$replyToken = $jsonData["events"][0]["replyToken"];
$userID = $jsonData["events"][0]["source"]["userId"];
$text = $jsonData["events"][0]["message"]["text"];
$timestamp = $jsonData["events"][0]["timestamp"];

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
        if ($getUserNum < 1) {
          $replyText["text"] = 'กรุณากรอกรหัสพนักงาน เช่น "รหัส:OGN0123"';
        } else {
          $replyText["text"] = 'ไม่สามารถลงทะเบียนซ้ำได้';
        }
        break;
      case "salary":
        if ($getUserNum < 1) {
          $replyText["text"] = "กรุณาลงทะเบียนก่อนใช้งาน";
        } else {
          while ($row = $getUser->fetch_assoc()) {
            $Name = $row['Name'];
            $Surname = $row['Surname'];
            $CustomerID = $row['CustomerID'];
            $Role = $row['Role'];
            $Salary = $row['Salary'];
            $OT = $row['OT'];
          }
          $flexDataJson = '{
            "type": "flex",
            "altText": "Flex Message",
            "contents": {
              "type": "bubble",
              "body": {
                "type": "box",
                "layout": "vertical",
                "contents": [
                  {
                    "type": "text",
                    "text": "Organics Legendary",
                    "weight": "bold",
                    "size": "md",
                    "color": "#1DB446"
                  },
                  {
                    "type": "box",
                    "layout": "vertical",
                    "contents": [
                      {
                        "type": "text",
                        "text": "ตำแหน่ง : ' . $Role . ' ",
                        "margin": "md",
                        "size": "xl",
                        "weight": "bold"
                      },
                      {
                        "type": "text",
                        "text": "ชื่อ : ' . $Name . ' ' . $Surname . '",
                        "margin": "md"
                      },
                      {
                        "type": "text",
                        "text": "รหัสพนักงาน : ' . $CustomerID . '"
                      }
                    ]
                  },
                  {
                    "type": "separator",
                    "margin": "xl"
                  },
                  {
                    "type": "box",
                    "layout": "vertical",
                    "contents": [
                      {
                        "type": "box",
                        "layout": "horizontal",
                        "contents": [
                          {
                            "type": "text",
                            "text": "เงินเดือน",
                            "color": "#777777",
                            "size": "sm"
                          },
                          {
                            "type": "text",
                            "text": "' . number_format($Salary) . ' บาท",
                            "align": "end",
                            "color": "#777777",
                            "size": "sm"
                          }
                        ]
                      },
                      {
                        "type": "box",
                        "layout": "horizontal",
                        "contents": [
                          {
                            "type": "text",
                            "text": "โอที",
                            "color": "#777777",
                            "size": "sm"
                          },
                          {
                            "type": "text",
                            "text": "' . number_format($OT) . ' บาท",
                            "align": "end",
                            "color": "#777777",
                            "size": "sm"
                          }
                        ]
                      }
                    ],
                    "margin": "xl"
                  },
                  {
                    "type": "separator",
                    "margin": "xl"
                  },
                  {
                    "type": "box",
                    "layout": "vertical",
                    "contents": [
                      {
                        "type": "box",
                        "layout": "horizontal",
                        "contents": [
                          {
                            "type": "text",
                            "text": "รวมเป็นเงิน",
                            "weight": "bold"
                          },
                          {
                            "type": "text",
                            "text": "' . number_format($Salary + $OT) . ' บาท",
                            "align": "end",
                            "weight": "bold"
                          }
                        ]
                      }
                    ],
                    "margin": "xl"
                  }
                ]
              }
            }
          }';
        }
        break;
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

if ($flexDataJson) {
  $flexDataJsonDecode = json_decode($flexDataJson, true);
  $replyJson["messages"][] = $flexDataJsonDecode;
} else if ($replyText["text"]) {
  $replyJson["messages"][] = $replyText;
}
$encodeJson = json_encode($replyJson);

$results = sendMessage($encodeJson, $lineData);
echo $results;
http_response_code(200);
