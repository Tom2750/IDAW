let path = "<?php echo(_PATH) ; ?>";

$(document).ready(function(){
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
/*
    function onSignUpFormSubmit() { //pas finie
        event.preventDefault();
        const inputName = document.getElementById('nameSignUp').val();
        const inputLogin = document.getElementById('emailSignUp').val();
        const inputPw = document.getElementById('pwSignUp').val();
        var hashPw = CryptoJS.MD5(inputPw);
        var jsonData = {
            "NOM": inputName,
            "LOGIN": inputLogin,
            "H_MOT_DE_PASSE": hashPw,
        };

        $.ajax({
            url: path + "/users",
            method: 'POST',
            dataType: 'json',
            data: JSON.stringify(jsonData),
            contentType: "application/json; charset=utf-8",
        })
        .done(function(response){
            alert("OK");
        })
        .fail(function(error){
            alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
        })
    }*/

    function onSignInFormSubmit() { //pas finie
        event.preventDefault();
        const inputLogin = document.getElementById('emailSignIn').val();
        const inputPw = document.getElementById('pwSignIn').val();
        var hashPw = CryptoJS.MD5(inputPw);
        var jsonData = {
            "LOGIN": inputLogin,
            "H_MOT_DE_PASSE": inputPw,  ////Mofifier avec le hash
        };
        $returnedUtilisateur = getUtilisateur(jsonData);
        if(!empty($returnedUtilisateur)) {
            document.location.href(path + "frontend/index.php")
        }
        else {
            alert("Mauvais couple login / mot de passe");
        }
        /*
        $.ajax({
            url: path + "/utilisateur",
            method: 'POST',
            dataType: 'json',
            data: JSON.stringify(jsonData),
            contentType: "application/json; charset=utf-8",
        })
        .done(function(response){
            alert("OK");
        })
        .fail(function(error){
            alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
        })*/
    }

    function getUtilisateur(jsonData) {
        jsonStringUtilisateurs = null;
        $.ajax({
            url: path + "backend/api.php/utilisateurs",
            method: 'GET',
            dataType: 'json',
            data: JSON.stringify(jsonData),
            contentType: "application/json; charset=utf-8",
        })
        .done(function(response){
            jsonStringUtilisateurs = JSON.stringify(response);
        })
        .fail(function(error){
            alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
        })
        return jsonStringUtilisateurs;
    }

    console.log(getUtilisateur({
        "LOGIN": "william.nguyen@etu.imt-lille-douai.fr",
        "H_MOT_DE_PASSE": "William"
    }))
});