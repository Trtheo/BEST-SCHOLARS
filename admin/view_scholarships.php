<?php
//session_start();
include('../includes/db.php');
include('admin_check.php');

// Delete scholarship if ID is provided in the URL
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $scholarship_id = $_GET['id'];

    // Delete scholarship from database
    $sql = "DELETE FROM scholarships WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $scholarship_id);
    $stmt->execute();
    $stmt->close();

    // Redirect back to view_scholarships.php after deletion
    header("Location: view_scholarships.php");
    exit();
}

// Fetch scholarships from database
$sql = "SELECT * FROM scholarships";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Scholarships - Admin Panel</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .add-button {
            
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php include('headerAdmin.php'); ?>
    <div class="container">
        <h2>View Scholarships</h2>
        <a href="add_scholarship.php" class="add-button">Add New Scholarship</a>
        <table class="request-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['start_date']; ?></td>
                        <td><?php echo $row['end_date']; ?></td>
                        <td><img src="../uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?> Image" style="max-width: 150px; max-height: 150px;"></td>
                        <td>
                            <a href="edit_scholarship.php?id=<?php echo $row['id']; ?>">Edit</a>
                            <a href="view_scholarships.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this scholarship?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <?php include('../includes/footer.php'); ?>
</body>
</html>
