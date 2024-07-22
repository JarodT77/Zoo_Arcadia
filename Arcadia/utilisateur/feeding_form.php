<?php
include(__DIR__ . '/../config.php');

$message="";

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $animal_id = intval($_POST['animal_id']);
    $date = $_POST['date'];
    $nourriture = htmlspecialchars_decode($_POST['nourriture']);
    $quantite = intval($_POST['quantite']);

    $query = "INSERT INTO feeding (animal_id, date, nourriture, quantite) VALUES (:animal_id, :date, :nourriture, :quantite)";

    $stmt = $bdd->prepare($query);

    $stmt->bindParam(':animal_id', $animal_id);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':nourriture', $nourriture);
    $stmt->bindParam(':quantite', $quantite);

    if ($stmt->execute()) {
        $message = "L'alimentation a été enregistrée avec succès";
    } else {
        $message = "Erreur lors de l'enregistrement de l'alimentation";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrer Alimentation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Enregistrer Alimentation</h2>
    <?php if (!empty($message)): ?>
        <div class="alert alert-info"><?php echo $message; ?></div>
    <?php endif; ?>
    <form action="" method="post">
        <div class="mb-3">
            <label for="animal_id" class="form-label">Animal</label>
            <select class="form-select" id="animal_id" name="animal_id" required>
                <?php
                $stmt = $bdd->query("SELECT id, prenom FROM animal");
                while ($row = $stmt->fetch()) {
                    echo "<option value='" . $row['id'] . "'>" . htmlspecialchars_decode($row['prenom']) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="datetime-local" class="form-control" id="date" name="date" required>
        </div>
        <div class="mb-3">
            <label for="nourriture" class="form-label">Nourriture</label>
            <input type="text" class="form-control" id="nourriture" name="nourriture" required>
        </div>
        <div class="mb-3">
            <label for="quantite" class="form-label">Quantité</label>
            <input type="number" class="form-control" id="quantite" name="quantite" required>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
<h2 class="mt-5">Nourriuture données</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Animal</th>
                <th>Nourritures données</th>
                <th>Quantité en g</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        <?php
// Récupérer les animaux existant
$stmt = $bdd->query("SELECT f.id, f.date, f.nourriture, f.quantite, a.prenom AS animal FROM feeding f JOIN animal a ON f.animal_id = a.id");
while ($row = $stmt->fetch()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['animal']) . "</td>";
    echo "<td>" . htmlspecialchars($row['nourriture']) . "</td>";
    echo "<td>" . htmlspecialchars($row['quantite']) . "</td>";
    echo "<td>" . htmlspecialchars($row['date']) . "</td>";
    echo "</tr>";
}
?>

        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
