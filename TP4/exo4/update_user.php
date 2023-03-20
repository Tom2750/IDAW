<!DOCTYPE html>
<html>
    <head>
        <title>Users</title>
        <meta charset="utf-8">
    </head>

    <form id="login_form" action="updated_user.php" method="POST">
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
        
        <?php
            echo '<input type="hidden" id="postId" name="postId" value='.$_POST['postId'].'>'
        ?>

    </form>
</html>