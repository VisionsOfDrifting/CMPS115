<?php
/* Displays user information and some useful messages */
session_start();

    $tr_name = $_SESSION['tr_name'];
    $tr_type = $_SESSION['tr_type'];
    $tr_cost = $_SESSION['tr_cost'];
    $name = $_SESSION['name'];
	$total = $_SESSION['total'];
	$date = $_SESSION['date']

?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <?php include 'css/css.html'; ?>
</head>

<body>
  <div class="form">
          <h1><?php echo  " The following Transaction failed" ?></h1> <br>
          <h2><?php echo  " $name-$tr_name-$tr_type-$tr_cost-$total-$date." ?></h2>
    
          <a href="WebContent.html"><button class="button button-block" name="logout"/>Home Page </button></a>

    </div>
    
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>
