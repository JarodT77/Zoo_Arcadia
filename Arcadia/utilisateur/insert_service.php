<?php
include('config.php');
$message="";

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $service = $_POST['nom'];
    $discribe = $_POST['descrpition'];
    $image = $_FILES['image'];

    $service = htmlspecialchars_decode($service);
    $discribe = htmlspecialchars_decode($description);

    if ($image['error'] == 0) {
        $imageName = basename($image['name']);
        $imagePath = "upload/" . $imageName;

        if (move_uploaded_file($image['tmp_name'], $imagePath)) {
            $stmt = $bdd ->prepare("INSERT INTO services (nom, discribe, image) VALUES (:nom, :discribe, :image)");
            $stmt->bindParam(':nom', $service);
            $stmt->bindParam(':discribe', $discribe);
            $stmt->bindParam(':image', $image);

            if ($stmt->execute()) {
                $message= "Le service a été ajouté avec succès.";
            } else {
            $message= "Erreur lors de l'ajout du service.";
            }
        } else {
            $message= "Erreur lors du téléchargement de l'image.";
        }
    } else {
        $message= "Veuillez choisir une image.";
    }
}
    