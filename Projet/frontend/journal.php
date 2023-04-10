<?php
    require_once('template_header.php');
    require_once('template_session.php');
?>

    <link rel="stylesheet" href="css/styles_dashboard.css">
    <!--<link rel="stylesheet" href="css/styles_profil.css">-->
    <link rel="stylesheet" href="css/styles_aliments.css">
    <link rel="stylesheet" href="css/styles_journal.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

    <script>
        var sessionId = <?php echo $_SESSION['user_id']; ?>;
    </script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="config.js"></script>
    <script src="js/journalPage.js"></script>

</head>
<body>
    <div class="container">
        <?php require_once('template_nav.php') ?>

        <div class="main-content">
            <div class="header">
                <h1>Journal</h1>
            </div>
            <div class="cards">
                <div class="card">
                    <div class="card-info">
                        <h2>Aliments</h2>
                        <table id="table-consommations" class="display"></table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-info">
                        <h2>Ajouter une consommation</h2>
                        <form id="ajoutForm">
                            <div class="form-group row">
                                <label>Aliment</label>
                                <select id="ajoutAlimentConso"></select></br></br>
                                <label>Quantité (en gramme)</label>          
                                <input type="number" id="ajoutQuantiteConso"></input>
                                <label>Date de consommation</label>
                                <input type="date" id="ajoutDateConso"></input>
                            </div>
                            <br>
                            <button type="submit" id="ajoutConso" class="ajout">Ajouter</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-info">
                        <h2>Modifier une consommation</h2>
                        <form id="modifForm">
                            <div class="form-group row">
                                <label>Id conso</label>
                                <select id="modifIdConso"></select>
                                <label>Aliment</label>
                                <select id="modifAlimentConso"></select>
                                <label>Quantité (en gramme)</label>          
                                <input type="number" id="modifQuantiteConso"></input>
                                <label>Date de consommation</label>
                                <input type="date" id="modifDateConso"></input>
                            </div>
                            <br>
                            <button type="submit" id="modifConso" class="ajout">Modifer</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-info">
                        <h2>Supprimer une consommation</h2>
                        <form id="supprForm">
                            <div class="form-group row">
                                <label>Id conso</label>
                                <select id="supprIdConso"></select>
                            </div>
                            <br>
                            <button type="submit" id="supprConso" class="ajout">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
    require_once('template_footer.php');
?>

<script>
    $("#ajoutConso").click(function() {
        event.preventDefault();
        ajoutConso();
        document.getElementById("ajoutForm").reset();
        location.reload();
    });

    $("#modifConso").click(function() {
        event.preventDefault();
        modifConso();
        document.getElementById("modifForm").reset();
        location.reload();
    });

    $("#supprConso").click(function() {
        event.preventDefault();
        supprConso();
        document.getElementById("supprForm").reset();
        location.reload();
    });
    

    function ajoutConso() {
        event.preventDefault();
        if($("#ajoutAlimentConso").val() == "" || $("#ajoutQuantiteConso").val() == "" || $("#ajoutDateConso").val() == "") {
            alert("Un nom d'aliment, une quantité et une date de consommation sont nécessaires !");
            return;
        }
        var jsonData = {
            "ID_UTILISATEUR": sessionId,
            "ID_ALIMENT": $("#ajoutAlimentConso").val(),
            "QUANTITE": $("#ajoutQuantiteConso").val(),
            "DATE_CONSO": $("#ajoutDateConso").val()
        };

        $.ajax({
            url: path + "backend/api.php/consommations",
            method: 'POST',
            dataType: 'json',
            data: JSON.stringify(jsonData),
            contentType: "application/json; charset=utf-8",
        })
        .done(function(response){

        })
        .fail(function(error){
            alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
        })
    }

    function afficheAlimentAjout() {
        event.preventDefault();
        $("#ajoutAlimentConso").empty();
        $("#ajoutAlimentConso").append('<option value="">--Choisissez un aliment--</option>');
        $alimentsAjout.forEach(function(aliment) {
            $("#ajoutAlimentConso").append('<option value="' + aliment.ID_ALIMENT + '">' + aliment.NOM_ALIMENT + '</option>');
        });
    }

    function getAliments() {
        $.ajax({
            url: path + "backend/api.php/aliments",
            method: 'GET',
            dataType: 'json',
        })
        .done(function(response){
            $alimentsAjout = response;
            afficheAlimentAjout();
            afficheAlimentModif();
        })
        .fail(function(error){
            alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
        });
    }

    function getConsos() {
        const params = `ID_UTILISATEUR=${sessionId}`
        $.ajax({
            url: path + "backend/api.php/consommations?" + params,
            method: 'GET',
            dataType: 'json',
        })
        .done(function(response){
            $consosModif = response;
            afficheConsoModif();
            afficheConsoSuppr();
        })
        .fail(function(error){
            alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
        });
    }

    function afficheConsoModif() {
        $("#modifIdConso").empty();
        $("#modifIdConso").append('<option value="">--Choisissez une consommation à modifier--</option>');
        $consosModif.forEach(function(conso) {
            $("#modifIdConso").append('<option value="' + conso.ID_CONSO + '">' + conso.ID_CONSO + '</option>');
        });
    }

    function afficheConsoSuppr() {
        $("#supprIdConso").empty();
        $("#supprIdConso").append('<option value="">--Choisissez une consommation à modifier--</option>');
        $consosModif.forEach(function(conso) {
            $("#supprIdConso").append('<option value="' + conso.ID_CONSO + '">' + conso.ID_CONSO + '</option>');
        });
    }

    function afficheAlimentModif() {
        $("#modifAlimentConso").empty();
        $("#modifAlimentConso").append('<option value="">--Choisissez un aliment--</option>');
        $alimentsAjout.forEach(function(aliment) {
            $("#modifAlimentConso").append('<option value="' + aliment.ID_ALIMENT + '">' + aliment.NOM_ALIMENT + '</option>');
        });
    }

    function modifConso() {
        event.preventDefault();
        if($("#modifIdConso").val() == "" || $("#modifAlimentConso").val() == "" || $("#modifQuantiteConso").val() == "" || $("#modifDateConso").val() == "") {
            alert("Un id de consommation, un nom d'aliment, une quantité et une date de consommation sont nécessaires !");
            return;
        }
        var jsonData = {
            "ID_UTILISATEUR": sessionId,
            "ID_ALIMENT": $("#modifAlimentConso").val(),
            "QUANTITE": $("#modifQuantiteConso").val(),
            "DATE_CONSO": $("#modifDateConso").val()
        };

        $.ajax({
            url: path + "backend/api.php/consommations/" + $("#modifIdConso").val(),
            method: 'PUT',
            dataType: 'json',
            data: JSON.stringify(jsonData),
            contentType: "application/json; charset=utf-8",
        })
        .done(function(response){

        })
        .fail(function(error){
            alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
        })
    }

    function supprConso() {
        event.preventDefault();
        if($("#supprIdConso").val() == "") {
            alert("Un id de consommation est nécessaire !");
            return;
        }

        $.ajax({
            url: path + "backend/api.php/consommations/" + $("#supprIdConso").val(),
            method: 'DELETE',
            dataType: 'json',
        })
        .done(function(response){

        })
        .fail(function(error){
            alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
        })
    }

$(document).ready(function () {
    getAliments();
    getConsos();
});
</script>