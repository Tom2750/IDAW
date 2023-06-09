<?php
    require_once('template_header.php');
    require_once('template_session.php');
?>
    <link rel="stylesheet" href="css/styles_dashboard.css">
    <link rel="stylesheet" href="css/styles_aliments.css">
    <link rel="stylesheet" href="css/styles_journal.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script>
        var sessionId = <?php echo $_SESSION['user_id']; ?>;
    </script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="config.js"></script>
    <script src="js/alimentPage.js"></script>
    

</head>
<body>
    <div class="container">
        <?php require_once('template_nav.php') ?>

        <div class="main-content">
            <div class="header">
                <h1>Aliments</h1>
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
                        <h2>Ajouter un aliment</h2>
                        <form id="alimentForm">
                            <div class="form-group row">
                                <label>Nom de l'aliment</label>
                                <input type="text" id="nom_aliment">
                                <label>Type de l'aliment</label>
                                <select id="type">
                                </select>
                            </div>
                            <br>
                            <button type="submit" id="ajoutAliment" class="ajout">Ajouter</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-info">
                        <h2>Ajouter un type</h2>
                        <form id="typeForm">
                            <div class="form-group row">
                                <label>Nom du type</label>
                                <input type="text" id="nom_type">
                            </div>
                            <br>
                            <button type="submit" id="ajoutType" class="ajout">Ajouter</button>
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
    $("#ajoutAliment").click(function() {
    event.preventDefault();
    ajoutAliment();
    document.getElementById("alimentForm").reset();
});

$("#ajoutType").click(function() {
    event.preventDefault();
    ajoutType();
    document.getElementById("typeForm").reset();
});

function ajoutAliment() {
    event.preventDefault();
    if($("#nom_aliment").val() == "" || $("#type").val() == "") {
        alert("Un nom d'aliment et un type sont nécessaires !");
        return;
    }
    var jsonData = {
        "NOM_ALIMENT": $("#nom_aliment").val(),
        "ID_TYPE": $("#type").val(),
    };

    $.ajax({
        url: path + "backend/api.php/aliments/",
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

function ajoutType(){
    event.preventDefault();
    if($("#nom_type").val() == "") {
        alert("Un nom de type est nécessaire !");
        return;
    }
    var jsonData = {
        "NOM": $("#nom_type").val()
    };

    $.ajax({
        url: path + "backend/api.php/types_aliments/",
        method: 'POST',
        dataType: 'json',
        data: JSON.stringify(jsonData),
        contentType: "application/json; charset=utf-8",
    })
    .done(function(response){
        getTypes();
    })
    .fail(function(error){
        alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
    })
}

function afficheTypes() {
    event.preventDefault();
    $("#type").empty();
    $("#type").append('<option value="">--Choisissez une option--</option>');
    $types.forEach(function(type) {
        $("#type").append('<option value="' + type.ID_TYPE + '">' + type.NOM + '</option>');
    });
}

function getTypes() {
    $.ajax({
        url: path + "backend/api.php/types_aliments",
        method: 'GET',
        dataType: 'json',
    })
    .done(function(response){
        $types = response;
        afficheTypes();
    })
    .fail(function(error){
        alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
    });
}

$(document).ready(function () {
    getTypes();
});
</script>