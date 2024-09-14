<?php
session_start();
include('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];

    // Validate phone number to contain only digits
    if (!preg_match('/^[0-9]+$/', $phone_number)) {
        echo "Phone number can only contain digits.";
        exit();
    }

    // Prepare an SQL statement to prevent SQL injection
    $sql = "INSERT INTO contact_requests (full_name, email, phone_number, address) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $full_name, $email, $phone_number, $address);

    if ($stmt->execute()) {
        echo "<script>alert('Your request has been submitted successfully.'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: contact.php");
    exit();
}
?>
