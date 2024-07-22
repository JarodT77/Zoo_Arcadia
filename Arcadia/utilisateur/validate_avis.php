<?php
include(__DIR__ . '/../config.php');


// Validation de l'avis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['validate'])) {
    $id = intval($_POST['id']);
    $query = "UPDATE avis SET isVisible = 1 WHERE id = :id";
    $stmt = $bdd->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valider les Avis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Valider les Avis</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        $stmt = $bdd->query("SELECT id, pseudo, commentaire FROM avis WHERE isVisible = 0");
        while ($row = $stmt->fetch()) {
            echo '<div class="col">';
            echo '<div class="card h-100">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . htmlspecialchars_decode($row['pseudo']) . '</h5>';
            echo '<p class="card-text">' . htmlspecialchars_decode($row['commentaire']) . '</p>';
            echo '<form action="validate_avis.php" method="post">';
            echo '<input type="hidden" name="id" value="' . htmlspecialchars($row['id']) . '">';
            echo '<button type="submit" name="validate" class="btn btn-primary">Valider</button>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
    <a href="../interface.html" class="btn btn-secondary mt-3">Retour menu</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
