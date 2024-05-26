<?php
session_start();

if (!isset($_SESSION['id_admin']) || empty($_SESSION['id_admin'])) {
  header("Location: ../login.php");
  exit();
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choix</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: url('https://media.istockphoto.com/photos/light-blue-paper-color-with-texture-for-background-picture-id1095286208?k=6&m=1095286208&s=170667a&w=0&h=wWBdZbQzn_zIsceTslZqy-rQSm6-Y19LC3WVSpLMkOw=') no-repeat center center fixed;
            background-size: cover;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 90vh;
            justify-content: flex-start;
        }

        .title {
            font-size: 50px;
            color: black;
            text-shadow: none;
            margin: 50px 0;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-grow: 1;
        }

        .button-group {
            margin-top: 20px;
        }

        .button-group a {
            background-color: #011e3d;
            color: white;
            text-decoration: none;
            padding: 50px 50px; /* Agrandit les boutons */
            margin: 60px;
            font-size: 25px; /* Augmente la taille de la police */
            display: inline-block;
            border-radius: 100px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .button-group a:hover {
            background-color: #4e8ed2;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <h1 class="title">Intern Management</h1>
    <div class="container">
       
        <div class="button-group">
            <a href="Dashboard.php">Département</a>
            <a href="internlist.php">Intern</a>
            <a href="internship.php">Internship</a>
        </div>
    </div>
</body>
</html>