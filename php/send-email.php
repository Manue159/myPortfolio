<?php
// Adresse email où vous voulez recevoir les messages
$to = 'manuegn145@gmail.com';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer et valider les données du formulaire
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    // Vérification des champs requis
    if (!$name || !$email || !$message) {
        echo "Tous les champs sont requis.";
        exit;
    }

    // Format du message
    $emailMessage = "
        <html>
        <head>
            <title>Mail from contact form</title>
        </head>
        <body>
            <p><strong>Nom :</strong> $name</p>
            <p><strong>Email :</strong> $email</p>
            <p><strong>Message :</strong></p>
            <p>" . nl2br($message) . "</p>
        </body>
        </html>
    ";

    // Headers pour l'email
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Envoi de l'email
    if (mail($to, $emailMessage, $headers)) {
        echo "Votre message a été envoyé avec succès.";
    } else {
        echo "Une erreur s'est produite lors de l'envoi du message. Veuillez réessayer.";
    }
}
?>
