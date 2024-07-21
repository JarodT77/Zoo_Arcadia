<?php
include('header.html');
?>
<body>
<div class="container mt-5">
    <h2>Contactez-nous</h2>
<?php
// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez l'existence des indices avant de les utiliser
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';

    // Vérifiez que tous les champs sont remplis
    if (!empty($title) && !empty($email) && !empty($description)) {
        $description = "Titre : " . $title . "\n" . "Email : " . $email . "\n" . "Description : " . $description;

        // Créez une instance de PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Configuration du serveur
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'jarod.arcadiazoo@gmail.com';
            $mail->Password   = 'fthbfdwygxvgtqjr';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            // Destinataires
            $mail->setFrom('from@example.com', 'Arcadia');
            $mail->addAddress('jarod.arcadiazoo@gmail.com');

            // Contenu
            $mail->isHTML(true);
            $mail->Subject = 'Demande de contact';
            $mail->Body    = nl2br($description);
            $mail->AltBody = $description;

            // Envoi de l'email
            $mail->send();
            echo '<div class="alert alert-success" role="alert">Message bien envoyé</div>';
        } catch (Exception $e) {
            echo '<div class="alert alert-danger" role="alert">Message non envoyé. Mailer Error: ' . $mail->ErrorInfo . '</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Veuillez remplir tous les champs du formulaire.</div>';
    }
} 
?>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control large-textarea" id="description" name="description" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Votre Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>
<footer class="mt-5">
  <div class="container">
  <h1 class="font-yellow">horaire d'ouverture</h1>
  <p>Lundi-dimanche: 10h-19h</p>

  </div>
 
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
