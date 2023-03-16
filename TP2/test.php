
<?php
    function renderMenuToHTML($currentPageId) {
        // un tableau qui d\'efinit la structure du site
        $mymenu = array(
            // idPage titre
            'index' => array('Accueil'),
            'cv' => array('Cv'),
            'projets' => array('Mes Projets')
        );
        echo "<nav id='wrap'>"."<br>";
        echo "<ul class='navbar'"."<br>";
        foreach($mymenu as $pageId => $pageParameters) {
            if($pageId==$currentPageId){
                echo "<li><a href='index.php' class='selected'>".$pageParameters[0]."</a></li>";
            }else{
                echo "<li><a href='index.php'>".$pageParameters[0]."</a></li>";
            }

        }
        echo "</ul>";
        echo "</nav>";
    }

    renderMenuToHTML('cv');
?>