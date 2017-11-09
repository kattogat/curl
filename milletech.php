<?php
    require "config.php";

    $curl = curl_init();
    $fileName = "milletech.json";
    $fp = fopen($fileName, "w");
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://www.milletech.se/invoicing/export/customers",
      //CURLOPT_RETURNTRANSFER => true,
      CURLOPT_FILE => $fp,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "postman-token: d0f852d2-e7c3-62dd-f118-8566fb29cf0f"
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
    
    fclose($fp);
    $content = file_get_contents($fileName);
    $data = json_decode($content, true);

    foreach ($data as $row) {

        $toEmail = $row["email"];
        $toFirstname = $row["firstname"];
        $toLastname = $row["lastname"];
        $toGender = $row["gender"];
        $toCustumer_activated = $row["customer_activated"];
        $toGroup_id = $row["group_id"];
        $toCustumer_company = $row["customer_company"];
        $toDefault_billing = $row["default_billing"];
        $toDefault_shipping = $row["default_shipping"];
        $toIs_active = $row["is_active"];
        $toCreated_at = $row["created_at"];
        $toUpdated_at = $row["updated_at"];
        $toCustumer_inoice_email = $row["customer_invoice_email"];
        $toCustumer_extra_text = $row["customer_extra_text"];
        $toCustumer_due_date = $row["customer_due_date_period"];
        $toExisting_id = $row["id"];

        $toFirstname_adress = $row["address"]["firstname"];
        $toLastname_adress = $row["address"]["lastname"];
        $toEmail_adress = $row["address"]["email"];
        $toEmail_adress = $row["address"]["email"];
        $toCustumer_address_id = $row["address"]["customer_address_id"];
        $toPostcode = $row["address"]["postcode"];
        $toStreet = $row["address"]["street"];
        $toCity = $row["address"]["city"];
        $toTel = $row["address"]["telephone"]; 
        $toContry_id = $row["address"]["country_id"]; 
        $toAdress_type = $row["address"]["address_type"];  
        $toCompany = $row["address"]["company"]; 
        $toContry = $row["address"]["country"];
        $toAddress_id = $row["address"]["id"];


        $sql = "INSERT INTO user (email, firstname, lastname, gender, customer_activated, group_id, customer_company, 
        default_billing, default_shipping, is_active, created_at, updated_at, customer_invoice_email, customer_extra_text, customer_due_date_period, existing_id)
        VALUES(:email, :firstname, :lastname, :gender, :customer_activated, :group_id, :customer_company, 
        :default_billing, :default_shipping, :is_active, :created_at, :updated_at, :customer_invoice_email, :customer_extra_text, :customer_due_date_period, :existing_id)";
        $intoDb = $pdo->prepare($sql);
        $intoDb->execute (array(':email' => $toEmail, ':firstname' => $toFirstname, ':lastname' => $toLastname, ':gender' => $toGender, ':customer_activated' => $toCustumer_activated, ':group_id' => $toGroup_id, ':customer_company' => $toCustumer_company, 
        ':default_billing' => $toDefault_billing, ':default_shipping' => $toDefault_shipping, ':is_active' => $toIs_active, ':created_at' => $toCreated_at, ':updated_at' => $toUpdated_at, ':customer_invoice_email' => $toCustumer_inoice_email, ':customer_extra_text' => $toCustumer_extra_text, ':customer_due_date_period' => $toCustumer_due_date, ':existing_id' => $toExisting_id)); 
    
        $sql = "INSERT INTO address (customer_id, customer_address_id, email, firstname, lastname, postcode, street, 
        city, telephone, country_id, address_type, company, country, existing_id)
        VALUES(:customer_id, :customer_address_id, :email, :firstname, :lastname, :postcode, :street, 
        :city, :telephone, :country_id, :address_type, :company, :country, :existing_id)";
        $intoDb = $pdo->prepare($sql);
        $intoDb->execute (array(':customer_id' => $toExisting_id, ':customer_address_id' => $toCustumer_address_id, ':email' => $toEmail_adress, ':firstname' => $toFirstname_adress, ':lastname' => $toLastname_adress, ':postcode' => $toPostcode, ':street' => $toStreet, 
        ':city' => $toCity, ':telephone' => $toTel, ':country_id' => $toContry_id, ':address_type' => $toAdress_type, ':company' => $toCompany, ':country' => $toContry, ':existing_id' => $toAddress_id)); 
    }