<?php
include 'connexion.php';

echo '<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login étudiant</title>
    <link rel="stylesheet" href="../CSS/selection.css">
    <style>
        /* Votre style existant */
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
<body>';

echo '<section id="header">
        <a href="#"><img src="../Images/esprit.png" class="logo" alt=""></a>
        <div>
            <ul id="navbar">
                <li><a class="active" href="../HTML/accueil.html"> Accueil </a></li>
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn">Espaces <i class="fa fa-caret-down"></i></a>
                    <div class="dropdown-content">
                        <a href="../HTML/login.html">Espace étudiant(e)</a>
                        <a href="../HTML/formencadrant.html">Espace Encadrant(e)</a>
                        <a href="../HTML/administration.html">Administration</a>
                    </div>
                </li>
                <li><a href="../HTML/stages.html">Stages</a></li>
                
                <li><a href="../HTML/contact.html">Contact</a></li>
            </ul>
        </div>
    </section>';

echo '<form action="" method="get">
<input type="text" name="id" placeholder="Entrez votre identifiant" required>
<input type="submit" value="Valider">
</form>';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $mysqli->prepare("DELETE FROM demande WHERE idEtudiant=?");

    if ($stmt === false) {
        die('MySQL prepare error: ' . $mysqli->error);
    }

    $result = $stmt->bind_param("s", $id);

    $result = $stmt->execute();
    if ($result) {
        if ($stmt->affected_rows > 0) {
            echo "Votre demande a été supprimée avec succès.";
        } else {
            echo "Aucune demande trouvée avec cet ID ou déjà supprimée.";
        }
    } else {
        die('Execute error: ' . $stmt->error);
    }

    $stmt->close();
}

echo '<a href="gestion.html" class="return-button">Revenir à la page des gestions</a>';

echo '</body>
</html>';

$mysqli->close();
?>
