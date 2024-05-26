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

if (isset($_POST['delete_intern'])) {
    $id = $_POST['id_intern'];
    

    if (!empty($id)) {
        $sql = "DELETE FROM intern WHERE id_intern= ?";
        $stmt = $cnx->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Department deleted successfully";
            header("location: internlist.php");
        } else {
            echo "Failed to delete intern";
        }
    } else {
        echo "intern ID is required";
    }


    // if ($res) {
    // }
}
