<?php
/* Registration process, inserts user info into the database 
   and sends account confirmation email message
 */

/* Set session variables to be used on profile.php page*/
require 'db.php';



$query = "SELECT first_name, last_name  FROM users WHERE active= 1";
$temp = "";
$previous_money = 0;
if ($result = $mysqli->query($query)) {

    /* fetch object array */
    while ($row = $result->fetch_row()) {
       $temp =  $row[0]. ' ' .$row[1];
	   
	   
	   
	}

    /* free result set */
    $result->close();

}



$_SESSION['tr_name'] = $_POST['tr_name'];
$_SESSION['tr_type'] = $_POST['tr_type'];
$_SESSION['tr_cost'] = $_POST['tr_cost'];
$_SESSION['name']  =  $temp; 

$_SESSION['date'] = $_POST['tr_date'];


// Escape all $_POST variables to protect against SQL injections
$tr_name = $mysqli->escape_string($_POST['tr_name']);
$tr_type = $mysqli->escape_string($_POST['tr_type']);
$tr_cost = $mysqli->escape_string($_POST['tr_cost']);
$tr_date = $mysqli->escape_string($_POST['tr_date']);
$name =  $temp; 

$store = "-1";

$sql = "INSERT INTO budget (name,tr_name,tr_type, tr_cost, total, date) " 
        . "VALUES ('$name','$tr_name','$tr_type','$store', '$tr_cost' , '$tr_date')";

			
if  ($mysqli->query($sql)){
        
$_SESSION['message'] = "Transaction was completed succesfully";
header("location: profileTransaction.php"); 

}

else {
    $_SESSION['message'] = 'Transaction  failed!';
    header("location: errorTransaction.php");
}
?>