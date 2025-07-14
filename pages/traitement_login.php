<?php
session_start();
include('../inc/function.php');

$conn = dbconnect();
if (!$conn) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

?>