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
    $sql = "SELECT * FROM `users` order by balance desc limit 5";
    $totalresults = $con->prepare($sql);
    $myarray = $totalresults->execute();
    $rows = $totalresults->fetchAll();


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
        <link rel="stylesheet" href="css/material-charts.css">
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
        <li><a href="myaccount.php">My Account<span class="sr-only">(current)</span></a></li>
        <li><a href="mybets.php">My Current Bets</a></li>
        <li><a href="pendingbets.php">Pending Bets</a></li>
        <li ><a href="archivebets.php">Archived Bets</a></li>
        <li class="active"><a href="leaderboards.php">Leaderboards</a></li>
      </ul>
     
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php">Sign Out</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
        	<div class="row">
	      	  <div class="col-lg-12" id="title">
		      	  <h1>Current Top 5</h1>
	      	  </div>
	      	 </div>

            <div class="row">
              <div class="col-lg-12">
                  <p>

                  </p>

              </div>

              <div class="row">
                <div class="col-lg-12">
                <center>
                     <div id="bar-chart"></div>
                </center>
                </div>
              </div>
             </div>




        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/material-charts.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <script type="text/javascript">
            
            $(document).ready(function() {
            //execute code
            var jsonArray =   <?php  echo json_encode($rows); ?>;
            var values = [];
            var names = [];

            for(var i = 0; i < jsonArray.length; i++) {
                var obj = jsonArray[i];
                values.push(obj.balance);
                names.push(obj.firstname);
            }

            console.log(values);
            console.log(names);


                var exampleBarChartData = {
                    "datasets": {
                        "values": values,
                        "labels": names,
                        "color": "blue"
                    },
                    "title": "Example Bar Chart",
                    "noY": true,
                    "height": "300px",
                    "width": "500px",
                    "background": "#FFFFFF",
                    "shadowDepth": "1"
                };

                MaterialCharts.bar("#bar-chart", exampleBarChartData)
            });
        </script>

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
