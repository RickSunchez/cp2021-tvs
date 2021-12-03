<?php
    if (!isset($_POST["access_token"])) {
        die("Smthg missing");
    }

    echo get_userinfo($_POST["access_token"]);

    function get_userinfo($access_token) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://tvscp.tionix.ru/realms/master/protocol/openid-connect/userinfo',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array("Authorization: Bearer $access_token")
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        
        return $response;
    }
?>