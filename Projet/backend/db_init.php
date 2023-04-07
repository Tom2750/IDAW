<?php
    ini_set('max_execution_time', 300);

    /* Connexion à la base de donnée */
    require_once('db_config.php');
    require_once('db_connect.php');

    // Suppression des foreign key
    deleteFK("aliments", $pdo);
    deleteFK("compositions", $pdo);
    deleteFK("consommations", $pdo);
    deleteFK("utilisateurs", $pdo);


    // Suppression des tables
    deleteTable("compositions", $pdo);
    deleteTable("nutriments", $pdo);
    deleteTable("consommations", $pdo);
    deleteTable("aliments", $pdo);
    deleteTable("types_aliments", $pdo);
    deleteTable("utilisateurs", $pdo);
    deleteTable("niveaux_sportifs", $pdo);
    deleteTable("sexes", $pdo);


    // Créations des tables
    $request = "CREATE TABLE IF NOT EXISTS `niveaux_sportifs` (
        `ID_NIVEAU_SPORTIF` int NOT NULL AUTO_INCREMENT,
        `NIVEAU` varchar(100) NOT NULL,
        PRIMARY KEY (`ID_NIVEAU_SPORTIF`)
      ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4";
    $pdo->exec($request);

    $request = "CREATE TABLE IF NOT EXISTS `sexes` (
        `ID_SEXE` int NOT NULL AUTO_INCREMENT,
        `SEXE` varchar(100) NOT NULL,
        PRIMARY KEY (`ID_SEXE`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4";
    $pdo->exec($request);

    $request = "CREATE TABLE IF NOT EXISTS `utilisateurs` (
        `ID_UTILISATEUR` int NOT NULL AUTO_INCREMENT,
        `LOGIN` varchar(100) NOT NULL,
        `HASH_MDP` varchar(100) NOT NULL,
        `NOM` varchar(100) NULL,
        `PRENOM` varchar(100) NULL,
        `TAILLE` int NULL,
        `POIDS` float NULL,
        `AGE` int NULL,
        `SEXE` int NOT NULL,
        `ID_NIVEAU_SPORTIF` int NOT NULL,
        PRIMARY KEY (`ID_UTILISATEUR`)
      ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4";
    $pdo->exec($request);

    $request = "CREATE TABLE IF NOT EXISTS `types_aliments` (
        `ID_TYPE` int NOT NULL AUTO_INCREMENT,
        `NOM` varchar(100) NOT NULL,
        PRIMARY KEY (`ID_TYPE`)
      ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4";
    $pdo->exec($request);

    $request = "CREATE TABLE IF NOT EXISTS `aliments` (
        `ID_ALIMENT` int NOT NULL AUTO_INCREMENT,
        `NOM_ALIMENT` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
        `ID_TYPE` int NOT NULL,
        PRIMARY KEY (`ID_ALIMENT`)
      ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4";
    $pdo->exec($request);

    $request = "CREATE TABLE IF NOT EXISTS `consommations` (
        `ID_CONSO` int NOT NULL AUTO_INCREMENT,
        `ID_UTILISATEUR` int NOT NULL,
        `ID_ALIMENT` int NOT NULL,
        `QUANTITE` int NOT NULL,
        `DATE_CONSO` date NOT NULL,
        PRIMARY KEY (`ID_CONSO`)
      ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4";
    $pdo->exec($request);

    $request = "CREATE TABLE IF NOT EXISTS `nutriments` (
        `ID_NUTRIMENT` int NOT NULL AUTO_INCREMENT,
        `NOM` varchar(100) NOT NULL,
        PRIMARY KEY (`ID_NUTRIMENT`)
      ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4";
    $pdo->exec($request);

    $request = "CREATE TABLE IF NOT EXISTS `compositions` (
        `ID_NUTRIMENT` int NOT NULL,
        `ID_ALIMENT` int NOT NULL,
        `RATIO` float DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    $pdo->exec($request);


    //Ajout des contraintes de clés étrangères
    $pdo->exec("ALTER TABLE `aliments` ADD CONSTRAINT `aliment_to_type` FOREIGN KEY (`ID_TYPE`) REFERENCES `types_aliments`(`ID_TYPE`) ON DELETE RESTRICT ON UPDATE RESTRICT");
    $pdo->exec("ALTER TABLE `compositions` ADD CONSTRAINT `comporte_to_aliment` FOREIGN KEY (`ID_ALIMENT`) REFERENCES `aliments`(`ID_ALIMENT`) ON DELETE RESTRICT ON UPDATE RESTRICT");
    $pdo->exec("ALTER TABLE `compositions` ADD CONSTRAINT `comporte_to_micro` FOREIGN KEY (`ID_NUTRIMENT`) REFERENCES `nutriments`(`ID_NUTRIMENT`) ON DELETE RESTRICT ON UPDATE RESTRICT");
    $pdo->exec("ALTER TABLE `consommations` ADD CONSTRAINT `consomme_to_aliment` FOREIGN KEY (`ID_ALIMENT`) REFERENCES `aliments`(`ID_ALIMENT`) ON DELETE RESTRICT ON UPDATE RESTRICT");
    $pdo->exec("ALTER TABLE `consommations` ADD CONSTRAINT `consomme_to_utilisateur` FOREIGN KEY (`ID_UTILISATEUR`) REFERENCES `utilisateurs`(`ID_UTILISATEUR`) ON DELETE RESTRICT ON UPDATE RESTRICT");
    $pdo->exec("ALTER TABLE `utilisateurs` ADD CONSTRAINT `user_to_sex` FOREIGN KEY (`SEXE`) REFERENCES `sexes`(`ID_SEXE`) ON DELETE RESTRICT ON UPDATE RESTRICT");
    $pdo->exec("ALTER TABLE `utilisateurs` ADD CONSTRAINT `user_to_sport` FOREIGN KEY (`ID_NIVEAU_SPORTIF`) REFERENCES `niveaux_sportifs`(`ID_NIVEAU_SPORTIF`) ON DELETE RESTRICT ON UPDATE RESTRICT");

    //Insérer des données
    $request = "INSERT INTO `niveaux_sportifs` (`ID_NIVEAU_SPORTIF`, `NIVEAU`) VALUES
        (1, 'bas'),
        (2, 'moyen'),
        (3, 'élevé');";
    $pdo->exec($request);

    $request = "INSERT INTO `sexes` (`ID_SEXE`, `SEXE`) VALUES
        (1, 'Homme'),
        (2, 'Femme');";
    $pdo->exec($request);

    $file = fopen('sql\utilisateurs.csv', "r");
    while (($row = fgetcsv($file)) !== FALSE) {
        $request = $pdo->prepare("
                                INSERT INTO utilisateurs (LOGIN, HASH_MDP, NOM, PRENOM, TAILLE, POIDS, AGE, SEXE, ID_NIVEAU_SPORTIF) 
                                VALUES (:login, :hash_mdp, :nom, :prenom, :taille, :poids, :age, :sexe, :id_niveau_sportif)");
        $request->bindParam(':login', $row[1]);
        $request->bindParam(':hash_mdp', $row[2]);
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
                                INSERT INTO types_aliments (NOM) 
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
                                INSERT INTO compositions (ID_NUTRIMENT, ID_ALIMENT, RATIO) 
                                VALUES (:id_nutriment, :id_aliment, :ratio)");
        $request->bindParam(':id_nutriment', $row[0]);
        $request->bindParam(':id_aliment', $row[1]);
        $request->bindParam(':ratio', $row[2]);

        $request->execute();
    }

    function deleteTable($tableName, $pdo){
        $sql = "SHOW TABLES FROM "._MYSQL_DBNAME." LIKE '$tableName'";
        $request = $pdo->query($sql);
        if($request->rowCount() > 0) {
          $pdo->exec("DROP TABLE $tableName");
        }
        $request->closeCursor();
    }

    function deleteFK($tableName, $pdo){
      $sql = "SHOW TABLES FROM "._MYSQL_DBNAME." LIKE '$tableName'";
      $request = $pdo->query($sql);
      if($request->rowCount() > 0) {
        switch($tableName) {
          case `compositions`:
            $pdo->exec("ALTER TABLE `compositions` DROP CONSTRAINT `comporte_to_aliment`");
            $pdo->exec("ALTER TABLE `compositions` DROP CONSTRAINT `comporte_to_micro`");
            break;
          case `aliments`:
            $pdo->exec("ALTER TABLE `aliments` DROP CONSTRAINT `aliment_to_type`");
            break;
          case `consommations`:
            $pdo->exec("ALTER TABLE `consommations` DROP CONSTRAINT `consomme_to_aliment`");
            $pdo->exes("ALTER TABLE `consommations` DROP CONSTRAINT `consomme_to_utilisateur`");
            break;
          case `utilisateurs`:
            $pdo->exec("ALTER TABLE `utilisateurs` DROP CONSTRAINT `user_to_sex`");
            $pdo->exec("ALTER TABLE `utilisateurs` DROP CONSTRAINT `user_to_sport`");
            break;
          default:
            break;
        }
      }
      $request->closeCursor();
    }
?>