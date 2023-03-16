<?php
    require_once("template_header.php");
    require_once("template_menu.php");
    $currentPageId = 'accueil';
    if(isset($_GET['page'])) {
        $currentPageId = $_GET['page'];
    }
?>

<header>
    <h1>Site de Hector Durand</h1>
</header>

<div class="presentation">
    <img class="pp" src="../images/photo de profil.jpg">
    <p>Beau gosse ?</p>
</div>

<?php
    require_once('template_menu.php');
    renderMenuToHTML($currentPageId);
?>

<section class="corps">
    <?php
        $pageToInclude = $currentPageId . ".php";
        if(is_readable($pageToInclude))
            require_once($pageToInclude);
        else
            require_once("error.php");
    ?>
</section>
<?php
    require_once("template_footer.php");
?>