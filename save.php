<?php
function makeString($url, $name) {
  $curl = curl_init();
  $fp = fopen($name, "w");

  curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
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
  $content = file_get_contents($name);
  $naked = strip_tags($content);

  return $naked;
}

function countWords($text, $words) {
  foreach ($words as $word) {
    
      $count = substr_count($text, $word);
      echo "Det finns " . $count . " utav " . $word . "<br>";
    }
}

$words = [
  "jag",
  "HTML",
  "Bok"
];
$wordsTwo = [
  "är",
  "CSS"
];

$naked = makeString("http://mariaberntsson.se/", "mariaberntsson.html");
countWords($naked, $words);
countWords($naked, $wordsTwo);