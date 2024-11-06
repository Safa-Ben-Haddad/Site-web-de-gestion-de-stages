<?php
include 'connexion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-yHJ3REdZT8IvMU2r+oy6T7GO3S/D3vIZtXnYAnZjvZaA8bmG5txa2PyR9LM1R+wS" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-iKsHBGBiJ4mMbFDtv3kWlBTv58/KG1ZGcfXAZy0klGBb3mzhE7H6gTTPf+tcJvP2Qmm0PMiGKDBwQhR7I+VzPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../CSS/selection.css">
    <title> Login etudiant </title>
    <style>
        form {
    margin: 20px 0;
}

fieldset {
    border: 2px solid #ccc;
    padding: 20px;
}

legend {
    font-size: 1.2em;
    font-weight: bold;
    margin-bottom: 10px;
}

label {
    display: block;
    margin-bottom: 10px;
}

input[type="text"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input[type="submit"] {
    background-color: red;
    color: #fff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
}

input[type="submit"]:hover {
    background-color: blue;
}

.return-button {
            display: inline-block;
            background-color: red;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
        }

        .return-button:hover {
            background-color: blue;
        }


    </style>
</head>
<body>

    <section id="header">
        <a href="#"> <img src="../Images/esprit.png" class="logo" alt=""> </a>
        <div>
            <ul id="navbar">
                <li> <a class="active" href="../HTML/accueil.html"> Accueil </a></li>
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn"> Espaces <i class="fa fa-caret-down"></i> </a>
                    <div class="dropdown-content">
                        <a href="../HTML/login.html">Espace etudiant(e)</a>
                        <a href="../HTML/formencadrant.html">Espace Encadrant(e)</a>
                        <a href="../HTML/administration.html">Administration </a>
                    </div>
                </li>
                <li> <a href="../HTML/offres.html"> Stages </a></li>
                
                
                
                <li> <a href="../HTML/contact.html"> Contact </a></li>
                
            </ul>
        </div>

    </section>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modifier'])) {
        $identifiant = $_POST['identifiant'];
        $nom = $_POST['Nom'];
        $prenom = $_POST['Prenom'];
        $mail = $_POST['Mail'];
        $spec = $_POST['Spec'];
        $nomSociete = $_POST['NomSociete'];
        $sujet = $_POST['Sujet'];
        $desc = $_POST['Desc'];

        $stmt = $mysqli->prepare("UPDATE demande SET nom=?, prenom=?, adresseMail=?, specialite=?, nomSociete=?, sujet=?, descriptionSujet=? WHERE idEtudiant=?");

        if (!$stmt) {
            echo "Erreur de préparation de la requête : " . $mysqli->error;
        } else {
            $stmt->bind_param("ssssssss", $nom, $prenom, $mail, $spec, $nomSociete, $sujet, $desc, $identifiant);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                echo "<p>La demande ID " . htmlspecialchars($identifiant) . " a été mise à jour avec succès.</p>";
            } else {
                echo "<p> Aucune demande trouvée avec cet identifiant ou aucune modification apportée. </p>";
            }
            $stmt->close();
        }
    }
    ?>

    <form action="" method="post">
        <fieldset>
            <legend> Informations de la Demande </legend>
            <label> ID de la Demande:
                <input type="text" name="identifiant" placeholder="Entrez l'ID de la demande à modifier" required>
            </label>
            <input type="submit" value="Rechercher">
        </fieldset>
    </form>

    <?php
    if (isset($_POST['identifiant']) && !empty($_POST['identifiant'])) {
        $identifiant = $_POST['identifiant'];
        $stmt = $mysqli->prepare("SELECT * FROM demande WHERE idEtudiant = ?");
        if (!$stmt) {
            echo "Erreur de préparation de la requête : " . $mysqli->error;
        } else {
            $stmt->bind_param("s", $identifiant);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='detail-card'>
                    <h2>Demande ID: " . htmlspecialchars($row["idEtudiant"]) . "</h2>
                    <form action='' method='post'>
                        <input type='hidden' name='identifiant' value='" . htmlspecialchars($row["idEtudiant"]) . "'>
                        <label>Nom: <input type='text' name='Nom' value='" . htmlspecialchars($row["nom"]) . "' required></label><br>
                        <label>Prénom: <input type='text' name='Prenom' value='" . htmlspecialchars($row["prenom"]) . "' required></label><br>
                        <label>Email: <input type='text' name='Mail' value='" . htmlspecialchars($row["adresseMail"]) . "' required></label><br>
                        <label>Spécialisation: <input type='text' name='Spec' value='" . htmlspecialchars($row["specialite"]) . "' required></label><br>
                        <label>Nom de la Société: <input type='text' name='NomSociete' value='" . htmlspecialchars($row["nomSociete"]) . "' required></label><br>
                        <label>Sujet: <input type='text' name='Sujet' value='" . htmlspecialchars($row["sujet"]) . "' required></label><br>
                        <label>Description: <textarea name='Desc' required>" . htmlspecialchars($row["descriptionSujet"]) . "</textarea></label><br>
                        <input type='submit' name='modifier' value='Modifier'>
                    </form>
                    </div>";
                }
            } else {
                echo "<p>Aucune demande trouvée avec cet identifiant.</p>";
            }
            $stmt->close();
        }
    }
    ?>

<a href="gestion.html" class="return-button">Revenir à la page des gestions</a>
</body>
</html>

<?php
$mysqli->close();
?>
