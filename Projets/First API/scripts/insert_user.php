<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root"; // Nom d'utilisateur par défaut
$password = ""; // Mot de passe vide par défaut
$dbname = "login_app"; // Nom de votre base de données

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Insertion d'un nouvel utilisateur
$username = "testuser2"; // Nom d'utilisateur d'exemple
$password = password_hash("testpassword2", PASSWORD_DEFAULT); // Hachage du mot de passe

$sql = "INSERT INTO utilisateurs (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();

echo "Utilisateur ajouté avec succès.";

$conn->close();
?>
