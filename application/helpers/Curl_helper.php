<?php

function call_curl($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($ch);

    curl_close($ch);

    return $result;
}

function call_cost($url, $data)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        // CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: fa49f24f8066436b03d51d12af6288f8"
        ),
    ));

    $response = curl_exec($curl);
    $response = json_decode($response, 1);
    $err = curl_error($curl);

    curl_close($curl);


    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        return $response;
    }
}
