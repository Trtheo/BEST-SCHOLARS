<?php
// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include database connection
include('db.php');

// Fetch website settings
$sql = "SELECT * FROM website_settings LIMIT 1";
$result = $conn->query($sql);
$settings = $result->fetch_assoc();

// Set timezone to Africa/Kigali (Rwanda)
date_default_timezone_set('Africa/Kigali');

// Fetch current date and time
$current_date = date('l, F j, Y');
$current_time = date('h:i A');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $settings['name'] ?? 'BEST SCHOLARS'; ?></title>
    <link rel="stylesheet" type="text/css" href="../bestscholars/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->
    <script src="../js/script.js"></script>
    <style>
        /* Include the CSS provided earlier */

        /* Additional CSS for menu icon visibility */
        .menu-icon {
            display: none; /* Hide by default */
            font-size: 34px;
            color: #fff;
            cursor: pointer;
            margin-right: 20px;
        }

        /* Show menu icon on small devices */
        @media (max-width: 768px) {
            .menu-icon {
                display: block; /* Show on small devices */
            }
            
            nav {
                display: none; /* Hide nav by default on small devices */
                flex-direction: column;
                align-items: center;
                width: 100%;
                background-color:gray;
                position: absolute;
                top:0;
                left: 0;
                z-index: 1000;
            }

            nav.active {
                display: flex; /* Show nav when active */
            }

            nav a {
                padding: 10px;
                font-size: 19px;
                display: block;
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-top-content">
            <img src="../bestscholars/uploads/<?php echo $settings['logo_image'] ?? 'logo.png'; ?>" alt="Website Logo" class="logo">
            <p>Welcome To <strong><u><?php echo $settings['name'] ?? 'BEST SCHOLARS'; ?></u></strong> <br><br> <?php echo $current_date . ' ' . $current_time; ?></p>
        </div>

        <div class="header-main">
            <!-- Menu Icon for mobile view -->
            <div class="menu-icon" onclick="toggleMenu()">
                <i class="fas fa-bars"></i>
            </div>

            <nav>
                <a href="../bestscholars/">Home</a>
                <a href="../bestscholars/scholarships.php">Trending Scholarships</a>
                <a href="../bestscholars/employment.php">Job Opportunities</a>
                <a href="../bestscholars/about.php">About Us</a>
                <a href="../bestscholars/contact.php">Contact Us</a>
                <a href="../bestscholars/Testmonials.php">Testmonials</a>
                <a href="../bestscholars/admin/login.php">Staff Login</a>
            </nav>
        </div>
    </header>

    <script>
        function toggleMenu() {
            const nav = document.querySelector('header nav');
            nav.classList.toggle('active');
        }
    </script>
</body>
</html>
