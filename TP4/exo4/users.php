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

    /*** close the database connection ***/
    $pdo = null;
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Users</title>
        <meta charset="utf-8">
    </head>
    <h1>Users</h1>
    <table>
        <tr><th>ID</th><th>Login</th><th>Mail</th><th>Update</th><th>Delete</th></tr>
        <?php
            foreach($resultat as $key => $colonne){
                echo '<tr>';
                foreach($colonne as $value){
                    echo '<th>';
                    echo $value;
                    echo '</th>';
                }
                echo '<th>';
                echo '<form action="update_user.php" method="POST">
                        <button type="submit">Modifier</button>
                        <input type="hidden" id="postId" name="postId" value='.$colonne->id.'>
                      </form>';
                echo '</th>';
                echo '<th>';
                echo '<form action="deleted_user.php" method="POST">
                      <button type="submit">Supprimer</button>
                      <input type="hidden" id="postId" name="postId" value='.$colonne->id.'>
                    </form>';
                echo '</th>';
            }
            echo '</tr>';
        ?>
    </table>
    
    <br><br>

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
</html>