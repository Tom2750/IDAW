<?php
    require_once('template_header.php');
    require_once('template_session.php');
?>
    <link rel="stylesheet" href="css/styles_dashboard.css">
    <link rel="stylesheet" href="css/styles_journal.css">
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="config.js"></script>
    <script>
        var sessionId = <?php echo $_SESSION['user_id']; ?>;
    </script>
    <script src="js/camembert.js"></script>
    <style>
        #chartdiv {
        width: 100%;
        height: 500px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php require_once('template_nav.php') ?>

        <div class="main-content">
            <div class="header">
                <h1>Dashboard</h1>
            </div>
            <div class="cards">
                <div class="card">
                    <h2 id="bienvenue"></h2>
                </div>
                <div class="card">
                    <h2>Vous l'avez mangé aujourd'hui</h2>
                    <div id="mangé" class="display"></div>
                </div>
                <div class="card">
                    <h2>Ce que vous avez consommés aujourd'hui</h2>
                    <div id="chartdiv"></div>
                </div>
            </div>
        </div>
    </div>

<?php
    require_once('template_footer.php');
?>

<script>
    $(document).ready(function(){
        getInfosUtilisateur();
        getConsos();
    });
    
    
    function getInfosUtilisateur() {
        $.ajax({
            url: path + "backend/api.php/utilisateurs/" + sessionId,
            method: 'GET',
            dataType: 'json',
        })
        .done(function(response){
            $infos = response;
            document.getElementById("bienvenue").innerHTML = "Bienvenue " + $infos[0]['PRENOM'] + " !";
        })
        .fail(function(error){
            alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
        });
    }

    function getConsos() {
        $.ajax({
            url: path + "backend/api.php/consommations/?" + `ID_UTILISATEUR=${sessionId}`,
            method: 'GET',
            dataType: 'json',
        })
        .done(function(response){
            $consos = response;
            afficheConsos($consos);
        })
        .fail(function(error){
            alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
        });
    }

    function afficheConsos($consos) {
        $.ajax({
            url: path + "backend/api.php/aliments/" + `${$consos[0]['ID_ALIMENT']}`,
            method: 'GET',
            dataType: 'json',
        })
        .done(function(response){
            $aliment = response;
            document.getElementById("mangé").innerHTML = `${$aliment[0]['NOM_ALIMENT']}`;
        })
        .fail(function(error){
            alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
        });
    }
</script>