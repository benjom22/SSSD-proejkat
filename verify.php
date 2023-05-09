<?php
$data = array(
            'secret' => "0xcc5268aC068Bcf0E89ADF177AAbD0F030d05892",
            'response' => $_POST['h-captcha-response']
        );
$verify = curl_init();
curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
curl_setopt($verify, CURLOPT_POST, true);
curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($verify);
//var_dump($response);
$responseData = json_decode($response, true);
var_dump($responseData);
echo"<pre>";
exit;
if($responseData->success) {
    // your success code goes here
} 
else {
   // return error to user; they did not pass
}
?>