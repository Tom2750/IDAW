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
    
    /* Update login */
    $request = $pdo->prepare("
                UPDATE Users
                SET Login=:login
                WHERE id=:id
  ");

    $id = $_POST['id']; $login = $_POST['login'];
    $request->bindParam(':id', $id);
    $request->bindParam(':login', $login);

    $request->execute();

    /* Update mail */
    $request = $pdo->prepare("
                UPDATE Users
                SET Mail=:mail
                WHERE id=:id
    ");

    $id = $_POST['id']; $mail = $_POST['mail'];
    $request->bindParam(':id', $id);
    $request->bindParam(':mail', $mail);

    $request->execute();

    echo '<h1>Utilisateur mis à jour!</h1><br>';
    echo '<a href="users.php">Liste des utilisateurs</a><br>';
?>