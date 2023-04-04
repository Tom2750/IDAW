<?php
    function api_aliments($request_method, $uri, $pdo){
        $resultat = 'method not allowed';

        switch($request_method){
            case 'GET':
                $resultat = get_aliments($uri, $pdo);
                break;
            case 'POST':
                $resultat = post_aliments($uri, $pdo);
                break;
            case 'PUT';
                $resultat = put_aliments($uri, $pdo);
                break;
            case 'DELETE':
                $resultat = delete_aliments($uri, $pdo);
                break;
        }
        
        return $resultat;
    }

    function get_aliments($uri, $pdo){
        if(!empty($uri[2])) {
            $request = $pdo->prepare("SELECT * FROM aliments WHERE id_aliment = $uri[2]");
        } else {
            $request = $pdo->prepare("SELECT * FROM aliments ORDER BY id_aliment ASC");
        }
        $request->execute();
        $resultat = $request->fetchAll(PDO::FETCH_OBJ);
        return $resultat;
    }

    function post_aliments($uri, $pdo){
        $json = json_decode(file_get_contents('php://input'), true);

        $nom = $json['NOM_ALIMENT'];
        $id_type = $json['ID_TYPE'];

        $request = $pdo->prepare("INSERT INTO aliments (NOM_ALIMENT, ID_TYPE) VALUES ('".$nom."', '".$id_type."')");
        $request->execute();

        $request = $pdo->prepare("SELECT * FROM aliments WHERE NOM_ALIMENT = '".$nom."' AND ID_TYPE = '".$id_type."'");
        $request->execute();
        $resultat = $request->fetchAll(PDO::FETCH_OBJ);
        return $resultat;
    }

    function put_aliments($uri, $pdo){
        if(!empty($uri[2])) {
            $json = json_decode(file_get_contents('php://input'), true);

            $nom = $json['NOM_ALIMENT'];
            $id_type = $json['ID_TYPE'];

            $request = $pdo->prepare("UPDATE aliments SET NOM_ALIMENT = '".$nom."', ID_TYPE = '".$id_type."' WHERE ID_ALIMENT = ".$uri[2]);
            $request->execute();
        }

        return get_aliments($uri, $pdo);
    }
    
    function delete_aliments($uri, $pdo){
        if(!empty($uri[2])) {
            $request = $pdo->prepare("DELETE FROM aliments WHERE ID_ALIMENT = $uri[2]");
            $request->execute();
        }

        return NULL;
    }
?>