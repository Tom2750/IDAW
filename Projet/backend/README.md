Documentation de l'api :

/aliments
    GET: renvoie tous les aliments
    POST: ajoute un aliment avec les valeurs NOM_ALIMENT et ID_TPE dans le corps de la requete

/aliments/{id}
    GET: renvoie l'aliment d'id {id}
    PUT: modifie l'aliment d'id {id} avec les valeurs NOM_ALIMENT et ID_TPE dans le corps de la requete
    DELETE: supprime l'aliment d'id {id}


/utilisateurs
    GET: renvoie l'utilisateur dont le login LOGIN et le mot de passe HASH_MDP sont dans l'url
    POST: ajoute un utilisateur avec les valeurs LOGIN, HASH_MDP, SEXE, ID_NIVEAU_SPORTIF fournies dans le corps de la requête

/utilisateurs/{id}
    GET: renvoie l'utilisateur d'id {id}
    PUT: modifie l'utilisateur d'id {id} avec les LOGIN, NOM, PRENOM, TAILLE, POIDS, AGE, SEXE, ID_NIVEAU_SPORTIF fournies dans le corps de la requête
    DELETE: supprime l'utilisateur d'id {id}


/compositions
    GET: renvoie toutes les compositions

/compositions/{id}
    GET: renvoie toutes les compositions pour l'aliment d'id {id}
    POST: ajoute une composition pour l'aliment d'id {id} avec les valeurs fournies dans le corps de la requête
    PUT: modifie la composition pour l'aliment d'id {id} et le nutriment avec la valeur dans le corps de la requête
    DELETE: supprime la composition pour l'aliment d'id {id} et le nutriment d'id id (dans la requete)


/consommations
    GET: renvoie toutes les consommations d'un utilisateur ID_UTILISATEUR à la date DATE_CONSO, valeurs dans l'url
    POST: ajoute une consommation avec les valeurs dans la requete

/consommations/{id}
    GET: renvoie la consommation d'id {id}
    PUT: modifie la consommation d'id {id} avec les valeurs dans la requete
    DELETE: supprime la conso d'id {id}


/niveaux_sportifs
    GET: renvoie tous les niveaux_sportifs
    POST: ajoute un niveau sportif avec les valeurs fournies dans le corps de la requête

/niveaux_sportifs/{id}
    GET: renvoie le niveau sportif d'id {id}
    PUT: modifie le niveau sportif d'id {id} avec les valeurs fournies dans le corps de la requête
    DELETE: supprime le niveau sprotif d'id {id}


/types_aliments
    GET: renvoie tous les types d'aliments
    POST: ajoute un type d'aliment avec les valeurs fournies dans le corps de la requête

/types_aliments/{id}
    GET: renvoie le type d'aliment d'id {id}
    PUT: modifie le type d'aliment d'id {id} avec les valeurs fournies dans le corps de la requête
    DELETE: supprime le type d'aliment d'id {id}






- id_micro_nutriment => id_nutriment x2
- doublons compositions
- consommation avec un s