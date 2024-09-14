<?php
// Set timezone to Rwanda
date_default_timezone_set('Africa/Kigali');
$current_date_time = date('Y-m-d H:i:s');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Panel</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            position: relative;
        }
        .header img {
            height: 100px;
            vertical-align: middle;
        }
        .header .welcome-message {
            margin-top: 10px;
            font-size: 1.2em;
        }
        .header .date-time {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
</head>
<body>

<div class="header">
    <img src="../uploads/logo.png" alt="Website Logo">
    <div class="welcome-message">WELCOME TO BEST SCHOLARS</div>
    <div class="date-time"><?php echo $current_date_time; ?></div>
</div>

</body>
</html>
