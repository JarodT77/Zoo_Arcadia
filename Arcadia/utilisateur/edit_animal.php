<?php
include(__DIR__ . '/../config.php');


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $bdd->prepare("SELECT * FROM animal WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $animal = $stmt->fetch();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Animal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Modifier un Animal</h2>
    <form action="update_animal.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars_decode($animal['id']); ?>">
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom de l'animal</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo htmlspecialchars_decode($animal['prenom']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="race" class="form-label">Race de l'animal</label>
            <input type="text" class="form-control" id="race" name="race" value="<?php echo htmlspecialchars_decode($animal['race']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="habitat" class="form-label">Habitat de l'animal</label>
            <select class="form-select" id="habitat" name="habitat" required>
                <?php
                $stmt = $bdd->query("SELECT id, nom FROM habitats");
                while ($row = $stmt->fetch()) {
                    $selected = $row['id'] == $animal['habitat_id'] ? 'selected' : '';
                    echo "<option value='" . htmlspecialchars_decode($row['id']) . "' $selected>" . htmlspecialchars_decode($row['nom']) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image de l'animal</label>
            <input type="file" class="form-control" id="image" name="image">
            <img src="upload/<?php echo htmlspecialchars_decode($animal['image']); ?>" alt="<?php echo htmlspecialchars_decode($animal['prenom']); ?>" width="100" class="mt-2">
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
