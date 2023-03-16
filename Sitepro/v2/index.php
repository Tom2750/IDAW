<?php
    require_once('template_header.php');
?>
    <header>
        <h1>Accueil</h1>
        <div class="presentation">
            <img class="pp" src="../images/photo de profil.jpg">
            <p>Beau gosse ?</p>
        </div>
    </header>
    <?php
        require_once('template_menu.php');
        renderMenuToHTML('index');
    ?>
    <div>
       <p>Bienvenue sur la page d'accueil ! Ici vous pouvez accéder à mon cv et à mes hobbies</p>
    </div>  
<?php
    require_once('template_footer.php');
?>