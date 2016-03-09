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