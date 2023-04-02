<?php
    require_once('config.php');
    require_once('db_connect.php');

    $request_method = $_SERVER['REQUEST_METHOD'];
    $uri = parse_url($_SERVER['PATH_INFO'], PHP_URL_PATH);
    $uri = explode( '/', $uri );

    if($uri[1]=='aliment'){
        require_once('aliment.php');
        $resultat = api_aliments($request_method, $uri, $pdo);
    }

    header('Content-Type: application/json');
    echo json_encode($resultat, JSON_PRETTY_PRINT);
?>