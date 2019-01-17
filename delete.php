<?php
session_start();
/**** Supprimer une randonnée ****/
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reunion_island";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error)
{ die ("Connection failed: " . $conn->connect_error); }

else {
    $conn->select_db($dbname); }



$id = (isset($_GET['id']) ? $_GET['id'] : null);
$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

function supp(){

    GLOBAL $conn;
global $id;



    $sql=" DELETE from hiking where id = $id";

    $conn->query($sql);

    header("Location:read.php");


}
supp();


