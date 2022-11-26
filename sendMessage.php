<?php

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