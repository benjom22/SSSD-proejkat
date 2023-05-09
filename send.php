<?php

function send_sms($number, $api_key, $api_secret, $code) {

    $ch = curl_init();

    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL, "https://rest.nexmo.com/sms/json");
    curl_setopt($ch,CURLOPT_POST, 1);
    curl_setopt($ch,CURLOPT_POSTFIELDS, "from=BURCH&text=123&to=". $number ."&api_key=".$api_key."&api_secret=".$api_secret."");

    //So that curl_exec returns the contents of the cURL; rather than echoing it
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

    $server_output = curl_exec($ch);

    curl_close($ch);

    print_r($server_output);

    $response = json_decode($server_output, true);
    print_r($response);


    if (!empty($response["messages"][0]["message-id"])) {
        echo "OK";
    } else {
        echo "NOT OK";
    }
}

?>
