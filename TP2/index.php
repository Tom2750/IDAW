<!DOCTYPE html>
<html>
    <head>
        <title>Test pour apprendre php</title>
        <meta charset="utf-8">
    </head>
    
    <body>
        <h1>Titre principal</h1>
        <?php
            $age = 24;
            if($age>20){
                echo "plus grand<br>";
            }else{
                echo "plus petit<br>";
            };

            function afficheDateAge($a){
                echo date('h:i:s A');
                echo "<br>".$a."<br>";
            }
            afficheDateAge($age);
            $ages = ['Tom' => 20, 'Jean Robert' => 25];

            echo $ages['Jean Robert']."<br>";

            foreach($ages as $clef => $valeur){
                echo $clef. ' a ' .$valeur. ' ans<br>';
            }
        ?>
        <p>Un paragraphe</p>
    </body>
</html>