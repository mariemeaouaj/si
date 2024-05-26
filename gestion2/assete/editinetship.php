<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Internship</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        select,
        input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button.add {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        button.add:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
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
    if (isset($_GET['id'])) {
        $idinternship = htmlspecialchars($_GET['id']);//kat7wl html sous forme charactere

        $internship_query = "SELECT * FROM internship WHERE id_internship = $idinternship";
        $internship_result = mysqli_query($cnx, $internship_query);
        if ($internship_result && mysqli_num_rows($internship_result) > 0) {
           $internship_details = mysqli_fetch_assoc($internship_result);
        
        } else {
            echo "Internship not found.";
            exit();
        }
    } else {
        echo "ID parameter not set.";
    }
    ?>
    <form action="update_internship.php" method="POST">
        <input type="hidden" value="<?php echo $internship_details['id_internship'] ?>" name="idinternship"
        />
        <div class="form-group">
            <label for="Departement">Departement</label>
            <select id="id_dept" name="id_dept">
                <option disabled selected> Select department </option>
                <?php
                $departement = "SELECT * FROM departement WHERE id_admin=$id";
                $resultat = mysqli_query($cnx, $departement);

                if ($resultat) {
                    while ($rowws = mysqli_fetch_assoc($resultat)) {
                        $id_dep = $rowws['id_dep'];
                        ?>
                        <option value="<?= $id_dep ?>" <?= ($id_dep === $internship_details['id_dep']) ? 'selected' : '' ?>>
                            <?= $rowws['departement'] ?>
                        </option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="Intern">Intern</label>
            <select id="id_intern" name="id_intern">
                <option disabled selected> Select intern </option>
                <?php
                $intern = "SELECT * FROM intern WHERE id_admin=$id";
                $resultat = mysqli_query($cnx, $intern);

                if ($resultat) {
                    while ($rowws = mysqli_fetch_assoc($resultat)) {
                        $id_intern = $rowws['id_intern'];
                ?>
                <option value="<?= $id_intern?>" <?= ($id_intern === $internship_details['id_intern']) ? 'selected' : '' ?>>
                        
                            <?= $rowws['first_name'] . ' ' . $rowws['last_name'] ?>
                        </option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="starting_day">Starting day:</label>
            <input type="date" id="starting_day" name="starting_day" value="<?php echo $internship_details['starting_day'] ?>" required>
        </div>
        <div class="form-group">
            <label for="ending_day">Ending day:</label>
            <input type="date" id="ending_day" name="ending_day" value="<?php echo $internship_details['ending_day'] ?>" required>
        </div>
        <button type="submit" class="add" name="updateinternship">Update</button>
    </form>
</body>

</html>