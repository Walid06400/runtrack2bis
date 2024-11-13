<?php
require_once("User.php");

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? "";
    $password = $_POST['password'] ?? "";
    $email = $_POST['email'] ?? "";
    $firstname = $_POST['firstname'] ?? "";
    $lastname = $_POST['lastname'] ?? "";

    $userCreated = $user->register($login, $password, $email, $firstname, $lastname);

    if ($userCreated) {
        header("Location: index.php?message=success");
        exit();
    } else {
        echo "Une erreur s'est produite lors de l'inscription.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="conexion.css">
</head>
<body>
    <div class="container">
        <h1>Inscription</h1>
        <form method="POST" action="register.php">
            <input type="text" name="login" placeholder="Login" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="firstname" placeholder="Firstname" required>
            <input type="text" name="lastname" placeholder="Lastname" required>
            <button type="submit">S'inscrire</button>
        </form>
        <a href="index.php">Retour à l'accueil</a>
    </div>
</body>
</html>
