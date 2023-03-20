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
    
    /* DELETE */
    $request = $pdo->prepare("
                DELETE FROM Users
                WHERE id=:id
  ");

    $id = $_POST['postId'];
    $request->bindParam(':id', $id);

    $request->execute();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Users</title>
        <meta charset="utf-8">
    </head>
    <h1>Utilisateur supprimé!<br></h1>
    <a href="users.php">Retour à la liste des utilisateurs</a><br>
</html>