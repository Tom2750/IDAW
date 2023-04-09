<?php
    require_once('template_header.php');
    require_once('template_session.php');
?>
    <link rel="stylesheet" href="css/styles_dashboard.css">
    <link rel="stylesheet" href="css/styles_aliments.css">
    <!-- datatable -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    

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
                        <h2>Ajouter un aliment</h2>
                        <form onsubmit="ajoutAliment();">
                            <div class="form-group row">
                                <label>Nom de l'aliment</label>
                                <input type="text" id="nom_aliment">
                                <label>Type de l'aliment</label>
                                <select id="type">
                                </select>
                            </div>
                            <br>
                            <button type="submit" class="ajout">Ajouter</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-info">
                        <h2>Ajouter un type</h2>
                        <form onsubmit="ajoutType();">
                            <div class="form-group row">
                                <label>Nom du type</label>
                                <input type="text" id="nom_type">
                            </div>
                            <br>
                            <button type="submit" class="ajout">Ajouter</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-info">
                        <h2>Aliments</h2>
                        <table id="dataTable">
                            <thead id=studentsTableHead>
                            </thead>
                            <tbody id="studentsTableBody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>

    <?php require_once('config.js'); ?>

    function ajoutAliment() {
        event.preventDefault();
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
            getAliments();
        })
        .fail(function(error){
            alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
        })
    }
    
    function afficheAliments() {
        event.preventDefault();
        // Ajout des entêtes du tableau
        let headers = ['ID_ALIMENT', 'NOM_ALIMENT', 'ID_TYPE'];
        let headerRow = '<tr>';
        headers.forEach(function(header) {
            headerRow += '<th>' + header + '</th>';
        });
        headerRow += '</tr>';
        $("#studentsTableHead").append(headerRow);

        // Ajout des lignes du tableau
        $aliments.forEach(function(aliment) {
            let row = '<tr>';
            row += '<td>' + aliment.ID_ALIMENT + '</td>';
            row += '<td>' + aliment.NOM_ALIMENT + '</td>';
            row += '<td>' + aliment.ID_TYPE + '</td>';
            row += '</tr>';
            $("#studentsTableBody").append(row);
        });
    }

    function getAliments() {
        $.ajax({
            url: path + "backend/api.php/aliments",
            method: 'GET',
            dataType: 'json',
        })
        .done(function(response){
            $aliments = response;
            afficheAliments();
        })
        .fail(function(error){
            alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
        });
    }

    function ajoutType(){
        event.preventDefault();
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

    $(document).ready(function(){
        getAliments();
        getTypes();
        // $('#dataTable').DataTable();
    });
</script>