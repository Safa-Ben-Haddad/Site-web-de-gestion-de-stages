<?php
include 'connexion.php';

if(isset($_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['adresseMail'], $_POST['mdp']) &&
   !empty($_POST['id']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['adresseMail']) && !empty($_POST['mdp'])) {

    $stmt = $mysqli->prepare("INSERT INTO etudiant VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['adresseMail'], $_POST['mdp']);

    if ($stmt->execute()) {
        echo "<script>window.location.href = 'selection.html';</script>";
        exit();
    } else {
        echo "Erreur : " . $mysqli->error . "<br>";
    }
    $stmt->close();
} else {
    echo 'Erreur d\'envoi ou champs manquants.<br>';
}
$mysqli->close();
?>
<a href="accueil.html">revenir à la page d'accueil</a>