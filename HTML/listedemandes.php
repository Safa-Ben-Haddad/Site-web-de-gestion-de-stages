<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/selection.css">
    <style>
        /* Styles pour le tableau et les boutons */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            margin: 150px auto 20px auto;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #f5f5f5;
        }

        /* Styles pour les boutons */
        .action-buttons button {
            background-color: goldenrod;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
        }

        .action-buttons button.accept {
            background-color: green;
        }

        .action-buttons button.reject {
            background-color: red;
        }

        /* Style pour le bouton de retour */
        .return-button {
            background-color: goldenrod;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            display: block;
            width: max-content;
            margin: 20px auto 0;
        }

        .return-button:hover {
            background-color: #4cae4c;
        }
    </style>
    <title>Liste des demandes</title>
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
                        <a href="../HTML/login.html">Espace étudiant(e)</a>
                        <a href="../HTML/login1.html">Espace Encadrant(e)</a>
                        <a href="../HTML/administration.html">Administration </a>
                    </div>
                </li>
                <li> <a href="../HTML/offres.html"> Stages </a></li>
                <li> <a href="../HTML/zama-about.html"> Actualités </a></li>
                <li> <a href="../HTML/zama-contact.html"> Contact </a></li>
            </ul>
        </div>
    </section>
    <?php
    include 'connexion.php';
    echo "<table>"; 
    echo "<thead><tr>";
    echo "<th>ID Étudiant</th><th>Nom</th><th>Prénom</th><th>Email</th><th>Spécialité</th><th>Sujet</th><th>Description du Sujet</th><th>Actions</th>";
    echo "</tr></thead><tbody>";
    
    $stmt = $mysqli->prepare("SELECT * FROM demande");
    if (!$stmt) {
        echo "Error preparing statement: " . $mysqli->error;
    } else {
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["idEtudiant"]. "</td><td>" . $row["nom"]. "</td><td>" . $row["prenom"]. "</td><td>" . $row["adresseMail"]. "</td><td>" . $row["specialite"]. "</td><td>" . $row["sujet"]. "</td><td>" . $row["descriptionSujet"]. "</td><td class='action-buttons'>";
                echo "<form action='accepterDmd.php' method='post' style='display:inline;'><input type='hidden' name='id' value='" . $row["idEtudiant"] . "'><button type='submit' class='accept'>Accepter</button></form> ";
                echo "<form action='rejeterDmd.php' method='post' style='display:inline;'><input type='hidden' name='id' value='" . $row["idEtudiant"] . "'><button type='submit' class='reject'>Refuser</button></form>";
                echo "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='8'>Aucune demande</td></tr>";
        }
        $stmt->close();
    }

    echo "</tbody></table>";
    $mysqli->close();
    ?>

    <!-- Bouton de retour -->
    <button class="return-button" onclick="window.location.href='accueil.html'">Revenir à la page d'accueil</button>
</body>
</html>
