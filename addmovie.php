<?php

include('functions/functions.php');


try {
	require_once 'resources/constants.inc.php';

} catch (Exception $e) {
	$error = $e->getMessage();
}

session_start();
$error='';

try 	{
		if(isset($_GET['submit'])) {

		$title = "";

			if(isset($_GET['movieTitle'])) {
				$title = $_GET['movieTitle'];
				$title = preg_replace('/\s+/', '+', $title);
				$year = $_GET['year'];
				$line = $_GET['line'];
			}


	if($title != "") {
		$url = "http://www.omdbapi.com/?t=" .$title. "&y=" . $year;
		//echo $url . "<br>";
		$json = json_decode(curl_get_contents($url));
		

		//var_dump($json);
		//now to see if the json is valid or not
		$jsontitle = "Title";
		$response = "Response";

		if($json->$response == "True") {
			
			$released = "Released";
			$poster = "Poster";
			$imdbID = "imdbID";
			/** echoing for debugging
			echo $json->$jsontitle . "<br>";
			echo $json->$released . "<br>";
			echo $json->$poster . "<br>";
			echo $json->$imdbID . "<br>";
			*/


			$dsn = new PDO("mysql:host=".CONST_HOST.";dbname=".CONST_DBNAME,CONST_USER,CONST_PASSWORD);
			$dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$query = "INSERT INTO movies (title, release_date, link, line, imdbID, active) 
			VALUES (:title, :release, :img, :line, :imdb, 1)";

			$results= $dsn->prepare($query);
			$results->bindParam(":title", $json->$jsontitle);
			$results->bindParam(":release", $json->$released);
			$results->bindParam(":img", $json->$poster);
			$results->bindParam(":line", $line);
			$results->bindParam(":imdb", $json->$imdbID);
			$insertresult = $results->execute();
			
			if($insertresult) {
				$db = null;
				$msg = "<h3>" . $json->$jsontitle . " added to the database.</h3>";
			}




		} else {
			$msg = "<h3>Movie not found</h3>";
		}

		

	}



}

		
	




	} catch (Exception $e) {
		$error = $e->getMessage();
	}
		

?>

<!DOCTYPE HTML>
<html>
<head class="no-js" lang="en">
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Add a Movie</title>
	<meta name="description" content="textbook exchange web application">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/mymain.css">
	<link href="css/animate.css" rel="stylesheet">
	<script src="js/vendor/modernizr-2.8.3.min.js"></script>
	<script src="js/main.js"></script>
</head>
<body>

	<span align="center"><?php 
	if(isset($msg)) {
		echo $msg;
	}?>
	</span>
	<form action="" method="GET">
		<fieldset class="form-group textEdit">
			<label for="exampleInputTitle">Movie Title</label>
			<input type="text" class="form-control" name="movieTitle" id="movieTitle" placeholder="title" required>
		</fieldset>

		<fieldset class="form-group textEdit">
			<label for="exampleInputTitle">Line</label>
			<input type="number" class="form-control" name="line" id="line" min="0" max="100" required>
		</fieldset>

		<fieldset class="form-group textEdit">
			<label for="exampleInputTitle"></label>
			<input type="hidden" class="form-control" name="year" id="year" value="2016">
		</fieldset>
	

		<center><button  class="btn btn-primary fancyButton" name="submit" id="submit" >submit</button></center>
	</form>
</body>
</html>