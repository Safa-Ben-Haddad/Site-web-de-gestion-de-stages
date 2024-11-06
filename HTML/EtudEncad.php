<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/selection.css">
    <title>Liste des stages</title>
    <style>
        

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            
            
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
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

        
        .return-button {
            background-color: red;
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
            background-color: blue;
        }

        h2 {
            margin-top: 50px;
            text-align: center;
        }
    </style>
</head>
<body>
    
    <section id="header">
        <a href="#"><img src="../Images/esprit.png" class="logo" alt=""></a>
        <div>
            <ul id="navbar">
                <li><a class="active" href="../HTML/accueil.html">Accueil</a></li>
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
    </section>
    <h2> Liste des etudiant(e)s encadrés</h2>

    
    <?php
    include 'connexion.php'; 

    
    $query = "SELECT * FROM stage";
    $result = $mysqli->query($query);

    if ($result) {
        // Si la requête réussit, afficher les résultats sous forme de tableau HTML
        echo "<table>";
        echo "<tr><th>ID</th><th>Nom</th><th>Email</th><th>Adresse Mail</th></tr>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['idEtud']) . "</td>";
            echo "<td>" . htmlspecialchars($row['NomEtud']) . "</td>";
            echo "<td>" . htmlspecialchars($row['PrenomEtud']) . "</td>";
            echo "<td>" . htmlspecialchars($row['adresseMail']) . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        // Si la requête échoue, afficher un message d'erreur
        echo "Erreur lors de la récupération des informations de stage : " . $mysqli->error;
    }

    $mysqli->close();
    ?>

    <!-- Bouton de retour -->
    <button class="return-button" onclick="window.location.href='../HTML/accueil.html'"> Revenir à la page d'accueil </button>
</body>
</html>
