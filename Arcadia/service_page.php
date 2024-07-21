<?php 
include('../arcadia/utilisateur/config.php');
include('header.html');

//recuperer tous les services 
$query ="SELECT id, nom, discribe, image FROM services";
$stmt = $bdd->query($query);
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<body>
<div class="container">
    <h1>Les services d'Arcadia</h1>
 </div>
 <div class="container mt-5">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($services as $service): ?>
            <div class="col">
                <div class="card" style="background-color: rgba(255, 255, 255, 0.1);">
                    <img src="../arcadia/utilisateur/upload/<?php echo htmlspecialchars_decode($service['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars_decode($service['nom']); ?>">
                    <div class="card-body">
                        <h5 class="card-title text-center font-yellow"><?php echo htmlspecialchars_decode($service['nom']); ?></h5>
                        <p class="card-text text-center" style="color: white;"><?php echo htmlspecialchars_decode($service['discribe']); ?></p>
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