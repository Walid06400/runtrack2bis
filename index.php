<?php
require_once("User.php");

$user = new User();
$users = $user->getAllUsers();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des utilisateurs</title>
    <link rel="stylesheet" href="conexion.css">
</head>

<body>
    <div class="container">
        <h1>Liste des utilisateurs</h1>
        <?php if (isset($_GET['message']) && $_GET['message'] == 'success'): ?>
            <p>Inscription réussie !</p>
        <?php endif; ?>
        <table>
            <tr>
                <th>Login</th>
                <th>Email</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['login'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['firstname'] ?></td>
                    <td><?= $user['lastname'] ?></td>
                    <td>
                        <?php if (isset($user['id'])): ?>
                            <a href="update.php?id=<?= $user['id'] ?>">Modifier</a> |
                            <a href="profile.php?id=<?= $user['id'] ?>">Supprimer</a>
                        <?php else: ?>
                            <span>Aucune action</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="register.php">Ajouter un utilisateur</a>
    </div>
</body>

</html>