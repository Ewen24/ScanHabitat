<?php

//Pour afficher les erreurs PHP et serveur 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "postgres";
$password = "AdminImmo*";

try {
    //Connexion à la base de données PostgreSQL
    $bdd = pg_connect("host=$servername dbname=ScanHabitat user=$username password=$password");
    if (!$bdd) {
        echo "Erreur de connexion : " . pg_last_error() . "<br>";
        exit;
    } else {
        echo "Connexion réussie !<br>";
    }
} catch (Exception $e) {
    echo 'Exception reçue : ', $e->getMessage(), "<br>";
}

if (isset($_POST['ok'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $pseudo = $_POST['pseudo'];
    $mdp = $_POST['pass'];
    $email = $_POST['email'];
    echo 'bonjour';

    if (pg_connection_status($bdd) === PGSQL_CONNECTION_OK) {
        //Hach mot de passe
        $hashed_mdp = md5($mdp); 

        
        $sql = "INSERT INTO immo.utilisateur (pseudo, nom, prenom, mdp, email) VALUES ($1, $2, $3, $4, $5) RETURNING id"; // "immo.utilisateur = Nom_schéma . table POSTGRESQL 
        
        //Préparer la requête
        $prepare_result = pg_prepare($bdd, "my_query", $sql);
        if (!$prepare_result) {
            die('Erreur lors de la préparation de la requête: ' . pg_last_error($bdd));
        }

        //Exécuter la requête avec les valeurs du formulaire d'inscription 
        $result = pg_execute($bdd, "my_query", array($pseudo, $nom, $prenom, $hashed_mdp, $email));
        if ($result) {
            //Récupérer l'identifiant retourné
            $id = pg_fetch_result($result, 0, "id");
            echo 'Sauvegardé. ID: ' . $id;
        } else {
             
            die('Erreur lors de l\'insertion: ' . pg_last_error($bdd));
        }
    } else {
        die('Erreur de connexion');
    }
}

//Pour afficher les Erreur php et le serveur 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// $servername = "localhost";
// $username = "postgres";
// $password = "AdminImmo*";

// try{
//         $bdd = pg_connect("host=$servername dbname=ScanHabitat user=$username password=$password");
//         if (!$bdd) {
//             echo "Erreur de connexion : " . pg_last_error() . "<br>";
//             exit;
//         } else {
//             echo "Connexion réussie !<br>";
//         }
//     } catch (Exception $e) {
//         echo 'Exception reçue : ',  $e->getMessage(), "<br>";
//     }

// if(isset($_POST['ok'])){
//     $nom = $_POST['nom'];
//     $prenom =$_POST['prenom'];
//     $pseudo = $_POST['pseudo'];
//     $mdp = $_POST['pass'];
//     $email= $_POST['email'];
//     echo'bonjour';

//     if (pg_connection_status($bdd) === PGSQL_CONNECTION_OK) {
//         // Préparer la requête SQL avec des placeholders
//         $sql = "INSERT INTO immo.utilisateur (pseudo, nom, prenom, mdp, email) VALUES ($1, $2, $3, $4, $5) RETURNING id"; // "immo.utilisateur = Nom_schéma . table POSTGRESQL 
        
//         // Préparer la requête
//         $prepare_result = pg_prepare($bdd, "my_query", $sql);
//         if (!$prepare_result) {
//             die('Erreur lors de la préparation de la requête: ' . pg_last_error($bdd));
//         }
    
//         // Exécuter la requête avec les valeurs fournies
//         $result = pg_execute($bdd, "my_query", array($pseudo, $nom, $prenom, $mdp, $email));
//         if ($result) {
//             // Récupérer l'identifiant retourné
//             $id = pg_fetch_result($result, 0, "id");
//             echo 'Sauvegardé. ID: ' . $id;
//         } else {
//             // Gérer l'erreur
//             die('Erreur lors de l\'insertion: ' . pg_last_error($bdd));
//         }
//     } else {
//         die('Erreur de connexion');
//     }

// }
?>