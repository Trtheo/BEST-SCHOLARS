<?php
session_start();
include('../includes/db.php');
include('headerAdmin.php');

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

// Fetch all requests from the database
$sql = "SELECT * FROM public_user_requests";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Requests - Admin Panel</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">
    <h2>View Requests</h2>
    <table >
        <thead>
            <tr>
                <th>Request ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['full_name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone_number']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td>
                        <a href="edit_request_for_app.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a href="delete_request_for_app.php?id=<?php echo $row['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include('../includes/footer.php'); ?>

</body>
</html>
