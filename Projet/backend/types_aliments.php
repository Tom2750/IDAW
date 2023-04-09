<?php
    function api_types_aliments($request_method, $uri, $pdo){
        switch($request_method){
            case 'GET':
                $resultat = get_types_aliments($uri, $pdo);
                break;
            case 'POST':
                $resultat = post_types_aliments($uri, $pdo);
                break;
            case 'PUT';
                $resultat = put_types_aliments($uri, $pdo);
                break;
            case 'DELETE':
                $resultat = delete_types_aliments($uri, $pdo);
                break;
            default:
                $resultat = 1;
        }
        
        return $resultat;
    }

    function get_types_aliments($uri, $pdo){
        if(!empty($uri[2])) {
            $request = $pdo->prepare("SELECT * FROM types_aliments WHERE id_type = $uri[2]");
        } else {
            $request = $pdo->prepare("SELECT * FROM types_aliments ORDER BY NOM ASC");
        }
        $request->execute();
        $resultat = $request->fetchAll(PDO::FETCH_OBJ);
        return $resultat;
    }

    function post_types_aliments($uri, $pdo){
        $json = json_decode(file_get_contents('php://input'), true);

        $nom = $json['NOM'];

        $request = $pdo->prepare("INSERT INTO types_aliments (NOM) VALUES (:nom)");
        $request->execute([':nom' => $nom]);

        $request = $pdo->prepare("SELECT * FROM types_aliments WHERE NOM = :nom");
        $request->execute([':nom' => $nom]);
        $resultat = $request->fetchAll(PDO::FETCH_OBJ);
        return $resultat;
    }

    function put_types_aliments($uri, $pdo){
        if(!empty($uri[2])) {
            $json = json_decode(file_get_contents('php://input'), true);

            $nom = $json['NOM'];

            $request = $pdo->prepare("UPDATE types_aliments SET NOM = '".$nom."' WHERE ID_TYPE = ".$uri[2]);
            $request->execute();
        }

        return get_types_aliments($uri, $pdo);
    }
    
    function delete_types_aliments($uri, $pdo){
        if(!empty($uri[2])) {
            $request = $pdo->prepare("DELETE FROM types_aliments WHERE ID_TYPE = $uri[2]");
            $request->execute();
        }

        return [];
    }
?>