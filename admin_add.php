<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "postgres";
$password = "AdminImmo*";

$bdd = pg_connect("host=$servername dbname=ScanHabitat user=$username password=$password");
if (!$bdd) {
    echo "Erreur de connexion : " . pg_last_error() . "<br>";
    exit();
}

// Vérifiez si l'utilisateur est admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo "Accès refusé.";
    exit();
}

if (isset($_POST['ajouter'])) {
    $ville = pg_escape_string($bdd, $_POST['ville']);
    $type = pg_escape_string($bdd, $_POST['type']);
    $prix = pg_escape_string($bdd, $_POST['prix']);
    $surface = pg_escape_string($bdd, $_POST['surface']);

    // Traitement de l'image
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image_temp = $_FILES['image']['tmp_name'];
        $image_name = $_FILES['image']['name'];
        $image_size = getimagesize($image_temp);

        if ($image_size !== false) {
            // Définir le chemin pour enregistrer l'image
            $image_path = '/var/www/scanhabitat/images/' . basename($image_name);

            // Déplacer le fichier téléchargé vers le répertoire des images dans le serveur
            if (move_uploaded_file($image_temp, $image_path)) {
                // Enregistrement des informations du bien dans la base de données
                $sql = 'INSERT INTO immo.biens (ville, type, prix, surface, image_path) VALUES ($1, $2, $3, $4, $5)';
                $result = pg_query_params($bdd, $sql, array($ville, $type, $prix, $surface, $image_path));

                if ($result) {
                    echo "Le bien a été ajouté avec succès.";
                } else {
                    echo "Erreur lors de l'ajout du bien : " . pg_last_error($bdd);
                }
            } else {
                echo "Erreur lors du téléchargement de l'image.";
            }
        } else {
            echo "Le fichier téléchargé n'est pas une image valide.";
        }
    } else {
        echo "Veuillez télécharger une image.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un Bien</title>
    <link rel="stylesheet" href="test.css"
</head>
<body>
    <h1>Ajouter un Nouveau Bien</h1>
    <form action="admin_add.php" method="post" enctype="multipart/form-data">
        Ville: <input type="text" name="ville" required><br>
        Type: <input type="text" name="type" required><br>
        Prix: <input type="text" name="prix" required><br>
        Surface (m²): <input type="text" name="surface" required><br>
        Image: <input type="file" name="image" ><br>
        <input type="submit" name="ajouter" value="Ajouter">
    </form>
</body>
</html>
