<?php

require "vendor/autoload.php";

use OTPHP\TOTP;

// A random secret will be generated from this.
// You should store the secret with the user for verification.

function storingHash() {
    $otp = TOTP::generate();
    $otp_hash_in_db = "FC7EC4YHKCQJLBFILPSFSXCZR3COA4XWMHSF6WBLCJWNAT5MISHKNTYMA6QHQ4WSBNUDE4N4YJY2E3ECYTA3ABQZJURJ3NRPML6DWQY";
    echo $otp_hash_in_db;
    return $otp_hash_in_db;
  }



// Note: use your own way to load the user secret.
// The function "load_user_secret" is simply a placeholder.
$hash = storingHash();
$otp = TOTP::createFromSecret($hash);
echo "The current OTP is: {$otp->now()}\n";


function qrScanner($hash){
    $otp = TOTP::createFromSecret($hash);
    $otp->setLabel('sssd-2023-20002226');
    $grCodeUri = $otp->getQrCodeUri(
    'https://api.qrserver.com/v1/create-qr-code/?data=[DATA]&size=300x300&ecc=M',
    '[DATA]'
);
echo "<img src='{$grCodeUri}'>";
}
qrScanner($hash);

function otpValidation($secret, $input)
{   
    $otp = TOTP::createFromSecret($secret); // create TOTP object from the secret.
    return $otp->verify($input); // Returns true if the input is verified, otherwise false.
}

// Generate OTP hash and create QR code
storingHash();

// Perform OTP validation

$otp_hash_in_db = $hash;
$input_otp = $otp->now();
function OTPValidate($otp_hash_in_db, $input_otp){
     // Example OTP input from user
    if (otpValidation($otp_hash_in_db, $input_otp)) {
        echo "OTP is valid";
    } else {
        echo "OTP is invalid";
    }   
}
OTPValidate($otp_hash_in_db, $input_otp);

?>