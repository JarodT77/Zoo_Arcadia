<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>??h1?Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
    <?php
require 'vendor/autoload.php'; // Inclure Composer autoload

use MongoDB\Client;

// Configuration MongoDB
$mongoClient = new Client("mongodb://localhost:27017"); // Connexion à MongoDB
$database = $mongoClient->selectDatabase('zoo'); // Sélection de la base de données 'zoo'
$collection = $database->selectCollection('animal_view'); // Sélection de la collection 'animal_views'

// Récupérer les consultations des animaux
$animals = $collection->find([], ['sort' => ['views' => -1]]); // Trouver tous les documents, triés par 'views' décroissant

echo "<h1>Dashboard des consultations des animaux</h1>";
echo "<table border='1'>";
echo "<tr><th>Animal</th><th>Consultations</th></tr>";

foreach ($animals as $animal) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($animal['name']) . "</td>";
    echo "<td>" . htmlspecialchars($animal['views']) . "</td>";
    echo "</tr>";
}

echo "</table>";
?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
