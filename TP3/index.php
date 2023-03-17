<?php
    if(isset($_GET['css'])){
        echo '<link rel="stylesheet" href="'.$_GET['css'].'.css">';
        setcookie('style_choisi', $_GET['css']);
    } elseif (isset($_COOKIE['style_choisi'])) {
        echo '<link rel="stylesheet" href="'.$_COOKIE['style_choisi'].'.css">';
        setcookie('style_choisi', $_COOKIE['style_choisi']);
    } else {
        echo '<link rel="stylesheet" href="style1.css">';
    }
?>

<form id="style_form" action="index.php" method="GET">
    <select name="css">
        <option value="style1">style1</option>
        <option value="style2">style2</option>
    </select>
    <input type="submit" value="Appliquer" />
</form>