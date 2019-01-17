<?php

session_start();
// Premiere ligne
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reunion_island";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error)
{ die ("Connection failed: " . $conn->connect_error); }

else {
    $conn->select_db($dbname); }







function affichage()
{
    GLOBAL $conn;

    $id = (isset($_GET['id']) ? $_GET['id'] : null);
    $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

    $name = (isset($_POST['name']) ? $_POST['name'] : null);
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $difficulty = (isset($_POST['difficulty']) ? $_POST['difficulty'] : null);
    $difficulty = filter_var($difficulty, FILTER_SANITIZE_STRING);

    $distance = (isset($_POST['distance']) ? $_POST['distance'] : null);
    $distance = filter_var($distance, FILTER_SANITIZE_STRING);

    $duration = (isset($_POST['duration']) ? $_POST['duration'] : null);
    $duration = filter_var($duration, FILTER_SANITIZE_STRING);

    $height_difference = (isset($_POST['height_difference']) ? $_POST['height_difference'] : null);
    $height_difference = filter_var($height_difference, FILTER_SANITIZE_NUMBER_INT);

    $sql ="select * from hiking where id = '$id'";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Ajouter une randonnée</title>
            <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
        </head>
        <body>
        <a href="read.php"><img src="tableauR.png" height="40" width="40" alt="Liste des randonnées"></a>
        <a href="logout.php"><img src="decoo.png" height="40" width="40" alt="Déconnexion"></a>
        <h1>Modifier</h1>
        <form class="form-style-9" action="" method="post">
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" value="<?= $row['name'] ?>">
            </div>

            <div>
                <label for="difficulty">Difficulté</label>
                <select name="difficulty">
                    <option selected="selected"> <?= $row['difficulty'] ?> </option>
                    <option value="tres facile">Tres facile</option>
                    <option value="facile">Facile</option>
                    <option value="moyen">Moyen</option>
                    <option value="difficile">Difficile</option>
                    <option value="tres difficile">Tres difficile</option>
                </select>
            </div>

            <div>
                <label for="distance">Distance</label>
                <input type="text" name="distance" value="<?= $row['distance'] ?>">
            </div>
            <div>
                <label for="duration">Durée</label>
                <input type="text" name="duration" value="<?= $row['duration'] ?>">
            </div>
            <div>
                <label for="height_difference">Dénivelé</label>
                <input type="text" name="height_difference" value="<?= $row['height_difference'] ?>">
            </div>
            <input type="submit" name="submit">
        </form>
        </body>
        </html>
        <?php
    }
}

affichage();


function Update(){

    GLOBAL $conn;

    $id = (isset($_GET['id']) ? $_GET['id'] : null);
    $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

    $name = (isset($_POST['name']) ? $_POST['name'] : null);
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $difficulty = (isset($_POST['difficulty']) ? $_POST['difficulty'] : null);
    $difficulty = filter_var($difficulty, FILTER_SANITIZE_STRING);

    $distance = (isset($_POST['distance']) ? $_POST['distance'] : null);
    $distance = filter_var($distance, FILTER_SANITIZE_STRING);

    $duration = (isset($_POST['duration']) ? $_POST['duration'] : null);
    $duration = filter_var($duration, FILTER_SANITIZE_STRING);

    $height_difference = (isset($_POST['height_difference']) ? $_POST['height_difference'] : null);
    $height_difference = filter_var($height_difference, FILTER_SANITIZE_NUMBER_INT);

    $sql = "UPDATE `hiking` 
                                set `name`='$name', `difficulty`='$difficulty' , `distance`= '$distance', `duration`= '$duration', `height_difference`= '$height_difference'
                                where id = '$id'";
    $conn->query($sql);


    if($name && $difficulty && $distance && $duration && $height_difference == true ){
        echo "Randonnée modifiée avec succès";
    }
}
Update();

