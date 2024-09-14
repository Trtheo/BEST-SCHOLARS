<?php
session_start();
include('../includes/db.php');

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $request_id = $_GET['id'];

    // Fetch request details to display confirmation
    $sql = "SELECT * FROM public_user_requests WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $request_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $request = $result->fetch_assoc();
    } else {
        echo "Request not found.";
        exit();
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete'])) {
    // Proceed with deletion
    $request_id = $_POST['request_id'];

    $sql = "DELETE FROM public_user_requests WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $request_id);
    $stmt->execute();
    $stmt->close();

    // Redirect back to view_requests.php after deletion
    header("Location: view_request_for_app.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Request - Admin Panel</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">
    <h2>Delete Request</h2>
    <p>Are you sure you want to delete the following request?</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
        <p><strong>Request ID:</strong> <?php echo $request['id']; ?></p>
        <p><strong>Full Name:</strong> <?php echo $request['full_name']; ?></p>
        <p><strong>Email:</strong> <?php echo $request['email']; ?></p>
        <p><strong>Phone Number:</strong> <?php echo $request['phone_number']; ?></p>
        <p><strong>Address:</strong> <?php echo $request['address']; ?></p>
        <button type="submit" name="confirm_delete">Confirm Delete</button>
        <a href="view_request_for_app.php">Cancel</a>
    </form>
</div>

<?php include('../includes/footer.php'); ?>

</body>
</html>
