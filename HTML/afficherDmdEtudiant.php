<?php
include 'connexion.php';?>
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
    <title> Login étudiant </title>
    <style>
        
        .custom-form {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            max-width: 300px;
            margin: 150px auto 20px auto; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .custom-form input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .custom-form input[type="submit"] {
            background-color: red;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }

        .custom-form input[type="submit"]:hover {
            background-color: blue;
        }

        
        .demande {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .demande-form label {
            display: block;
            margin-bottom: 10px;
        }

        .demande-form input,
        .demande-form textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }

        .demande-form .actions {
            text-align: right;
        }

        .demande-form button {
            padding: 10px 20px;
            margin-top: 10px;
            cursor: pointer;
        }

        
        .return-button-container {
            text-align: center;
            margin-top: 20px;
        }

        .return-button-container a {
            background-color: red;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 3px;
            display: inline-block;
            font-size: 16px;
        }

        .return-button-container a:hover {
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
                        <a href="../HTML/login.html">Espace étudiant(e)</a>
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
    echo '<form class="custom-form" action="" method="get">
        <input type="text" name="id" placeholder="Entrez votre identifiant" required>
        <input type="submit" value="Valider">
    </form>';

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $stmt = $mysqli->prepare("SELECT * FROM demande WHERE idEtudiant = ?");
        if ($stmt) {
            $stmt->bind_param('s', $_GET['id']); 
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='demande'>
                    <form class='demande-form'>
                        <h2>Demande de l'étudiant ID: " . htmlspecialchars($row["idEtudiant"]) . "</h2>
                        <label>Nom:<input type='text' value='" . htmlspecialchars($row["nom"]) . "' readonly> </label>
                        <label>Prénom:<input type='text' value='" . htmlspecialchars($row["prenom"]) . "' readonly> </label>
                        <label>Email:<input type='email' value='" . htmlspecialchars($row["adresseMail"]) . "' readonly> </label>
                        <label>Spécialité:<input type='text' value='" . htmlspecialchars($row["specialite"]) . "' readonly> </label>
                        <label>Sujet:<input type='text' value='" . htmlspecialchars($row["sujet"]) . "' readonly></label>
                        <label>Description du Sujet:<textarea readonly>" . htmlspecialchars($row["descriptionSujet"]) . "</textarea></label>
                    </form>
                    </div>";
                }
            } else {
                echo "<p> Aucun résultat trouvé.</p>";
            }
            $stmt->close();
        }
    }

    $mysqli->close();
    ?>
    <div class="return-button-container">
        <a href="gestion.html"> Revenir à la page des gestions </a>
    </div>
</body>
</html>
