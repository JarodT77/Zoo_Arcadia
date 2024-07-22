<?php
include(__DIR__ . '/../config.php');


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $bdd->prepare("SELECT * FROM habitats WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $habitat = $stmt->fetch();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un habitat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Modifier un habitat</h2>
    <form action="update_habitat.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars_decode($habitat['id']); ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Nom de l'habitat</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars_decode($habitat['nom']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="race" class="form-label">Description de l'habitat</label>
            <input type="text" class="form-control" id="discribe" name="discribe" value="<?php echo htmlspecialchars_decode($habitat['discribe']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image de l'habitat</label>
            <input type="file" class="form-control" id="image" name="image">
            <img src="upload/<?php echo htmlspecialchars_decode($habitat['image']); ?>" alt="<?php echo htmlspecialchars_decode($habitat['nom']); ?>" width="100" class="mt-2">
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
