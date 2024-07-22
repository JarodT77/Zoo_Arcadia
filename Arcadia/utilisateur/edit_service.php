<?php
include(__DIR__ . '/../config.php');


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $bdd->prepare("SELECT * FROM services WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $service = $stmt->fetch();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Modifier un service</h2>
    <form action="update_service.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars_decode($service['id']); ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Nom du service</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars_decode($service['nom']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="discribe" class="form-label">Description du service</label>
            <input type="text" class="form-control" id="discribe" name="discribe" value="<?php echo htmlspecialchars_decode($service['discribe']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image du service</label>
            <input type="file" class="form-control" id="image" name="image">
            <img src="upload/<?php echo htmlspecialchars_decode($service['image']); ?>" alt="<?php echo htmlspecialchars_decode($service['nom']); ?>" width="100" class="mt-2">
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
