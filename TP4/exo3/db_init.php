<?php
    /* Connexion à la base de donnée */
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
        
    /* Supprimer la table Users (et toutes ses données au passage)*/
    $request = "DROP TABLE Users";
    $pdo->exec($request);

    /* Créer la table Users */
    $request = "CREATE TABLE Users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Login VARCHAR(30) NOT NULL,
        Mail VARCHAR(50) NOT NULL
      )";
    $pdo->exec($request);

    /* Insérer des données */
    $request = $pdo->prepare("
                  INSERT INTO Users (Login, Mail)
                  VALUES (:login, :mail)
                ");
                
    $request->bindParam(':login', $login);
    $request->bindParam(':mail', $mail);

    $login = "Tom"; $mail = "tom@gmail.com";
    $request->execute();

    $login = "Ordi"; $mail = "ordi@gmail.com";
    $request->execute();
?>