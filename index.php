<?php

	//these are for the PHP Helper files
	//include('headers/databaseConn.php');
	//include('headers/AJAXFunctions.php');
	include('helpers.php');

	/*if(isset($_COOKIE["user"]) && isset($_COOKIE["userId"])) {    //this is when the cookies exist aleady!

		//Also, consider the fact that cookies might not exist. But the user is already there in the database. Clear that too!!
		//leave this thing as of now!!
		header("location: profile.php?exist=1");
	}
	else if(!isset($_COOKIE["user"]) && isset($_COOKIE["userId"])) {
		header("location: profile.php?exist=2");	
	}
	else if(isset($_COOKIE["user"]) && !isset($_COOKIE["userId"])) {
		header("location: profile.php?exist=3");	
	}
	else {
		//die("There are no Cookies!!");
		//header("location: profile.php?exist=-1&int=1");		
	}   */ 

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<meta name="Mentored-Research Connect" content="MR Connect, Mentored-Research">
		<meta name="author" content="Sagar anand, Mentored-Research Tech Team, MR Connect">

		<title>MR-Connect</title>

		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
		<link rel="icon" href="img/favicon.ico" type="image/x-icon" />

		<!-- for the jQuery CDN -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

		<!-- for the Scrolly jQuery plugin -->
		<script src="js/jquery.scrolly.min.js"></script>

		<!-- for all the custom javascript functions -->
		<script src="js/scripts.js"></script>

		<!-- for all the styles with the media queries -->
		<link href="css/styles.css" rel="stylesheet" media="screen" />	

		<style type="text/css">

	    	@font-face {
	    		font-family: regularText;
	    		src: url('fonts/AlegreyaSansSC-Regular.ttf');
	    	}

	    	@font-face {
	    		font-family: boldText;
	    		src: url('fonts/AlegreyaSansSC-Bold.ttf');
	    	}

	    	@font-face {
	    		font-family: lightText;
	    		src: url('fonts/AlegreyaSansSC-Light.ttf');
	    	}

	    	@font-face {
	    		font-family: mediumText;
	    		src: url('fonts/AlegreyaSansSC-Medium.ttf');
	    	}

    	</style>

    	<script type="text/javascript">
    		$(document).ready(function() {

    			var btnLogin = $('#btnLogin');

    			btnLogin.on('click', function() {

					//alert(getCookie("userEmail") + " --> " + getCookie("userID"));

    				//here, check if the cookies exist. If they exist, then go to exist=1 or else exist=2
    				if(getCookie("userEmail") != "" && getCookie("userID") != "") {
    					//when both the cookies exists. Load data from database here, obviously after checking if data exists!
    					window.location.href =  "profile.php?exist=1";	
    				}
    				else if(getCookie("userEmail") != "" && getCookie("userID") == "") {
    					//when either of the cookies do not exist. Load data from the database if exists, otherwise from Linkedin.
    					window.location.href =  "profile.php?exist=2";		
    				}
    				else if(getCookie("userEmail") == "" && getCookie("userID") != "") {
    					//when either of the cookies do not exist. Load data from the database if exists, otherwise from Linkedin.
    					window.location.href =  "profile.php?exist=2";		
    				}
    				else if(getCookie("userEmail") == "" && getCookie("userID") == "") {
    					//No cookies exist. Load data from database if record exists. Otherwise from linkedin.
    					window.location.href =  "profile.php?exist=3";		
    				}

    				return false;
    			});

    		});
    	</script>
	</head>	

	<body>
		
		<button id="btnLogin" class="btn btn-lg btn-primary btn-block">
			Sign in and Get the LinkedIn Data
		</button>

		<!-- for bootstrap CSS and JS files. Included here to improve the page load time -->
		<link type="text/css" href="BootStrap/css/bootstrap-theme.css" rel="stylesheet" />
		<link type="text/css" href="BootStrap/css/bootstrap.css" rel="stylesheet" />
		<script type="text/javascript" src="BootStrap/js/bootstrap.js"></script>

	</body>
</html>