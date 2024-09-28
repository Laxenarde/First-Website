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

// Vérification des données de connexion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Requête pour obtenir l'utilisateur
    $sql = "SELECT * FROM utilisateurs WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $input_username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifier si l'utilisateur existe
    if ($result->num_rows > 0) {
        // Récupérer les informations de l'utilisateur
        $user = $result->fetch_assoc(); // Renommez $row en $user pour correspondre à votre code

        // Vérification du mot de passe
        if (password_verify($input_password, $user['password'])) {
            header("Location: ../success.html"); // Rediriger vers la page de succès
            exit();
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Utilisateur non trouvé."; // Afficher un message si l'utilisateur n'existe pas
    }
}

// Fermer la connexion
$conn->close();
?>
