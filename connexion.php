<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "postgres";
$password = "AdminImmo*";

// Vérifie si le formulaire est soumis
if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') {
    if (isset($_POST['pseudo']) && !empty($_POST['pseudo']) && isset($_POST['pass']) && !empty($_POST['pass'])) {
        $bdd = pg_connect("host=$servername dbname=ScanHabitat user=$username password=$password");
        if (!$bdd) {
            echo "Erreur de connexion : " . pg_last_error() . "<br>";
            exit();
        }

        // Préparation de la requête pour éviter les injections SQL
        $pseudo = pg_escape_string($_POST['pseudo']);
        $pass = pg_escape_string($_POST['pass']);

        // Hashage du mot de passe
        $hashed_pass = md5($pass); // Assurez-vous d'utiliser le même algorithme de hachage que lors de l'inscription

        $sql = 'SELECT * FROM immo.utilisateur WHERE pseudo=$1 AND mdp=$2';
        $result = pg_query_params($bdd, $sql, array($pseudo, $hashed_pass));

        if ($result) {
            $data = pg_fetch_assoc($result);
            if ($data) {
                // Mot de passe correct, démarrer la session
                $_SESSION['user_id'] = $data['id'];
                $_SESSION['pseudo'] = $data['pseudo'];
                $_SESSION['nom'] = $data['nom'];
                $_SESSION['prenom'] = $data['prenom'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['role'] = $data['role'];

                // Redirection en fonction du rôle de l'utilisateur
                if ($data['role'] == 'admin') {
                    header('Location: admin_gestion.php');
                } else {
                    header('Location: espace_membre.php');
                }
                exit();
            } else {
                $erreur = 'Pseudo ou mot de passe non reconnu ! ';
                echo $erreur;
                echo "<br/><a href=\"acceuil.php\">Acceuil</a>";
                exit();
            }
        } else {
            echo "Une erreur est survenue.\n";
            exit();
        }
    } else {
        $erreur = 'Erreur de saisie ! Au moins un des champs est vide ! ';
        echo $erreur;
        echo "<br/><a href=\"acceuil.php\">Acceuil</a>";
        exit();
    }
}

// include ("connect.php");
// $servername = "localhost";
// $username = "postgres";
// $password = "AdminImmo*";

// //Vérifie si le formulaire est bien envoyé
// if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') {
//     //echo 'bonjour';

//     //Vérifie si les input pseudo et mot de passe sont remplis
//     if (isset($_POST['pseudo']) && !empty($_POST['pseudo']) && isset($_POST['pass']) && !empty($_POST['pass'])) {
//        // echo 'bonjour2 <br>';

//         //Connexion à la base de données
//         $bdd = pg_connect("host=$servername dbname=ScanHabitat user=$username password=$password");

//         // if (!$bdd) {
//         //     echo "LA CONNEXION A ECHOUEE !!!!\n";
//         //     exit();
//         // } else {
//         //     echo 'Connexion réussie !';
//         // }

//         //Préparation de la requête pour éviter les injections SQL !!!!!!
//         $pseudo = pg_escape_string($_POST['pseudo']);
//         $pass = pg_escape_string($_POST['pass']);

//         // Hashage du mot de passe
//         $hashed_pass = md5($pass); // Il faut avoir le meme algo de hash que dans l'inscrip

//         $sql = 'SELECT count(*) FROM immo.utilisateur WHERE pseudo=$1 AND mdp=$2';
//         $result = pg_query_params($bdd, $sql, array($pseudo, $hashed_pass));

//         if (!$result) {
//             echo "Une erreur est survenue.\n";
//             exit();
//         }

//         $data = pg_fetch_result($result, 0, 0);
//         pg_free_result($result);
//         pg_close($bdd);

//         //Vérification des résultats 
//         if ($data == 1) {
//             session_start();
//             $_SESSION['pseudo'] = $pseudo;
//             header('Location: espace_membre.php');
//             exit();
//         } elseif ($data == 0) {
//             $erreur = 'Pseudo ou mot de passe non reconnu ! ';
//             echo $erreur;
//             echo "<br/><a href=\"acceuil.php\">Acceuil</a>";
//             exit();
//         } else {
//             $erreur = 'Plusieurs membres ont les mêmes pseudo et mot de passe';
//             echo $erreur;
//             echo "<br/><a href=\"acceuil.php\">Acceuil</a>";
//             exit();
//         }
//     } else {
//         $erreur = 'Erreur de saisie ! Au moins un des champs est vide ! ';
//         echo $erreur;
//         echo "<br/><a href=\"acceuil.php\">Acceuil</a>";
//         exit();
//     }
// }
?>
