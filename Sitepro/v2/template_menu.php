<nav id="wrap">
    <ul class="navbar">
        <li><a href="index.php">Accueil</a></li>
        <li><a href="cv.php">CV</a></li>
        <li><a href="projets.php">Mes projets</a></li>
        <li><a>Nouvelle entrée</a></li>
    </ul>
</nav>

<?php
    function renderMenuToHTML($currentPageId) {
        // un tableau qui d\'efinit la structure du site
        $mymenu = array(
            // idPage titre
            'index' => array( 'Accueil' ),
            'cv' => array( 'Cv' ),
            'projets' => array('Mes Projets')
        );
        // ...
        foreach($mymenu as $pageId => $pageParameters) {
            echo "...";
        }
        // ...
    }
?>