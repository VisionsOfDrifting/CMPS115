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
$_SESSION['tr_query'] = $_POST['tr_query'];


// Escape all $_POST variables to protect against SQL injections
$tr_name = $mysqli->escape_string($_POST['tr_name']);
$tr_type = $mysqli->escape_string($_POST['tr_type']);
$tr_cost = $mysqli->escape_string($_POST['tr_cost']);
$tr_date = $mysqli->escape_string($_POST['tr_date']);
$tr_query = $mysqli->escape_string($_POST['tr_query']);
$name =  $temp; 

$query2 =  "SELECT money FROM storebudget WHERE name = '$temp' ";
$previous_money = 0;
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

if($tr_query == "No"){
	$total = $previous_money - $tr_cost;
	$cost = "-";
	$cost .= $tr_cost;
	$query4 = "INSERT INTO storeBudget (name,money,date) " 
            . "VALUES ('$temp','$total','$tr_date')";

	$bool = $mysqli->query($query4);
	$sql = "INSERT INTO budget (name,tr_name,tr_type, tr_cost, total, date) " 
            . "VALUES ('$name','$tr_name','$tr_type','$cost', '$total' , '$tr_date')";
} 


if($tr_query == "Yes"){
	$new_budget_value = $tr_cost + $previous_money;
	$ncost = "+";
	$ncost .= $tr_cost;
	$sql = "INSERT INTO storeBudget (name,money,date) " 
            . "VALUES ('$temp','$new_budget_value','$tr_date')";
			
	$bool = $mysqli->query($sql);		
	$sql = "INSERT INTO budget (name,tr_name,tr_type, tr_cost, total, date) " 
            . "VALUES ('$name','$tr_name','$tr_type','$ncost', '$new_budget_value' , '$tr_date')";
}
			
if($tr_query == "Yes"){
	if ( $mysqli->query($sql) ){

        $_SESSION['message'] = "Transaction was completed succesfully";
        header("location: profileBudget.php"); 

    }

    else {
        $_SESSION['message'] = 'Transaction  failed!';
        header("location: errorBudget.php");
    }

}
if($tr_query == "No"){
	if  ($mysqli->query($sql)){

        
        $_SESSION['message'] = "Transaction was completed succesfully";
        header("location: profileTransaction.php"); 

    }

    else {
        $_SESSION['message'] = 'Transaction  failed!';
        header("location: errorTransaction.php");
    }
}
?>