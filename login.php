<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reunion_island";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error)
{ die ("Connection failed: " . $conn->connect_error); }

else {
    $conn->select_db($dbname); }


$login_valide="";
$pwd_valide="";


$username = (isset($_GET['username']) ? $_GET['username'] : null);
$username = filter_var($username, FILTER_SANITIZE_STRING);

$mdp = (isset($_POST['password']) ? $_POST['password'] : null);
$mdp = filter_var($mdp, FILTER_SANITIZE_STRING);
$mdp= sha1($mdp);





$sql="SELECT * FROM `user` ";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {

    $login_valide = $row['username'];
    $pwd_valide = $row['password'];

    if (isset($_POST['username']) && isset($_POST['password'])) {

        if ($login_valide == $_POST['username'] && $pwd_valide == sha1($_POST['password'])) {

            session_start();
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['password'] = $_POST['password'];

            header('location:read.php');

        }
        if ($_POST['username'] != $login_valide && $_POST['password'] != $pwd_valide) {

            echo "Login ou Mot de passe incorrect";
        }
    }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>

    <form class="form-style-9" action="" method="post">
      <div>
        <label for="username">Identifiant</label>
        <input type="text" name="username">
      </div>
      <div>
        <label for="password">Mot de passe </label>
        <input type="password" name="password">
      </div>
      <div>
        <input type="submit" value="connexion">
      </div>
    </form>
  </body>
</html>
