<?php
    require_once('template_header.php');
    require_once('template_session.php');
?>  

    <link rel="stylesheet" href="css/styles_dashboard.css">
    <link rel="stylesheet" href="css/styles_profil.css">
    <script>
        var sessionId = <?php echo $_SESSION['user_id']; ?>;
    </script>
    <script src="config.js"></script>
    <script src="js/profilPage.js"></script>

</head>
<body>
    <div class="container">
        <?php require_once('template_nav.php') ?>
        <div class="main-content">
            <div class="header">
                <h1>Profil</h1>

            </div>
            <form id="addStudentForm">
                <div class="cards">
                    <div class="card">
                            <h2>Login</h2>
                            <input type="text" placeholder="email" id="login">
                    </div>
                    <div class="card">
                            <h2>Nom</h2>
                            <input type="text" placeholder="nom" id="nom">
                    </div>
                    <div class="card">
                            <h2>Prenom</h2>
                            <input type="text" placeholder="prenom" id="prenom">
                    </div>
                    <div class="card">
                            <h2>Age</h2>
                            <input type="number" placeholder="age" id="age">
                    </div>
                    <div class="card">
                            <h2>Taille</h2>
                            <input type="number" placeholder="taille en cm" id="taille">
                    </div>
                    <div class="card">
                            <h2>Poids</h2>
                            <input type="number" placeholder="poids en kg"step="0.01" id="poids">
                    </div>
                    <div class="card">
                            <h2>Sexe</h2>
                            <select class = "box" id="sexe">
                                <option value="">--Choisissez une option--</option>
                                <option value="1">homme</option>
                                <option value="2">femme</option>
                            </select>
                    </div>
                    <div class="card">
                            <h2>Niveau sportif</h2>
                            <select class = "box" id="niveau_sportif">
                                <option value="">--Choisissez une option--</option>
                                <option value="1">bas</option>
                                <option value="2">moyen</option>
                                <option value="3">élevé</option>
                            </select>
                    </div>
                </div>
                <button type="submit" class="sauvegarde" id="sauvegarde">Sauvegarder</button>
            </form>
        </div>
    </div>

<?php
    require_once('template_footer.php');
?>