<?php
    /* Connexion à la base de donnée */
    require_once('config.php');
    require_once('db_connect.php');
        

    // Suppression des tables
    deleteTable("compositions", $pdo);
    deleteTable("est_compose_de", $pdo);
    deleteTable("nutriments", $pdo);
    deleteTable("consommation", $pdo);
    deleteTable("aliments", $pdo);
    deleteTable("type_aliment", $pdo);
    deleteTable("utilisateurs", $pdo);
    deleteTable("niveau_sportif", $pdo);
    deleteTable("sexe", $pdo);


    // Créations des tables
    $request = "CREATE TABLE IF NOT EXISTS `niveau_sportif` (
        `ID_NIVEAU_SPORTIF` int NOT NULL AUTO_INCREMENT,
        `NIVEAU` varchar(100) NOT NULL,
        PRIMARY KEY (`ID_NIVEAU_SPORTIF`)
      ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $pdo->exec($request);

    $request = "CREATE TABLE IF NOT EXISTS `sexe` (
        `ID_SEXE` int NOT NULL AUTO_INCREMENT,
        `SEXE` varchar(100) NOT NULL,
        PRIMARY KEY (`ID_SEXE`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $pdo->exec($request);

    $request = "CREATE TABLE IF NOT EXISTS `utilisateurs` (
        `ID_UTILISATEUR` int NOT NULL AUTO_INCREMENT,
        `LOGIN` varchar(100) NOT NULL,
        `H_MOT_DE_PASSE` varchar(100) NOT NULL,
        `NOM` varchar(100) NOT NULL,
        `PRENOM` varchar(100) NOT NULL,
        `TAILLE` int NOT NULL,
        `POIDS` float NOT NULL,
        `AGE` int NOT NULL,
        `SEXE` int NOT NULL,
        `ID_NIVEAU_SPORTIF` int NOT NULL,
        PRIMARY KEY (`ID_UTILISATEUR`),
        KEY `user_to_sex` (`SEXE`),
        KEY `user_to_sport` (`ID_NIVEAU_SPORTIF`)
      ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $pdo->exec($request);

    $request = "CREATE TABLE IF NOT EXISTS `type_aliment` (
        `ID_TYPE` int NOT NULL AUTO_INCREMENT,
        `NOM` varchar(100) NOT NULL,
        PRIMARY KEY (`ID_TYPE`)
      ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $pdo->exec($request);

    $request = "CREATE TABLE IF NOT EXISTS `aliments` (
        `ID_ALIMENT` int NOT NULL AUTO_INCREMENT,
        `NOM_ALIMENT` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
        `ID_TYPE` int NOT NULL,
        PRIMARY KEY (`ID_ALIMENT`),
        KEY `aliment_to_type` (`ID_TYPE`)
      ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $pdo->exec($request);

    $request = "CREATE TABLE IF NOT EXISTS `consommation` (
        `ID_CONSO` int NOT NULL AUTO_INCREMENT,
        `ID_UTILISATEUR` int NOT NULL,
        `ID_ALIMENT` int NOT NULL,
        `QUANTITE` int NOT NULL,
        `DATE_CONSO` date NOT NULL,
        PRIMARY KEY (`ID_CONSO`),
        KEY `consomme_to_utilisateur` (`ID_UTILISATEUR`),
        KEY `consomme_to_aliment` (`ID_ALIMENT`)
      ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $pdo->exec($request);

    $request = "CREATE TABLE IF NOT EXISTS `nutriments` (
        `ID_MICRO_NUTRIMENT` int NOT NULL AUTO_INCREMENT,
        `NOM` varchar(100) NOT NULL,
        PRIMARY KEY (`ID_MICRO_NUTRIMENT`)
      ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $pdo->exec($request);

    $request = "CREATE TABLE IF NOT EXISTS `est_compose_de` (
        `ID_ALIMENT_PERE` int NOT NULL,
        `ID_ALIMENT_FILS` int NOT NULL,
        `RATIO` float NOT NULL,
        KEY `compose_to_aliment_pere` (`ID_ALIMENT_PERE`),
        KEY `compose_to_aliment_fils` (`ID_ALIMENT_FILS`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
      $pdo->exec($request);

    $request = "CREATE TABLE IF NOT EXISTS `compositions` (
        `ID_MICRO_NUTRIMENT` int NOT NULL,
        `ID_ALIMENT` int NOT NULL,
        `RATIO` float DEFAULT NULL,
        KEY `comporte_to_micro` (`ID_MICRO_NUTRIMENT`),
        KEY `comporte_to_aliment` (`ID_ALIMENT`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    $pdo->exec($request);

    //Insérer des données
    $request = "INSERT INTO `niveau_sportif` (`ID_NIVEAU_SPORTIF`, `NIVEAU`) VALUES
        (1, 'bas'),
        (2, 'moyen'),
        (3, 'élevé');";
    $pdo->exec($request);

    $request = "INSERT INTO `sexe` (`ID_SEXE`, `SEXE`) VALUES
        (1, 'Homme'),
        (2, 'Femme');";
    $pdo->exec($request);

    $file = fopen('sql\utilisateurs.csv', "r");
    while (($row = fgetcsv($file)) !== FALSE) {
        $request = $pdo->prepare("
                                INSERT INTO utilisateurs (LOGIN, H_MOT_DE_PASSE, NOM, PRENOM, TAILLE, POIDS, AGE, SEXE, ID_NIVEAU_SPORTIF) 
                                VALUES (:login, :h_mot_de_passe, :nom, :prenom, :taille, :poids, :age, :sexe, :id_niveau_sportif)");
        $request->bindParam(':login', $row[1]);
        $request->bindParam(':h_mot_de_passe', $row[2]);
        $request->bindParam(':nom', $row[3]);
        $request->bindParam(':prenom', $row[4]);
        $request->bindParam(':taille', $row[5]);
        $request->bindParam(':poids', $row[6]);
        $request->bindParam(':age', $row[7]);
        $request->bindParam(':sexe', $row[8]);
        $request->bindParam(':id_niveau_sportif', $row[9]);

        $request->execute();
    }   

    $file = fopen('sql\type_aliment.csv', "r");
    while (($row = fgetcsv($file)) !== FALSE) {
        $request = $pdo->prepare("
                                INSERT INTO type_aliment (NOM) 
                                VALUES (:nom)");
        $request->bindParam(':nom', $row[1]);

        $request->execute();
    }   

    $file = fopen('sql\aliments.csv', "r");
    while (($row = fgetcsv($file)) !== FALSE) {
        $request = $pdo->prepare("
                                INSERT INTO aliments (NOM_ALIMENT, ID_TYPE) 
                                VALUES (:nom_aliment, :id_type)");
        $request->bindParam(':nom_aliment', $row[1]);
        $request->bindParam(':id_type', $row[2]);

        $request->execute();
    }   

    $file = fopen('sql\nutriments.csv', "r");
    while (($row = fgetcsv($file)) !== FALSE) {
        $request = $pdo->prepare("
                                INSERT INTO nutriments (NOM) 
                                VALUES (:nom)");
        $request->bindParam(':nom', $row[1]);

        $request->execute();
    }   

    $file = fopen('sql\compositions.csv', "r");
    while (($row = fgetcsv($file)) !== FALSE) {
        $request = $pdo->prepare("
                                INSERT INTO compositions (ID_MICRO_NUTRIMENT, ID_ALIMENT, RATIO) 
                                VALUES (:id_micro_nutriment, :id_aliment, :ratio)");
        $request->bindParam(':id_micro_nutriment', $row[0]);
        $request->bindParam(':id_aliment', $row[1]);
        $request->bindParam(':ratio', $row[2]);

        $request->execute();
    }   

    function deleteTable($tableName, $pdo){
        $pdo->exec("DROP TABLE $tableName");
    }
?>

