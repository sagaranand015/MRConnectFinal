<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<meta name="Mentored-Research Connect" content="MR Connect, Mentored-Research">
		<meta name="author" content="Sagar anand, Mentored-Research Tech Team, MR Connect">

		<title>MR-Connect - Logout</title>

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

	    	p, h1, button {
	    		font-family: regularText;
	    	}
    	</style>

    	<!-- onLoad: onLinkedInLoad -->
		<script type="text/javascript" src="http://platform.linkedin.com/in.js">
		    api_key: 77i3n33j66yvv6
		    authorize: true
		</script>

		 <script type="text/javascript">

		 	var qs = getQueryStrings();

	        function login() {

	        	var alertMsg = $('#alertMsg').fadeOut();
				var popup = $('#popup').fadeOut();    			

        		//here, check if the cookies exist. If they exist, then go to exist=1 or else exist=2
				if(getCookie("userEmail") != "") {
					//when both the cookies exists. Load data from database here, obviously after checking if data exists!

					console.log("Cookies exists. " + getCookie("userEmail"));

					alertMsg.children('p').remove();

					//set the "id" cookie here.
					alertMsg.append("<p>Logging you in... Please wait</p>").fadeIn();
					$.ajax({
						type: "GET",
						url: "AJAXFunctions.php",
						data: {
							no: "6", email: getCookie("userEmail")
						},
						success: function(response) {
							if(response == "-1") {
								alert("Error. Please try again.");
							}
							else {
								setCookie("userID", response, 150);
							}
						},
						error: function(response) {
							alert("ERROR in setting ID Cookie.");
						}
					});

					//check if the user exists in the database. If yes, then go ahead. Otherwise, go to linkedIn function.
					$.ajax({
						type: "GET",
						url: "AJAXFunctions.php",
						data: {
							no: "5", email: getCookie("userEmail"), id: getCookie("userID")
						},
						success: function(response) {
							alertMsg.children("p").remove();
							alertMsg.fadeOut('fast');
							if(response == "1") {
								window.location.href = "profile.php?exist=1";	
							}
							else if(response == "-1") {
								window.location.href = "profile.php?exist=-1";		
							}
							else {
								alert("Error occured. Please try again!");
							}
						},
						error: function(response) {
							alert("Error. " + response.responseText);
						}
					});
				}
				else if(getCookie("userEmail") == "") {
					//No cookies exist. Load data from database if record exists. Otherwise from linkedin.
					console.log("Cookies DOES NOT exist. " + getCookie("userEmail"));
					IN.User.authorize(linkedInAuth);
				}
				else {
					alert("Problem with the cookies and stuff!!");
				}
	        }

	        //this is the function to check if the user exists in the database, after the cookies DO NOT exist.
	        function linkedInAuth() {

	        	var alertMsg = $('#alertMsg').fadeOut();
				var popup = $('#popup').fadeOut();    			

		 		IN.API.Profile("~").fields("first-name", "last-name", "email-address", "picture-url", "location", "public-profile-url", "summary", "educations", "pictureUrls::(original)", "phone-numbers", "primary-twitter-account", "positions").result(function (data) {
                    console.log(data);

                	var memData = data.values[0];
					var email = memData.emailAddress;
					setCookie("userEmail", email, 150);

					alertMsg.children('p').remove();

					//set the "id" cookie here.
					alertMsg.append("<p>Logging you in... Please wait</p>").fadeIn('fast');
					$.ajax({
						type: "GET",
						url: "AJAXFunctions.php",
						data: {
							no: "6", email: getCookie("userEmail")
						},
						success: function(response) {
							if(response == "-1") {
								alert("Error. Please try again.");
							}
							else {
								setCookie("userID", response, 150);
							}
							alert("ID Cookie set successfully.");
						},
						error: function(response) {
							alert("ERROR in setting ID Cookie.");
						}
					});

					//now, check if email exists in the database and then necessary action.
					//check if the user exists in the database. If yes, then go ahead. Otherwise, go to linkedIn function.
					$.ajax({
						type: "GET",
						url: "AJAXFunctions.php",
						data: {
							no: "5", email: getCookie("userEmail"), id: getCookie("userID")
						},
						success: function(response) {
							alertMsg.children("p").remove();
							alertMsg.fadeOut('fast');
							if(response == "1") {
								window.location.href = "profile.php?exist=1";	
							}
							else if(response == "-1") {
								window.location.href = "profile.php?exist=-1";		
							}
							else {
								alert("Error occured. Please try again!");
							}
						},
						error: function(response) {
							alert("Error. " + response.responseText);
						}
					});

		            }).error(function (data) {
		                console.log(data);
	            });	
		 	}
	    </script>


    	<script type="text/javascript">
    		$(document).ready(function() {

    			var alertMsg = $('#alertMsg').fadeOut();
				var popup = $('#popup').fadeOut();    

    			var btnHome = $('#btnHome');
    			btnHome.on('click', function() {
    				window.location.href = "index.php";
    				return false;
    			});

    		});
    	</script>

    	<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-61843203-1', 'auto');
			ga('send', 'pageview');
		</script>
		
	</head>

	<body style="background: #070716; color:white;">
		
		<div id="alertMsg" class="alert alert-warning" role="alert">
		</div>

		<div id="popup" class="alert alert-danger" role="alert">
		</div>

		<div class="col-lg-10 col-lg-offset-1 col-xs-10 col-xs-offset-1 col-md-10 col-md-offset-1" style="margin-top:3%;">
			<h1 class="page-header" style="font-size:8em;"> Thank You. </h1>
	        <p style="font-size: 1.3em;" id="txtError">
	            You have been successfully logged out. Thank You for using MR - Connect.
	            <br /><br />
	            <button id="btnLogin" class="btn btn-lg btn-primary" onclick="login()">
	            	Login Again
	            </button>
	            <button id="btnHome" class="btn btn-lg btn-primary">
	            	Home Page
	            </button>
	        </p>

        </div>

		<!-- for bootstrap CSS and JS files. Included here to improve the page load time -->
		<link type="text/css" href="BootStrap/css/bootstrap-theme.css" rel="stylesheet" />
		<link type="text/css" href="BootStrap/css/bootstrap.css" rel="stylesheet" />
		<script type="text/javascript" src="BootStrap/js/bootstrap.js"></script>

	</body>

</html>