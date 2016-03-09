<?php
/****************************************************
Name: Process bet
Purpose: The big boy!!! Take in the userid, movieid, bet amount, over or under
Then first check and make sure they didn't already bet..i.e. checkUserBet function
Then check if they have enough moneys in their account..i.e. checkUserBalance function
Then insert into the bets table (what this fucntion will do)
Then if that is sucessfull, run an update on the balance to subtract the balance
 and redirect them to their account page.

phew

date		developer		comment
20150129	Nick Robinson	This page holds a function that will return user's balance as an variable.
*****************************************************/

function processBet($userid, $movieid, $betamt, $ou) {


include('functions/functions.php');


//makes sure the user didn't already bet on the movie
if (checkBetPlaced($userid, $movieid)) {

	//make sure that the user has enough money in the account to place a bet
	$currentbalance = getUserBalance($userid);
	if ($currentbalance > $betamt) {


try 
	{

		$con = new PDO("mysql:host=".CONST_HOST.";dbname=".CONST_DBNAME,CONST_USER,CONST_PASSWORD);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//if a session is already started, then assign orderid to the session variable
		$sql = "insert into bets (userid, movieid, ou, bet_amt, status) 
		VALUES (:userid, :movieid, :ou, :betamt, 'In Progress');";
		$results = $con->prepare($sql);
		$results->bindParam(":userid", $userid);
		$results->bindParam(":movieid", $movieid);
		$results->bindParam(":ou", $ou);
		$results->bindParam(":betamt", $betamt);
		$inserted = $results->execute();
		

	
	}

catch (Exception $e) 
	{
	$error = $e->getMessage();
	echo $error;
	}

		$con = null;

				if($inserted) {
					if(subtractBalance($userid, $betamt)) {
					//echo "bet has been inserted, and balance has been updated.";
					return 1;
				} else {
					//echo "bet has been inserted, but amount was not updated";


				}
			} else {
				echo "bet was not inserted, aamount shouldnt have been changd.";
			}
		}//end if for user balance
		else {
			$errmsg = "not enough";
			echo $errmsg;
			return 2;
		}
	}//end if for check bet
	else {
		$errmsg = "already bet";
		echo $errmsg;
		return 3;
		}
} //end function 
 
 ?>
