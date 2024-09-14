<?php
// Ensure $conn is included and initialized properly
include('db.php');

// Initialize $settings with default values
$settings = array(
    'logo_image' => 'logo.png',
    'name' => 'BEST SCHOLARS',
    'contact_email' => 'bestscholars1@gmail.com',
    'contact_phone' => '+250 788932662',
    'contact_location' => 'Nyarugenge Town, Kigali City, Rwanda.'
);

// Fetch website settings for footer content
$sql = "SELECT * FROM website_settings LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $settings = $result->fetch_assoc();
}
?>

<footer>
    <div class="footer-content">
        <div class="column">
            <img src="../bestscholars/uploads/<?php echo htmlspecialchars($settings['logo_image']); ?>" alt="Website Logo">
            <p><?php echo htmlspecialchars($settings['name']); ?></p>
        </div>
    
        <div class="column">
            <h3>Contact Us</h3>
            <p><i class="fas fa-envelope"></i>
            <?php echo htmlspecialchars($settings['contact_email']); ?></p>
            <p><i class="fas fa-phone"></i>
            <?php echo htmlspecialchars($settings['contact_phone']); ?></p>
            <p><i class="fas fa-map-marker-alt"></i>
            <?php echo htmlspecialchars($settings['contact_location']); ?></p>
        </div>
        <div class="social-media">
            <h3>Follow Us</h3>
            <a href="https://www.youtube.com/@scholarshipsignals"><i class="fab fa-youtube"></i></a>
            <a href="https://www.facebook.com/scholarshipSignals"><i class="fab fa-facebook"></i></a>
            <a href="https://www.tiktok.com/@scholarship_signals"><i class="fab fa-tiktok"></i></a>
            <a href="https://www.instagram.com/sholarshipsignals/"><i class="fab fa-instagram"></i></a>
            <a href="https://x.com/scholarshipsign"><i class="fab fa-twitter"></i></a>
            <a href="https://wa.link/4t21ki"><i class="fab fa-whatsapp"></i></a>
            <br> <p><b>Working Time:</b> 24 Hours / 7  days</p>
        </div>
         
    </div>
    <div class="footer-bottom" style="background-color: #152022; color: #ffffff;">
        <p>&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($settings['name']); ?>. All Rights Reserved.</p>
    </div>
</footer>

<?php
// Close database connection if necessary (uncomment if needed)
// $conn->close();
?>