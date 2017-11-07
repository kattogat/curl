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
//$blank = explode(" ", $naked);

echo "Det finns " . substr_count($naked, "jag") . " jag i texten." . "<br>";
echo "Det finns " . substr_count($naked, "HTML") . " HTML i texten." . "<br>";
echo "Det finns " . substr_count($naked, "Bok") . " bok i texten." . "<br>";
