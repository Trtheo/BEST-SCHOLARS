<?php
// Database connection
include('db.php');

// Function to get website settings
function getWebsiteSettings($conn) {
    $sql = "SELECT * FROM website_settings LIMIT 1";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

// Function to fetch scholarships
function getScholarships($conn) {
    $sql = "SELECT * FROM scholarships ORDER BY created_at DESC";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to validate email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate phone number
function validatePhoneNumber($phone) {
    return preg_match('/^[0-9]{10,15}$/', $phone);
}

// Function to sanitize input
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Add more functions as needed
?>
