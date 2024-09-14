<?php
session_start();
include('../includes/db.php');

// Check if the admin is logged in
// if (!isset($_SESSION['admin'])) {
//     header('Location: login.php');
//     exit();
// }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - BEST SCHOLARS</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="../js/script.js"></script>
</head>
<body>
    <?php include('../includes/header.php'); ?>
    
    <!-- <div class="container">
        <h1>Admin Dashboard</h1>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="add_scholarship.php">Add Scholarship</a></li>
                <li><a href="view_requests.php">View Requests</a></li>
                <li><a href="settings.php">Settings</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </div>
     -->
    <?php include('../includes/footer.php'); ?>
</body>
</html>
