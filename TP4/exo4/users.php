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

<form id="login_form" action="create_user.php" method="POST">
    <table>
        <tr>
            <th>Login :</th>
            <td><input type="text" name="login"></td>
        </tr>
        <tr>
            <th>Mail :</th>
            <td><input type="text" name="mail"></td>
        </tr>
        <tr>
            <th></th>
            <td><input type="submit" value="Ajouter" /></td>
        </tr>
    </table>
</form>

<form id="login_form" action="update_user.php" method="POST">
    <table>
        <tr>
            <th>id :</th>
            <td><input type="text" name="id"></td>
        </tr>
        <tr>
            <th>Login :</th>
            <td><input type="text" name="login"></td>
        </tr>
        <tr>
            <th>Mail :</th>
            <td><input type="text" name="mail"></td>
        </tr>
        <tr>
            <th></th>
            <td><input type="submit" value="Modifier" /></td>
        </tr>
    </table>
</form>