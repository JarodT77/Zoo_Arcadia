<?php
include('config.php');
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
<h2 class="mt-5">Nourriuture données</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Animal</th>
                <th>Nourritures données</th>
                <th>Quantité en kg</th>
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