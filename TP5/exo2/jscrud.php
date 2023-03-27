<!doctype html>
<html lang="fr">
    <head>
        <meta charset='utf-8'>
        <link rel="stylesheet" href="style1.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <?php require_once('config.php'); ?>
        <title>tabletest</title>
    </head>
    <body>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Login</th>
                    <th scope="col">Mail</th>
                    <th scope="col">CRUD</th>
                </tr>
            </thead>
            <tbody id="studentsTableBody">
            </tbody>
        </table>
        <form id="addStudentForm" action="" onsubmit="onFormSubmit();">
            <div class="form-group row">
                <label for="inputLogin" class="col-sm-2 col-form-label">Login</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="inputLogin" >
                </div>
                <label for="inputMail" class="col-sm-2 col-form-label">Mail</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="inputMail" >
                </div>
            </div>

            <div class="form-group row">
                <span class="col-sm-2"></span>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary form-control">Submit</button>
                </div>
            </div>
        </form>

        <script>
            let path = "<?php echo(_PATH) ; ?>";

            function afficheUtilisateurs() {
                jsonArrayUtilisateurs = JSON.parse(jsonStringUtilisateurs);
                $("#studentsTableBody").empty();
                for(var i = 0; i < jsonArrayUtilisateurs.length; i++ ){
                    $("#studentsTableBody").append(`<tr id="${jsonArrayUtilisateurs[i].id}"><td>${jsonArrayUtilisateurs[i].id}</td><td>${jsonArrayUtilisateurs[i].Login}</td><td>${jsonArrayUtilisateurs[i].Mail}</td><td>
                        <button onclick="onModifierClick(${jsonArrayUtilisateurs[i].id}); return false;">Modifier</button>
                        <button onclick="onSupprimerClick(${jsonArrayUtilisateurs[i].id}); return false;">Supprimer</button></td></tr>`);
                }
            }

            function getAllUtilisateurs() {
                $.ajax({
                    url: path + "/users",
                    method: 'GET',
                    dataType: 'json',
                })
                .done(function(response){
                    jsonStringUtilisateurs = JSON.stringify(response);
                    afficheUtilisateurs();
                })
                .fail(function(error){
                    alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
                })
            }

            function onFormSubmit() {
                event.preventDefault();
                var jsonData = {
                    "Login": $("#inputLogin").val(),
                    "Mail": $("#inputMail").val(),
                };

                $.ajax({
                    url: path + "/users",
                    method: 'POST',
                    dataType: 'json',
                    data: JSON.stringify(jsonData),
                    contentType: "application/json; charset=utf-8",
                })
                .done(function(response){
                    getAllUtilisateurs();
                })
                .fail(function(error){
                    alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
                })
            }

            function onSupprimerClick(id){
                $.ajax({
                    url: path + `/users/${id}`,
                    method: 'DELETE',
                    dataType: 'json',
                })
                .done(function(response){
                    $("#" + id).remove();
                })
                .fail(function(error){
                    alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
                })                
            }

            function onModifierClick(id){
                let currentRow = $("#" + id);

                let login = currentRow.find("td:eq(1)").text();
                let mail = currentRow.find("td:eq(2)").text();

                $("#inputLogin").val(login);
                $("#inputMail").val(mail);

                $("#addStudentForm button[type='submit']").replaceWith(`<button type="submit" onclick="onUpdateClick(${id});" class="btn btn-primary form-control">Sauvegarder</button>`);
            }

            function onUpdateClick(id){
                event.preventDefault();
                var jsonData = {
                    "Login": $("#inputLogin").val(),
                    "Mail": $("#inputMail").val(),
                };

                $.ajax({
                    url: path + `/users/${id}`,
                    method: 'PUT',
                    dataType: 'json',
                    data: JSON.stringify(jsonData),
                    contentType: "application/json; charset=utf-8",
                })
                .done(function(response){
                    $("#" + id).html(`<td>${id}</td><td>${jsonData.Login}</td><td>${jsonData.Mail}</td><td>
                        <button onclick="onModifierClick(id}); return false;">Modifier</button>
                        <button onclick="onSupprimerClick(id}); return false;">Supprimer</button></td>`);
                })
                .fail(function(error){
                    alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
                })

                $("#addStudentForm button[type='submit']").replaceWith(`<button type="submit" class="btn btn-primary form-control">Submit</button>`);
            }

            $(document).ready(function(){
                getAllUtilisateurs();
            });
        </script>
    </body>
</html>