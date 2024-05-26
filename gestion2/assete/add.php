<?php
session_start();
include 'cnx.php';

// Check if the necessary session variables are set and not empty
if (
    isset($_COOKIE['id_admin'], $_COOKIE['admin']) &&
    !empty($_COOKIE['id_admin']) && !empty($_COOKIE['admin'])
) {
    $id = $_COOKIE['id_admin']; // c'est l'ID de l'utilisateur connecté
    $admin = $_COOKIE['admin'];
} else {
    header("location: login.php");
    exit();
}

if (isset($_POST['add'])) {
    // Échapper les valeurs des champs du formulaire pour prévenir les injections SQL
    $departement = mysqli_real_escape_string($cnx, $_POST['departement']);
    $prenom = mysqli_real_escape_string($cnx, $_POST['prenom']);
    $adresse = mysqli_real_escape_string($cnx, $_POST['adresse']);
    $tele = mysqli_real_escape_string($cnx, $_POST['tele']);

    // Préparation de la requête SQL avec des paramètres pour éviter les injections SQL
    $query = "INSERT INTO departement (departement, prenom, adresse, tele, id_admin) VALUES (?, ?, ?, ?, ?)";
    
    // Préparation de la requête
    $stmt = mysqli_prepare($cnx, $query);
    
    // Liaison des valeurs aux paramètres
    mysqli_stmt_bind_param($stmt, "ssssi", $departement, $prenom, $adresse, $tele, $id);

    // Exécution de la requête
    $res = mysqli_stmt_execute($stmt);

    if ($res) {
        header("location: Dashboard.php");
    } else {
        // Gestion des erreurs
        echo "Erreur : " . mysqli_error($cnx);
    }
}
?>
