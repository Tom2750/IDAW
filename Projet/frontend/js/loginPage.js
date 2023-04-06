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

    $("#connexion").click(function() {
        event.preventDefault();
        const inputLogin = $("#emailSignIn").val();
        const inputPw = $("#pwSignIn").val();
        var hashPw = CryptoJS.MD5(inputPw);
        connexion(inputLogin, inputPw); //modifier avec hashPw
    });

    function connexion(login, pwd) {
        params = `LOGIN=${login}&HASH_MDP=${pwd}`; 
        console.log(path + `backend/api.php/utilisateurs?` + params);
        $.ajax({
            url: path + `backend/api.php/utilisateurs?` + params,
            type: "GET",
            dataType: "json",
            success: function(response) {
              // Traitement de la réponse de l'API
              if (!(response.length==0)) {
                // Connexion réussie
                alert("Connexion réussie !");
                window.location.href = "index.php";
              } else {
                // Connexion échouée
                alert("Login ou mot de passe incorrect !");
              }
            },
            error: function(jqXHR, textStatus, errorThrown) {
              // Traitement de l'erreur
              alert("Une erreur s'est produite : " + textStatus + ", " + errorThrown);
            }
          });
    }





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

