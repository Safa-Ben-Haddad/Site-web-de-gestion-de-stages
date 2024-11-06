<?php
include 'connexion.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Start transactionq
    $mysqli->begin_transaction();

    try {
        // Insert into stage table
        $stmt = $mysqli->prepare("INSERT INTO stage SELECT * FROM demande WHERE idEtudiant = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->close();

        // Delete from demande table
        $stmt = $mysqli->prepare("DELETE FROM demande WHERE idEtudiant = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->close();

        // Commit transaction
        $mysqli->commit();
        echo 'la liste des etudiants encadrés a ete cree' ;
        echo "<script>window.location.href = 'accueil.html';</script>";
        exit();
    } catch (Exception $e) {
        $mysqli->rollback(); // Rollback on error
        echo "An error occurred: " . $e->getMessage();
    }
}
$query = "SELECT * FROM stage";
$result = $mysqli->query($query);

if ($result) {
    echo "<table border='1'><tr><th>ID</th><th>Nom</th><th>Mail</th><th>Sujet</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['idEtud'] . "</td><td>" . $row['NomEtud'] . "</td><td>" . $row['adresseMail'] . "</td><td>". $row['sujet']."</td></tr>";
    }
    echo "</table>";
} else {
    echo "Erreur lors de la récupération des stages: " . $mysqli->error;
}

$mysqli->close();
?>
