<?php
session_start();
include 'db.php';
$error = "";

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $user = $result->fetch_assoc();
        if(password_verify($password, $user['password'])){
            $_SESSION['user'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header("Location: admin.php");
            exit;
        } else {
            $error = "Hibás jelszó";
        }
    } else {
        $error = "Nincs ilyen felhasználó";
    }
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bejelentkezés - DropNet</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/bejelentkezes.css" />
</head>
<body>
  <!-- Háttér -->
  <div class="background"></div>

  <!-- Vissza a főoldalra -->
  <div class="back-button">
    <a href="index.html" class="btn">Vissza a főoldalra</a>
  </div>

  <!-- Bejelentkezés űrlap -->
  <div class="login-form">
    <h1>Bejelentkezés</h1>
    <form method="post">
      <input type="text" name="username" placeholder="Felhasználónév" required>
      <input type="password" name="password" placeholder="Jelszó" required>
      <button type="submit">Bejelentkezés</button>
    </form>

    <?php if($error != ""): ?>
      <p style="color:red; text-align:center;"><?php echo $error; ?></p>
    <?php endif; ?>
  </div>  
</body>
</html>
