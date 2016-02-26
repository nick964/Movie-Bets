<?php
/****************************************************
Name: Check Bet Placed
Purpose: This file wil make sure that that user didn't already place a bet on a given movie.
Users should only be able to bet on a movie once.

date		developer		comment
20150129	Nick Robinson	This page holds a function that will return user's balance as an variable.
*****************************************************/

function checkBetPlaced($userid, $movieid) {

require_once('resources/constants.inc.php');




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
 
 ?>
