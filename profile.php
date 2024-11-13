<?php
require_once("User.php");
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['id'];
$infos = $user->getAllInfos();
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';
    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';

    if ($user->update($login, $password, $email, $firstname, $lastname)) {
        $message = "Mise à jour réussie.";
        $infos = $user->getAllInfos();
    } else {
        $message = "Erreur lors de la mise à jour.";
    }
}

if (isset($_POST['delete'])) {
    if ($user->delete()) {
        header("Location: index.php");
        exit();
    } else {
        $message = "Erreur lors de la suppression.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="conexion.css">
    <title>Profil</title>
</head>
<body>
    <div class="container">
        <h2>Mon Profil</h2>
        <?php if ($message): ?>
            <p class="message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
        <form method="POST" action="profile.php">
            <input type="text" name="login" value="<?= htmlspecialchars($infos['login']) ?>" required>
            <input type="password" name="password" placeholder="Nouveau mot de passe">
            <input type="email" name="email" value="<?= htmlspecialchars($infos['email']) ?>" required>
            <input type="text" name="firstname" value="<?= htmlspecialchars($infos['firstname']) ?>" required>
            <input type="text" name="lastname" value="<?= htmlspecialchars($infos['lastname']) ?>" required>
            <button type="submit">Mettre à jour</button>
        </form>
        <form method="POST" action="profile.php">
            <button type="submit" name="delete">Supprimer le compte</button>
        </form>
        <a href="index.php">Retour à l'accueil</a>
    </div>
</body>
</html>
