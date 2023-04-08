<?php
    session_start();
    if(isset($_COOKIE['user_id'])){
        $_SESSION['user_id'] = $_COOKIE['user_id'];
    }
    setcookie('user_id', '', time()-3600);
    header('Location: dashboard.php');
    exit();
?>