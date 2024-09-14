<?php
// request_application.php
session_start();
include('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['scholarship_id'])) {
    $scholarship_id = $_POST['scholarship_id'];
    
    // Store the request in the public_user_requests table
    $sql = "INSERT INTO public_user_requests (scholarship_id, full_name, email, phone_number, address) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    // Replace these placeholders with actual user data or gather them through a form
    $full_name = "John Doe"; // Replace with actual data
    $email = "johndoe@example.com"; // Replace with actual data
    $phone_number = "1234567890"; // Replace with actual data
    $address = "123 Main St"; // Replace with actual data
    $stmt->bind_param("issss", $scholarship_id, $full_name, $email, $phone_number, $address);
    
    if ($stmt->execute()) {
        // Redirect to the admin view_request_for_app page with the request ID
        $request_id = $stmt->insert_id;
        header("Location: admin/view_request_for_app.php?id=$request_id");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Scholarship ID not provided.";
}
?>
