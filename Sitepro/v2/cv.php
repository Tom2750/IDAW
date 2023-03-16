<?php
    require_once('template_header.php');
?>
    <header>
        <h1>Mon CV</h1>
        <div class="presentation">
            <img src="../images/photo de profil.jpg" class="pp">
            <p class="textePP">Beau gosse ?</p>
        </div>
    </header>
<?php
    require_once('template_menu.php');
    renderMenuToHTML('cv');
?>
    <div>
       <p>Ici je vous parle de mon CV</p>
    </div>
<?php
    require_once('template_footer.php');
?>