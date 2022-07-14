<?php
// Initialize a new cURL session
$curl = curl_init();  
$params = [
    "grant_type" => 'client_credentials', "client_id"  => 'CCB1-PS-20-00000000', 'client_secret'=>'OOvciD+vIt4eoDEEG8T+####'
 ];

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://mims.imonitor.center/connect/token",
    
    // True - Initialize the response into the $responseData variable. False - The response will be displayed directly on the screen.
    CURLOPT_RETURNTRANSFER => true,
    
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_ENCODING => "utf-8",
    
    // Enable-Disable Redirect 
    CURLOPT_FOLLOWLOCATION => false,
    // Maximum Number of Redirects
    CURLOPT_MAXREDIRS => 10,

    CURLOPT_TIMEOUT => 3000,

    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0,

    CURLOPT_CUSTOMREQUEST => "POST",
    // Use http_build_query
    CURLOPT_POSTFIELDS => http_build_query($params),
    
    /* Set HTTP Header
    - Content-Type: application/json  // For JSON
    - Content-Type: application/xml   // For XML
    - Content-Type: application/x-www-form-urlencoded  // Default Value
    */
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/x-www-form-urlencoded"
    ),
));

$response = curl_exec($curl);

if ($response === false) {
    echo 'Curl error: ' . curl_error($ch);
}
else {
    echo $response;
}

curl_close($curl);
?>
