<?php 
include('config.php');
$message="";

if($_SERVER["REQUEST_METHOD"] == "POST") {  
    $animal_id = intval($_POST['animal_id']);
    $detail = htmlspecialchars_decode($_POST['detail']);
    $date = $_POST['date'];

    $query = "INSERT INTO rapports_veterinaires (animal_id, detail, date) VALUES (:animal_id, :detail, :date)";
    $stmt = $bdd->prepare($query);

    $stmt->bindParam(':animal_id', $animal_id);
    $stmt->bindParam(':detail', $detail);
    $stmt->bindParam(':date', $date);

    if ($stmt->execute()) {
        $message= "Le compte rendu a été ajouté avec succès";
    } else {
        $message = "erreur lors de l'ajout du compte rendu";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapports veterinaires</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
        <h2 class="mt-5">Liste des rapport</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nom de l'animal</th>
                <th>Detail</th>
                <th>date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $bdd->query ("SELECT r.id, a.prenom AS animal_name, r.detail, r.date 
            FROM rapports_veterinaires r 
            JOIN animal a ON r.animal_id = a.id");
            while ($row = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars_decode($row['animal_name']) . "</td>";
                echo "<td>" . htmlspecialchars_decode($row['detail']) . "</td>";
                echo "<td>" . htmlspecialchars_decode($row['date']) . "</td>";
                echo "</tr>";
            }
            ?>''
        </tbody>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>