<?php
include('config.php');
$message="";

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = $_POST['prenom'];
    $race = $_POST['race'];
    $habitat = $_POST['habitat'];
    $image = $_FILES['image'];

    // Validation et sécurisation des données
    $prenom = htmlspecialchars_decode($prenom);
    $race = htmlspecialchars_decode($race);
    $habitat = intval($habitat);

    // Vérification de l'image
    if ($image['error'] == 0) {
        $imageName = basename($image['name']);
        $imagePath = "upload/" . $imageName;

        // Vérifiez si le répertoire d'upload existe, sinon le créer

        // Déplacer l'image dans le dossier 'upload'
        if (move_uploaded_file($image['tmp_name'], $imagePath)) {
            // Préparer la requête d'insertion
            $stmt = $bdd->prepare("INSERT INTO animal (prenom, race, image, habitat_id) VALUES (:prenom, :race, :image, :habitat)");
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':race', $race);
            $stmt->bindParam(':image', $imageName);
            $stmt->bindParam(':habitat', $habitat);

            // Exécuter la requête
            if ($stmt->execute()) {
                $message = "L'animal a été ajouté avec succès.";
            } else {
                $message = "Erreur lors de l'ajout de l'animal.";
            }
        } else {
            $message = "Erreur lors du téléchargement de l'image.";
        }
    } else {
        $message = "Veuillez choisir une image.";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Animal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Ajouter un Animal</h2>
    <?php if ($message != ""): ?> 
        <div class="alert alert-info">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom de l'animal</label>
            <input type="text" class="form-control" id="prenom" name="prenom" required>
        </div>
        <div class="mb-3">
            <label for="race" class="form-label">Race de l'animal</label>
            <input type="text" class="form-control" id="race" name="race" required>
        </div>
        <div class="mb-3">
            <label for="habitat" class="form-label">Habitat de l'animal</label>
            <select class="form-select" id="habitat" name="habitat" required>
                <?php
                // Connexion à la base de données
                include('config.php');
                $stmt = $bdd->query("SELECT id, nom FROM habitats");
                while ($row = $stmt->fetch()) {
                    echo "<option value='" . htmlspecialchars_decode($row['id']) . "'>" . htmlspecialchars_decode($row['nom']) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image de l'animal</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
    <h2 class="mt-5">Liste des Animaux</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Race</th>
                <th>Image</th>
                <th>Habitat</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Récupérer les animaux existants
            $stmt = $bdd->query("SELECT a.id, a.prenom, a.race, a.image, h.nom AS habitat FROM animal a JOIN habitats h ON a.habitat_id = h.id");
            while ($row = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars_decode($row['prenom']) . "</td>";
                echo "<td>" . htmlspecialchars_decode($row['race']) . "</td>";
                echo "<td><img src='upload/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['prenom']) . "' width='100'></td>";
                echo "<td>" . htmlspecialchars_decode($row['habitat']) . "</td>";
                echo "<td>";
                echo "<a href='edit_animal.php?id=" . htmlspecialchars_decode($row['id']) . "' class='btn btn-warning btn-sm'>Modifier</a> ";
                echo "<a href='delete_animal.php?id=" . htmlspecialchars_decode($row['id']) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cet animal ?\");'>Supprimer</a>";
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
