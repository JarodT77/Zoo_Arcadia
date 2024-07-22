<?php
require 'C:/xampp/htdocs/Arcadia/vendor/autoload.php';

use MongoDB\Client;

$mongoClient = new Client("mongodb://localhost:27017");
$database = $mongoClient->selectDatabase('zoo');
$collection = $database->selectCollection('animal_view');

function incrementAnimalView($animalName) {

    $result = $collection->findOneAndUpdate(
        ['name' => $animalName],
        ['$inc' => ['views' => 1]],
        ['upsert' => true, 'returnDocument' => MongoDB\Operation\FindOneAndUpdate::RETURN_DOCUMENT_AFTER]
    );
    
    if ($result) {
        return $result ['views'];
    } else {
        return 0;
    }
} 

if (isset($_GET['animal'])) {
    $animalName = htmlspecialchars($_GET['animal']);
    $views = incrementAnimalView($animalName);
    echo "Nombre de vues pour $animalName : $views";
}
?>