<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://curl.dev/form.php",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"animal\"\r\n\r\nÖrn\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"name\"\r\n\r\nHenrik\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
    "postman-token: cb920ab8-e883-ae79-220e-7765be679963"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

?>

<form method="post" action="form.php">
    <label>Namn</label><br>
    <input name="name" type="text"><br>  
    <label>animal</label><br>
    <input type="text" name="animal"><br>
    <input type="submit" text="Sänd">  
</form>

<?php
    require "config.php";

    $nam = $_POST["name"];
    $ani = $_POST["animal"];

    $sql = "INSERT INTO form (name, animal)
    VALUES(:nameuo, :animaluo)";
    $intoDb = $pdo->prepare($sql);
    $intoDb->execute (array(':nameuo' => $nam, ':animaluo' => $ani)); 