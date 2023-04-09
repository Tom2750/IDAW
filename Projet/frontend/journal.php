<?php
    require_once('template_header.php');
    require_once('template_session.php');
?>

    <link rel="stylesheet" href="css/styles_dashboard.css">
    <link rel="stylesheet" href="css/styles_profil.css">
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

            <table id="table-consommations" class="display">
            <caption>Consommations</caption>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Aliment</th>
                        <th>Quantité</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

<?php
    require_once('template_footer.php');
?>