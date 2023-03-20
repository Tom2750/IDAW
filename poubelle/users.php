<?php
    function getUsers() {
        global $pdo;
        $request = $pdo->prepare("select * from users");
        $request->execute();
        $resultat = $request->fetchAll(PDO::FETCH_OBJ);

        header('Content-Type: application/json');
        echo json_encode($response, JSON_PRETTY_PRINT);
    }
?>

<?php
    include('db_connect.php');

    $request_method = $_SERVER['REQUEST_METHOD'];

    switch($request_method){
        case 'GET':
            if(!empty($_GET['id'])) {
                $id = intval($_GET["id"]);
                getUsers($id);
            } else {
                getUsers();
            }
            break;
        default:
            header("HTTP/1.0 405 Method Not Allowed");
            break;
    }
?>