<?php
include 'connexion.php';

$stmt = $mysqli->prepare("SELECT id_etudiant, motDePasse FROM etudiant");
if ($stmt) {
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $id_etudiant = $row['id_etudiant'];
        $password = $row['motDePasse'];

        $update_stmt = $mysqli->prepare("UPDATE etudiant SET motDePasse = ? WHERE id_etudiant = ?");
        if ($update_stmt) {
            $update_stmt->bind_param("ss", $password, $id_etudiant);
            $update_stmt->execute();
            $update_stmt->close();
        }
    }
    $stmt->close();
} else {
    echo "Erreur de préparation : " . $mysqli->error;
}

$username = $_POST['id'];
$password = $_POST['MotDePasse'];

function verifyLogin($mysqli, $username, $password) {
    $stmt = $mysqli->prepare("SELECT motDePasse FROM etudiant WHERE id_etudiant = ?");
    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($stored_password);
            $stmt->fetch();
            
            if ($password === $stored_password) {
                echo "<script>window.location.href = 'selection.html';</script>";
            } else {
                echo "<div class='error-box'><p>Mot de passe incorrect.</p><button onclick='goBack()'>Retour</button></div>";
            }
        } else {
            echo "<div class='error-box'><p>Identifiant non trouvé.</p><button onclick='goBack()'>Retour</button></div>";
        }
        $stmt->close();
    } else {
        echo "Erreur de préparation : " . $mysqli->error;
    }
}

verifyLogin($mysqli, $username, $password);

$mysqli->close();
?>

<style>
body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    background-color: #f0f0f0;
    font-family: Arial, sans-serif;
}

.error-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 300px;
    padding: 20px;
    border: 1px solid #f44336;
    background-color: #ffebee;
    color: #f44336;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.error-box p {
    margin: 0 0 10px;
}

.error-box button {
    padding: 10px 20px;
    border: none;
    background-color: #f44336;
    color: white;
    border-radius: 3px;
    cursor: pointer;
    font-size: 14px;
}

.error-box button:hover {
    background-color: #d32f2f;
}
</style>

<script>
function goBack() {
    window.history.back();
}
</script>
