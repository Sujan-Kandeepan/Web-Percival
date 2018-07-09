<?php
    $to      = $_GET["to"];
    $subject = $_GET["subject"];
    $message = $_GET["message"];
    $headers = 'From: '.$_GET["from"] . "\r\n" .
        'Reply-To: webmaster@example.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    $result = array();
    $result["success"] = mail($to, $subject, $message, $headers);

    $data = '{}'; // json string

    if (array_key_exists('callback', $_GET)){

        header('Content-Type: text/javascript; charset=utf8');
        header('Access-Control-Allow-Origin: http://www.example.com/');
        header('Access-Control-Max-Age: 3628800');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

        $callback = $_GET['callback'];
        echo $callback.'('.json_encode($result).');';

    } else {
        // normal JSON string
        header('Content-Type: application/json; charset=utf8');

        echo json_encode($result);
    }
?> 