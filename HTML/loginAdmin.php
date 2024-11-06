<?php
include 'connexion.php';

$username = $_POST['id'];
$password = $_POST['MotDePasse'];

// Correct method for a prepared statement is prepare()
$sql = "SELECT mdp FROM administrateur WHERE id_administrateur = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    // Ensure the field name used here matches the one you've selected, which is 'mdp'
    if (password_verify($password, $row['mdp'])) {
        header("location: EtudEncad.php");
    } else {
        echo "Mot de passe incorrect";
        header("location: administration.html");
    }
} else {
    echo "Nom d'utilisateur incorrect";
}

$stmt->close();
$mysqli->close(); // Use the correct variable for connection that was opened
?>
