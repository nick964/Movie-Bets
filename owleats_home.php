<?php
header("Location: betlogin.php");
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
<!doctype html>
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
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->


        <!-- Add your site or application content here -->
        <div class="container-fluid">

	<div id="home_page"><button id="signupBtn"><a id="signupBtn" href="signup.php">Sign Up</a></button>
		<div id="nosignup"><p id="home_title" style="display:none;">OwlEats<p>
		
		<h1>Login and start betting on movies!!</h1>


		<form id="form1" class="form"  method="POST" action="login.php">
					<div class="form_description">
					<p id="user_error"><span><?php echo $errmsg; ?></span></p>
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


		
	
	
	
	
	</div>	
</div>
	
	
	


</body>
</html>

