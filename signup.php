<?php

include('functions/functions.php');


try {
	require_once 'resources/constants.inc.php';

} catch (Exception $e) {
	$error = $e->getMessage();
}

session_start();
$error='';
		if(isset($_POST['submit'])) {
		if(empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is invalid! Please reenter Username or Password.";
		} else if (confirmPassword($_POST['password'], $_POST['confirm']) == false) {
			$error = "Password doesn't match. Please try again.";
		}
		else 
		{
			//define $username and $password
			$username=$_POST['username'];
			$password=md5($_POST['password']);
			$firstname=$_POST['firstname'];
			$lastname=$_POST['lastname'];
			$phonenumber=$_POST['phonenumber'];
			$email=$_POST['email'];
			//establishing connection with server by passing server_name, username and password
			$dsn = new PDO("mysql:host=".CONST_HOST.";dbname=".CONST_DBNAME,CONST_USER,CONST_PASSWORD);
			$dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query = "INSERT INTO users (firstname, lastname, email, username, password, balance) 
			VALUES (:firstname, :lastname, :email, :username, :password, 1000)";
			$results= $dsn->prepare($query);
			$results->bindParam(":firstname", $firstname);
			$results->bindParam(":lastname", $lastname);
			$results->bindParam(":email", $email);
			$results->bindParam(":username", $username);
			$results->bindParam(":password", $password);
			$insertresult = $results->execute();
			
			if($insertresult) {
				$db = null;
				header("Location: userconfirmation.php");
			}
			else {
				$error = $e->getMessage();
				echo $error;
			}
		}
		}



?>


<!DOCTYPE html>
<html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
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
		<h2>Signup Page</h2><br>
		  
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

		<form id="signupform" class="signupform"  method="post" action="">
		
							<div class="form-group">
			<table id="table_signup" class="table-responsive" align="center">		
			<tr class="spaceUnder"><td>
			<input type="" name="firstname" id="firstname" value="" placeholder="First Name" size="20" maxlength="20" required>
			</td></tr>
			<br>	
			<tr class="spaceUnder"><td>
			<input type="" name="lastname" id="lastname" value="" placeholder="Last Name" size="20" maxlength="20" required>
			</td></tr>
			<br>
			<tr class="spaceUnder"><td>
			<input type="text" name="email" id="email" value="" placeholder="Email" size="20" maxlength="20" required> 
			</td></tr>
			<br>
			<tr class="spaceUnder"><td>
			<input type="text" name="phonenumber" id="phonenumber" value="" placeholder="Phone Number" size="20" maxlength="20" required> 
			</td></tr>
			<br>
			<tr class="spaceUnder"><td>
			<input type="text" name="username" id="username" value="" placeholder="Username" size="20" maxlength="20" required> 
			</td></tr>
			<br>
			<tr class="spaceUnder"><td>
			<input type="password" name="password" id="password" value="" placeholder="Password" size="20" maxlength="20" required><br>
			</td></tr>
			<tr class="spaceUnder"><td>
			<input type="password" name="confirm" id="confirm" value="" placeholder="Confirm Password" size="20" maxlength="20" required>
			</td></tr>
			</table>
			</div>
		
		<p align="center"><input class="btn" type="submit" name="submit" id="submit" value="Submit"></p>
		<div class="wrapper">
		<button id="backBtn" align="center" class="btn"><a id="backBtn" href="betlogin.php">Return to Homepage</a></button>	
		</div>
		
		
		</form> 
	
		</div>

		<div class="col-md-3">
		<span></span>
		</div>    


	</div>
		
</div>
	
	
	
</body>
</html>

