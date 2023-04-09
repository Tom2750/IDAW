$(document).ready(function () {
    var table = $('#table-consommations').DataTable({
        language: {
            url: "http://cdn.datatables.net/plug-ins/1.10.9/i18n/French.json"
        },

        pagingType: "full_numbers",
        lengthMenu: [5,10,15,20,25],
        pageLength: 3,

        columns: [
            { title: "ID_CONSO", data: "ID_CONSO" },
            { title: "ALIMENT", data: "NOM_ALIMENT" },
            { title: "QUANTITE", data: "QUANTITE" },
            { title: "DATE_CONSO", data: "DATE_CONSO" }
        ]
    });


    const params = `ID_UTILISATEUR=${sessionId}`; 
    $.ajax({
        
        url: path + "backend/api.php/consommations?" + params,
        type: "GET",
        success: function(data) {
            var formattedData = [];

            getNomAliment(function(nomAliments) {
                // Formatage des données pour DataTable
                for (var i = 0; i < data.length; i++) {
                    var aliment = nomAliments.find(a => a.ID_ALIMENT === data[i].ID_ALIMENT);
                    var row = {
                        ID_CONSO: data[i]['ID_CONSO'],
                        NOM_ALIMENT: aliment ? aliment.NOM_ALIMENT : "N/A",
                        QUANTITE: data[i]['QUANTITE'],
                        DATE_CONSO: data[i]['DATE_CONSO']
                    };

                    formattedData.push(row);
                }

                // Remplissage de la DataTable avec les données
                table.rows.add(formattedData).draw();
            });
        }
    });

    function getNomAliment(callback) {
        $.ajax({
        
            url: path + "backend/api.php/aliments",
            type: "GET",
            success: function(data) {
                var formattedData = [];
    
                // Formatage des données pour DataTable
                for (var i = 0; i < data.length; i++) {
                    var row = {
                        ID_ALIMENT: data[i]['ID_ALIMENT'],
                        NOM_ALIMENT: data[i]['NOM_ALIMENT']
                    };
    
                    formattedData.push(row);
                }
                callback(formattedData);
            }
        });
    }
});