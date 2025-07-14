<?php
    session_start();
    include('../inc/function.php');
    $id_user = $_SESSION['user_id'];
    $duree = $_GET['duree'];
    $date_debut = date('Y-m-d');
    $date_fin = date('Y-m-d', strtotime("+$duree days"));
    $id_object = $_GET['id_object'];
    $insert_emprunt = insert_emprunt($id_user, $id_object,$date_debut, $date_fin);

    header('Location: liste_objets.php?status=success');
?>