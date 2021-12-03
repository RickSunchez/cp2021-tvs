<?php
    if (!isset($_POST["username"]) || !isset($_POST["password"])) {
        die("Smthg missing");
    }

    echo get_access_token($_POST["username"], $_POST["password"]);

    function get_access_token($username, $password) {
        $curl = curl_init();

        $data = array(
            "client_id" => "tvscp",
            "client_secret" => "f3e94369-53ac-43d5-842e-09fe6d8a71ff",
            "grant_type" => "password",
            "username" => $username,
            "password" => $password,
            "scope" => "openid"
        );

        $headers = array(
            'Content-Type: application/x-www-form-urlencoded'
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://tvscp.tionix.ru/realms/master/protocol/openid-connect/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => $headers
        ));

        $response = curl_exec($curl);

        $access_token = json_decode($response) -> access_token;

        curl_close($curl);

        return $access_token;
    }
?>