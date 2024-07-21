<?php
include('../arcadia/utilisateur/config.php');

$stmt = $bdd->query("SELECT id, label FROM role");
$roles = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <form action="" method="post">
        <label for="email">Votre e-mail:</label>
        <input type="email" id="email" name="email" placeholder="Entrez votre email">
        <br>
        <label for="password">Votre mot de passe</label>
        <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe">
        <br>
        <label for="role" class="form-label">Role</label>
        <select class="form-select" id="role" name="role" required>
        <?php
          foreach ($roles as $role) {
            echo "<option value='" . htmlspecialchars($role['id']) . "'>" . htmlspecialchars($role['label']) . "</option>";
         }
        ?>
        <br>
        <input type="submit" value="m'inscrire" name="ok">
        <?php
include('../arcadia/utilisateur/config.php');

if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $role = intval($_POST['role']);

    $stmt = $bdd->prepare ("INSERT INTO utilisateurs (email, password, role_id) VALUES (:email, :password, :role)");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role', $role);

    if ($stmt->execute()) {
        echo  "inscription reussite !";
    } else {
        echo  "Erreur lors de l'inscription. Veuillez réessayer.";
    }
}
?>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>