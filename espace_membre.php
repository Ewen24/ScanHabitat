<?php
// session_start();
// if (!isset($_SESSION['pseudo'])) {
//     header('Location : index.php');exit();
//     }
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$pseudo = $_SESSION['pseudo'];
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Membre</title>
</head>
<body>
    <h1>Bienvenue, <?php echo htmlspecialchars($prenom) . ' ' . htmlspecialchars($nom); ?>!</h1>
    <p>Votre pseudo : <?php echo htmlspecialchars($pseudo); ?></p>
    <p>Votre email : <?php echo htmlspecialchars($email); ?></p>
    <p><a href="deconnexion.php">Déconnexion</a></p>
</body>
</html>



<!-- <html>
    <head>
        <meta http-equiv="Content-Type" content="test/html; charset=UTF-8" />
        <title>Espace Client</title>
        <meta name ="robots" content="noindex, nofollow">
    </head>
    <body>
        <p><strong>ESPACE CLIENTS</strong><br/>
        Bienvenue <?php echo htmlentities(trim($_SESSION['pseudo'])); ?> !<br/>
        <a href="deconnexion.php">Déconnexion</a> 
        </p>
    </body>
</html> -->


