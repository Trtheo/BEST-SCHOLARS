<?php
date_default_timezone_set('Africa/Kigali');
// Fetch current date and time
$current_date = date('l, F j, Y');
$current_time = date('h:i A');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Your CSS styles */
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
            height: 130px;
            vertical-align: middle;
        }
        .header .date-time {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
        }
        .nav {
            display: flex;
            justify-content: center;
            background-color: #333;
            flex-wrap: wrap;
        }
        .nav a {
            padding: 14px 20px;
            display: block;
            color: white;
            text-align: center;
            text-decoration: none;
            flex: 1 0 100%;
        }
        .nav a:hover {
            background-color: #ddd;
            color: black;
        }
        @media (min-width: 600px) {
            .nav a {
                flex: 1 0 auto;
            }
        }
        @media (max-width: 600px) {
            .header img {
                height: 100px;
            }
            .header h2 {
                font-size: 1.2em;
            }
            .header .date-time {
                position: static;
                transform: none;
                margin-top: 10px;
            }
            .nav a {
                padding: 10px;
            }
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: -250px; /* Initially hidden */
            width: 250px;
            height: 50%;
            background-color: #152022;
            color: white;
            transition: left 0.3s;
            z-index: 1100;
            padding-top: 20px;
        }
        .sidebar.open {
            left: 0; /* Slide in when open */
        }
        .sidebar nav a {
            display: block;
            padding: 15px;
            color: rgb(16, 14, 14);
            background: #f4f4f4;
            text-align: center;
        }
        .sidebar nav a:hover {
            background-color: #128c7e;
        }
        .sidebar .close-btn {
            position: absolute;
            top: 20px;
            right: 10px;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }
        .nav-toggle {
            display: none;
            font-size: 1.5rem;
            cursor: pointer;
        }
        @media (max-width: 768px) {
            .nav {
                display: none;
            }
            .nav-toggle {
                display: block;
                position: absolute;
                top: 15px;
                left: 15px;
                color: white;
            }

            
        }

    </style>
</head>
<body>
    <header>
        <div class="header-top">
            <div class="header-top-content">
                <img src="../uploads/logo.png" alt="Website Logo" class="logo">
                <p>Welcome To <strong><u><?php echo htmlspecialchars($settings['name'] ?? 'BEST SCHOLARS'); ?></u></strong> <br><br>   <?php echo $current_date . ' ' . $current_time; ?> 
            </p>
            </div>
            <div class="nav-toggle"><i class="fas fa-bars"></i></div>
        </div>
        <div class="header-main">
            <nav class="nav">
                <a href="add_scholarship.php">Add Scholarship</a>
                <a href="view_request_for_app.php">View Requests For Application</a>
                <a href="settings.php">Settings</a>
                <a href="view_requests_for_contact.php">View Contacts</a>
                <a href="view_scholarships.php">View Scholarship List</a>
                <a href="logout.php">Logout</a>
            </nav>
        </div>
    </header>

    <div class="sidebar">
        <span class="close-btn">&times;</span>
        <nav>
            <a href="add_scholarship.php">Add Scholarship</a>
            <a href="view_request_for_app.php">View Requests For Application</a>
            <a href="settings.php">Settings</a>
            <a href="view_requests_for_contact.php">View Contacts</a>
            <a href="view_scholarships.php">View Scholarship List</a>
            <a href="logout.php">Logout</a>
        </nav>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var sidebar = document.querySelector('.sidebar');
            var toggleBtn = document.querySelector('.nav-toggle');
            var closeBtn = document.querySelector('.close-btn');

            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('open');
            });

            closeBtn.addEventListener('click', function() {
                sidebar.classList.remove('open');
            });
        });
    </script>
</body>
</html>
