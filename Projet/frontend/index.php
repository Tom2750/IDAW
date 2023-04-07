<?php
    require_once('template_header.php');
?>

        <link rel="stylesheet" href="css/styles_loginForm.css">
        
        <script src="config.js"></script>
        <script src="js/loginPage.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/core.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/md5.js"></script>
        <style>
            .box {
                background-color: #eee;
                border: none;
                border-radius: 1px;
                padding: 12px 15px;
                margin: 8px 0;
                width: 100%;
            }
        </style>
   </head>
   <body>
        <div class="container" id="container">
            <div class="form-container sign-up-container">
                <form action="#">
                    <h1>Créer un compte</h1>
                    <input type="email" id="emailSignUp" placeholder="Email" />
                    <input type="password" id="pwSignUp" placeholder="Mot de passe" />
                    <select class="box" id="sexeSignUp">
                        <option value="">Sexe :</option>
                        <option value=1>Homme</option>
                        <option value=2>Femme</option>
                    </select>
                    <select class="box" id="sportSignUp" >
                        <option value="">Niveau sportif :</option>
                        <option value=1>Bas</option>
                        <option value=2>Moyen</option>
                        <option value=3>Elevé</option>
                    </select>
                    <button type="submit" id="creerCompte">Créer compte</button>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form action="dashboard.php">
                    <h1>Se connecter</h1>
                    <input type="email" id="emailSignIn" placeholder="Email" />
                    <input type="password" id="pwSignIn" placeholder="Mot de passe" />
                    <a href="#">Mot de passe oublié ?</a>
                    <button type="submit" id="connexion">Connexion</button>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Bon retour parmi nous !</h1>
                        <p>Pour rester connecter, merci de renseigner vos informations de connexion</p>
                        <button class="ghost" id="signIn">Se connecter</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Bonjour vous !</h1>
                        <p>Complétez le formulaire et commencez votre expérience avec nous !</p>
                        <button class="ghost" id="signUp">Créer un compte</button>
                    </div>
                </div>
            </div>
        </div>

        
<?php
    require_once('template_footer.php');
?>