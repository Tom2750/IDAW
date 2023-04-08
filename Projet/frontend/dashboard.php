<?php
    require_once('template_header.php');
    require_once('template_session.php');
?>
    <link rel="stylesheet" href="css/styles_dashboard.css">
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
                        <h2>Derniers aliments ajoutés</h2>
                        <p>carotte</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="card-info">
                        <h2>Calories consommées ajd</h2>
                        <p>Bouton pour changer 1j, 7j,...</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="card-info">
                        <h2>Encore des trucs</h2>
                        <p>trucs</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="card-info">
                        <h2>Sales</h2>
                        <p>$32,584</p>
                    </div>
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
