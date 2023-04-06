<?php
    function api_niveaux_sportifs($request_method, $uri, $pdo){
        switch($request_method){
            case 'GET':
                $resultat = get_niveaux_sportifs($uri, $pdo);
                break;
            case 'POST':
                $resultat = post_niveaux_sportifs($uri, $pdo);
                break;
            case 'PUT';
                $resultat = put_niveaux_sportifs($uri, $pdo);
                break;
            case 'DELETE':
                $resultat = delete_niveaux_sportifs($uri, $pdo);
                break;
            default:
                $resultat = 1;
        }
        
        return $resultat;
    }

    function get_niveaux_sportifs($uri, $pdo){
        if(!empty($uri[2])) {
            $request = $pdo->prepare("SELECT * FROM niveaux_sportifs WHERE id_niveau_sportif = $uri[2]");
        } else {
            $request = $pdo->prepare("SELECT * FROM niveaux_sportifs ORDER BY id_niveau_sportif ASC");
        }
        $request->execute();
        $resultat = $request->fetchAll(PDO::FETCH_OBJ);
        return $resultat;
    }

    function post_niveaux_sportifs($uri, $pdo){
        $json = json_decode(file_get_contents('php://input'), true);

        $niveau = $json['NIVEAU'];

        $request = $pdo->prepare("INSERT INTO niveaux_sportifs (NIVEAU) VALUES ('".$niveau."')");
        $request->execute();

        $request = $pdo->prepare("SELECT * FROM niveaux_sportifs WHERE NIVEAU = '".$niveau."'");
        $request->execute();
        $resultat = $request->fetchAll(PDO::FETCH_OBJ);
        return $resultat;
    }

    function put_niveaux_sportifs($uri, $pdo){
        if(!empty($uri[2])) {
            $json = json_decode(file_get_contents('php://input'), true);

            $niveau = $json['NIVEAU'];

            $request = $pdo->prepare("UPDATE niveaux_sportifs SET NIVEAU = '".$niveau."' WHERE ID_NIVEAU_SPORTIF = ".$uri[2]);
            $request->execute();
        }

        return get_niveaux_sportifs($uri, $pdo);
    }
    
    function delete_niveaux_sportifs($uri, $pdo){
        if(!empty($uri[2])) {
            $request = $pdo->prepare("DELETE FROM niveaux_sportifs WHERE ID_NIVEAU_SPORTIF = $uri[2]");
            $request->execute();
        }
        return [];
    }
?>