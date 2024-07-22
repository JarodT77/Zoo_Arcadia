<?php
include(__DIR__ . '/../config.php');


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    try {
        // Démarrer une transaction
        $bdd->beginTransaction();

        // Supprimer les références dans `rapports_veterinaires`
        $stmt = $bdd->prepare("
            DELETE FROM rapports_veterinaires 
            WHERE animal_id IN (SELECT id FROM animal WHERE habitat_id = :id)
        ");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Supprimer les références dans `feeding`
        $stmt = $bdd->prepare("
            DELETE FROM feeding 
            WHERE animal_id IN (SELECT id FROM animal WHERE habitat_id = :id)
        ");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Supprimer les animaux associés à cet habitat
        $stmt = $bdd->prepare("
            DELETE FROM animal 
            WHERE habitat_id = :id
        ");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Supprimer l'habitat
        $stmt = $bdd->prepare("
            DELETE FROM habitats 
            WHERE id = :id
        ");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Valider la transaction
        $bdd->commit();

        // Rediriger vers l'interface après suppression
        header("Location: form_habitat.php");
        exit();
    } catch (Exception $e) {
        // Annuler la transaction en cas d'erreur
        $bdd->rollBack();
        echo "Erreur lors de la suppression de l'habitat: " . $e->getMessage();
    }
} else {
    echo "ID de l'habitat non spécifié.";
}
?>

