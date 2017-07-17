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



$_SESSION['budget_value'] = $_POST['budget_value'];


// Escape all $_POST variables to protect against SQL injections
$budget_value = $mysqli->escape_string($_POST['budget_value']);
$date = date("Y/m/d");
$query2 =  "SELECT money FROM storebudget WHERE name = '$temp' ";

if ($result = $mysqli->query($query2)) {

    /* fetch object array */
    while ($row = $result->fetch_row()) {
       $previous_money =  $row[0] ;
	   
	   
	   
	}

    /* free result set */
    $result->close();

}

$query3 = "Delete FROM storebudget WHERE name = '$temp' ";
$bool = $mysqli->query($query3);





$new_budget_value = $budget_value + $previous_money;

    // active is 0 by DEFAULT (no need to include it here)
    $sql = "INSERT INTO storeBudget (name,money,date) " 
            . "VALUES ('$temp','$new_budget_value','$date')";

    // Add user to the database
    if ( $mysqli->query($sql) ){

        
        $_SESSION['message'] = "Transaction was completed succesfully";
        header("location: profileBudget.php"); 

    }

    else {
        $_SESSION['message'] = 'Transaction  failed!';
        header("location: errorBudget.php");
    }

?>