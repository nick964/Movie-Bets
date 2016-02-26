<?php
try {
	require_once 'resources/constants.inc.php';

} catch (Exception $e) {
	$error = $e->getMessage();
}
if(isset($_SESSION['userid'])){
	header("Location: homepage.php");
}
include('login.php'); //includes login script
?>


<!DOCTYPE html>
<html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Movie Login</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <!-- Bootstrap -->
    	<link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/mymain.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
        <script src="js/myscript.js"></script>
    </head>
    <body>

<div id="container-fluid">
<div class="row">

		<div class="col-md-12" style="text-align: center">
		<img align="center" class="img-responsive center-block mainimg" src="img/moviebets.png" alt="home"></img>
		  
	<?php
    if(isset($error)) {
      echo "<h1>". $error . "</h1>";
    }
	
	?>
		</div>
		</div>


		<div class="row">

		<div class="col-md-3">
		<span></span>
		</div>        


			<div class="col-md-6">        


	<div id="home_page">

		
		


		<form id="form1" class="form"  method="POST" action="login.php">
					<div class="form_description">
					<p id="user_error"><span></span></p>
					</div>	
		
							
			<table id="table_home" align="center">
			<tr id="tr_1" >
			<input type="text" name="username" id="username" placeholder="Username" value="" size="20" maxlength="20">
			</tr>
			<br>	
			<tr id="tr_1" >
			<input type="password" name="password" id="password" placeholder="Password" value="" size="20" maxlength="20">
			</tr>
			<br>
			<tr id="tr_1">
			<input type="submit" name="submit" id="home_submit" value="Login">	
			</tr>
			</table>
		<br>
		
		</form></div>

		<button id="signupBtn"><a id="signupBtn" href="signup.php">Sign Up</a></button>

</div>	
	
	</div>	
</div>
</body>
</html>

