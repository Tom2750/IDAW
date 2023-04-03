<?php
    function api_utilisateurs($request_method, $uri, $pdo){
        $resultat = 'method not allowed';

        if($request_method=='GET'){
            $resultat = get_utilisateurs($uri, $pdo);
        } elseif($request_method=='POST') {
            $resultat = post_utilisateurs($uri, $pdo);
        } elseif($request_method=='PUT') {
            $resultat = put_utilisateurs($uri, $pdo);
        } elseif($request_method=='DELETE') {
            $resultat = delete_utilisateurs($uri, $pdo);
        }

        return $resultat;
    }

    function get_utilisateurs($uri, $pdo){
        if(!empty($uri[2])) {
            $request = $pdo->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = $uri[2]");
        } else {
            $request = $pdo->prepare("SELECT * FROM utilisateur ORDER BY id_utilisateur ASC");
        }
        $request->execute();
        $resultat = $request->fetchAll(PDO::FETCH_OBJ);
        return $resultat;
    }

    function post_utilisateurs($uri, $pdo){
        $json = json_decode(file_get_contents('php://input'), true);
            
        $login = $json['LOGIN'];
        $mot_de_passe = $json['MOT_DE_PASSE'];
        $nom = $json['NOM'];
        $prenom = $json['PRENOM'];
        $taille = $json['TAILLE'];
        $poids = $json['POIDS'];
        $age = $json['AGE'];
        $sexe = $json['SEXE'];
        $id_niveau = $json['ID_NIVEAU_SPORTIF'];

        $request = $pdo->prepare("INSERT INTO utilisateur (LOGIN, MOT_DE_PASSE, NOM, PRENOM, TAILLE, POIDS, AGE, SEXE, ID_NIVEAU_SPORTIF) 
                                VALUES ('".$login."', '".$mot_de_passe."', '".$nom."', '".$prenom."', 
                                '".$taille."', '".$poids."', '".$age."', '".$sexe."', '".$id_niveau."')");
        $request->execute();

        $request = $pdo->prepare("SELECT * FROM utilisateur WHERE NOM = '".$nom."' AND PRENOM = '".$prenom."'");
        $request->execute();
        $resultat = $request->fetchAll(PDO::FETCH_OBJ);

        return $resultat;
    }

    function put_utilisateurs($uri, $pdo){
        if(!empty($uri[2])) {
            $json = json_decode(file_get_contents('php://input'), true);
            
            $login = $json['LOGIN'];
            $mot_de_passe = $json['MOT_DE_PASSE'];
            $nom = $json['NOM'];
            $prenom = $json['PRENOM'];
            $taille = $json['TAILLE'];
            $poids = $json['POIDS'];
            $age = $json['AGE'];
            $sexe = $json['SEXE'];
            $id_niveau = $json['ID_NIVEAU_SPORTIF'];

            $request = $pdo->prepare("UPDATE utilisateur SET LOGIN = '".$login."', MOT_DE_PASSE = '".$mot_de_passe."', 
            NOM = '".$nom."', PRENOM = '".$prenom."', TAILLE = '".$taille."', 
            POIDS = '".$poids."', AGE = '".$age."', SEXE = '".$sexe."', 
            ID_NIVEAU_SPORTIF = '".$id_niveau."' WHERE ID_UTILISATEUR = ".$uri[2]);
            $request->execute();
        }

        return get_utilisateurs($uri, $pdo);
    }
    
    function delete_utilisateurs($uri, $pdo){
        if(!empty($uri[2])) {
            $request = $pdo->prepare("DELETE FROM utilisateur WHERE ID_UTILISATEUR = $uri[2]");
            $request->execute();
        }

        return NULL;
    }
?>