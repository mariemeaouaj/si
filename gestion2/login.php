<?php
session_start();
include 'assete/cnx.php';

if (isset($_POST['login'])) {
  $name = $_POST['name'];
  $password = $_POST['password'];
  $q = $cnx->prepare("SELECT * FROM user WHERE user_name = ?");
  $q->bind_param("s", $name);
  $q->execute();
  $result = $q->get_result();
  if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();

    if ($password === $data['password']) {
      $_SESSION['id_admin'] = $data['id_admin'];
      $_SESSION['admin'] = $data['user_name'];

      if (isset($_POST['check'])) {
        setcookie('id_admin', $data['id_admin'], time() + (86400 * 30), "/");
        setcookie('admin', $data['user_name'], time() + (86400 * 30), "/");
      } else {
        // Clear the cookies if "Remember me" is not checked
        setcookie('id_admin', '', time() - 3600, "/");
        setcookie('admin', '', time() - 3600, "/");
      }

      header("Location: assete/afterlogin.php");
      exit;
    } else {
      echo "Invalid password";
    }
  } else {
    echo "Invalid username";
  }
}

if (isset($_COOKIE['id_admin'], $_COOKIE['admin']) && !empty($_COOKIE['id_admin']) && !empty($_COOKIE['admin'])) {
  $_SESSION['id_admin'] = $_COOKIE['id_admin'];
  $_SESSION['admin'] = $_COOKIE['admin'];
  header("Location: assete/afterlogin.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login page</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" />
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container">
    <div class="login-box">
      <h2>Login</h2>
      <form action="login.php" method="post">
        <div class="input-box">
          <input type="text" name="name" required />
          <label>Email</label>
        </div>
        <div class="input-box">
          <input type="password" name="password" required />
          <label>Password</label>
        </div>
        <div class="forgot">
          <section>
            <input type="checkbox" id="check" name="check">
            <label for="check">Remember me</label>
          </section>
        </div>
        <button type="submit" class="btn" name="login">Login</button>
      </form>
    </div>
  </div>
</body>
</html>