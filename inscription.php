<!DOCTYPE html> 
<html lang="fr">
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width-device-width">
    <link rel="stylesheet" href="inscription.css"/>
    <title>Inscription</title>
</head>
<body>
    <form method="POST" action="traitement.php">
    <label for="nom">Votre nom </label>
    <input type="text" id="nom" name="nom" placeholder="Entrez votre nom" required>
    <br /> 
    <label for="prenom">Votre prénom </label>
    <input type="text" id="prenom" name="prenom" placeholder="Entrez votre prénom" required>
    <br /> 
    <label for="pseudo">Votre pseudo </label>
    <input type="text" id="pseudo" name="pseudo" placeholder="Entrez votre pseudo" required>
    <br />
    <label for="email">Votre email </label>
    <input type="email" id="email" name="email" placeholder="Entrez votre email" required>
    <br />  
    <label for="pass">Votre mot de passe </label>
    <input type="password" id="pass" name="pass" placeholder="Entrez votre mot de passe" required>
    <br /> 
    <input type="submit" value="m inscrire" name="ok">
    
    </form>
</body>