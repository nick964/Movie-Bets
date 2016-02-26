<?php
try {
	require_once 'resources/constants.inc.php';

} catch (Exception $e) {
	$error = $e->getMessage();
}

session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Movie Bet Confirmation Page</title>
	<link href="css/view.css" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<style>
		
	</style>
</head>
<body>
	<div id="home_page" align="center">
	<h1 id="uc_h1">Movie Bets</h1>	
		
	<p id="uc_p">Sign Up Confirmed!</p>
	<br>
	<br>
	<button id="backBtn"><a id="backBtn" href="betlogin.php">Return to Home Page</a></button>
	</div>
	
</body>
</html>

