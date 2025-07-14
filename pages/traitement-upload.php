<?php
session_start();
include('../inc/function.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_FILES['fichier'])) {
    header('Location: upload.php?error=1');
    exit;
}

$id_objet = isset($_GET['id_object']) ? intval($_GET['id_object']) : 0;
if ($id_objet <= 0) {
    header('Location: liste_objets.php?error=2');
    exit;
}

$conn = dbconnect();
$result = mysqli_query($conn, "SELECT id_membre FROM objet WHERE id_object = $id_objet");
$objet = mysqli_fetch_assoc($result);

if (!$objet || $objet['id_membre'] != $_SESSION['user_id']) {
    header('Location: liste_objets.php?error=3');
    exit;
}

$uploadDir = '../assets/uploads/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$file = $_FILES['fichier'];
$maxSize = 10 * 1024 * 1024;
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

if ($file['error'] !== UPLOAD_ERR_OK) {
    header('Location: upload.php?id_object='.$id_objet.'&error=4');
    exit;
}

if ($file['size'] > $maxSize) {
    header('Location: upload.php?id_object='.$id_objet.'&error=5');
    exit;
}

$mime = mime_content_type($file['tmp_name']);
if (!in_array($mime, $allowedTypes)) {
    header('Location: upload.php?id_object='.$id_objet.'&error=6');
    exit;
}

$extension = pathinfo($file['name'], PATHINFO_EXTENSION);
$newName = 'img_'.time().'_'.uniqid().'.'.$extension;

if (move_uploaded_file($file['tmp_name'], $uploadDir.$newName)) {
    if (insertimage($id_objet, $newName)) {
        header('Location: upload.php?id_object='.$id_objet.'&success=1');
    } else {
        unlink($uploadDir.$newName);
        header('Location: upload.php?id_object='.$id_objet.'&error=7');
    }
} else {
    header('Location: upload.php?id_object='.$id_objet.'&error=8');
}
?>