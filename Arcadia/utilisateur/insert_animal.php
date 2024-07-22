<?php
include(__DIR__ . '/../config.php');

$message="";

if  (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = $_POST['prenom'];
    $race = $_POST['race'];
    $habitat = $_POST['habitat'];
    $image = $_FILES['image'];

    // Validation et sécurisation des données
    $prenom = htmlspecialchars_decode($prenom);
    $race = htmlspecialchars_decode($race);
    $habitat = intval($habitat);

    // Vérification de l'image
    if ($image['error'] == 0) {
        $imageName = basename($image['name']);
        $imagePath = "upload/" . $imageName;

        // Déplacer l'image dans le dossier 'uploads'
        if (move_uploaded_file($image['tmp_name'], $imagePath)) {
            // Préparer la requête d'insertion
            $stmt = $bdd->prepare("INSERT INTO animal (prenom, race, image, habitat_id) VALUES (:prenom, :race, :image, :habitat)");
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':race', $race);
            $stmt->bindParam(':image', $imageName);
            $stmt->bindParam(':habitat', $habitat);

            // Exécuter la requête
            if ($stmt->execute()) {
                $message= "L'animal a été ajouté avec succès.";
            } else {
            $message= "Erreur lors de l'ajout de l'animal.";
            }
        } else {
            $message= "Erreur lors du téléchargement de l'image.";
        }
    } else {
        $message= "Veuillez choisir une image.";
    }
}

