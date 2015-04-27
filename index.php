<?php

	//these are for the PHP Helper files
	//include('headers/databaseConn.php');
	//include('headers/AJAXFunctions.php');
	include('helpers.php');
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

		<!-- Custom CSS for the template -->
    	<link href="css/agency.css" rel="stylesheet">

		<!-- Custom Fonts -->
	    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
	    <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
	    <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
	    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

	    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	    <![endif]-->

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

	    	.index {
	    		background: rgba(66, 124, 200, 0.3);
	    		color: black;
	    	}

	    	.navbar {
	    		background: rgba(66, 124, 200, 0.3);
	    	}

	    	.text-white {
	    		color: white;	
	    	}

	    	/*body {
	    		background: url('img/header-bg.jpg');
	    		-webkit-background-size: cover;
			    -moz-background-size: cover;
			    background-size: cover;
			    -o-background-size: cover;
	    	}

	    	.mainWrapper {

	    	}

	    	.mainHeading {
	    		text-align: left;
	    		font-family: boldText;
	    		font-size: 4em;
	    		color:white;
	    	}

	    	.headerText {
	    		font-size: 3em;
	    		font-style: bold;
	    		text-align: center;
	    		font-family: regularText;
	    		color:white;
	    		margin: 20% 0 0 0%; 
	    	}

	    	nav {
	    		background: transparent;
	    	}
*/

			#alertMsg {
				z-index:9999; 
				position: absolute;
				margin: 2% 2% 2% 2%;
				font-family: boldText;
				position: absolute;
			}

			#popup {
				z-index:9999; 
				position: absolute;
				margin: 2% 2% 2% 2%;	
				font-family: boldText;
				position: absolute;
			}

			.section-heading {
				font-family: boldText;
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

					console.log("The Email Cookie already exists. Go ahead!");

					console.log(getCookie("userEmail"));

					alertMsg.children('p').remove();

					//set the "id" cookie here.
					alertMsg.append("<p>Logging you in... Please wait</p>").fadeIn();
					// $.ajax({
					// 	type: "GET",
					// 	url: "AJAXFunctions.php/SetCookieID",
					// 	data: {
					// 		no: "6", email: getCookie("userEmail")
					// 	},
					// 	success: function(response) {
					// 		if(response == "-1") {
					// 			alert("Error. Please try again.");
					// 		}
					// 		else {
					// 			setCookie("userID", response, 150);
					// 		}
					// 	},
					// 	error: function(response) {
					// 		//alert("ERROR in setting ID Cookie." + response.responseText);
					// 	}
					// });

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
								//window.location.href = "profile.php?exist=1";	

								//set the "id" cookie here.
								alertMsg.append("<p>Logging you in... Please wait</p>").fadeIn();
								$.ajax({
									type: "GET",
									url: "AJAXFunctions.php/SetCookieID",
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
										//alert("ERROR in setting ID Cookie." + response.responseText);
									}
								});

								// to go the network page bcoz the data already exists in the database.
								window.location.href = "home.php?exist=1";	
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
					console.log(email);
					setCookie("userEmail", email, 150);

					alertMsg.children('p').remove();

					//set the "id" cookie here.
					alertMsg.append("<p>Logging you in... Please wait</p>").fadeIn('fast');

					// should not be here.

					// $.ajax({
					// 	type: "GET",
					// 	url: "AJAXFunctions.php",
					// 	data: {
					// 		no: "6", email: getCookie("userEmail")
					// 	},
					// 	success: function(response) {
					// 		if(response == "-1") {
					// 			alert("Error. Please try again.");
					// 		}
					// 		else {
					// 			setCookie("userID", response, 150);
					// 		}
					// 	},
					// 	error: function(response) {
					// 		alert("ERROR in setting ID Cookie." + response.responseText);
					// 	}
					// });

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

								// here, set the ID Cookie for all future correspondences!
								$.ajax({
									type: "GET",
									url: "AJAXFunctions.php",
									data: {
										no: "6", email: getCookie("userEmail")
									},
									success: function(response) {
										if(response == "-1") {
											alert("Error in setting the Cookie ID. Please try again.");
										}
										else {
											setCookie("userID", response, 150);
										}
									},
									error: function(response) {
										alert("ERROR in setting ID Cookie." + response.responseText);
									}
								});

								// now, redirect to the profile page coz data is there in the database.
								//window.location.href = "profile.php?exist=1";	
								window.location.href = "home.php?exist=1";
							}
							else if(response == "-1") {

								// redirect to the profile page. Data is not there in the database.
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

				$('#btnWorks').on('click', function() {
					$('.worksModal').modal('show');
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

	<body id="page-top" class="index">

		<div id="alertMsg" class="alert alert-warning" role="alert">
		</div>

		<div id="popup" class="alert alert-danger" role="alert">
		</div>

		<nav class="navbar navbar-default navbar-fixed-top" style="z-index:10;">
	        <div class="container">
	            <!-- Brand and toggle get grouped for better mobile display -->
	             <!-- page-scroll -->
	            <div class="navbar-header page-scroll">
	                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	                    <span class="sr-only">Toggle navigation</span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                </button>
	                <a class="navbar-brand page-scroll" href="#page-top">MR - Connect</a>
	            </div>

	            <!-- Collect the nav links, forms, and other content for toggling -->
	            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	                <ul class="nav navbar-nav navbar-right">
	                    <li>
	                    	<a class="page-scroll" href="#" onclick="login()">Login</a>
	                    </li>
	                    <li>
	                    	<a class="page-scroll" href="http://mentored-research.com">MR - Home</a>
	                    </li>
	                    <li>
	                    	<!-- <a id="works" class="page-scroll" href="#">How it Works?</a>	 -->
	                    	<!-- data-toggle="modal" data-target="#worksModal" -->
	                    	<button id="btnWorks" class="btn btn-lg btn-primary" >
	                    		How it Works
	                    	</button>
	                    </li>
	                </ul>
	            </div>
	            <!-- /.navbar-collapse -->
	        </div>
	        <!-- /.container-fluid -->
	    </nav>

	   <!-- Services Section -->
	    <section id="works">
	        <div class="container">
	            <div class="row">
	                <div class="col-lg-12 text-center">
	                    <h2 class="section-heading" style="font-family: boldText;">Our Network</h2>
	                    <h3 class="section-subheading text-muted">Get the alumni of Mentored-Research, all in one place.</h3>
	                </div>
	            </div>
	            <div class="row text-center">
	                <div class="col-md-4">
	                    <span class="fa-stack fa-4x">
	                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
	                        <i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i>
	                    </span>
	                    <h4 class="service-heading" style="font-family: boldText;">Comprehensive</h4>
	                    <p class="text-muted">Stay connected with fellow Mentored-Research alumni</p>
	                </div>
	                <div class="col-md-4">
	                    <span class="fa-stack fa-4x">
	                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
	                        <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
	                    </span>
	                    <h4 class="service-heading" style="font-family: boldText;">Request Based</h4>
	                    <p class="text-muted">Enrich your network and broaden your horizons</p>

	                    <button id="btnLogin" class="btn btn-lg btn-primary" onclick="login()" style="margin:1% 1% 1% 1%;">
							Get Started Now!
						</button>

	                </div>
	                <div class="col-md-4">
	                    <span class="fa-stack fa-4x">
	                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
	                        <i class="fa fa-lock fa-stack-1x fa-inverse"></i>
	                    </span>
	                    <h4 class="service-heading" style="font-family: boldText;">Mentorship</h4>
	                    <p class="text-muted">Seek guidance and assistance from fellow alumni</p>
	                </div>
	            </div>
	        </div>
	    </section>

	    <div class="modal fade worksModal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title worksModalTitle">
							MR - Connect - The Way it Works!
						</h4>
					</div>

					<!-- for the modal body -->
					<div class="modal-body worksModalBody">

						<div class="row">
			                <div class="text-center">
			                    <h2 class="section-heading">How MR - Connect Works</h2>
			                </div>
			            </div>

			            <div class="row" style="margin: 5% 0% 0% 0%;">
			            	<ul class="timeline">
		                        <li>
		                            <div class="timeline-image">
		                                <img class="img-circle img-responsive" alt="">
		                            </div>
		                            <div class="timeline-panel">
		                                <div class="timeline-heading">
		                                    <h4 class="subheading">LOGIN!</h4>
		                                </div>
		                                <div class="timeline-body">
		                                    <p class="text-muted">Login using your LinkedIn Credentials. Since, this is a professional network, we'd take your Basic Profile info, Education and Experiences info only. </p>
		                                </div>
		                            </div>
		                        </li>

		                        <li class="timeline-inverted">
		                            <div class="timeline-image">
		                                <img class="img-circle img-responsive" alt="">
		                            </div>
		                            <div class="timeline-panel">
		                                <div class="timeline-heading">
		                                    <h4 class="subheading">There's some to Guide you!</h4>
		                                </div>
		                                <div class="timeline-body">
		                                    <p class="text-muted">You seek guidance in a specific field. say, CFA or GMAT or CAT etc.</p>
		                                </div>
		                            </div>
		                        </li>

		                        <li>
		                            <div class="timeline-image">
		                                <img class="img-circle img-responsive" alt="">
		                            </div>
		                            <div class="timeline-panel">
		                                <div class="timeline-heading">
		                                    <h4 class="subheading">Explore MR - Connect</h4>
		                                </div>
		                                <div class="timeline-body">
		                                    <p class="text-muted">Visit 'Our Network' and also make use of the 'Search Network' option to find awesome people, all under the umbrella of MR - Connect</p>
		                                </div>
		                            </div>
		                        </li>

		                        <li class="timeline-inverted">
		                            <div class="timeline-image">
		                                <img class="img-circle img-responsive" alt="">
		                            </div>
		                            <div class="timeline-panel">
		                                <div class="timeline-heading">
		                                    <h4 class="subheading">Start Connecting!</h4>
		                                </div>
		                                <div class="timeline-body">
		                                    <p class="text-muted">Send a connection request to a relevant person</p>
		                                </div>
		                            </div>
		                        </li>

		                        <li>
		                            <div class="timeline-image">
		                                <img class="img-circle img-responsive" alt="">
		                            </div>
		                            <div class="timeline-panel">
		                                <div class="timeline-heading">
		                                    <h4 class="subheading">We Moderate MR - Connect!</h4>
		                                </div>
		                                <div class="timeline-body">
		                                    <p class="text-muted">The connection requests will be moderated by the Mentored-Research team, who will facilitate a connection depending on the calendar of the expert and the urgency of the situation</p>
		                                </div>
		                            </div>
		                        </li>
	                        </ul>
			            </div>

					</div>   <!-- end of modal Body -->

					<!-- for the footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->


		<!-- for bootstrap CSS and JS files. Included here to improve the page load time -->
		<link type="text/css" href="BootStrap/css/bootstrap-theme.css" rel="stylesheet" />
		<link type="text/css" href="BootStrap/css/bootstrap.css" rel="stylesheet" />
		<script type="text/javascript" src="BootStrap/js/bootstrap.js"></script>

		<!-- Bootstrap Core JavaScript -->
	    <!-- <script src="js/bootstrap.min.js"></script> -->

	    <!-- Plugin JavaScript -->
	    <!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
	    <script src="js/classie.js"></script>
	    <script src="js/cbpAnimatedHeader.js"></script> -->

	    <!-- Contact Form JavaScript -->
	    <!-- <script src="js/jqBootstrapValidation.js"></script> -->
	    <!-- <script src="js/contact_me.js"></script> -->

	    <!-- Custom Theme JavaScript -->
	    <!-- <script src="js/agency.js"></script> -->

	</body>

</html>