<?php
/* Log out process, unsets and destroys session variables */
 require 'db.php';
session_start();

$sql = "UPDATE users SET active = 0 WHERE active = 1";
    $mysqli->query($sql);

session_unset();
session_destroy(); 

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Error</title>
  <?php include 'css/css.html'; ?>
</head>

<body>
    <div class="form">
          <h1>Thanks for stopping by</h1>
              
          <p><?= 'You have been logged out!'; ?></p>
          
          <a href="WebApp.html"><button class="button button-block"/>Home</button></a>

    </div>
</body>
</html>
