var $infos;

function afficheInfosUtilisateur() {
    document.getElementById("login").setAttribute("value", $infos[0]['LOGIN']);
    document.getElementById("nom").setAttribute("value", $infos[0]['NOM']);
    document.getElementById("age").setAttribute("value", $infos[0]['AGE']);
    document.getElementById("prenom").setAttribute("value", $infos[0]['PRENOM']);
    document.getElementById("taille").setAttribute("value", $infos[0]['TAILLE']);
    document.getElementById("poids").setAttribute("value", $infos[0]['POIDS']);
    document.getElementById("sexe").value = $infos[0]['SEXE'];
    document.getElementById("niveau_sportif").value = $infos[0]['ID_NIVEAU_SPORTIF'];
}

function getInfosUtilisateur() {
    $.ajax({
        url: path + "backend/api.php/utilisateurs/" + sessionId,
        method: 'GET',
        dataType: 'json',
    })
    .done(function(response){
        $infos = response;
        afficheInfosUtilisateur();
    })
    .fail(function(error){
        alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
    });
}

$("#sauvegarde").click(function() {
    event.preventDefault();
    var jsonData = {
        "LOGIN": $("#login").val(),
        "NOM": $("#nom").val(),
        "PRENOM": $("#prenom").val(),
        "TAILLE": $("#taille").val(),
        "POIDS": $("#poids").val(),
        "AGE": $("#age").val(),
        "SEXE": $("#sexe").val(),
        "ID_NIVEAU_SPORTIF": $("#niveau_sportif").val(),
    };
    modifierUtilisateur(jsonData);
});

function modifierUtilisateur(jsonData) {
    $.ajax({
        url: path + "backend/api.php/utilisateurs/" + sessionId,
        method: 'PUT',
        dataType: 'json',
        data: JSON.stringify(jsonData),
        contentType: "application/json; charset=utf-8",
    })
    .done(function(response){
        afficheInfosUtilisateur();
    })
    .fail(function(error){
        alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
    })
}

$(document).ready(function(){
    getInfosUtilisateur();
});