<?php
include(__DIR__ . '/../config.php');
include('header.html'); 

require 'C:/xampp/htdocs/Arcadia/vendor/autoload.php';

use MongoDB\Client;

// Configuration MongoDB
$mongoClient = new Client("mongodb://localhost:27017"); // Connexion à MongoDB
$database = $mongoClient->selectDatabase('zoo'); // Sélection de la base de données 'zoo'
$collection = $database->selectCollection('animal_view'); // Sélection de la collection 'animal_views'

// Fonction pour augmenter les consultations d'un animal
function incrementAnimalView($collection, $animalName) {
    $result = $collection->findOneAndUpdate(
        ['name' => $animalName], // Trouver le document avec le nom de l'animal
        ['$inc' => ['views' => 1]], // Incrémenter le champ 'views' de 1
        ['upsert' => true, 'returnDocument' => MongoDB\Operation\FindOneAndUpdate::RETURN_DOCUMENT_AFTER]
    );

    if ($result) {
        return $result['views']; // Retourner le nombre de vues mis à jour
    } else {
        return 0; // Retourner 0 si aucun document n'est trouvé ou mis à jour
    }
}

$habitat_id = intval($_GET['habitat_id']);

// Récupérer les informations de l'habitat
$stmt = $bdd->prepare("SELECT * FROM habitats WHERE id = :id");
$stmt->bindParam(':id', $habitat_id);
$stmt->execute();
$habitat = $stmt->fetch();

if (!$habitat) {
    echo "Habitat non trouvé.";
    exit();
}

// Récupérer les animaux de cet habitat avec leurs avis vétérinaires
$query = "
    SELECT a.id AS animal_id, a.prenom, a.image, a.race, r.detail AS vet_review, r.date AS vet_review_date
    FROM animal a
    LEFT JOIN (
        SELECT animal_id, detail, date
        FROM rapports_veterinaires
        WHERE (animal_id, date) IN (
            SELECT animal_id, MAX(date)
            FROM rapports_veterinaires
            GROUP BY animal_id
        )
    ) r ON a.id = r.animal_id
    WHERE a.habitat_id = :habitat_id
";

$stmt = $bdd->prepare($query);
$stmt->bindParam(':habitat_id', $habitat_id);
$stmt->execute();
$animals = $stmt->fetchAll();
?>
<body>
    <div class="container mt-5">
        <h2>Habitat: <?php echo htmlspecialchars($habitat['nom']); ?></h2>
        <img src="../utilisateur/upload/<?php echo htmlspecialchars($habitat['image']); ?>" class="img-fluid mb-4 animal" alt="<?php echo htmlspecialchars($habitat['nom']); ?>">
        <p><?php echo htmlspecialchars($habitat['discribe']); ?></p>
        <div class="d-flex justify-content-center mb-4">
            <a href="habitat_page.php" class="content-button">Retour aux habitats</a>
        </div>
        
        <h2>Liste des Animaux</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($animals as $animal): 
                $animalName = htmlspecialchars_decode($animal['prenom']);
                $vetReview = htmlspecialchars_decode($animal['vet_review']);
                $vetReviewDate = htmlspecialchars($animal['vet_review_date']);
            ?>
                <div class="col">
                    <div class="card mb-4 h-100 animal-card" data-animal-name="<?php echo $animalName; ?>" style="background-color: rgba(255, 255, 255, 0.1);">
                        <img src="../utilisateur/upload/<?php echo htmlspecialchars_decode($animal['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars_decode($animal['prenom']); ?>">
                        <div class="card-body">
                            <h5 class="card-title text-center font-yellow"><?php echo $animalName; ?></h5>
                            <p class="card-text text-center" style="color: white">Race: <?php echo htmlspecialchars_decode($animal['race']); ?></p>

                            <!-- Button to toggle collapse -->
                            <button class="content-button w-100" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $animal['animal_id']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $animal['animal_id']; ?>">
                                Voir les details
                            </button>

                            <!-- Collapsible content -->
                            <div class="collapse mt-3" id="collapse<?php echo $animal['animal_id']; ?>">
                                <div class="card card-body">
                                    <p class="card-text review-details">Avis vétérinaire: <?php echo $vetReview; ?></p>
                                    <p class="card-text review-details">Date: <?php echo $vetReviewDate; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <footer class="mt-5">
  <div class="container">
  <h1 class="font-yellow">horaire d'ouverture</h1>
  <p>Lundi-dimanche: 10h-19h</p>

  </div>
 
</footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/animal.js"></script> <!-- Inclusion du fichier JavaScript externe -->
</body>
</html>



    