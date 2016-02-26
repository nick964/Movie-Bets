<?php
/****************************************************
Name: Subtract Balance 
Purpose: This function will remove a certain amount from the user's current balance 

date		developer		comment
20130912	Nick Robinson	none so far
*****************************************************/

function subtractBalance($userid, $amt) {

include('functions/getuserBalance.php');
require_once('resources/constants.inc.php');

$errortext = "";
//run sql to get the current balance, given the userid
$currentBalance = getUserBalance($userid);

if($currentBalance == "err") {
	echo "error: getUserBalance isn't working..";
	return false;
}

//calculate what the new balance is, and check if it should be less
//ideally I should get and make sure that it doesn't happen, but whatever, make it 0 if it somehow happens.
	if($amt > $currentBalance) {
		echo "Error: You can not subtract more than what is currently in the user's account. Try an amount less than $currentBalance";
		return false;
	} else {
	$newBalance = $currentBalance - $amt;
	}



// Now that you have the new balance, update it in the backend
try 
	{

		$con = new PDO("mysql:host=".CONST_HOST.";dbname=".CONST_DBNAME,CONST_USER,CONST_PASSWORD);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//if a session is already started, then assign orderid to the session variable
		$sql = "update users set balance = :newBalance where userid = :userid";
		$results = $con->prepare($sql);
		$results->bindParam(":userid", $userid);
		$results->bindParam(":newBalance", $newBalance);
		$results->execute();

		if ($results) {
			$msg = "Your new balace is $newBalance after $amt has been removed from $currentBalance";
		} else {
			echo "Error, you balance could not be updated in the sql database";
			return false;
		}

	}

catch (Exception $e) 
	{
	$error = $e->getMessage();
	echo $error;
	}

		$con = null;
		echo $msg;
		return true;
		
} 
 
 ?>
