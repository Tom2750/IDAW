<?php
    function renderMenuToHTML($currentPageId) {
        // un tableau qui d\'efinit la structure du site
        $mymenu = array(
            // idPage titre
            'index' => array('Accueilenanglais','accueil'),
            'cv' => array('Cv','cv'),
            'projets' => array('Mes Projets','projets'),
            'contact' => array('Mes Contacts','contact')
        );
        echo "<nav id='wrap'>"."<br>";
        echo "<ul class='navbar'"."<br>";
        foreach($mymenu as $pageId => $pageParameters) {
            if($pageId==$currentPageId){
                echo "<li><a href='index.php'?page=".$pageParameters[1]." class='selected'>".$pageParameters[0]."</a></li>";
            }else{
                echo "<li><a href='index.php?page=".$pageParameters[1]."'>".$pageParameters[0]."</a></li>";
            }
        }
        echo "</ul>";
        echo "</nav>";
    }
?>