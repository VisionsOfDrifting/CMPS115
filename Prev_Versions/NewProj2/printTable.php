<?php 
/* Main page with two forms: sign up and log in */
require 'db.php';
session_start();

$query = "SELECT first_name, last_name  FROM users WHERE active= 1";
$temp = "";
if ($result = $mysqli->query($query)) {

    /* fetch object array */
    while ($row = $result->fetch_row()) {
       $temp =  $row[0]. ' ' .$row[1];
	   
	   
	   
	}

    /* free result set */
    $result->close();

}






?>
<!DOCTYPE html>
<html>
<head>
  <title>This is your Budget Table</title>
  <?php include 'css/css.html'; ?>
</head>


<body>
  <div class="form">
      
      
	  
     <div class="field-wrap">
	  
	  
	 
	  
	  <?php
echo "<table style='border: solid 1px green;'>";

echo "<tr><th>Id</th><th>Name</th><th>Tr_Name</th><th>Tr_Type</th><th>Tr_Cost</th><th>Account</th><th>Date<th></tr>";

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width:3600px;border:1px solid green;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ir";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT* FROM budget WHERE name = '$temp'"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>
	  
	  
		 
		 
		 
		 
		 
		 
		 
		 
          </div>
		  
          
         <a href="WebContent.html"><button class="button button-block" name="logout"/> Home Page </button></a>
          
          </form>

        
		
        
     
      
</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
