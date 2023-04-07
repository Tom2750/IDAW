<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/styles_dashboard.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <img src="img/logo.png" alt="logo">
            </div>
            <ul class="menu">
                <li><a href="#" class="active">Dashboard</a></li>
                <li><a href="#">Profil</a></li>
                <li><a href="#">Aliments</a></li>
                <li><a href="#">Journal</a></li>
            </ul>
            <div class="footer">
                <p>&copy; 2023 Dashboard. All rights reserved.</p>
            </div>
        </div>

        <div class="main-content">
            <div class="header">
                <h1>Dashboard</h1>
            </div>
            <div class="cards">
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-users"></i>
                    </div>
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
