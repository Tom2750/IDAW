<?php
    function api_aliments($request_method, $uri, $pdo){
        $resultat = 'method not allowed';

        if($request_method=='GET'){
            $resultat = get_aliments($uri, $pdo);
        } elseif($request_method=='POST') {
            $resultat = post_aliments($uri, $pdo);
        } elseif($request_method=='PUT') {
            $resultat = put_aliments($uri, $pdo);
        } elseif($request_method=='DELETE') {
            $resultat = delete_aliments($uri, $pdo);
        }

        return $resultat;
    }

    function get_aliments($uri, $pdo){
        if(!empty($uri[2])) {
            $request = $pdo->prepare("SELECT * FROM aliment WHERE id_aliment = $uri[2]");
        } else {
            $request = $pdo->prepare("SELECT * FROM aliment ORDER BY id_aliment ASC");
        }
        $request->execute();
        $resultat = $request->fetchAll(PDO::FETCH_OBJ);
        return $resultat;
    }

    function post_aliments($uri, $pdo){
        if(!empty($uri[2])) {
            $json = json_decode(file_get_contents('php://input'), true);

            $nom = $json['NOM_ALIMENT'];
            $id_type = $json['ID_TYPE'];

            $request = $pdo->prepare("INSERT INTO aliment (NOM_ALIMENT, ID_TYPE) VALUES ('".$nom."', '".$id_type."')");
            $request->execute();

            $request = $pdo->prepare("SELECT * FROM aliment WHERE NOM_ALIMENT = '".$nom."' AND ID_TYPE = '".$id_type."'");
            $request->execute();
            $resultat = $request->fetchAll(PDO::FETCH_OBJ);
        }
        return $resultat;
    }

    function put_aliments($uri, $pdo){
        if(!empty($uri[2])) {
            $json = json_decode(file_get_contents('php://input'), true);

            $nom = $json['NOM_ALIMENT'];
            $id_type = $json['ID_TYPE'];

            $request = $pdo->prepare("UPDATE aliment SET NOM_ALIMENT = '".$nom."' WHERE ID_ALIMENT = ".$uri[2]);
            $request->execute();
            $request = $pdo->prepare("UPDATE aliment SET ID_TYPE = '".$id_type."' WHERE ID_ALIMENT = ".$uri[2]);
            $request->execute();
        }

        return get_aliments($uri, $pdo);
    }
    
    function delete_aliments($uri, $pdo){
        if(!empty($uri[2])) {
            $request = $pdo->prepare("DELETE FROM aliment WHERE ID_ALIMENT = $uri[2]");
            $request->execute();
        }

        return NULL;
    }
?>