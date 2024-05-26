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
    header("location: intern_formulaire.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>intern</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 0px 20px 0px 20px;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        
        h2 {
            font-size: 32px;
            text-align: center;
        }
        
        .intern {
            display: grid;
            grid-template-columns: 250px auto;
            min-height: 100vh;
        }
        
        .sidebar {
            background-color: #67a8ed;
            color: #fff;
        }
        
        .sidebar h2 {
            margin-top: 0;
        }
        
        .main-content {
            padding: 20px;
        }
        
        .sidebar ul {
            list-style: none;
            margin: auto;
        }
        
        .user-img {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .user-img img {
            width: 100%;
            object-fit: cover;
        }
        
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
            margin-top: 30px;
            text-align: center;
            font-size: 23px;
        }
        
        .sidebar a:hover {
            text-decoration: underline;
        }
        
        h1 {
            color: #6460e3;
            font-size: 32px;
            font-weight: 700;
        }
        
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #007bff;
            color: white;
        }
        
        .action-icons {
            font-size: 18px;
            margin-right: 5px;
            cursor: pointer;
        }
        
        #delete {
            color: red;
        }
        
        #update {
            color: blue;
        }
        
        input[type="text"] {
            width: 400px;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        
        button {
            padding: 5px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff !important;
            font-size: 16px !important;
            font-weight: bold !important;
            cursor: pointer;
        }
        
        .names-container {
            margin-top: 20px;
        }
        
        #nameForm {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: auto;
            width: 60%;
            background-color: #007bff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 5px;
        }
        
        .btn {
            background-color: teal !important;
            margin: 0 20px !important;
        }
        
        #updateDepartement {
            width: 500px !important;
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
    <div class="intern">
        <!-- Sidebar -->
        <div class="sidebar">
            <a href="Dashboard.php">
                <h2>Departement</h2>
            </a>
            <a href="internlist.php">
                <h2>Intern</h2>
            </a>
            <a href="internship.php">
                <h2>Internship</h2>
            </a>
            <ul>
                <li><a href="logout.php"><h2>LogOut</h2></a></li>
            </ul>
        </div>
        <!-- Main Content -->
        <div class="main-content">
            <h1>Gestion intern</h1>
            <div class="my-2">
                <!-- Trigger the modal with a button -->
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add intern</button>
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-body">
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
                                    <button type="submit" class="add" name="addintern">ADD</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>first_name</th>
                        <th>last_name</th>
                        <th>birthday</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $aff = "SELECT * FROM intern WHERE id_admin=$id";
                    $res = mysqli_query($cnx, $aff);

                    if ($res) {
                        while ($rowws = mysqli_fetch_assoc($res)) {
                            $id_intern = $rowws['id_intern'];
                    ?>
                            <tr>
                                <td><?= $id_intern ?></td>
                                <td><?= $rowws['first_name'] ?></td>
                                <td><?= $rowws['last_name'] ?></td>
                                <td><?= $rowws['birthday'] ?></td>
                                <td>
                                    <i class="fas fa-edit action-icons" id="update" onclick="openEditModal(<?= $id_intern ?>, '<?= $rowws['first_name'] ?>','<?= $rowws['last_name'] ?>','<?= $rowws['birthday'] ?>')"></i>
                                    <i class="fas fa-trash-alt action-icons" id="delete" onclick="openDeleteModal(<?= $id_intern ?>)"></i>
                                </td>
                            </tr>
                    <?php
                        }
                    } elseif (!$res) {
                        die("Query failed: " . mysqli_error($cnx));
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap Modal for Update -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update intern</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateForm" method="post" action="update_intern.php">
                        <div class="form-group">
                            <input type="hidden" name="id_intern" id="updateId">
                        </div>
                        <div class="form-group">
                            <label for="First_Name">First Name:</label>
                            <input type="text" id="updatfirst_name" name="First_Name" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="text" id="updatlast_name" name="Last_Name" required>
                        </div>
                        <div class="form-group">
                            <label for="birthday">Birthday:</label>
                            <input type="date" id="updatbirthday" name="Birthday" required>
                        </div>
                        <button type="submit" class="btn" name="updateintern">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Modal for Delete -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete intern</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this intern?</p>
                    <form id="deleteForm" method="post" action="delete_intern.php">
                        <input type="hidden" name="id_intern" id="deleteId">
                        <button type="submit" name="delete_intern" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Function to open Update Modal
        function openEditModal(id, first_name, last_name, birthday) {
            $('#updateId').val(id);
            $('#updatfirst_name').val(first_name);
            $('#updatlast_name').val(last_name);
            $('#updatbirthday').val(birthday);
            $('#updateModal').modal('show');
        }

        // Function to open Delete Modal
        function openDeleteModal(id) {
            $('#deleteId').val(id);
            $('#deleteModal').modal('show');
        }
    </script>
</body>

</html>
