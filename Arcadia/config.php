<?php

if (getenv('JAWSDB_URL') !== false) {
    $dbparts = parse_url(getenv('JAWSDB_URL'));

    $host = $dbparts['host'];
    $username = $dbparts['user'];
    $password = $dbparts['pass'];
    $dbname= ltrim($dbparts['path'],'/');
} else {
    
$host = "localhost";
$username = "root";
$password = "";
$dbname = "arcadia_zoo";
}

try {
    $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
