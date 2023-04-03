<?php
    function api_consommes($request_method, $uri, $pdo){
        $resultat = 'method not allowed';

        if($request_method=='GET'){
            $resultat = get_consommes($uri, $pdo);
        } elseif($request_method=='POST') {
            $resultat = post_consommes($uri, $pdo);
        } elseif($request_method=='PUT') {
            $resultat = put_consommes($uri, $pdo);
        } elseif($request_method=='DELETE') {
            $resultat = delete_consommes($uri, $pdo);
        }

        return $resultat;
    }

    function get_consommes($uri, $pdo){
    }
?>