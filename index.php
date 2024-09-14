<?php
include('includes/db.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Best Scholars</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            function fetchScholarships(query = '') {
                $.ajax({
                    url: 'scholarships.php',
                    method: 'POST',
                    data: {query: query},
                    success: function(data) {
                        $('.scholarships').html(data);
                    }
                });
            }

            fetchScholarships(); // Initial load

            $("#search").on('keyup', function(){
                var query = $(this).val();
                fetchScholarships(query);
            });
        });
    </script>
    <style>
        .container {
            width: 90%;
            margin: auto;
            
        }
        .scholarships {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .scholarship {
            flex: 1 1 calc(33.333% - 20px);
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            padding: 20px;
            box-sizing: border-box;
        }
        .scholarship img {
            max-width:300px;
            height: 200px;
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    
    <?php include('includes/header.php'); ?>

    <div class="container">
        <h1>Welcome to Best Scholars</h1>
         <p>
         Welcome to Best Scholars! We are here as dedicated Technology support , consultant to bringing you the latest updates on scholarships from around 
         the world. Whether you're a high school student, college undergrad, or a graduate seeking funding opportunities, 
         we provide timely information to help you achieve your academic dreams. Subscribe to stay informed about new scholarships,
          application tips, eligibility criteria, and success stories. Join our community and let Best Scholars be your trusted
           guide to unlocking educational opportunities. 
         </p>
       
        <div class="scholarships">
            <!-- AJAX-loaded content will appear here -->
        </div>
    </div>
    
    <?php include('includes/footer.php'); ?>
</body>
</html>
