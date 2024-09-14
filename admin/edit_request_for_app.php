<?php
session_start();
include('../includes/db.php');
include('admin_check.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $request_id = $_GET['id'];

    // Fetch request details
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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $request_id = $_POST['request_id'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];

    // Update request in database
    $sql = "UPDATE public_user_requests SET full_name = ?, email = ?, phone_number = ?, address = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $full_name, $email, $phone_number, $address, $request_id);
    $stmt->execute();
    $stmt->close();

    // Redirect back to view_requests.php or show success message
    header("Location: view_request_for_app.php?id=$request_id");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Request - Admin Panel</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include('headerAdmin.php'); ?>
    <div class="container">
        <h2>Edit Request</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" value="<?php echo $request['full_name']; ?>" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $request['email']; ?>" required>
            <label for="phone_number">Phone Number:</label>
            <input type="tel" id="phone_number" name="phone_number" value="<?php echo $request['phone_number']; ?>" pattern="[0-9]{10}" required>
            <label for="address">Address:</label>
            <textarea id="address" name="address" required><?php echo $request['address']; ?></textarea>
            <button type="submit" name="submit">Update Request</button>
        </form>
    </div>

    <?php include('../includes/footer.php'); ?>
</body>
</html>
