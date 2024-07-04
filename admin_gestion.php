<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Vérifier si l'utilisateur est connecté et si administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord administrateur</title>
</head>
<body>
    <h1>Tableau de bord administrateur</h1>
    <nav>
        <ul>
            <li><a href="admin_add.php">Ajouter un nouveau bien</a></li>
            <li><a href="admin_view_properties.php">Voir tous les biens</a></li>
            <li><a href="admin_manage_users.php">Gérer les utilisateurs</a></li>
            <li><a href="deconnexion.php">Déconnexion</a></li>
        </ul>
    </nav>

    <!-- <section>
        <h2>Statistiques</h2>
        <p>Nombre de biens immobiliers: <?php echo get_property_count(); ?></p>
        <p>Nombre d'utilisateurs: <?php echo get_user_count(); ?></p>
        <!-- Ajoutez d'autres statistiques pertinentes ici -->
    </section> -->
</body>
</html>

<?php
// Fonctions pour récupérer les statistiques
function get_property_count() {
    global $servername, $username, $password;
    $bdd = pg_connect("host=$servername dbname=ScanHabitat user=$username password=$password");
    if (!$bdd) {
        echo "Erreur de connexion : " . pg_last_error() . "<br>";
        exit;
    }
    $result = pg_query($bdd, "SELECT COUNT(*) AS count FROM immo.biens");
    if ($result) {
        $row = pg_fetch_assoc($result);
        pg_close($bdd);
        return $row['count'];
    } else {
        pg_close($bdd);
        return 0;
    }
}

function get_user_count() {
    global $servername, $username, $password;
    $bdd = pg_connect("host=$servername dbname=ScanHabitat user=$username password=$password");
    if (!$bdd) {
        echo "Erreur de connexion : " . pg_last_error() . "<br>";
        exit;
    }
    $result = pg_query($bdd, "SELECT COUNT(*) AS count FROM immo.utilisateur");
    if ($result) {
        $row = pg_fetch_assoc($result);
        pg_close($bdd);
        return $row['count'];
    } else {
        pg_close($bdd);
        return 0;
    }
}
?>
