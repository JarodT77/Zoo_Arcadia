<?php
include(__DIR__ . '/../config.php');


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    try {
        // Démarrer une transaction
        $bdd->beginTransaction();

        // Supprimer les références dans la table `feeding`
        $stmt = $bdd->prepare("DELETE FROM feeding WHERE animal_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Supprimer les références dans la table `rapports_veterinaires`
        $stmt = $bdd->prepare("DELETE FROM rapports_veterinaires WHERE animal_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Supprimer l'animal de la table `animal`
        $stmt = $bdd->prepare("DELETE FROM animal WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Valider la transaction
        $bdd->commit();

        // Rediriger vers l'interface après suppression
        header("Location: form_animal.php");
        exit();
    } catch (Exception $e) {
        // Annuler la transaction en cas d'erreur
        $bdd->rollBack();
        echo "Erreur lors de la suppression de l'animal: " . $e->getMessage();
    }
} else {
    echo "ID de l'animal non spécifié.";
}
?>
