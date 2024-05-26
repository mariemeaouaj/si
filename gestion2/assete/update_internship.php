<?php
session_start();
include 'cnx.php';

// Check if the necessary session variables are set and not empty
if (
    isset($_COOKIE['id_admin'], $_COOKIE['admin']) &&
    !empty($_COOKIE['id_admin']) && !empty($_COOKIE['admin'])
) {
    $id = $_COOKIE['id_admin'];
    $admin = $_COOKIE['admin'];
} else {
    header("location: login.php");
    exit();
}


if (isset($_POST['updateinternship'])) {
    $departement = $_POST['id_dept'];
    $intern = $_POST['id_intern'];
    $starting_day = $_POST['starting_day'];
    $ending_day = $_POST['ending_day'];
    $id_internship = $_POST['idinternship'];
//echo  $id_internship ;
    // Create the SQL query
   $sql = "UPDATE internship SET id_intern='$intern', id_dep='$departement', starting_day='$starting_day', ending_day='$ending_day' WHERE id_internship='$id_internship'";
//echo  $sql;
    // Execute the query
    $result = mysqli_query($cnx, $sql);
//echo $departement,$intern,$starting_day, $ending_day,$id_internship; 
    //Check if the query was successful
  if ($result) {
        //echo "Intern updated successfully";
    header("location: internship.php");
        exit(); // After header redirect, exit to prevent further execution
    } else {
       echo "Failed to update internship";
    }
}