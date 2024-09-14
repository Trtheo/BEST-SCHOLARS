<?php
session_start();
include('includes/db.php');
include('includes/header.php');

// Fetch scholarships and their start/end dates from the database
$sql = "SELECT id, title, description, start_date, end_date, image FROM scholarships";
$result = $conn->query($sql);

// Check if form was submitted and display success message
$requestSent = false;
if (isset($_SESSION['request_sent'])) {
    $requestSent = $_SESSION['request_sent'];
    unset($_SESSION['request_sent']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Testimonials</title>
    <link rel="stylesheet" href="../css/style.css">

  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

  <!-- CSS -->
  <link rel="stylesheet" href="styleTestmonial.css">

</head>

<body>

<section class="testmonial">

  <div class="slide-container swiper">
    <div class="slide-content">
      <div class="card-wrapper swiper-wrapper">
        <div class="card swiper-slide">
          <div class="image-content">
            <span class="overlay"></span>

            <div class="card-image">
              <img src="imagesTestmonials/A.PNG" alt="" class="card-img">
            </div>
          </div>

          <div class="card-content">
            <h2 class="name">David Dell</h2>
            <p class="description">The lorem text the section that contains header with having open functionality. Lorem
              dolor sit amet consectetur adipisicing elit.</p>

            <button class="button">Vistit Best Scholars</button>
          </div>
        </div>
        <div class="card swiper-slide">
          <div class="image-content">
            <span class="overlay"></span>

            <div class="card-image">
              <img src="imagesTestmonials/brigtT.png" alt="" class="card-img">
            </div>
          </div>

          <div class="card-content">
            <h2 class="name">David Dell</h2>
            <p class="description">The lorem text the section that contains header with having open functionality. Lorem
              dolor sit amet consectetur adipisicing elit.</p>

            <button class="button">Vistit Best Scholars</button>
          </div>
        </div>
        <div class="card swiper-slide">
          <div class="image-content">
            <span class="overlay"></span>

            <div class="card-image">
              <img src="imagesTestmonials/me.jpeg" alt="" class="card-img">
            </div>
          </div>

          <div class="card-content">
            <h2 class="name">David Dell</h2>
            <p class="description">The lorem text the section that contains header with having open functionality. Lorem
              dolor sit amet consectetur adipisicing elit.</p>

            <button class="button">Vistit Best Scholars</button>
          </div>
        </div>
        <div class="card swiper-slide">
          <div class="image-content">
            <span class="overlay"></span>

            <div class="card-image">
              <img src="imagesTestmonials/me2.png" alt="" class="card-img">
            </div>
          </div>

          <div class="card-content">
            <h2 class="name">David Dell</h2>
            <p class="description">The lorem text the section that contains header with having open functionality. Lorem
              dolor sit amet consectetur adipisicing elit.</p>

            <button class="button">Vistit Best Scholars</button>
          </div>
        </div>
        <div class="card swiper-slide">
          <div class="image-content">
            <span class="overlay"></span>

            <div class="card-image">
              <img src="imagesTestmonials/Passport Photo.jpg" alt="" class="card-img">
            </div>
          </div>

          <div class="card-content">
            <h2 class="name">David Dell</h2>
            <p class="description">The lorem text the section that contains header with having open functionality. Lorem
              dolor sit amet consectetur adipisicing elit.</p>

            <button class="button">Vistit Best Scholars</button>
          </div>
        </div>
        <div class="card swiper-slide">
          <div class="image-content">
            <span class="overlay"></span>

            <div class="card-image">
              <img src="imagesTestmonials/profile6.jpg" alt="" class="card-img">
            </div>
          </div>

          <div class="card-content">
            <h2 class="name">David Dell</h2>
            <p class="description">The lorem text the section that contains header with having open functionality. Lorem
              dolor sit amet consectetur adipisicing elit.</p>

            <button class="button">Best Scholars</button>
          </div>
        </div>
        <div class="card swiper-slide">
          <div class="image-content">
            <span class="overlay"></span>

            <div class="card-image">
              <img src="imagesTestmonials/profile7.jpg" alt="" class="card-img">
            </div>
          </div>

          <div class="card-content">
            <h2 class="name">David Dell</h2>
            <p class="description">The lorem text the section that contains header with having open functionality. Lorem
              dolor sit amet consectetur adipisicing elit.</p>

            <button class="button">Vistit Best Scholars</button>
          </div>
        </div>
        <div class="card swiper-slide">
          <div class="image-content">
            <span class="overlay"></span>

            <div class="card-image">
              <img src="imagesTestmonials/profile8.jpg" alt="" class="card-img">
            </div>
          </div>

          <div class="card-content">
            <h2 class="name">David Dell</h2>
            <p class="description">The lorem text the section that contains header with having open functionality. Lorem
              dolor sit amet consectetur adipisicing elit.</p>

            <button class="button">Vistit Best Scholars</button>
          </div>
        </div>
        <div class="card swiper-slide">
          <div class="image-content">
            <span class="overlay"></span>

            <div class="card-image">
              <img src="imagesTestmonials/profile9.jpg" alt="" class="card-img">
            </div>
          </div>

          <div class="card-content">
            <h2 class="name">David Dell</h2>
            <p class="description">The lorem text the section that contains header with having open functionality. Lorem
              dolor sit amet consectetur adipisicing elit.</p>

            <button class="button">Vistit Best Scholars</button>
          </div>
        </div>
      </div>
    </div>

    <div class="swiper-button-next swiper-navBtn"></div>
    <div class="swiper-button-prev swiper-navBtn"></div>
    <div class="swiper-pagination"></div>
  </div>
</section>


<?php include('includes/footer.php'); ?>
</body>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- JavaScript -->
<script src="scriptTestmonials.js"></script>

</html>



