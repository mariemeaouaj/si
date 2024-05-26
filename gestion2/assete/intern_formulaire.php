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
}

if (isset($_POST['addintern'])) {
    
    $first_Name = $_POST['First_Name'];
    $last_Name = $_POST['Last_Name'];
    $birthday =  ($_POST['Birthday']);
    $sql = "INSERT INTO intern (id_admin,First_Name, Last_Name, Birthday) VALUES ('$id','$first_Name', '$last_Name', '$birthday')";

    // Execute the query
   
    $res = mysqli_query($cnx,$sql);

    if ($res) {
        header("location: internlist.php");
       
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('https://cdn.pixabay.com/photo/2012/02/28/10/16/blue-18042_960_720.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            width: 80%;
            max-width: 300px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        .add {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

       .add {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<form action="intern_formulaire.php" method="POST">
            
            <div class="form-group">
                <label for="First_Name">First Name:</label>
                <input type="text" id="first_name" name="First_Name" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="Last_Name" required>
            </div>
            <div class="form-group">
                <label for="birthday">Birthday:</label>
                <input type="date" id="birthday" name="Birthday" required>
            </div>
            <button type="submit" class="add" name="addintern">ADD </button>
        </form>
    
        </div>
    
</body>
</html>