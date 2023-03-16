<?php
    require_once('template_header.php');
?>
    <header>
        <h1>Mes projets</h1>
        <div class="presentation">
            <img src="../images/photo de profil.jpg" class="pp">
            <p class="textePP">Beau gosse ?</p>
        </div>
    </header>
<?php
    require_once('template_menu.php');
    renderMenuToHTML('projets');
?>
    <div>
       <p>Ici je vous parle de mes projets</p>
    </div>
<?php
    require_once('template_footer.php');
?>