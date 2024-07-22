<?php
include(__DIR__ . '/../config.php');

include('header.html');
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $commentaire = htmlspecialchars($_POST['commentaire']);

    $query = "INSERT INTO avis (pseudo, commentaire, isVisible) VALUES (:pseudo, :commentaire, 0)";
    $stmt = $bdd->prepare($query);

    $stmt->bindParam(':pseudo', $pseudo);
    $stmt->bindParam(':commentaire', $commentaire);

    if ($stmt->execute()) {
        $message = "Votre avis a été soumis pour validation.";
    } else {
        $message = "Erreur lors de la soumission de votre avis.";
    }
}
?>
    <div class="container mt-5 centered-text">
      <h1 class="font-yellow">BIENVENUE AU ZOOPARK D'ARCADIA</h1>
      <h2>Venez a la rencontre de nos animaux !</h2>
    </div>
    <div class="container mt-5 content">
      <div class="row align-items-center">
        <div class="col-12 col-md-6 d-flex justify-content-center mb-4 mb-md-0">
          <img src="../images/lion.jpg" alt="Image Description" class="img-fluid img-large">
        </div>
        <div class="col-12 col-md-6">
          <div class="content-text">
              <h2 class="font-yellow">Bienvenue à Arcadia Zoo : Un Paradis Écologique en Bretagne</h2>
              <p>Découvrez Arcadia Zoo, un lieu magique niché près de la forêt de Brocéliande, en Bretagne, où la nature rencontre l'aventure depuis 1960. Plongez dans un monde fascinant où des centaines d'animaux de la savane, de la jungle et des marais vivent en harmonie dans des habitats soigneusement recréés.</p>
              <div class="button-container">
                <button class="content-button"  onclick="window.location.href='./habitat_page.php'">Je découvre le zoo !</button>
            </div>
          </div>
      </div>
  </div>
</div>
<div class="container mt-5 centered-text">
  <h1>Nos differents habitats a explorer !</h1>
</div>
<div class="container mt-5">
  <div class="row text-center"> <!-- Ajout de text-center pour centrer le texte et les images -->
    <div class="col-md-4 d-flex flex-column align-items-center mb-4">
        <img src="../images/Elephant.jpg" class="rounded-circle img-fluid mb-3" alt="Image 1">
        <h2 class="font-yellow">La jungle</h2>
        <p class="mt-3">Rencontrez les géants doux et apprenez-en plus sur leurs habitudes fascinantes.</p>
    </div>
    <div class="col-md-4 d-flex flex-column align-items-center mb-4">
        <img src="../images/crocodile.jpg" class="rounded-circle img-fluid mb-3" alt="Image 2">
        <h2 class="font-yellow">Le marais</h2>
        <p class="mt-3">Frissonnez devant les prédateurs redoutables</p>
    </div>
    <div class="col-md-4 d-flex flex-column align-items-center mb-4">
        <img src="../images/zebre.jpg" class="rounded-circle img-fluid mb-3" alt="Image 3">
        <h2 class="font-yellow">La savane</h2>
        <p class="mt-3">Observez la savane dans toute sa majesté</p>
    </div>
  </div>
</div>
<div class="container">
  <h2 class="font-yellow">D'autre animaux a decouvir !</h2>
   <button class="content-button" onclick="window.location.href='./habitat_page.php'">J'explore leur territoire !</button>
  </div>
  <div class="container mt-5 centered-text">
    <h1>Profitez de nos services !</h1>
  </div>
  <div class="container mt-5">
    <div class="row text-center">
        <div class="col-md-4 d-flex flex-column align-items-center mb-4">
            <div class="img-container">
                <img src="../images/restaurant.jpg" class="img-fluid" alt="Image 1">
            </div>
            <h2 class="font-yellow">Restaurant</h2>
            <p class="mt-3">Venez manger dans notre restaurant du park ayant une vue sur les animaux.</p>
        </div>
        <div class="col-md-4 d-flex flex-column align-items-center mb-4">
            <div class="img-container">
                <img src="../images/train.jpg" class="img-fluid" alt="Image 2">
            </div>
            <h2 class="font-yellow">Train</h2>
            <p class="mt-3">Baladez vous dans notre train faisant le tour du park. Ideal pour les enfants.</p>
        </div>
        <div class="col-md-4 d-flex flex-column align-items-center mb-4">
            <div class="img-container">
                <img src="../images/zookeeper.png" class="img-fluid" alt="Image 3">
            </div>
            <h2 class="font-yellow">Guide</h2>
            <p class="mt-3">Decouvrez le parc plus en detail avec nos guides et ayez la possibilite de nourriture les animaux avec eux.</p>
        </div>
    </div>
</div>
<div class="container mt-5">
  <h2 class="font-yellow">Voir les autres services d'Arcadia !</h2>
   <button class="content-button" onclick="window.location.href='./service_page.php'">Decouvrir !</button>
  </div>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Avis des Clients</h2>
    <div id="avisCarousel" class="carousel slide custom-carousel" data-bs-ride="carousel">
        <div class="carousel-inner">
          <?php
            $stmt = $bdd->query("SELECT pseudo, commentaire FROM avis WHERE isVisible = 1");
            $active = 'active';
            while ($row = $stmt->fetch()) {
                echo '<div class="carousel-item ' . $active . '">';
                echo '<div class="d-flex flex-column align-items-center">';
                echo '<h5 class="text-center">' . htmlspecialchars_decode($row['pseudo']) . '</h5>';
                echo '<p class="text-center">' . htmlspecialchars_decode($row['commentaire']) . '</p>';
                echo '</div>';
                echo '</div>';
                $active = ''; // Only the first item should be active
            }
          ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#avisCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#avisCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Laisser un Avis</h2>
        <form action="" method="post">
            <?php if ($message != ""): ?>
                <div class="alert alert-info">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="pseudo" class="form-label">Pseudo</label>
                <input type="text" class="form-control" id="pseudo" name="pseudo" required>
            </div>
            <div class="mb-3">
                <label for="commentaire" class="form-label">Commentaire</label>
                <textarea class="form-control large-textarea" id="commentaire" name="commentaire" rows="4" required></textarea>
            </div>
            <div class="container"> 
              <button type="submit" class="content-button">Soumettre</button>
          </div>
           
        </form>
    </div>
</div>
<footer class="mt-5">
  <div class="container">
  <h1 class="font-yellow">horaire d'ouverture</h1>
  <p>Lundi-dimanche: 10h-19h</p>

  </div>
 
</footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
  </body>
</html>