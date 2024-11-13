<?php
require_once("User.php");

$user = new User();
$id = $_GET['id'] ?? null;
$currentUser = $user->getUserById($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    $updated = $user->update($id, $login, $email, $firstname, $lastname);

    if ($updated) {
        header("Location: index.php?message=updated");
        exit();
    } else {
        echo "Erreur lors de la mise à jour.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'utilisateur</title>
    <link rel="stylesheet" href="conexion.css">
</head>
<body>
    <div class="container">
        <h1>Modifier l'utilisateur</h1>
        <form method="POST">
            <input type="text" name="login" value="<?= $currentUser['login'] ?>" required>
            <input type="email" name="email" value="<?= $currentUser['email'] ?>" required>
            <input type="text" name="firstname" value="<?= $currentUser['firstname'] ?>" required>
            <input type="text" name="lastname" value="<?= $currentUser['lastnamee'] ?>" required>
