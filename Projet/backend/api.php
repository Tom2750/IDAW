<?php
    require_once('config.php');
    require_once('db_connect.php');

    $request_method = $_SERVER['REQUEST_METHOD'];
    $uri = parse_url($_SERVER['PATH_INFO'], PHP_URL_PATH);
    $uri = explode( '/', $uri );
        
    switch ($uri[1]) {
        case 'aliments':
            require_once('aliments.php');
            $resultat = api_aliments($request_method, $uri, $pdo);
            break;
        case 'utilisateurs':
            require_once('utilisateurs.php');
            $resultat = api_utilisateurs($request_method, $uri, $pdo);
            break;
        case 'compositions':
            require_once('compositions.php');
            $resultat = api_compositions($request_method, $uri, $pdo);
            break;
        case 'consommations':
            require_once('consommations.php');
            $resultat = api_consommations($request_method, $uri, $pdo);
            break;
    }

    header('Content-Type: application/json');
    echo json_encode($resultat, JSON_PRETTY_PRINT);
?>