<?php
session_start();
include('../includes/db.php');

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $request_id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];

    // Update request in database
    $sql = "UPDATE contact_requests SET full_name = ?, email = ?, phone_number = ?, address = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $full_name, $email, $phone_number, $address, $request_id);

    if ($stmt->execute()) {
        header("Location: view_requests_for_contact.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $request_id = $_GET['id'];
    $sql = "SELECT * FROM contact_requests WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $request_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $request = $result->fetch_assoc();

    $stmt->close();
} else {
    header("Location: view_requests_for_contact.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Contact Request - Admin Panel</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">
    <h2>Edit Contact Request</h2>
    <form action="edit_contact_request.php" method="post">
        <input type="hidden" name="id" value="<?php echo $request['id']; ?>">

        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" value="<?php echo $request['full_name']; ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $request['email']; ?>" required>

        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" value="<?php echo $request['phone_number']; ?>" required>

        <label for="address">Address:</label>
        <textarea id="address" name="address" required><?php echo $request['address']; ?></textarea>

        <button type="submit">Update</button>
    </form>
</div>

<?php include('../includes/footer.php'); ?>

</body>
</html>
