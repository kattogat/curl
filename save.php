<?php

$curl = curl_init();
$fileName = "mariaberntsson.html";
$fp = fopen($fileName, "w");

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://mariaberntsson.se/",
  //CURLOPT_RETURNTRANSFER => true,
  CURLOPT_FILE => $fp,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
    "postman-token: 39695d27-c71e-c8cb-8ede-c317f31cf818"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
}

fclose($fp);
$content = file_get_contents($fileName);


$naked = strip_tags($content);
$words = [
  "jag",
  "HTML",
  "Bok"
];
$wordsTwo = [
  "är",
  "CSS"
];

function countWords($text, $words) {
  foreach ($words as $word) {
    
      $count = substr_count($text, $word);
      echo "Det finns " . $count . " $word i texten." . "<br>";
    }
};

countWords($naked, $words);
countWords($naked, $wordsTwo);