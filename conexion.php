<?php
$servername = "localhost";
$username = "root";
$password = "root";

try {
    $bdd = new PDO("mysql:host=$servername;dbname=blog", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
