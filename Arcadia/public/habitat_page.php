<?php 
include(__DIR__ . '/../config.php');

include ('header.html'); 

// Récupérer tous les habitats
$query = "SELECT id, nom, discribe, image FROM habitats";
$stmt = $bdd->query($query);
$habitats = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<body>
<div class="container">
    <h1>Les habitats d'Arcadia</h1>
 </div>
 <div class="container mt-5">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($habitats as $habitat): ?>
            <div class="col">
                <div class="card" style="background-color: rgba(255, 255, 255, 0.1);">
                    <img src="../utilisateur/upload/<?php echo htmlspecialchars_decode($habitat['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars_decode($habitat['nom']); ?>">
                    <div class="card-body">
                        <h5 class="card-title text-center font-yellow"><?php echo htmlspecialchars_decode($habitat['nom']); ?></h5>
                        <p class="card-text text-center" style="color: white;"><?php echo htmlspecialchars_decode($habitat['discribe']); ?></p>
                        <div class="d-flex justify-content-center mt-4"><a href="animal.php?habitat_id=<?php echo htmlspecialchars_decode($habitat['id']); ?>" class="content-button">Voir les animaux</a></div>
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

</body>
</html>