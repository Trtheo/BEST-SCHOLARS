<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        function validateForm() {
            var phone = document.getElementById('phone_number').value;
            var phoneRegex = /^[0-9]+$/;
            if (!phoneRegex.test(phone)) {
                alert('Phone number can only contain digits.');
                return false;
            }
            return true;
        }
    </script>
</head>
<body>

<?php include('includes/header.php'); ?>

<div class="container">
    <h2>Contact Us</h2>
    <form action="submit_contact.php" method="post" onsubmit="return validateForm();">
        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" required>

        <label for="address">Address:</label>
        <textarea id="address" name="address" placeholder="Province, District, Sector" required></textarea>

        <button type="submit">Submit</button>
    </form>
</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
