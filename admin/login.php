<?php
session_start();
include('../includes/db.php');
include('headerLogin.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['admin'] = $email;
        header('Location: dashboard.php');
    } else {
        echo " <p style='color:red;font-size:20px;'>User_Name or Password is Incorrect!</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <h2><center>ADMIN LOGIN PANEL</center><h2>
    <form method="POST" action="">
        <label>USER_NAME</label>
        <input type="email" name="email" required >
        <label>PASSWORD</label>
        <input type="password" name="password"  required>
        <button type="submit">Login</button>
      
    </form>
</body>
</html>
