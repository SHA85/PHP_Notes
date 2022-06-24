<?php
$curl = curl_init();
$params = [
    "grant_type" => 'client_credentials', "client_id"  => 'CCB1-PS-20-00000333', 'client_secret'=>'OOvciD+vIt4eoDEEG8T+OQ##'
 ];

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://mims.imonitor.center/connect/token",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_ENCODING => "utf-8",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 3000,
    CURLOPT_FOLLOWLOCATION => false,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => http_build_query($params),  // Use http_build_query Important
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/x-www-form-urlencoded"
    ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
?>
