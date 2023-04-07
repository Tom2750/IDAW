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
            </div>
            <div class="cards">
                <div class="card">
                        <h2>Mail</h2>
                        <p>carotte</p>
                </div>
                <div class="card">
                        <h2>Nom</h2>
                        <p>carotte</p>
                </div>
                <div class="card">
                        <h2>Prenom</h2>
                        <p>carotte</p>
                </div>
                <div class="card">
                        <h2>Taille</h2>
                        <p>carotte</p>
                </div>
                <div class="card">
                        <h2>Poids</h2>
                        <p>carotte</p>
                </div>
            </div>
            <div class="charts">
                <div class="chart">
                    <h2>Orders</h2>
                    <canvas id="orders-chart"></canvas>
                </div>
                <div class="chart">
                    <h2>Sales</h2>
                    <canvas id="sales-chart"></canvas>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    afficheInfoUtilisateurs(){
        
    }

    getInfoUtilisateur(){

    }
</script>