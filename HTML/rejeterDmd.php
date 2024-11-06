<?php
include 'connexion.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $stmt = $mysqli->prepare("DELETE FROM demande WHERE idEtudiant = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo'modifi reuissies';
    } else {
        echo "Erreur" . $mysqli->error;
    }
    $stmt->close();
}
$mysqli->close();
?>