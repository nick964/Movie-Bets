<?php
require_once('resources/constants.inc.php');
include('betstable.php');
session_start();
//make sure that user is logged in for this page
        if(!(isset($_SESSION['userid']))) {
           header("Location: owleats_home.php");
        } else {
            $userid = $_SESSION['userid'];
            echo $userid;
        }
$err = "";

try 
    {
    $con = new PDO("mysql:host=".CONST_HOST.";dbname=".CONST_DBNAME,CONST_USER,CONST_PASSWORD);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM users where userid = :userid";
    $totalresults = $con->prepare($sql);
    $totalresults->bindParam(":userid", $userid);
    $myarray = $totalresults->execute();
    $rows = $totalresults->fetchAll();
    $betsql = "SELECT * FROM bets where userid = :userid";
    $betresults = $con->prepare($betsql);
    $betresults->bindParam(":userid", $userid);
    $betrows = $betresults->fetchAll();

    $didtheybet = false;
    if(!empty($betrows)) {
    	$didtheybet = true;
    }

} 
catch (Exception $e) 
    {
    $error = $e->getMessage();
    echo $error;
    }

$con = null;


if(empty($rows)) {
    $err = "No account information present.";
}

if ($err == "") {
    $username = $rows[0]['username'];
    $balance = $rows[0]['balance'];
}

//get balance as a percent of goal
$goal = 10000;

$current = ($balance / $goal) * 100;
//echo $current;



//here I will loop through the query to count how many bets the user has placed.
//it will also check the status of each row, and if bet placed in is progress, update the 
//open bets number.
$i = 0;
$total = 0; 
$openTotal = 0;          
while ($i < count($betrows)) {
    $total = $total + 1;

    if($betrows[$i]['status'] == "In Progress") {
        $openTotal = $openTotal + 1;
    }
    $i++;
}


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
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/mymain.css">
        <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
        <script src="js/myscript.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->


        <!-- Add your site or application content here -->
        <div class="container-fluid" >
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="homepage.php">Movie Bets</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="myaccount.php">My Account<span class="sr-only">(current)</span></a></li>
        <li><a href="mybets.php">My Current Bets</a></li>
        <li><a href="pendingbets.php">Pending Bets</a></li>
        <li ><a href="archivebets.php">Archived Bets</a></li>
        <li><a href="leaderboards.php">Leaderboards</a></li>
      </ul>
     
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php">Sign Out</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
        	<div class="row">
	      	  <div class="col-lg-12" id="title">
		      	  <h1>Your Account</h1>
	      	  </div>
	      	 </div>

   <div class="row">
        
       <div class="col-md-12">
     <div style="display:flex;justify-content:center;align-items:center;">
        <table cellpadding="15" class="table-responsive table-bordered  accounttable">

	

          
<tr>
    <th>Name</th>
    <th>Balance</th>
    <th>Total Bets Placed</th>
    <th>Total Open Bets</th>
</tr>


<tr>
    <td><?php echo $username ?></td>
    <td><?php echo $balance ?></td>
    <td><?php echo $total ?></td>
    <td><?php echo $openTotal ?></td>         
   
</tr>
             
        </table>
        </div> <!-- end row -->

        <div class="row">

        <div class="col-md-3">
        <span></span>
        </div>
        <div class="col-md-6">
        <h2 id="goal" style="text-align: center; color: green" class="bounce">Goal: $10,000</h2>
        		<div class="progress">
					  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $balance ?>" aria-valuemin="0" aria-valuemax="10000" style="width: <?php echo $current ?>%">
					    <span class="sr-only"><?php echo $current ?></span>
					  </div>
					</div>
        </div>

        <div class="col-md-3">
        <span></span>
        </div>
        </div>

        
        </div>
        </div>

        </div>  <!-- end container -->




        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Include all compiled plugins (below), or include individual files as needed -->
  	  <script src="js/bootstrap.min.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
    </body>
</html>
