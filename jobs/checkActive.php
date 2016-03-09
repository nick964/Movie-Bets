<?php
require_once('../resources/constants.inc.php');


//NOTES: Change this variable if you want to change the number of days before the release of a movie to stop the bet ya kno???????/
$TIMEGAP = 7;


session_start();
//make sure that user is logged in for this page

try 
    {
    $con = new PDO("mysql:host=".CONST_HOST.";dbname=".CONST_DBNAME,CONST_USER,CONST_PASSWORD);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "select * from movies where active = 1;";
    $totalresults = $con->prepare($sql);
    $myarray = $totalresults->execute();
    $rows = $totalresults->fetchAll();



    foreach($rows as $movie) {
        echo $movie['title'] . "<br>";

        $release = strtotime($movie['release_date']);
        $today = strtotime(date("Y/m/d"));

        echo "movie release: " . $release . "<br>";

        echo "today: " . $today . "<br>";
        echo "difference : " . (($release - $today) / 86400)   . "<br>";
        $difference = (($release - $today) / 86400);

        echo "_____________" . "<br>";

        //if the time between release date is 
        if($difference <= $TIMEGAP) {
            $update = "update movies set active = 2 where movieid = :id";
            $results = $con->prepare($update);
            $results->bindParam(":id", $movie['movieid']);

            $exe = $results->execute();

            echo "<br> the result: " . $exe . "<br>";




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

