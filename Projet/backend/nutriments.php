<?php
    function api_nutriments($request_method, $uri, $pdo){
        switch($request_method){
            case 'GET':
                $resultat = get_nutriments($uri, $pdo);
                break;
            default:
                $resultat = 1;
        }
        
        return $resultat;
    }

    function get_nutriments($uri, $pdo){
        if(!empty($uri[2])) {
            $request = $pdo->prepare("SELECT * FROM nutriments WHERE id_nutriment = $uri[2]");
        } else {
            $request = $pdo->prepare("SELECT * FROM nutriments ORDER BY id_nutriment ASC");
        }
        $request->execute();
        $resultat = $request->fetchAll(PDO::FETCH_OBJ);
        return $resultat;
    }
?>