<?php
include 'connexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-yHJ3REdZT8IvMU2r+oy6T7GO3S/D3vIZtXnYAnZjvZaA8bmG5txa2PyR9LM1R+wS" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-iKsHBGBiJ4mMbFDtv3kWlBTv58/KG1ZGcfXAZy0klGBb3mzhE7H6gTTPf+tcJvP2Qmm0PMiGKDBwQhR7I+VzPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../CSS/formetudiant.css">
    <title>Formulaire étudiant</title>
    <style>
        .detail-card {
            background-color: #f4f4f4;
            border: 1px solid #ddd;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
        }

        .detail-card h2 {
            color: #333;
            font-family: 'Arial', sans-serif;
        }

        .detail-card p {
            color: #666;
            font-family: 'Arial', sans-serif;
            line-height: 1.5;
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
   
    <?php
    if (
        isset($_POST['identifiant'], $_POST['Nom'], $_POST['Prenom'], $_POST['Mail'], $_POST['Spec'], $_POST['NomSociete'], $_POST['Sujet'], $_POST['Desc']) &&
        !empty($_POST['identifiant']) && !empty($_POST['Nom']) && !empty($_POST['Prenom']) && !empty($_POST['Mail']) && !empty($_POST['Spec']) && !empty($_POST['NomSociete']) &&
        !empty($_POST['Sujet']) && !empty($_POST['Desc'])
    ) {

        $stmt = $mysqli->prepare("INSERT INTO demande VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $_POST['identifiant'], $_POST['Nom'], $_POST['Prenom'], $_POST['Mail'], $_POST['Spec'], $_POST['NomSociete'], $_POST['Sujet'], $_POST['Desc']);

        if ($stmt->execute()) {
            echo "La demande a été ajoutée avec succès.<br>";
            $stmt->close(); 

            header("Location: ../HTML/selection.html");
            exit(); 
        } else {
            echo "Erreur : " . $stmt->error . "<br>";
        }

        $stmt->close();
    }
    $mysqli->close();
    ?>
</body>
</html>
