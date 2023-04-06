<?php
    require_once('db_config.php');
    require_once('db_connect.php');

    $request_method = $_SERVER['REQUEST_METHOD'];
    $uri = parse_url($_SERVER['PATH_INFO'], PHP_URL_PATH);
    $uri = explode( '/', $uri );

    $resultat = 0;
        
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
        case 'niveaux_sportifs':
            require_once('niveaux_sportifs.php');
            $resultat = api_niveaux_sportifs($request_method, $uri, $pdo);
            break;
        case 'types_aliments':
            require_once('types_aliments.php');
            $resultat = api_types_aliments($request_method, $uri, $pdo);
            break;
        case 'nutriments':
            require_once('nutriments.php');
            $resultat = api_nutriments($request_method, $uri, $pdo);
            break;
    }

    switch ($resultat):
        case 0:
            header('HTTP/1.1 404 Not Found');
            break;
        case 1:
            header('HTTP/1.1 405 Method Not Allowed');
            break;
        default:
            header('HTTP/1.1 200 OK');
            header('Content-Type: application/json');
            echo json_encode($resultat, JSON_PRETTY_PRINT);
?>