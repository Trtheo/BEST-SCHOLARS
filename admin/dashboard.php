<?php
session_start();
include('headerAdmin.php');
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

include('../includes/db.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <h1>Welcome to Admin Dashboard</h1>
</body>
</html>
