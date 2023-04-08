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

    $("#creerCompte").click(function() {
        event.preventDefault();
        const inputNom = $("#nameSignUp").val();
        const inputLogin = $("#emailSignUp").val();
        const inputPw = $("#pwSignUp").val();
        const inputSexe = $("#sexeSignUp").val();
        const inputSport = $("#sportSignUp").val();
        var hashPw = CryptoJS.MD5(inputPw);
        creerCompte(inputLogin, inputPw, inputSexe, inputSport); //modifier avec hashPw
    });

    function connexion(login, pwd) {
        params = `LOGIN=${login}&HASH_MDP=${pwd}`; 
        $.ajax({
            url: path + `backend/api.php/utilisateurs?` + params,
            type: "GET",
            dataType: "json",
            success: function(response) {
              // Traitement de la réponse de l'API
              if (!(response.length==0)) {
                // Connexion réussie
                alert("Connexion réussie !");
                document.cookie = 'user_id='+response[0]['ID_UTILISATEUR'];
                window.location.href = "login.php";
                document.getElementById("signInForm").reset();
              } else {
                // Connexion échouée
                alert("Login ou mot de passe incorrect !");
                document.getElementById("signInForm").reset();
              }
            },
            error: function(jqXHR, textStatus, errorThrown) {
              // Traitement de l'erreur
              alert("Une erreur s'est produite : " + textStatus + ", " + errorThrown);
            }
          });
    }

    function creerCompte(login, pwd, sexe, niveauSport) {
        var jsonData = {
            "LOGIN": login,
            "HASH_MDP": pwd,
            "SEXE": sexe,
            "ID_NIVEAU_SPORTIF": niveauSport
          }
        compteExiste(login, function(result) {
          if (result) {
              alert("Cet email est déjà utilisé !");
          } else {
              $.ajax({
                url: path + "backend/api.php/utilisateurs",
                method: "POST",
                dataType: "json",
                data: JSON.stringify(jsonData),
                contentType: "application/json; charset=utf-8",
                success: function(response) {
                  // Traitement de la réponse de l'API
                  if (!(response.length==0)) {
                    // Enregistrement réussi
                    alert("Compte créé avec succès !");
                    document.getElementById("signUpForm").reset();
                  } else {
                    // Enregistrement échoué
                    alert("Erreur : " + response.message);
                    document.getElementById("signUpForm").reset();
                  }
                },
                error: function(error) {
                  // Traitement de l'erreur
                  alert("Une erreur s'est produite : " + JSON.stringify(error));
                } 
              });
          }
          container.classList.remove("right-panel-active");
      });
  }


    function compteExiste(login, callback) {
        params = `LOGIN=${login}`; 
        $.ajax({
            url: path + `backend/api.php/utilisateurs?` + params,
            type: "GET",
            dataType: "json",
            success: function(response) {
              // Traitement de la réponse de l'API
              if (!(response.length==0)) {
                console.log(response);
                callback(true);
              } else {
                console.log(response);
                callback(false);
              }
            },
            error: function(jqXHR, textStatus, errorThrown) {
              // Traitement de l'erreur
              alert("Une erreur s'est produite : " + textStatus + ", " + errorThrown);
            }
        });
    }


});

