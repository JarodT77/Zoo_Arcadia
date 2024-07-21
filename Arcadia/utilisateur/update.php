<?php
include('config.php');

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $prenom = htmlspecialchars_decode($_POST['prenom']);
    $race = htmlspecialchars_decode($_POST['race']);
    $habitat = intval($_POST['habitat']);
    $image = $_FILES['image'];

    // Préparer la requête d'update
    $query = "UPDATE animal SET prenom = :prenom, race = :race, habitat_id = :habitat";
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
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':race', $race);
    $stmt->bindParam(':habitat', $habitat);
    if (isset($imageName)) {
        $stmt->bindParam(':image', $imageName);
    }

    if ($stmt->execute()) {
        header("Location: ../arcadia/interface.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour de l'animal.";
    }
}

