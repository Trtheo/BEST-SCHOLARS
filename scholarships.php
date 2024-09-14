<?php
session_start();
include('includes/db.php');
include('includes/header.php');

// Fetch scholarships and their start/end dates from the database
$sql = "SELECT id, title, description, start_date, end_date, image FROM scholarships";
$result = $conn->query($sql);

// Check if form was submitted and display success message
$requestSent = false;
if (isset($_SESSION['request_sent'])) {
    $requestSent = $_SESSION['request_sent'];
    unset($_SESSION['request_sent']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scholarships</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
          
        }
        .scholarship-item {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .scholarship-item h3 {
            margin-top: 0;
        }
        .scholarship-item p {
            margin: 5px 0;
        }
        .scholarship-item img {
            width: 100%;
            height: 40%;
            display: block;
            margin-bottom: 10px;
        }
        .request-button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 1px solid #ccc;
            padding: 20px;
            background-color: white;
            z-index: 1000;
            width: 50%;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .popup.active {
            display: block;
        }
        .popup label {
            display: block;
            margin-bottom: 5px;
        }
        .popup input, .popup textarea {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
        }
        .popup button {
            padding: 10px 15px;
            background-color:#007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        .popup button.close {
            background-color: #f44336;
        }
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 500;
        }
        .overlay.active {
            display: block;
        }
        .success-box {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #dff0d8;
            color: #3c763d;
            z-index: 1000;
            width: 50%;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .success-box.active {
            display: block;
        }
    </style>
    <script>
        function toggleForm(id) {
            var form = document.getElementById('popup-form-' + id);
            var overlay = document.getElementById('overlay');
            form.classList.toggle('active');
            overlay.classList.toggle('active');
        }
        function closeForm(id) {
            var form = document.getElementById('popup-form-' + id);
            var overlay = document.getElementById('overlay');
            form.classList.remove('active');
            overlay.classList.remove('active');
        }
        function closeSuccessBox() {
            var successBox = document.getElementById('success-box');
            successBox.classList.remove('active');
        }
    </script>
</head>
<body>

<?php if ($requestSent) { ?>
    <div id="success-box" class="success-box active">
        <p>Your Request Sent Successfully</p>
        <button onclick="closeSuccessBox()">Close</button>
    </div>
<?php } ?>

<div class="container">
    <h2>List of Scholarships</h2>
    <div class="scholarship-list">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="scholarship-item">
                <img src="uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?> Image">
                <h3><?php echo $row['title']; ?></h3>
                <p><strong>Description:</strong> <?php echo $row['description']; ?></p>
                <p><strong>Start Date:</strong> <?php echo $row['start_date']; ?></p>
                <p><strong>End Date:</strong> <?php echo $row['end_date']; ?></p>
                <button type="button" class="request-button" onclick="toggleForm(<?php echo $row['id']; ?>)">
                    Request Application Service Now
                </button>
            </div>
        <?php } ?>
    </div>

    <?php
    // Reset the result pointer to the beginning for displaying forms
    $result->data_seek(0);
    while ($row = $result->fetch_assoc()) { ?>
        <div id="popup-form-<?php echo $row['id']; ?>" class="popup">
            <form action="submit_request.php" method="post">
                <input type="hidden" name="scholarship_id" value="<?php echo $row['id']; ?>">
                <label for="full_name_<?php echo $row['id']; ?>">Full Name:</label>
                <input type="text" id="full_name_<?php echo $row['id']; ?>" name="full_name" required>
                <label for="email_<?php echo $row['id']; ?>">Email:</label>
                <input type="email" id="email_<?php echo $row['id']; ?>" name="email" required>
                <label for="phone_number_<?php echo $row['id']; ?>">Phone Number:</label>
                <input type="tel" id="phone_number_<?php echo $row['id']; ?>" name="phone_number" pattern="[0-9]{10}" required>
                <label for="address_<?php echo $row['id']; ?>">Address (Province, District, Sector):</label>
                <textarea id="address_<?php echo $row['id']; ?>" name="address" placeholder="Province, District, Sector" required></textarea>
                <button type="submit">Submit Request</button>
                <button type="button" class="close" onclick="closeForm(<?php echo $row['id']; ?>)">Close</button>
            </form>
        </div>
    <?php } ?>

    <div id="overlay" class="overlay"></div>
</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
