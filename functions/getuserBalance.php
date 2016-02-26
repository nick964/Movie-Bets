<?php
/****************************************************
Name: Get User Balance
Purpose: 

date		developer		comment
20150129	Nick Robinson	This page holds a function that will return user's balance as an variable.
*****************************************************/

function getUserBalance($userid) {

require_once('resources/constants.inc.php');
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
 
 ?>
