<?php
function sendEmail($to, $subject, $message) {
    // En-têtes de l'e-mail
    $headers = "From: matteo2004cours@gmail.com\r\n";
    $headers .= "Reply-To: contact@tonsite.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Envoi de l'e-mail
    if (mail($to, $subject, $message, $headers)) {
        echo "E-mail envoyé avec succès à $to!";
    } else {
        echo "Échec de l'envoi de l'e-mail.";
    }
}

// Informations de l'e-mail
$to = "cagnon.ewen@outlook.fr";
$subject = "Nouveautés sur notre site !";
$message = "Voici un nouveaux bien qui pourrait vous interessez";
<html>
<head>
    <title>Nouveautés sur notre site</title>
</head>
<body>
    <h1>Bonjour,</h1>
    <p>Nous avons des nouveautés sur notre site ! Venez les découvrir dès maintenant.</p>
    <p><a href='https://scanhabitat.quovadev.fr/'>Visitez notre site</a></p>
</body>
</html>
";

// Appel de la fonction pour envoyer l'e-mail
sendEmail($to, $subject, $message);
?>

<?php
// Exemple de script qui ajoute des nouveautés à ton site

// ... Code pour ajouter des nouveautés ...

// Vérifie si des nouveautés ont été ajoutées
$nouveaute_ajoutee = true; // Remplace par ta condition réelle

if ($nouveaute_ajoutee) {
    // Appel de la fonction pour envoyer l'e-mail
    $to = "adresse_destinataire@example.com";
    $subject = "Nouveautés sur notre site !";
    $message = "
    <html>
    <head>
        <title>Nouveautés sur notre site</title>
    </head>
    <body>
        <h1>Bonjour,</h1>
        <p>Nous avons des nouveautés sur notre site ! Venez les découvrir dès maintenant.</p>
        <p><a href='https://www.tonsite.com'>Visitez notre site</a></p>
    </body>
    </html>
    ";
    
    sendEmail($to, $subject, $message);
}
?>