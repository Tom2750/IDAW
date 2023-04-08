<?php
    require_once('template_header.php');
    require_once('template_session.php');
?>
    <link rel="stylesheet" href="css/styles_dashboard.css">
    <!-- datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    

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
                    <div class="card-info">
                        <h2>Aliments</h2>
                        <table id="table">
                            <thead id=studentsTableHead>
                            </thead>
                            <tbody id="studentsTableBody">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-info">
                        <h2>Ajouter un aliment</h2>
                        <p>carotte</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>

    <?php require_once('config.js'); ?>
    
    function afficheAliments() {
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

    $(document).ready(function(){
        $(document).ready( function () {
            $('#table').DataTable();
        } );

        
        getAliments();
    });
</script>