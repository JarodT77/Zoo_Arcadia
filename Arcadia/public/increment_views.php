<?php
require 'C:/xampp/htdocs/Arcadia/vendor/autoload.php'; // Inclure Composer autoload

use MongoDB\Client;

// Vérifier si le nom de l'animal est fourni
if (isset($_POST['animal_name'])) {
    $animalName = $_POST['animal_name'];

    // Connexion à MongoDB
    $mongoClient = new Client("mongodb://localhost:27017");
    $database = $mongoClient->selectDatabase('zoo');
    $collection = $database->selectCollection('animal_view');

    // Fonction pour augmenter les consultations d'un animal
    function incrementAnimalView($collection, $animalName) {
        $result = $collection->findOneAndUpdate(
            ['name' => $animalName],
            ['$inc' => ['views' => 1]],
            ['upsert' => true, 'returnDocument' => MongoDB\Operation\FindOneAndUpdate::RETURN_DOCUMENT_AFTER]
        );

        if ($result) {
            return $result['views'];
        } else {
            return 0;
        }
    }

    $views = incrementAnimalView($collection, $animalName);

    echo json_encode(['views' => $views]);
}
?>
