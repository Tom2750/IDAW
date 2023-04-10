$(document).ready(function () {
    var table = $('#table-consommations').DataTable({
        language: {
            url: "http://cdn.datatables.net/plug-ins/1.10.9/i18n/French.json"
        },

        pagingType: "full_numbers",
        lengthMenu: [5,10,15,20,25],
        pageLength: 3,

        columns: [
            { title: "ID_ALIMENT", data: "ID_ALIMENT" },
            { title: "NOM_ALIMENT", data: "NOM_ALIMENT" },
            { title: "TYPE", data: "TYPE" },
        ]
    });


    $.ajax({
        
        url: path + "backend/api.php/aliments",
        type: "GET",
        success: function(data) {
            var formattedData = [];

            getType(function(nomType) {
                // Formatage des données pour DataTable
                for (var i = 0; i < data.length; i++) {
                    var type = nomType.find(a => a.ID_TYPE === data[i].ID_TYPE);
                    var row = {
                        ID_ALIMENT: data[i]['ID_ALIMENT'],
                        NOM_ALIMENT: data[i]['NOM_ALIMENT'],
                        TYPE: type ? type.NOM_TYPE : "N/A"
                    };

                    formattedData.push(row);
                }

                // Remplissage de la DataTable avec les données
                table.rows.add(formattedData).draw();
            });
        }
    });


    function getType(callback) {
        $.ajax({
        
            url: path + "backend/api.php/types_aliments",
            type: "GET",
            success: function(data) {
                var formattedData = [];
    
                // Formatage des données pour DataTable
                for (var i = 0; i < data.length; i++) {
                    var row = {
                        ID_TYPE: data[i]['ID_TYPE'],
                        NOM_TYPE: data[i]['NOM']
                    };
    
                    formattedData.push(row);
                }
                callback(formattedData);
            }
        });
    }   

});