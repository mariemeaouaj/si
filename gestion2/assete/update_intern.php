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


if (isset($_POST['updateintern'])) {
    echo"good";
    $firstName = $_POST['First_Name'];
    $lastName = $_POST['Last_Name'];
    $birthday = $_POST['Birthday'];
    
    $id = $_POST['id_intern'];
    

    if (!empty($firstName)) {
        $sql = "UPDATE intern SET first_name = ?,last_name = ?,birthday = ? WHERE id_intern = ?";
        
        $stmt = $cnx->prepare($sql);
        $stmt->bind_param("sssi", $firstName, $lastName, $birthday, $id);
        $stmt->execute();
      
        if ($stmt->affected_rows > 0) {
            echo "intern updated successfully";
            header("location: internlist.php");
        } else {
            echo "Failed to update intern";
        }
    } else {
        echo "intern name is required";
    }
}
