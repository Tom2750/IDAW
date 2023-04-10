--------Projet IDAW : iMangerMieux--------

Application web type tracker de nourriture et de maintien d'un journak des consommations.


--------Configuration base de donnée-------- 

Pour récupérer la base de données, il suffit de créer une base de données sur phpMyAdmin. Puis de renseigner le fichier config.php avec les informations de la BDD, pour finir il n'y a plus qu'à lancer db_init.php afin d'initialiser et remplir la base de données.

Si un problème est rencontré lors de l'utilisation de db_init, il reste toujours le fichier projet_idaw_bdd.sql situé dans backend/sql qui est un export direct de notre base de données. Il est donc également possible d'importer la base de données de cette manière sur phpMyAdmin.


--------Configuration du path côté front end-------- 

Il suffit de modifier le fichier config.js présent dans le dossier frontend avec le chemin souhaité.


--------Compte admin--------

Afin de vous faciliter la tâche, nous vous avons créé un compte admin afin de pouvoir tester au mieux les fonctionnalités de l'application.
Login : admin
Mot de passe : admin




Réalisé par Julien FREMAUX et Tom NGUYEN-CADORET
