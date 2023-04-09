<?php
    require_once('template_header.php');
    require_once('template_session.php');
?>  
    <link rel="stylesheet" href="css/styles_dashboard.css">
    <link rel="stylesheet" href="css/styles_profil.css">
</head>
<body>
    <div class="container">
        <?php require_once('template_nav.php') ?>
        <div class="main-content">
            <div class="header">
                <h1>Profil</h1>

            </div>
            <form id="addStudentForm" onsubmit="onFormSubmit();">
                <div class="cards">
                    <div class="card">
                            <h2>Login</h2>
                            <input type="text" id="login">
                    </div>
                    <div class="card">
                            <h2>Nom</h2>
                            <input type="text" id="nom">
                    </div>
                    <div class="card">
                            <h2>Prenom</h2>
                            <input type="text" id="prenom">
                    </div>
                    <div class="card">
                            <h2>Age</h2>
                            <input type="text" id="age">
                    </div>
                    <div class="card">
                            <h2>Taille</h2>
                            <input type="text" id="taille">
                    </div>
                    <div class="card">
                            <h2>Poids</h2>
                            <input type="text" id="poids">
                    </div>
                    <div class="card">
                            <h2>Sexe</h2>
                            <select id="sexe">
                                <option value="">--Choisissez une option--</option>
                                <option value="1">homme</option>
                                <option value="2">femme</option>
                            </select>
                    </div>
                    <div class="card">
                            <h2>Niveau sportif</h2>
                            <select id="niveau_sportif">
                                <option value="">--Choisissez une option--</option>
                                <option value="1">bas</option>
                                <option value="2">moyen</option>
                                <option value="3">élevé</option>
                            </select>
                    </div>
                </div>
                <button type="submit" class="sauvegarde">Sauvegarder</button>
            </form>
        </div>
    </div>
</body>
</html>

<script>
    <?php require_once('config.js'); ?>

    var $infos;

    function afficheInfosUtilisateur() {
        document.getElementById("login").setAttribute("value", $infos[0]['LOGIN']);
        document.getElementById("nom").setAttribute("value", $infos[0]['NOM']);
        document.getElementById("age").setAttribute("value", $infos[0]['AGE']);
        document.getElementById("prenom").setAttribute("value", $infos[0]['PRENOM']);
        document.getElementById("taille").setAttribute("value", $infos[0]['TAILLE']);
        document.getElementById("poids").setAttribute("value", $infos[0]['POIDS']);
        document.getElementById("sexe").value = $infos[0]['SEXE'];
        document.getElementById("niveau_sportif").value = $infos[0]['ID_NIVEAU_SPORTIF'];
    }

    function getInfosUtilisateur() {
        $.ajax({
            url: path + "backend/api.php/utilisateurs/" + <?php echo $_SESSION['user_id'] ?>,
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

    function onFormSubmit() {
        event.preventDefault();
        var jsonData = {
            "LOGIN": $("#login").val(),
            "NOM": $("#nom").val(),
            "PRENOM": $("#prenom").val(),
            "TAILLE": $("#taille").val(),
            "POIDS": $("#poids").val(),
            "AGE": $("#age").val(),
            "SEXE": $("#sexe").val(),
            "ID_NIVEAU_SPORTIF": $("#niveau_sportif").val(),
        };

        $.ajax({
            url: path + "backend/api.php/utilisateurs/" + <?php echo $_SESSION['user_id'] ?>,
            method: 'PUT',
            dataType: 'json',
            data: JSON.stringify(jsonData),
            contentType: "application/json; charset=utf-8",
        })
        .done(function(response){
            afficheInfosUtilisateur();
        })
        .fail(function(error){
            alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
        })
    }

    $(document).ready(function(){
        getInfosUtilisateur();
    });
</script>