<?php
include(__DIR__ . '/../config.php');

$message="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $habitat = $_POST['habitat'];
    $discribe = $_POST['discribe'];
    $image = $_FILES['image'];

    // Validation et sécurisation des données
    $habitat = htmlspecialchars_decode($habitat);
    $discribe = htmlspecialchars_decode($discribe);

    if ($image['error'] == 0) {
        $imageName = basename($image['name']);
        $imagePath = "upload/" . $imageName;


        if (move_uploaded_file($image['tmp_name'], $imagePath)) {
            // Préparer la requête d'insertion
            $stmt = $bdd->prepare("INSERT INTO habitats (nom, discribe, image) VALUES (:nom, :discribe, :image)");
            $stmt->bindParam(':nom', $habitat);
            $stmt->bindParam(':discribe', $discribe);
            $stmt->bindParam(':image', $imageName);

            // Exécuter la requête
            if ($stmt->execute()) {
                $message= "L'habitat a été ajouté avec succès.";
            } else {
                $message= "Erreur lors de l'ajout de l'habitat.";
            }
        } else {
            $message= "Erreur lors du téléchargement de l'image.";
        }
    } else {
        $message= "Veuillez choisir une image.";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Habitat</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Ajouter habitat</h2>
    <?php if ($message != ""): ?> 
            <div class="alert alert-info">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="habitat" class="form-label">nom de l'habitat</label>
            <input type="text" class="form-control" id="habitat" name="habitat" required>
        </div>
        <div class="mb-3">
            <label for="discribe" class="form-label">description de l'habitat</label>
            <input type="text" class="form-control" id="discribe" name="discribe" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image de l'habitat</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
    <h2 class="mt-5">Liste des habitats</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nom habitat</th>
                <th>Description</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Récupérer les animaux existants
            $stmt = $bdd->query("SELECT h.id, h.nom, h.discribe, h.image FROM habitats h");
            while ($row = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars_decode($row['nom']) . "</td>";
                echo "<td>" . htmlspecialchars_decode($row['discribe']) . "</td>";
                echo "<td><img src='upload/" . htmlspecialchars_decode($row['image']) . "' alt='" . htmlspecialchars_decode($row['nom']) . "' width='100'></td>";
                echo "<td>";
                echo "<a href='edit_habitat.php?id=" . htmlspecialchars_decode($row['id']) . "' class='btn btn-warning btn-sm'>Modifier</a> ";
                echo "<a href='delete_habitat.php?id=" . htmlspecialchars_decode($row['id']) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cet habitat ?\");'>Supprimer</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>