<?php 
/* Main page with two forms: sign up and log in */
require 'db.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Sign-Up/Login Form</title>
  <?php include 'css/css.html'; ?>
</head>

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    require 'insertBudget.php';
}
?>
<body>
  <div class="form">
      
      
      <div class="tab-content">

         <div id="login">   
          <h1>Insert new Transaction!</h1>
          
          <form action="InsertTransaction.php" method="post" autocomplete="off">
          
            <div class="field-wrap">
            <label>
              Name of the Transaction<span class="req">*</span>
            </label>
            <input type="text" name= "tr_name"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Type of the Transaction<span class="req">*</span>
            </label>
            <input type="text" name = "tr_type" />
          </div>
		  
		  
		  <div class="field-wrap">
            <label>
             Cost of the Transaction<span class="req">*</span>
            </label>
            <input type="text" name = "tr_cost" />
          </div>
		  
          
         <button type="submit" class="button button-block" name="register" />Submit</button>
          
          </form>

        
		
        
     
      
</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
