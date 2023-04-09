$("#ajoutAliment").click(function() {
    event.preventDefault();
    ajoutAliment();
});

$("#ajoutType").click(function() {
    event.preventDefault();
    console.log("coucou");
    const nomType = $("#nom_type").val();
    console.log(nomType);
    ajoutType(nomType);
});

function ajoutAliment() {
    event.preventDefault();
    var jsonData = {
        "NOM_ALIMENT": $("#nom_aliment").val(),
        "ID_TYPE": $("#type").val(),
    };

    $.ajax({
        url: path + "backend/api.php/aliments/",
        method: 'POST',
        dataType: 'json',
        data: JSON.stringify(jsonData),
        contentType: "application/json; charset=utf-8",
    })
    .done(function(response){
        getAliments();
    })
    .fail(function(error){
        alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
    })
}

function afficheAliments() {
    event.preventDefault();
    // Ajout des entêtes du tableau
    let headers = ['ID_ALIMENT', 'NOM_ALIMENT', 'ID_TYPE'];
    let headerRow = '<tr>';
    headers.forEach(function(header) {
        headerRow += '<th>' + header + '</th>';
    });
    headerRow += '</tr>';
    $("#studentsTableHead").append(headerRow);

    // Ajout des lignes du tableau
    $aliments.forEach(function(aliment) {
        let row = '<tr>';
        row += '<td>' + aliment.ID_ALIMENT + '</td>';
        row += '<td>' + aliment.NOM_ALIMENT + '</td>';
        row += '<td>' + aliment.ID_TYPE + '</td>';
        row += '</tr>';
        $("#studentsTableBody").append(row);
    });
}

function getAliments() {
    $.ajax({
        url: path + "backend/api.php/aliments",
        method: 'GET',
        dataType: 'json',
    })
    .done(function(response){
        $aliments = response;
        afficheAliments();
    })
    .fail(function(error){
        alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
    });
}

function ajoutType(nomType){
    event.preventDefault();
    var jsonData = {
        "NOM": nomType
    }

    $.ajax({
        url: path + "backend/api.php/types_aliments/",
        method: 'POST',
        dataType: 'json',
        data: JSON.stringify(jsonData),
        contentType: "application/json; charset=utf-8",
    })
    .done(function(response){
        alert("OK");
        console.log(response);
        getTypes();
    })
    .fail(function(error){
        alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
    })
}

function afficheTypes() {
    event.preventDefault();
    $("#type").empty();
    $("#type").append('<option value="">--Choisissez une option--</option>');
    $types.forEach(function(type) {
        $("#type").append('<option value="' + type.ID_TYPE + '">' + type.NOM + '</option>');
    });
}

function getTypes() {
    $.ajax({
        url: path + "backend/api.php/types_aliments",
        method: 'GET',
        dataType: 'json',
    })
    .done(function(response){
        $types = response;
        afficheTypes();
    })
    .fail(function(error){
        alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
    });
}

$(document).ready(function(){
    getAliments();
    getTypes();
    // $('#dataTable').DataTable();
});