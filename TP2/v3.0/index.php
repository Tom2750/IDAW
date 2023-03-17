<?php
    require_once("template_header.php");
    $currentPageId = 'accueil';
    if(isset($_GET['page'])) {
        $currentPageId = $_GET['page'];
    }
    $lang = 'fr';
    if(isset($_GET['lang'])) {
        $lang = $_GET['lang'];
    }
?>

<header>
    <h1>Hector Durand</h1>
</header>

<div class="presentation">
    <img class="pp" src="../images/photo de profil.jpg">
    <p>Beau gosse ?</p>
</div>

<?php
    if($lang=='fr'){
        require_once('./fr/template_menu.php');
    } else {
        require_once('./en/template_menu.php');
    }
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