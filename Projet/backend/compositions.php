<?php
    function api_compositions($request_method, $uri, $pdo){
        $resultat = 'method not allowed';

        switch($request_method){
            case 'GET':
                $resultat = get_compositions($uri, $pdo);
                break;
            case 'POST':
                $resultat = post_compositions($uri, $pdo);
                break;
            case 'PUT';
                $resultat = put_compositions($uri, $pdo);
                break;
            case 'DELETE':
                $resultat = delete_compositions($uri, $pdo);
                break;
        }

        return $resultat;
    }

    function get_compositions($uri, $pdo){
        if(!empty($uri[2])) {
            $request = $pdo->prepare("SELECT * FROM compositions JOIN nutriments ON compositions.id_nutriment = nutriments.id_nutriment WHERE id_aliment = $uri[2]");
        } else {
            $request = $pdo->prepare("SELECT * FROM compositions JOIN nutriments ON compositions.id_nutriment = nutriments.id_nutriment ORDER BY id_aliment ASC");
        }
        $request->execute();
        $resultat = $request->fetchAll(PDO::FETCH_OBJ);
        return $resultat;
    }

    function post_compositions($uri, $pdo){
        if(!empty($uri[2])) {
            $json = json_decode(file_get_contents('php://input'), true);

            $id_nutriment = $json['ID_NUTRIMENT'];
            $ratio = $json['RATIO'];

            $request = $pdo->prepare("INSERT INTO compositions (ID_NUTRIMENT, ID_ALIMENT, RATIO) VALUES ('".$id_nutriment."', '".$uri[2]."', '".$ratio."')");
            $request->execute();

            $request = $pdo->prepare("SELECT * FROM compositions JOIN nutriments ON compositions.id_nutriment = nutriments.id_nutriment WHERE compositions.id_nutriment = '".$id_nutriment."' AND ID_ALIMENT = '".$uri[2]."'");
            $request->execute();
            $resultat = $request->fetchAll(PDO::FETCH_OBJ);
        }
        return $resultat;
    }

    function put_compositions($uri, $pdo){
        if(!empty($uri[2])) {
            $json = json_decode(file_get_contents('php://input'), true);

            $id_nutriment = $json['ID_NUTRIMENT'];
            $ratio = $json['RATIO'];

            $request = $pdo->prepare("SELECT * FROM compositions JOIN nutriments ON compositions.id_nutriment = nutriments.id_nutriment WHERE compositions.id_nutriment = '".$id_nutriment."' AND ID_ALIMENT = '".$uri[2]."'");
            $request->execute();
            $resultat = $request->fetchAll(PDO::FETCH_OBJ);
        }

        return $resultat;
    }
    
    function delete_compositions($uri, $pdo){
        if(!empty($uri[2])) {
            $json = json_decode(file_get_contents('php://input'), true);

            $id_nutriment = $json['ID_NUTRIMENT'];

            $request = $pdo->prepare("DELETE FROM compositions WHERE ID_NUTRIMENT = '".$id_nutriment."' AND ID_ALIMENT = $uri[2]");
            $request->execute();
        }

        return NULL;
    }
?>