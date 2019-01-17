<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reunion_island";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error)
{ die ("Connection failed: " . $conn->connect_error); }

else {
    $conn->select_db($dbname); }

$sql="SELECT * FROM hiking";
GLOBAL $conn;
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Randonnées</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
  <a href="create.php"><img src="rando.png" height="40" width="40" alt="ajouter randonner"></a>
  <a href="logout.php"><img src="decoo.png" height="40" width="40" alt="Déconnexion"></a>
    <h1>Liste des randonnées</h1>
    <table>
      <!-- Afficher la liste des randonnées -->
        <tr>

            <th>Supprimer/Ajouter</th>

            <th>Name</th>

            <th>Difficulty</th>

            <th>Distance(km)</th>

            <th>Duration</th>

            <th>Height Difference(m)</th>


        </tr>

        <?php
        //On affiche les lignes du tableau une à une à l'aide d'une boucle
        while($donnees = $result->fetch_assoc())
        {$val = $donnees['id'];
               ?>
                <tr>
                    <td><a href="delete.php?id=<?= $val ?>"><img src="supprimer.png" height="40" width="40" alt="Supprimer"></a> <a href="update.php?id=<?php echo $donnees['id']?>"><img src="modifier.png" height="40" width="40" alt="Modifier"></a></td>
                    <td><?=  $donnees['name'] ?> </td>
                    <td><?=  $donnees['difficulty'] ?></td>
                    <td><?=  $donnees['distance'] ?></td>
                    <td><?=  $donnees['duration']  ?></td>
                    <td><?=  $donnees['height_difference'] ?></td>
                </tr>
<?php
            }
        ?>
    </table>
  </body>
</html>

