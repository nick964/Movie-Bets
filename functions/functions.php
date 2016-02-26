<?php

require_once('resources/constants.inc.php');

/****************************************************
Name: Get User Balance
Purpose: 

date		developer		comment
20150129	Nick Robinson	This page holds a function that will return user's balance as an variable.
*****************************************************/

function getUserBalance($userid) {


$balance = "err";



// Get the balance record for the given user id
try 
	{

		$con = new PDO("mysql:host=".CONST_HOST.";dbname=".CONST_DBNAME,CONST_USER,CONST_PASSWORD);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//if a session is already started, then assign orderid to the session variable
		$sql = "select balance from users where userid = :userid";
		$results = $con->prepare($sql);
		$results->bindParam(":userid", $userid);
		$results->execute();

		$row = $results->fetchAll();
		$balance = $row[0]['balance'];
	}

catch (Exception $e) 
	{
	$error = $e->getMessage();
	echo $error;
	}

		$con = null;
		return $balance;
		
} 




/****************************************************
Name: Check Bet Placed
Purpose: This file wil make sure that that user didn't already place a bet on a given movie.
Users should only be able to bet on a movie once.

date		developer		comment
20150129	Nick Robinson	This page holds a function that will return user's balance as an variable.
*****************************************************/

function checkBetPlaced($userid, $movieid) {
// Check if there is already a bet for the given userid and movieid in the bets table
//if this returns true, then you need to echo out an error explaining why the user cant bet
try 
	{

		$con = new PDO("mysql:host=".CONST_HOST.";dbname=".CONST_DBNAME,CONST_USER,CONST_PASSWORD);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//if a session is already started, then assign orderid to the session variable
		$sql = "select * from bets where userid = :userid and movieid = :movieid";
		$results = $con->prepare($sql);
		$results->bindParam(":userid", $userid);
		$results->bindParam(":movieid", $movieid);
		$results->execute();
		$rows = $results->fetchAll();
		

	
	}

catch (Exception $e) 
	{
	$error = $e->getMessage();
	echo $error;
	}

		$con = null;

		if(empty($rows)) {
			//no bet in table..user can go ahead and bet
			return true;
		} else {
			//user already bet..cant bet again.";
			return false;
		}	
		
} 

/****************************************************
Name: Subtract Balance 
Purpose: This function will remove a certain amount from the user's current balance 

date		developer		comment
20130912	Nick Robinson	none so far
*****************************************************/

function subtractBalance($userid, $amt) {


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
 
/****************************************************
Name: Confirm Password
Purpose: This function will check that the password is working

date		developer		comment
20150206	Nick Robinson	none so far
*****************************************************/

function confirmPassword($password, $confirm) {
	$result = false;

	if($password == $confirm) {
		$result = true;
	}

	return $result;
}
 
 ?>
