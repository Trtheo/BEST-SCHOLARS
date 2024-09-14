<?php
session_start();
include('../includes/db.php');

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $request_id = $_GET['id'];

    if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
        // Delete request from database
        $sql = "DELETE FROM contact_requests WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $request_id);
        $stmt->execute();
        $stmt->close();

        // Redirect back to view_requests_for_contact.php after deletion
        header("Location: view_requests_for_contact.php");
        exit();
    }
} else {
    // Redirect if accessed directly without request ID
    header("Location: view_requests_for_contact.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Contact Request - Admin Panel</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">
    <h2>Delete Contact Request</h2>
    <p>Are you sure you want to delete this request?</p>
    <a href="delete_contact_request.php?id=<?php echo $request_id; ?>&confirm=yes">Yes</a>
    <a href="view_requests_for_contact.php">No</a>
</div>

<?php include('../includes/footer.php'); ?>

</body>
</html>
