<?php
include(__DIR__ . '/../config.php');

$message="";

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $habitat = $_POST['nom'];
    $discribe = $_POST['discribe'];
    $image = $_FILES['image'];

    $habitat = htmlspecialchars_decode($habitat);
    $discribe = htmlspecialchars_decode($discribe);

    if ($image['error'] == 0) {
        $imageName = basename($image['name']);
        $imagePath = "upload/" . $imageName;

        if (move_uploaded_file($image['tmp_name'], $imagePath)) {
            $stmt = $bdd ->prepare("INSERT INTO habitats (nom, discribe, image) VALUES (:nom, :discribe, :image)");
            $stmt->bindParam(':nom', $habitat);
            $stmt->bindParam(':discribe', $discribe);
            $stmt->bindParam(':image', $image);

            if ($stmt->execute()) {
                $message= "L'habitat a été ajouté avec succès.";
            } else {
            $message= "Erreur lors de l'ajout de l'habitat.";
            }
        } else {
            $message= "Erreur lors du téléchargement de l'image.";
        }
    } else {
        $message= "Veuillez choisir une image.";
    }
}
    


