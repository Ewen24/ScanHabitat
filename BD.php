<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "postgres";
$password = "AdminImmo*";
$dbname = "ScanHabitat";

// Connexion à la base de données PostgreSQL
$bdd = pg_connect("host=$servername dbname=$dbname user=$username password=$password");
if (!$bdd) {
    die("Erreur de connexion : " . pg_last_error());
}

// Récupération des données du formulaire
$ville = isset($_POST['ville']) ? $_POST['ville'] : '';
$prix_min = isset($_POST['prix_min']) ? (int)$_POST['prix_min'] : 0;
$prix_max = isset($_POST['prix_max']) ? (int)$_POST['prix_max'] : PHP_INT_MAX;
$surface_min = isset($_POST['surface_min']) ? (int)$_POST['surface_min'] : 0;
$surface_max = isset($_POST['surface_max']) ? (int)$_POST['surface_max'] : PHP_INT_MAX;

// Construction de la requête SQL
$sql = "SELECT * FROM immo.biens WHERE 1=1";

if (!empty($ville)) {
    $sql .= " AND ville = '" . pg_escape_string($ville) . "'";
}

if ($prix_min > 0 || $prix_max < PHP_INT_MAX) {
    $sql .= " AND prix BETWEEN $prix_min AND $prix_max";
}

if ($surface_min > 0 || $surface_max < PHP_INT_MAX) {
    $sql .= " AND surface BETWEEN $surface_min AND $surface_max";
}

// Exécution de la requête SQL
$result = pg_query($bdd, $sql);

if (!$result) {
    echo "Erreur dans la requête : " . pg_last_error();
    pg_close($bdd);
    exit;
}

// Affichage des résultats
echo "<h2>Résultats de la recherche</h2>";
if (pg_num_rows($result) > 0) {
    while ($row = pg_fetch_assoc($result)) {
        echo "Ville: " . htmlspecialchars($row['ville']) . "<br>";
        echo "Prix: " . htmlspecialchars($row['prix']) . " €<br>";
        echo "Surface: " . htmlspecialchars($row['surface']) . " m²<br>";
        echo "<hr>";
    }
} else {
    echo "Aucune annonce trouvée.";
}

pg_close($bdd);
?>

