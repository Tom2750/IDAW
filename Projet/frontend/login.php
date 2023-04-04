<?php
    require_once('template_header.php');
?>

        <link rel="stylesheet" href="css/loginForm_styles.css">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="js/signButton.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/core.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/md5.js"></script>
   </head>
   <body>

        <div class="container" id="container">
            <div class="form-container sign-up-container">
                <form action="#" onsubmit="onSignUpFormSubmit()">
                    <h1>Créer un compte</h1>
                    <input type="text" id="nameSignUp" placeholder="Nom" />
                    <input type="email" id="emailSignUp" placeholder="Email" />
                    <input type="password" id="pwSignUp" placeholder="Mot de passe" />
                    <button type="submit">Créer compte</button>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form action="#" onsubmit="onSignInFormSubmit()">
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