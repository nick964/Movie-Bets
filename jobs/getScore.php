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
    $sql = "select * from movies where active = 2;";
    $totalresults = $con->prepare($sql);
    $myarray = $totalresults->execute();
    $rows = $totalresults->fetchAll();



    foreach($rows as $movie) {
        $title = $movie['title'];
        $movieID = $movie['movieid'];
        $imdbID = $movie['imdbID'];

        echo $title . "<br>";
        echo $movieID . "<br>";
        echo $imdbID . "<br>";

        //check to make sure that there is a present imdb id in the database
        if($imdbID == "") {
            echo "ERROR: No IMDB ID in the database. ";
        } else {

             $url = "http://www.omdbapi.com/?i=" .$imdbID. "&tomatoes=true";
             echo "<br>";
             echo $url;
              echo "<br>";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            //set the url
            curl_setopt($ch, CURLOPT_URL, $url);

            //execute the curl cmd
            $result = curl_exec($ch);

            //close the curl
            curl_close($ch);

            $rottenresults = json_decode($result, true);

            //reassigning the array to that actual array that we want

           // $rottenresults = $rottenresults[0];

           // var_dump($rottenresults);
            echo "<br>";

            echo "Movie score for " .$rottenresults['Title']. " is ". $rottenresults['tomatoMeter'];

            echo "<br>";
            echo "____________________________";
            echo "<br>";


            if($rottenresults['tomatoMeter'] == "N/A") {
                echo "Movie does not have ratings yet";
            } else { 

               $update = "update movies set critic_score = :score where movieid = :id";
               $results = $con->prepare($update);
               $results->bindParam(":id", $movieID);
               $results->bindParam(":score", $rottenresults['tomatoMeter']);
               $exe = $results->execute();
               echo "<br> the result: " . $exe . "<br>";   



            }

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

