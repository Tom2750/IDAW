Documentation de l'api :

/aliment
    GET: renvoie tous les aliments
    POST: ajoute un aliment avec les valeurs fournies dans le corps de la requête

/aliment/{id}
    GET: renvoie l'aliment d'id {id}
    PUT: modifie l'aliment d'id {id} avec les valeurs fournies dans le corps de la requête
    DELETE: supprime l'aliment d'id {id}

/utilisateur
    GET: renvoie tous les utilisateurs
    POST: ajoute un utilisateur avec les valeurs fournies dans le corps de la requête

/utilisateur/{id}
    GET: renvoie l'utilisateur d'id {id}
    PUT: modifie l'utilisateur d'id {id} avec les valeurs fournies dans le corps de la requête
    DELETE: supprime l'utilisateur d'id {id}

/composition
    GET: renvoie toutes les compositions

/composition/{id}
    GET: renvoie toutes les compositions pour l'aliment d'id {id}
    POST: ajoute une composition pour l'aliment d'id {id} avec les valeurs fournies dans le corps de la requête
    PUT: modifie la composition pour l'aliment d'id {id} et le nutriment avec la valeur dans le corps de la requête
    DELETE: supprime la composition pour l'aliment d'id {id} et le nutriment d'id id

/consommation
    GET: renvoie toutes les consommations d'un utilisateur sur une période, valeur dans la requête

/consommation/{id}
    GET: renvoie la consommation d'id {id}

- id_micro_nutriment => id_nutriment x2
- doublons compositions
clé primaire pour composition
ajout d'un id pour la table composition ?
- consommation avec un s

TODO :
faire put composition
finir consommation