<?php
    require_once('template_header.php');
?>  
    <link rel="stylesheet" href="css/styles_dashboard.css">
</head>
<body>
    <div class="container">
        <?php require_once('template_nav.php') ?>
        <div class="main-content">
            <div class="header">
                <h1>Profil</h1>
                <button class="edit-info-btn" onlick="profil-edit.php">Modifier les informations</button>
            </div>
            <div class="cards">
                <div class="card">
                        <h2>Login</h2>
                        <p id="login"></p>
                </div>
                <div class="card">
                        <h2>Nom</h2>
                        <p id="nom"></p>
                </div>
                <div class="card">
                        <h2>Prenom</h2>
                        <p id="prenom"></p>
                </div>
                <div class="card">
                        <h2>Taille</h2>
                        <p id="taille"></p>
                </div>
                <div class="card">
                        <h2>Poids</h2>
                        <p id="poids"></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    <?php require_once('config.js'); ?>

    var $infos;

    function afficheInfosUtilisateur() {
        document.getElementById("login").textContent = $infos[0]['LOGIN'];
        document.getElementById("nom").textContent = $infos[0]['NOM'];
        document.getElementById("prenom").textContent = $infos[0]['PRENOM'];
        document.getElementById("taille").textContent = $infos[0]['TAILLE'];
        document.getElementById("poids").textContent = $infos[0]['POIDS'];
    }

    function getInfosUtilisateur() {
        $.ajax({
            url: path + "backend/api.php/utilisateurs/" + <?php echo $_COOKIE['id'] ?>,
            method: 'GET',
            dataType: 'json',
        })
        .done(function(response){
            $infos = response;
            afficheInfosUtilisateur();
        })
        .fail(function(error){
            alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
        });
    }

    $(document).ready(function(){
        getInfosUtilisateur();
    });
</script>