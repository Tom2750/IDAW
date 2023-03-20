<?php
    require_once('config.php');
    require_once('db_connect.php');
        
    $request_method = $_SERVER['REQUEST_METHOD'];

    if($request_method=='GET'){
        if(empty($_GET['id'])) {
            $request = $pdo->prepare("select * from users");
        } else {
            $request = $pdo->prepare("select * from users where id=".$_GET['id']);
        }
        $request->execute();
        $resultat = $request->fetchAll(PDO::FETCH_OBJ);

        header('Content-Type: application/json');
        echo json_encode($resultat, JSON_PRETTY_PRINT);
    }

    $pdo = null;
?>