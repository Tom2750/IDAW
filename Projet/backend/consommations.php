<?php
    function api_consommations($request_method, $uri, $pdo){
        $resultat = 'method not allowed';

        switch($request_method){
            case 'GET':
                $resultat = get_consommations($uri, $pdo);
                break;
            case 'POST':
                $resultat = post_consommations($uri, $pdo);
                break;
            case 'PUT';
                $resultat = put_consommations($uri, $pdo);
                break;
            case 'DELETE':
                $resultat = delete_consommations($uri, $pdo);
                break;
        }
        
        return $resultat;
    }

    function get_consommations($uri, $pdo){
        if(!empty($uri[2])) {
            $request = $pdo->prepare("SELECT * FROM consommations WHERE id_conso = $uri[2]");
        } else {
            $json = json_decode(file_get_contents('php://input'), true);

            $id_utilisateur = $json['ID_UTILISATEUR'];
            $date_debut = $json['DATE_DEBUT'];
            $date_fin = $json['DATE_FIN'];
            
            $request = $pdo->prepare("SELECT * FROM consommations WHERE ID_CONSO = ".$id_utilisateur." 
            AND DATE_CONSO > '".$date_debut."' AND DATE_CONSO < '".$date_fin."' ORDER BY ID_UTILISATEUR ASC");

        }
        $request->execute();
        $resultat = $request->fetchAll(PDO::FETCH_OBJ);
        return $resultat;
    }

    function post_consommations($uri, $pdo){
        $json = json_decode(file_get_contents('php://input'), true);

        $id_utilisateur = $json['ID_UTILISATEUR'];
        $id_aliment = $json['ID_ALIMENT'];
        $quantite = $json['QUANTITE'];
        $date = $json['DATE_CONSO'];

        $request = $pdo->prepare("INSERT INTO consommations (ID_UTILISATEUR, ID_ALIMENT, QUANTITE, DATE_CONSO) VALUES 
        ('".$id_utilisateur."', '".$id_aliment."', '".$quantite."', '".$date."')");
        $request->execute();

        $request = $pdo->prepare("SELECT * FROM consommations WHERE ID_UTILISATEUR = '".$id_utilisateur."' AND ID_ALIMENT = '".$id_aliment."' AND DATE_CONSO = '".$date."'");
        $request->execute();
        $resultat = $request->fetchAll(PDO::FETCH_OBJ);
        
        return $resultat;
    }

    function put_consommations($uri, $pdo){
        if(!empty($uri[2])) {
            $json = json_decode(file_get_contents('php://input'), true);

            $id_utilisateur = $json['ID_UTILISATEUR'];
            $id_aliment = $json['ID_ALIMENT'];
            $quantite = $json['QUANTITE'];
            $date = $json['DATE_CONSO'];

            $request = $pdo->prepare("UPDATE consommations SET ID_UTILISATEUR = '".$id_utilisateur."', ID_ALIMENT = '".$id_aliment."',
            QUANTITE = '".$quantite."', DATE_CONSO = '".$date."' WHERE ID_CONSO = ".$uri[2]);
            $request->execute();
        }

        return get_consommations($uri, $pdo);
    }
    
    function delete_consommations($uri, $pdo){
        if(!empty($uri[2])) {
            $request = $pdo->prepare("DELETE FROM consommations WHERE ID_CONSO = $uri[2]");
            $request->execute();
        }

        return [];
    }
?>