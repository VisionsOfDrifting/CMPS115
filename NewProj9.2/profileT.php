<?php
/* Displays user information and some useful messages */
session_start();


    // Makes it easier to read
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
  <title>The following transaction was processed <?= $name.' '.$tr_name. ' '.$tr_type.' '.$tr_cost.' '. $total.' '. $date. ?></title>
  <?php include 'css/css.html'; ?>
</head>

<body>
  <div class="form">

          
          <a href="WebContent.html"><button class="button button-block" name="logout"/>Follow the link </button></a>

    </div>
    
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>
