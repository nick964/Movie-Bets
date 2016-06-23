<?php
require_once('../resources/constants.inc.php');
include('../functions/functions.php');


//NOTES: Change this variable if you want to change how long after the release until the score is updated.
$TIMEGAP = 7;


session_start();

try 
    {
    $con = new PDO("mysql:host=".CONST_HOST.";dbname=".CONST_DBNAME,CONST_USER,CONST_PASSWORD);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "select * from movies where active = 2;";
    $totalresults = $con->prepare($sql);
    $myarray = $totalresults->execute();
    $rows = $totalresults->fetchAll();



    foreach($rows as $movie) {
        $movieid = $movie['movieid'];
        $score = $movie['critic_score'];
        $line = $movie['line'];

        //here we figureout for the current movie, is the critic score over what we said the line would be. 
        $isitover;
        if($score >= $line) {
            $isitover = true;
        } else {
            $isitover = false;
        }



        $release = strtotime($movie['release_date']);
        $today = strtotime(date("Y/m/d"));

        $difference = (($today - $release) / 86400);


        //if the time between release date is 
        if($difference >= $TIMEGAP) {

            $betsql = "select * from bets where movieid = :movieid and status = 'In Progress'";
            $betresults = $con->prepare($betsql);
            $betresults->bindParam(":movieid", $movieid);
            $betarray = $totalresults->execute();
            $bets = $totalresults->fetchAll();
            
            //loop through the bets that bet the movie
            foreach ($bets as $bet) {
                $ou = $bet['ou'];
                $amt = $bet['bet_amt'];
                $userid = $bet['userid'];
                $betid = $bet['betid'];

                //look how gorgeous this if statement is..my god..i hope this fuckin works cause i love u line below this line
                if(($isitover && $ou == "over") || (!$isitover && $ou == "under") ) {
                    $winresult = processWin($userid, $amt);
                }

                $update = "update bet set status = 'Complete' where betid = :id";
                $results = $con->prepare($update);
                $results->bindParam(":id", $betid);
                $results->execute();
            }

            $movieupdate = "update movies set active = 3 where movieid = :id";
            $movieresults = $con->prepare($movieupdate);
            $movieresults->bindParam(":id", $movie['movieid']);
            $exe = $results->execute();
        }


    }
} 
catch (Exception $e) 
    {
    $error = $e->getMessage();
    echo $error;
    }

$con = null;

?>

