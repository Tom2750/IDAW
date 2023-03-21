## API REST pour la gestion des utilisateurs

Cette API REST est utilisée pour gérer les utilisateurs d'une application. Elle permet de réaliser les opérations CRUD (Create, Read, Update, Delete) sur les données des utilisateurs.
Installation

    Clonez ce dépôt sur votre machine
    Configurez le fichier config.php en renseignant les informations de votre base de données
    Exécutez le fichier db_connect.php pour établir la connexion à votre base de données

# Utilisation

L'API dispose des endpoints suivants :
GET /users

Retourne la liste des utilisateurs.
GET /users/{id}

Retourne les informations de l'utilisateur dont l'ID est {id}.
POST /users

Permet d'ajouter un nouvel utilisateur. Les informations de l'utilisateur doivent être envoyées dans le corps de la requête au format JSON avec les champs Login et Mail.
PUT /users/{id}

Permet de mettre à jour les informations de l'utilisateur dont l'ID est {id}. Les informations de l'utilisateur doivent être envoyées dans le corps de la requête au format JSON avec les champs Login et Mail.
DELETE /users/{id}

Permet de supprimer l'utilisateur dont l'ID est {id}.



# Exemple d'utilisation

Pour récupérer la liste des utilisateurs, envoyez une requête GET à l'URL suivante :
http://votre-domaine.com/api/users

Pour récupérer les informations de l'utilisateur ayant l'ID 1, envoyez une requête GET à l'URL suivante :
http://votre-domaine.com/api/users/1

Pour ajouter un nouvel utilisateur avec les informations suivantes : Login = "JohnDoe" et Mail = "john.doe@example.com", envoyez une requête POST à l'URL suivante :
http://votre-domaine.com/api/users

{
    "Login": "JohnDoe",
    "Mail": "john.doe@example.com"
}

Pour mettre à jour les informations de l'utilisateur ayant l'ID 1 avec les nouvelles informations suivantes : Login = "JohnDoe" et Mail = "john.doe@example.com", envoyez une requête PUT à l'URL suivante :

http://votre-domaine.com/api/users/1

{
    "Login": "JohnDoe",
    "Mail": "john.doe@example.com"
}

Pour supprimer l'utilisateur ayant l'ID 1, envoyez une requête DELETE à l'URL suivante :

http://votre-domaine.com/api/users/1
