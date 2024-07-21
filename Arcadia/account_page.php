<?php 
session_start(); // Inclusion de l'en-tête commun à toutes les pages
 
  include('../arcadia/utilisateur/config.php');


if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if($email != "" && $password != ""){
        // Utiliser des requêtes préparées pour éviter les injections SQL
        $req = $bdd->prepare("SELECT * FROM utilisateurs WHERE email = :email AND password = :password");
        $req->bindParam(':email', $email);
        $req->bindParam(':password', $password);
        $req->execute();
        $user = $req->fetch();

            // Récupération des permissions associées au rôle de l'utilisateur
            $stmt = $bdd->prepare("SELECT p.name FROM permissions p WHERE p.role_id = :role_id");
            $stmt->execute(['role_id' => $user['role_id']]);
            $_SESSION['permissions'] = $stmt->fetchAll(PDO::FETCH_COLUMN);

            // Redirection vers l'interface utilisateur sécurisée
            header('Location: interface.php');
            exit();
        } else {
            echo "Identifiant ou mot de passe incorrect";
        }
    } 


include('header.html'); // Inclusion de l'en-tête commun à toutes les pages
?> 
 <div class="container">
  <form action="" method="POST" class="form-example">
        <div class="form">
        <label for="User">Utilisateur:</label>
        <input type="email" name="email" id="email" required />
    </div>
    <div class="form">
        <label for="password">Mot de passe:</label>
        <input type="password" name="password" id="password" required />
    </div>
    <div class="form_submit">
        <input type="submit" value="Se connecter" />
      </div>
    </form>
  </div>
 </div>  
</body>
</html>