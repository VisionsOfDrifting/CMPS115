<?php
/* Displays user information and some useful messages */
session_start();

     $budget_value = $_SESSION['budget_value'];
   
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <?php include 'css/css.html'; ?>
</head>

<body>
   <div class="form">
          <h1><?php echo  " The Budget failed to be updated with " ?></h1> <br>
          <h2><?php echo  " $budget_value." ?></h2>
    
    </div>
    
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>
