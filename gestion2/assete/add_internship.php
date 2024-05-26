<?php
session_start();
include 'cnx.php';

// Check if the necessary session variables are set and not empty
if (
    isset($_COOKIE['id_admin'], $_COOKIE['admin']) &&
    !empty($_COOKIE['id_admin']) && !empty($_COOKIE['admin'])
) {
    $id = $_COOKIE['id_admin'];// c'est l'ID de luser connectee
    $admin = $_COOKIE['admin'];
} else {
    header("location: login.php");
    exit();
}

if (isset($_POST['addintern'])) {
    $departement = $_POST['id_dept'];
    $id_intern = $_POST['intern_id'];
    $starting_day = $_POST['starting_day'];
    $ending_day = $_POST['ending_day'];
    
    // Construire la requête SQL avec les valeurs récupérées du formulaire
    $query = "INSERT INTO `internship`(`id_intern`,`id_dep`,`id_admin`,`starting_day`,`ending_day`) 
    VALUES ($id_intern,$departement,$id,'$starting_day','$ending_day')";
 
    // Exécuter la requête
    $res = mysqli_query($cnx, $query);

    // Vérifier si la requête s'est bien exécutée
    if ($res) {
        header("location: internship.php");
    } else {
        echo "Erreur lors de l'exécution de la requête : " . mysqli_error($cnx);
    }
}