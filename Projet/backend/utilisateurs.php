<?php
    function api_utilisateurs($request_method, $uri, $pdo){
        switch($request_method){
            case 'GET':
                $resultat = get_utilisateurs($uri, $pdo);
                break;
            case 'POST':
                $resultat = post_utilisateurs($uri, $pdo);
                break;
            case 'PUT';
                $resultat = put_utilisateurs($uri, $pdo);
                break;
            case 'DELETE':
                $resultat = delete_utilisateurs($uri, $pdo);
                break;
            default:
                $resultat = 1;
        }

        return $resultat;
    }

    function get_utilisateurs($uri, $pdo){
        if(!empty($uri[2])) {
            $request = $pdo->prepare("SELECT * FROM utilisateurs WHERE id_utilisateur = $uri[2]");
        } else if(isset($_GET['LOGIN']) AND isset($_GET['HASH_MDP'])){
            $json = json_decode(file_get_contents('php://input'), true);

            $login = $_GET['LOGIN'];
            $h_mot_de_passe = $_GET['HASH_MDP'];

            $request = $pdo->prepare("SELECT * FROM utilisateurs WHERE login = '".$login."' AND HASH_MDP = '".$h_mot_de_passe."'");
        } else if(isset($_GET['LOGIN'])){
            $json = json_decode(file_get_contents('php://input'), true);

            $login = $_GET['LOGIN'];

            $request = $pdo->prepare("SELECT * FROM utilisateurs WHERE login = '".$login."'");
        }
        $request->execute();
        $resultat = $request->fetchAll(PDO::FETCH_OBJ);
        return $resultat;
    }

    function post_utilisateurs($uri, $pdo){
        $json = json_decode(file_get_contents('php://input'), true);
            
        $login = $json['LOGIN'];
        $mot_de_passe = $json['HASH_MDP'];
        //$nom = $json['NOM'];
        //$prenom = $json['PRENOM'];
        //$taille = (int)$json['TAILLE'];
        //$poids = (float)$json['POIDS'];
        //$age = (int)$json['AGE'];
        $sexe = (int)$json['SEXE'];
        $id_niveau = (int)$json['ID_NIVEAU_SPORTIF'];

        
        /*$request = $pdo->prepare("INSERT INTO utilisateurs (LOGIN, HASH_MDP, NOM, PRENOM, TAILLE, POIDS, AGE, SEXE, ID_NIVEAU_SPORTIF) 
                                VALUES ('".$login."', '".$mot_de_passe."', '".$nom."', '".$prenom."', 
                                '".$taille."', '".$poids."', '".$age."', '".$sexe."', '".$id_niveau."')");*/

        /*$request = $pdo->prepare("INSERT INTO utilisateurs (LOGIN, HASH_MDP, NOM, SEXE, ID_NIVEAU_SPORTIF) 
                                VALUES ('".$login."', '".$mot_de_passe."', '".$nom."', '".$sexe."', '".$id_niveau."')");*/

        $request = $pdo->prepare("INSERT INTO utilisateurs (LOGIN, HASH_MDP, SEXE, ID_NIVEAU_SPORTIF) 
        VALUES (:login,:mdp,:sexe,:niveau)");
        $request->execute([
            ':login' => $login,
            ':mdp' => $mot_de_passe,
            ':sexe' => $sexe,
            ':niveau' => $id_niveau
        ]);

        $request2 = $pdo->prepare("SELECT * FROM utilisateurs WHERE LOGIN = :login");
        $request2->execute([
            ':login' => $login
        ]);
        $resultat = $request2->fetchAll(PDO::FETCH_OBJ);

        return $resultat;
    }

    function put_utilisateurs($uri, $pdo){
        if(!empty($uri[2])) {
            $json = json_decode(file_get_contents('php://input'), true);
            
            $login = $json['LOGIN'];
            // $h_mot_de_passe = $json['HASH_MDP'];
            $nom = $json['NOM'];
            $prenom = $json['PRENOM'];
            $taille = $json['TAILLE'];
            $poids = $json['POIDS'];
            $age = $json['AGE'];
            $sexe = $json['SEXE'];
            $id_niveau = $json['ID_NIVEAU_SPORTIF'];

            $request = $pdo->prepare("UPDATE utilisateurs SET LOGIN = '".$login."', 
            NOM = '".$nom."', PRENOM = '".$prenom."', TAILLE = '".$taille."', 
            POIDS = '".$poids."', AGE = '".$age."', SEXE = '".$sexe."', 
            ID_NIVEAU_SPORTIF = '".$id_niveau."' WHERE ID_UTILISATEUR = ".$uri[2]);
            $request->execute();
        }

        return get_utilisateurs($uri, $pdo);
    }
    
    function delete_utilisateurs($uri, $pdo){
        if(!empty($uri[2])) {
            $request = $pdo->prepare("DELETE FROM utilisateurs WHERE ID_UTILISATEUR = $uri[2]");
            $request->execute();
        }

        return NULL;
    }
?>