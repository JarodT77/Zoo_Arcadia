<?php
include('config.php');

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER['REQUEST_METHOD'] == "POST") {
    $id = intval($_POST['id']);
    $nom = htmlspecialchars_decode($_POST['nom']);
    $discribe = htmlspecialchars_decode($_POST['discribe']);
    $image = $_FILES['image'];

    $query = "UPDATE services SET nom = :nom, discribe = :discribe";

    if ($image['error'] == 0) {
        $imageName = basename($image['name']);
        $imagePath = "upload/" . $imageName;

        if (move_uploaded_file($image['tmp_name'], $imagePath)) {
            $query .= ", image = :image";
        }
    }

    $query .= " WHERE id = :id";

    $stmt = $bdd->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':discribe', $discribe);

    if (isset($imageName)) {
        $stmt->bindParam(':image', $imageName);
    }

    if ($stmt->execute()) {
        header("Location: form_service.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour du service";
    }
}