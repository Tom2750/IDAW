<?php
    $lang = 'fr';
    if(isset($_GET['lang'])) {
        $lang = $_GET['lang'];
    }
?>

<?php
    require_once("./".$lang."/template_header.php");
    require_once("./".$lang."/template_menu.php");
    $currentPageId = 'accueil';
    if(isset($_GET['page'])) {
        $currentPageId = $_GET['page'];
    }
    renderMenuToHTML($currentPageId);   
?>

<section class="corps">
    <?php
        $pageToInclude = "./".$lang."/".$currentPageId .".php";
        if(is_readable($pageToInclude))
            require_once($pageToInclude);
        else
            require_once("error.php");
    ?>
    <a href="index.php?page=accueil&lang=fr">Français</a>
    <a href="index.php?page=accueil&lang=en">Anglais</a>
</section>

<?php
    require_once("./".$lang."/template_footer.php");
?>
