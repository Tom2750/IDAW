<?php
    function renderMenuToHTML($currentPageId) {
        $mymenu = array(
            // idPage titre
            'accueil' => array('accueil','Accueil' ),
            'cv' => array('cv','Cv' ),
            'projets' => array('projets','Mes Projets'),
            'infos' => array('infos-technique','Informations techniques')
        );

        echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
    <a class="navbar-brand js-scroll-trigger" href="#page-top">
        <span class="d-block d-lg-none">Jean Robert</span>
        <span class="d-none d-lg-block"><img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="assets/img/profile.jpg" alt="..." /></span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav">
        ';

        foreach($mymenu as $pageId => $pageParameters) {
            if($currentPageId==$pageId){
                echo '<li class="nav-item selected"><a class="nav-link js-scroll-trigger" href="index.php?page='.$pageParameters[0].'&lang=en">'.$pageParameters[1].'</a></li>';
            } else {
                echo '<li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page='.$pageParameters[0].'&lang=en">'.$pageParameters[1].'</a></li>';
            }
        }

        echo '
        </ul>
    </div>
</nav>
        ';

    }
?>