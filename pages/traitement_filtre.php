<?php
    include('../inc/function.php');

    if (isset($_GET['id_categorie'])) {
        $id_categorie = $_GET['id_categorie'];
        $resultat_filtre = filtre_categorie($id_categorie);
        header('Location: Filtres.php');
        exit();
    } else {
        echo "Error";
    }
?>