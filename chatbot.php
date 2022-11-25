<?php
// --Credit--
// Medium: https://medium.com/@sirateek
// Github: https://github.com/maiyarapkung
// Develop with /\/\ By: Siratee K.
//              \  /
//               \/


$LINEData = file_get_contents('php://input');
$flexDataJson = '{
  type: "bubble",
  body: {
    type: "box",
    layout: "vertical",
    contents: [
      {
        type: "text",
        text: `${company}`,
        color: "#1DB446",
        size: "md",
        weight: "bold",
      },
      {
        type: "text",
        text: `ตำแหน่ง : ${department}`,
        weight: "bold",
        size: "xl",
        margin: "md",
      },
      {
        type: "text",
        text: `คุณ ${name}`,
        size: "sm",
        color: "#555555",
        wrap: true,
        margin: "sm",
      },
      {
        type: "text",
        text: `รหัสพนักงาน : ${id}`,
        size: "sm",
        color: "#555555",
        wrap: true,
        margin: "sm",
      },
      {
        type: "separator",
        margin: "xxl",
      },
      {
        type: "box",
        layout: "vertical",
        margin: "xxl",
        spacing: "sm",
        contents: [
          {
            type: "box",
            layout: "horizontal",
            contents: [
              {
                type: "text",
                text: "เงินเดือน",
                size: "md",
                color: "#777777",
                flex: 0,
              },
              {
                type: "text",
                text: `${numberToStringCurrency(salary)} บาท`,
                size: "md",
                color: "#777777",
                align: "end",
              },
            ],
          },
          {
            type: "box",
            layout: "horizontal",
            contents: [
              {
                type: "text",
                text: "โอที",
                size: "md",
                color: "#777777",
                flex: 0,
              },
              {
                type: "text",
                text: `${numberToStringCurrency(ot)} บาท`,
                size: "md",
                color: "#777777",
                align: "end",
              },
            ],
          },
        ],
      },
      {
        type: "separator",
        margin: "xxl",
      },
      {
        type: "box",
        layout: "horizontal",
        margin: "lg",
        contents: [
          {
            type: "text",
            text: "รวมเป็นเงิน",
            size: "lg",
            color: "#555555",
            flex: 0,
            weight: "bold",
          },
          {
            type: "text",
            text: `${numberToStringCurrency(total)} บาท`,
            color: "#555555",
            size: "lg",
            align: "end",
            weight: "bold",
            style: "normal",
          },
        ],
      },
    ],
  },
  styles: {
    footer: {
      separator: true,
    },
  },
};';
$jsonData = json_decode($LINEData, true);

$replyToken = $jsonData["events"][0]["replyToken"];
$userID = $jsonData["events"][0]["source"]["userId"];
$text = $jsonData["events"][0]["message"]["text"];
$timestamp = $jsonData["events"][0]["timestamp"];

// $flexDataJsonDeCode = ["contents"]["contents"][0]["header"]["contents"][0]["text"];

// $servername = "https://d588-184-82-148-66.ap.ngrok.io/phpmyadmin/";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINE";
$mysql = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($mysql, "utf8");

if ($mysql->connect_error) {
  $errorcode = $mysql->connect_error;
  print("MySQL(Connection)> " . $errorcode);
}

function sendMessage($replyJson, $sendInfo)
{
  $ch = curl_init($sendInfo["URL"]);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLINFO_HEADER_OUT, true);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt(
    $ch,
    CURLOPT_HTTPHEADER,
    array(
      'Content-Type: application/json',
      'Authorization: Bearer ' . $sendInfo["AccessToken"]
    )
  );
  curl_setopt($ch, CURLOPT_POSTFIELDS, $replyJson);
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
          $replyText["text"] = "สวัสดีคุณ $Name $Surname (#$CustomerID)";
        }
        break;
        // case "slips":
        //   break;
      default:
        $replyText["text"] = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse tenetur molestias, nam rem maxime facilis perferendis saepe culpa assumenda, facere voluptatem nisi nobis id eum error delectus necessitatibus at minima!";
    }
  }
}

$lineData['URL'] = "https://api.line.me/v2/bot/message/reply";
$lineData['AccessToken'] = "QyIKS6V+lZOMRnUG2U9X1SVWzXeJZe+pOHjSwtfQOEkiVFPzNRFm0zvSWjtLyOGnDDCGpQ9dFbR/eZ7iw7mWEGrAVjJ5+8PAxZEsCB2+CNPp10pjrVjwbKeRzC5aMEKfl1kGJlr4nguXsoVVhMGfaQdB04t89/1O/w1cDnyilFU=";

$replyJson["replyToken"] = $replyToken;
$replyJson["messages"][0] = $replyText;

$encodeJson = json_encode($replyJson);

$results = sendMessage($encodeJson, $lineData);
echo $results;
http_response_code(200);

// --Credit--
// Medium: https://medium.com/@sirateek
// Github: https://github.com/maiyarapkung
// Develop with /\/\ By: Siratee K.
//              \  /
//               \/
