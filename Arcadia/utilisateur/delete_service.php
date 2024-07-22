<?php
include(__DIR__ . '/../config.php');


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $bdd->prepare("DELETE FROM services where id = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header("Location: form_service.php");
        exit();
    } else {
        echo "Erreur lors de la suppression du service";
    }
}