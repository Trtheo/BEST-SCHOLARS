<?php
//session_start();
include('../includes/db.php');
include('admin_check.php'); // Include the new session check file

// Initialize variables
$scholarship = array('title' => '', 'description' => '', 'start_date' => '', 'end_date' => '');

// Fetch scholarship details for editing
if (isset($_GET['id'])) {
    $scholarship_id = $_GET['id'];

    // Fetch scholarship details from database
    $sql = "SELECT * FROM scholarships WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $scholarship_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $scholarship = $result->fetch_assoc();
    } else {
        echo "Scholarship not found.";
        exit();
    }
    $stmt->close();

    // Handle form submission to update scholarship
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validate and process form data
        $title = $_POST['title'];
        $description = $_POST['description'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        // Update scholarship in database
        $sql = "UPDATE scholarships SET title=?, description=?, start_date=?, end_date=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $title, $description, $start_date, $end_date, $scholarship_id);
        $stmt->execute();
        $stmt->close();

        // Redirect or display success message
        header("Location: view_scholarships.php");
        exit();
    }

    // Handle deletion of scholarship
    if (isset($_POST['delete'])) {
        $sql_delete = "DELETE FROM scholarships WHERE id=?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("i", $scholarship_id);
        $stmt_delete->execute();
        $stmt_delete->close();

        // Redirect or display success message
        header("Location: view_scholarships.php");
        exit();
    }
} else {
    echo "No scholarship ID provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Scholarship - Admin Panel</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include('headerAdmin.php'); ?>

    <div class="container">
        <h2>Edit Scholarship</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $scholarship_id; ?>" method="POST">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($scholarship['title']); ?>" required>
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="5" required><?php echo htmlspecialchars($scholarship['description']); ?></textarea>
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" value="<?php echo $scholarship['start_date']; ?>" required>
            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" value="<?php echo $scholarship['end_date']; ?>" required>
            <button type="submit">Update Scholarship</button>
        </form>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $scholarship_id; ?>" method="POST">
            <button type="submit" name="delete">Delete Scholarship</button>
        </form>
    </div>

    <?php include('../includes/footer.php'); ?>
</body>
</html>
