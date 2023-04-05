Documentation de l'api :

/aliments
    GET: renvoie tous les aliments
    POST: ajoute un aliment avec les valeurs fournies dans le corps de la requête

/aliments/{id}
    GET: renvoie l'aliment d'id {id}
    PUT: modifie l'aliment d'id {id} avec les valeurs fournies dans le corps de la requête
    DELETE: supprime l'aliment d'id {id}

/utilisateurs
    GET: renvoie l'utilisateur dont le login est dans le corps de la requête
    POST: ajoute un utilisateur avec les valeurs fournies dans le corps de la requête

/utilisateurs/{id}
    GET: renvoie l'utilisateur d'id {id}
    PUT: modifie l'utilisateur d'id {id} avec les valeurs fournies dans le corps de la requête
    DELETE: supprime l'utilisateur d'id {id}

/compositions
    GET: renvoie toutes les compositions

/compositions/{id}
    GET: renvoie toutes les compositions pour l'aliment d'id {id}
    POST: ajoute une composition pour l'aliment d'id {id} avec les valeurs fournies dans le corps de la requête
    PUT: modifie la composition pour l'aliment d'id {id} et le nutriment avec la valeur dans le corps de la requête
    DELETE: supprime la composition pour l'aliment d'id {id} et le nutriment d'id id (dans la requete)

/consommations
    GET: renvoie toutes les consommations d'un utilisateur sur une période, valeur dans la requête
    POST: ajoute une consommation avec les valeurs dans la requete

/consommations/{id}
    GET: renvoie la consommation d'id {id}
    PUT: modifie la consommation d'id {id} avec les valeurs dans la requete
    DELETE: supprime la conso d'id {id}

- id_micro_nutriment => id_nutriment x2
- doublons compositions
clé primaire pour composition
ajout d'un id pour la table composition ?
- consommation avec un s