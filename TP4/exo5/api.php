<?php
    require_once('config.php');
    require_once('db_connect.php');
        
    $request_method = $_SERVER['REQUEST_METHOD'];
    $uri = parse_url($_SERVER['PATH_INFO'], PHP_URL_PATH);
    $uri = explode( '/', $uri );
        
    $resultat = NULL;

    $status_code_header = 'HTTP/1.1 404 Not Found';

    if($request_method=='GET'){
        if(!empty($uri[2])) {
            $request = $pdo->prepare("SELECT * FROM Users WHERE id=$uri[2]");
            $request->execute();
            $resultat = $request->fetchAll(PDO::FETCH_OBJ);
            $status_code_header = 'HTTP/1.1 200 OK';
        } else {
            $request = $pdo->prepare("SELECT * FROM Users");
            $request->execute();
            $resultat = $request->fetchAll(PDO::FETCH_OBJ);
            $status_code_header = 'HTTP/1.1 200 OK';
        }


    } elseif($request_method=='POST') {
        $json = json_decode(file_get_contents('php://input'), true);
        $login = $json['Login'];
        $mail = $json['Mail'];
        $request = $pdo->prepare("INSERT INTO Users (Login, Mail) VALUES ('".$login."', '".$mail."')");
        $request->execute();
        $status_code_header = 'HTTP/1.1 201 Created';

    } elseif($request_method=='PUT') {
        if(!empty($uri[2])) {
            $json = json_decode(file_get_contents('php://input'), true);
            $login = $json['Login'];
            $mail = $json['Mail'];
            $request = $pdo->prepare("UPDATE Users SET Login='".$login."' WHERE id=".$uri[2]);
            $request->execute();
            $request = $pdo->prepare("UPDATE Users SET Mail='".$mail."' WHERE id=".$uri[2]);
            $request->execute();
            $status_code_header = 'HTTP/1.1 200 OK';
        }


    } elseif($request_method=='DELETE') {
        if(!empty($uri[2])) {
            $request = $pdo->prepare("DELETE FROM Users WHERE id=$uri[2]");
            $request->execute();
            $status_code_header = 'HTTP/1.1 200 OK';
        }
    }

    header($status_code_header);
    header('Content-Type: application/json');
    echo json_encode($resultat, JSON_PRETTY_PRINT);
    $pdo = null;
?>