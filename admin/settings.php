<?php
session_start();
include('../includes/db.php');

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

include('headerAdmin.php');

// Fetch website settings from database
$sql = "SELECT * FROM website_settings LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $settings = $result->fetch_assoc();
} else {
    $settings = array(
        'name' => '',
        'contact_email' => '',
        'contact_phone' => '',
        'contact_location' => '',
        'logo_image' => ''
    );
}

$uploadError = "";
$uploadSuccess = "";

// Handle form submission to update settings
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $site_name = $_POST['site_name'];
    $contact_email = $_POST['contact_email'];
    $contact_phone = $_POST['contact_phone'];
    $contact_location = $_POST['contact_location'];
    $logo_image = $settings['logo_image'];

    if (!empty($_FILES['logo_image']['name'])) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["logo_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["logo_image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadError = "File is not an image.";
            $uploadOk = 0;
        }

        if (file_exists($target_file)) {
            $uploadError = "Sorry, file already exists.";
            $uploadOk = 0;
        }

        if ($_FILES["logo_image"]["size"] > 500000) {
            $uploadError = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $uploadError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            $uploadError .= " Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["logo_image"]["tmp_name"], $target_file)) {
                $logo_image = basename($_FILES["logo_image"]["name"]);
                $uploadSuccess = "The file " . htmlspecialchars(basename($_FILES["logo_image"]["name"])) . " has been uploaded.";
            } else {
                $uploadError = "Sorry, there was an error uploading your file.";
            }
        }
    }

    $sql_update = "UPDATE website_settings SET name=?, contact_email=?, contact_phone=?, contact_location=?, logo_image=? WHERE id=1";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("sssss", $site_name, $contact_email, $contact_phone, $contact_location, $logo_image);
    $stmt->execute();
    $stmt->close();

    header("Location: settings.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Website Settings - Admin Panel</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="tel"] {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-group input[type="file"] {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-group button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-group button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Website Settings</h2>
        <?php
        if (!empty($uploadError)) {
            echo '<p style="color: red;">' . $uploadError . '</p>';
        }
        if (!empty($uploadSuccess)) {
            echo '<p style="color: green;">' . $uploadSuccess . '</p>';
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="site_name">Site Name:</label>
                <input type="text" id="site_name" name="site_name" value="<?php echo htmlspecialchars($settings['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="contact_email">Contact Email:</label>
                <input type="email" id="contact_email" name="contact_email" value="<?php echo htmlspecialchars($settings['contact_email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="contact_phone">Contact Phone:</label>
                <input type="tel" id="contact_phone" name="contact_phone" pattern="[0-9]{10}" value="<?php echo htmlspecialchars($settings['contact_phone']); ?>" required>
                <small>Format: 1234567890</small>
            </div>
            <div class="form-group">
                <label for="contact_location">Contact Location:</label>
                <input type="text" id="contact_location" name="contact_location" value="<?php echo htmlspecialchars($settings['contact_location']); ?>" required>
            </div>
            <div class="form-group">
                <label for="logo_image">Website Logo:</label>
                <input type="file" id="logo_image" name="logo_image" accept="image/*">
            </div>
            <div class="form-group">
                <button type="submit">Update Settings</button>
            </div>
        </form>
    </div>

    <?php include('../includes/footer.php'); ?>
</body>
</html>
