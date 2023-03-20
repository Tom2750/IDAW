<?php
    require_once('config.php');
    $connectionString = "mysql:host=". _MYSQL_HOST;
    if(defined('_MYSQL_PORT')) {
        $connectionString .= ";port=". _MYSQL_PORT;
    }

    $connectionString .= ";dbname=" . _MYSQL_DBNAME;
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' );

    try {
        $pdo = new PDO($connectionString,_MYSQL_USER,_MYSQL_PASSWORD,$options);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $erreur) {
        myLog('Erreur : '.$erreur->getMessage());
    }
    $request = $pdo->prepare("select * from users");
    $request->execute();

    /*Retourne un tableau associatif pour chaque entrée de notre table avec le nom des colonnes sélectionnées en clefs*/
    $resultat = $request->fetchAll(PDO::FETCH_OBJ);

    echo '<pre>';
    print_r($resultat);
    echo '</pre>';

    /*** close the database connection ***/
    $pdo = null;
?>