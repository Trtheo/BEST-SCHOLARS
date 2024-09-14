<?php
session_start();
include('includes/db.php');

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $scholarship_id = $_POST['scholarship_id'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];

    // Insert the request into the database
    $sql = "INSERT INTO public_user_requests (scholarship_id, full_name, email, phone_number, address)
            VALUES ('$scholarship_id', '$full_name', '$email', '$phone_number', '$address')";
    
    if ($conn->query($sql) === TRUE) {
        $_SESSION['request_sent'] = true;
    } else {
        $_SESSION['request_sent'] = false;
    }
}

header('Location: scholarships.php');
exit();
