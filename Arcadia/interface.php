<?php
session_start(); // Assurez-vous que session_start() est appelé en premier sur toutes les pages utilisant des sessions

// Vérifie si l'utilisateur est connecté et a des permissions définies
if (isset($_SESSION['permissions'])) {
    // Liste des pages avec leurs permissions associées
    $pages = [
        'inscription.php' => 'create_account',
        '../Arcadia/utilisateur/form_animal.php' => 'modify_animals',
        '../Arcadia/utilisateur/form_habitat.php' => 'modify_habitat',
        '../Arcadia/utilisateur/form_service.php' => 'modify_service',
        '../Arcadia/utilisateur/form_rapport.php' => 'view_rapport',
        '../Arcadia/dashboard.php' => 'view_dashboard',
        '../Arcadia/utilisateur/feeding_form.php' => 'feeding_animal',
        '../Arcadia/utilisateur/rapport_staff.php' => 'vet_feeding',
        '../Arcadia/utilisateur/validate_avis.php' => 'reviews_client',
        '../Arcadia/utilisateur/rapport_staff.php' => 'vet_feeding',
        '../Arcadia/utilisateur/rapport_veterinaire.php' => 'admin_rapport',
        
    ];
} else {
    // Si l'utilisateur n'est pas authentifié ou n'a pas de permissions définies, redirigez-le vers la page de connexion
    header('Location: account_page.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoo d'Arcadia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">Afficher le menu</button>
    <div class="content flex-grow-1 p-1">
        <iframe id="contentFrame" name="contentFrame" src="" width="100%" height="1000px" frameborder="0"></iframe>
    </div>
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="wrapper d-flex">
                <div class="sidebar">
                    <h2 class="user">Bienvenue</h2>
                    <ul class="list-unstyled">
                        <?php
                        // Parcours des pages et affichage des liens si l'utilisateur a la permission correspondante
                        foreach ($pages as $page => $permission) {
                            if (in_array($permission, $_SESSION['permissions'])) {
                                echo "<li class='side-item'><a class='side-link' href='$page' target='contentFrame'>" . ucfirst(str_replace(array(".php", "_"), array("", " "), basename($page))) . "</a></li>";
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>