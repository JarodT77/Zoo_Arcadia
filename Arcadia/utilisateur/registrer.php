<?php
include(__DIR__ . '/../config.php');

$message ="";

if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $role = intval($_POST['role']);

    $stmt = $bdd->prepare ("INSERT INTO utilisateurs (email, password, role_id) VALUES (:email, :password, :role)");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role', $role);

    if ($stmt->execute()) {
        header("Location: inscription.php");
        exit();
    } else {
        $message = "Erreur lors de l'inscription. Veuillez réessayer.";
    }
}