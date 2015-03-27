<?php 
	//these are for the PHP Helper files
	//include('headers/databaseConn.php');
	include('helpers.php');

	//to get the query String values in the respective variables.
	if(isset($_SERVER["QUERY_STRING"])) {
		parse_str($_SERVER['QUERY_STRING']);
	}
	else {
		header("location: profile.php?exist=1");
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<meta name="Mentored-Research Connect" content="MR Connect, Mentored-Research">
		<meta name="author" content="Sagar anand, Mentored-Research Tech Team, MR Connect">

		<title>MR-Connect Profile Page</title>

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

	    	h1 h2 h3 h4 h5 h6 p span {
	    		font-family: regularText;
	    		color:black;
	    	}

	    	a:hover {
	    		cursor: pointer;
	    	}

	    	.main-wrapper {
	    		background-color: rgb(233, 233, 233);
	    		z-index: -1;
	    	}

			.head {
				height: 600px;
				background: url('img/head-back.jpg');			
				-webkit-background-size: cover;
			    -moz-background-size: cover;
			    background-size: cover;
			    -o-background-size: cover;
			}

			.headingName {
				color: white;
				font-family: boldText;
			}

			.navigationDiv {
				background: white;
				padding: 1% 0% 1% 0%;
				/*border-radius: 10%;   */
				border-radius: 10px;
			}

			.profileNav>ul>li {
				/*display: inline;  */
				font-family: boldText;  
				font-size: 18px;
				/*margin-left: 10%;    */
			}

			.displayImg {
				border-radius: 20%;
				/*margin-left: 80%;  */
				/*margin-top: 20%;    */
			}

			.basic {
				/*margin: 1% 1% 1% 3%;  */
				font-family: regularText;
				background-color: #fff;
			}

			.education {
				/*margin: 1% 1% 1% 3%;  */
				font-family: regularText;
				background-color: #fff;
			}

			.experience {
				/*margin: 1% 1% 1% 3%;  */
				font-family: regularText;
				background-color: #fff;	
			}

			.interest {
				/*margin: 1% 1% 1% 3%;  */
				font-family: regularText;
				background-color: #fff;	
			}

			.interest>small {
				font-size: 1.2em;
			}

			button {
				font-family: regularText;
			}

			.requestDiv {
				background:red; 
				height: 300px;
				margin: 2% 0% 0% 4%;
			}

			a.editButton {
				font-size: 0.5em;
			}
			a.eduEditButton {
				font-size: 0.5em;
			}
			a.expEditButton {
				font-size: 0.5em;
			}

			.page-heading {
				color: rgb(180, 180, 180);
			}

			.name {
				font-style: bold;
				font-size: 3em; 
			}
			.email {
				font-style: bold;
				font-size: 1.5em; 	
			}
			.contact {
				font-style: bold;
				font-size: 1.5em; 	
			}
			.address {
				font-size: 1.5em;
			}
			.profile {
				font-size: 1.5em;
			}
			.blog {
				font-size: 1.5em;
			}
			.lastAss {
				font-size: 1.5em;
			}

			.education p {
				font-size: 1.5em;
			}

			.experience p {
				font-size: 1.5em;
			}

			.interest h4 {
				font-style: bold;
				font-size: 1.5em;	
			}

			.interest p {
				font-size: 1.2em;	
			}

			.eduTable, .expTable {
				border: solid 1px rgb(180, 180, 180);
			}

			footer {
				margin-top: 2%;
				background-color: rgb(200, 200, 200);
			}

			/*.requestDiv {
				position: fixed;
				float: right;
				margin: 5% 0% 0% 5%;
				background-color: blue;
				height: 500px;
			}  */
		   
		</style>

		<!-- onLoad: onLinkedInLoad -->
		<script type="text/javascript" src="http://platform.linkedin.com/in.js">
		    api_key: 77i3n33j66yvv6
		    onLoad: onLinkedInLoad
		    authorize: true
		</script>

		 <script type="text/javascript">

		 	var qs = getQueryStrings();

	        function onLinkedInLoad() {

	        	IN.User.authorize(onlyAuthenticate);
	        	
        		/*if(qs["exist"] == "1") {
        			IN.User.authorize(onlyAuthenticate);
        		}
        		else if(qs["exist"] == "2") {
        			//IN.User.authorize(onlyAuthenticate);
        			alert("Exist = 2");	
        		}
        		else if(qs["exist"] == "3") {
        			//IN.User.authorize(onlyAuthenticate3);
        			alert("Exist = 3");	
        		}
        		else {
        			alert("We have an error here.");
        		}  */
	        }   //end of the onLinkedInLoad function!!

	        //this is the function for only authentication.
	        function onlyAuthenticate() {
	        	//here, all the data needs to be loaded from the database!
	        	console.log("I m in the onlyAuthenticate function. Data to be loaded from Database!");
	        	//now, get data from the database here and show it appropriately!!
	        	$.ajax({
	        		type: "GET",
	        		url: "AJAXFunctions.php/LoadData",
	        		data: {
	        			no: "2", email: getCookie("userEmail"), id: getCookie("userID")
	        		},
	        		success: function(response) {
	        			alert("Success in getting the data from the database" + response);
	        		},
	        		error: function() {
	        			alert("Error in getting the data from the database");
	        		}
	        	});
	        }

	        //this is the authenticate function here!!
	        function linkedInAuth() {
	            console.log("I m in authorize function (mine)");

	            //this is how to get all the data from the user's linkedin Profile!
	            IN.API.Profile("me").fields("first-name", "last-name", "email-address", "picture-url", "location", "public-profile-url", "summary", "educations", "pictureUrls::(original)", "phone-numbers", "primary-twitter-account", "positions").result(function (data) {
	                    console.log(data);

	                    var memData = data.values[0];

	                    //var jsonBasic = JSON.stringify(memData);
	                    var jsonPhone = JSON.stringify(memData.phoneNumbers.values[0]);
	                    var jsonPic = JSON.stringify(memData.pictureUrls.values[0]);
	                    var jsonEdu = JSON.stringify(memData.educations.values);
	                    var jsonExp = JSON.stringify(memData.positions.values);

	                    //all the data from the user's linkedin profile goes here into the AJAx call and then saved in to the database.
	                    $.ajax({
	                    	type: "GET",
	                    	url: "AJAXFunctions.php",
	                    	data: {
	                    		no: "1", basic: memData, contact: jsonPhone, picture: jsonPic, education: jsonEdu, experience: jsonExp
	                    	},
	                    	success: function(response) {

	                    		//here, save the cookies in javaScript!
	                    		var resArr = response.split(", ");
	                    		response = resArr[0];

	                    		var userEmail = resArr[1];
	                    		var userID = resArr[2];

	                    		setCookie("userEmail", userEmail, 150);
	                    		setCookie("userID", userID, 150);

	                    		if(response == "1") {
	                    			alert("Data Saved Successfully.");
	                    		}
	                    		else {
	                    			alert("Error in saving the data. Please recheck." + response);	
	                    		}
	                    	},
	                    	error: function(response) {
	                    		alert("This is the error in AJAX. " + response);
	                    	}
	                    });


	                    $('#headName').text(memData.firstName + "  " + memData.lastName);
	                    $('.displayImg').attr('src', memData.pictureUrls.values[0]);  

	                    $('.name').children('span').html(memData.firstName + " " + memData.lastName);
	                    $('.name').attr('data-content', memData.firstName + " " + memData.lastName);

	                    $('.email').children('span').html(memData.emailAddress);
	                    $('.email').attr('data-content', memData.emailAddress);


	                    var phno = memData.phoneNumbers.values[0].phoneNumber;
	                    if(phno == "undefined" || phno == "") {
	                    	$('.contact').children('span').html("<b>Add Contact Number</b>");
	                    	$('.contact').attr('data-content', "");
	                    }
	                    else {
	                    	$('.contact').children('span').html(phno);
	                    	$('.contact').attr('data-content', phno);
	                    }

						$('.address').children('span').html(memData.location.name);
	                    $('.address').attr('data-content', memData.location.name);	    

	                    $('.profile').children('span').children('a').attr("href", memData.publicProfileUrl);
	                    $('.profile').attr('data-content', memData.publicProfileUrl);	

	                    $('.blog').children('span').html(memData.primaryTwitterAccount.providerAccountName);
	                    $('.blog').children('span').html(memData.primaryTwitterAccount.providerAccountName);

	                    //now, for the education listing from linkedin API
	                    var edu = memData.educations.values;
	                    var markup = "";

	                    //for removing the tables!
	                    $('.education').children('table').remove();

	                    for(var i = 0;i<edu.length;i++) {

	                        if(edu[i].startDate == undefined) {
	                        	edu[i].startDate = {year: ""};
	                        }
	                        if(edu[i].endDate == undefined) {
	                        	edu[i].endDate = {year: ""};	
	                        }
	                        if(edu[i].schoolName == undefined) {
	                        	edu[i].schoolName = "Add School Name";	
	                        }
	                        if(edu[i].degree == undefined) {
	                        	edu[i].degree = "Add Degree";	
	                        }
	                        if(edu[i].fieldOfStudy == undefined) {
	                        	edu[i].fieldOfStudy = "Add Field Of Study";	
	                        }

	                        //console.log(edu[i]);
	                        console.log(edu[i].schoolName + " -> " + edu[i].degree + " -> " + edu[i].startDate + " -> " + edu[i].endDate + " -> " + edu[i].fieldOfStudy);

	                        //here, add each school to the HTML Markup.
	                        markup += "<table class='table table-responsive table-striped eduTable'><tr><td><p id='eduSchoolName class='schoolName' data-content='" + edu[i].schoolName + "'><span>" + edu[i].schoolName + "</span><a class='glyphicon glyphicon-pencil eduEditButton' aria-hidden='true'></a></p></td><tr><td><p id='eduDate' class='date' data-content='" + edu[i].startDate.year + " - " + edu[i].endDate.year + "'><span>" + edu[i].startDate.year + " - " + edu[i].endDate.year + "</span><a class='glyphicon glyphicon-pencil eduEditButton' aria-hidden='true'></a></p></td></tr><tr><td><p id='eduDegree' class='degree' data-content='" + edu[i].degree +  "'><span>" + edu[i].degree +  "</span><a class='glyphicon glyphicon-pencil eduEditButton' aria-hidden='true'></a></p></tr><tr></td><td><p id='eduFOS' class='fos' data-content='" + edu[i].fieldOfStudy + "'><span>" + edu[i].fieldOfStudy + "</span><a class='glyphicon glyphicon-pencil eduEditButton' aria-hidden='true'></a></p>	</td></tr></table>";
	                    }   //end of for loop
	                    $('.education').append(markup);

	                    //for all the events that happen to the dynamic elements!
	                    var eduEditButton = $('.eduEditButton').hide();
	                    var eduTable = $('.eduTable');

	                    //for the on mouse over event on the Education Div
	                    eduTable.on('mouseover', function() {
	                    	eduEditButton.show();
	                    	return false;
	                    });

	                    //for the on mouse out event on the Education Listings Div
	                    eduTable.on('mouseout', function() {
	                    	eduEditButton.hide();
	                    	return false;
	                    });

	                    var eduEditModal = $('.eduEditModal');

	                    //for the click event of the edit button in the education Div!
	                    eduEditButton.on('click', function() {
	                    	//show the update modal for the education Div here.

	                		//get all the previous values in the Education Div here!!
	                		/*var school = $(this).parent().attr('data-content');
	                		var date = $(this).parent().attr('data-content');
	                		var degree = $(this).parent().attr('data-content');
	                		var fos = $(this).parent().attr('data-content');

	                		alert(school + " -> " + date + " -> " + degree + " -> " + fos);  */

	                		eduEditModal.modal('show');
	                		$('.editEduModalTitle').html("Edit Your Education Listings");

	                    	return false;
	                    });

	                    //for the update button in the update Education Listings!
	                    $('.eduBtnUpdate').on('click', function() {
	                    	alert("This is the update button for education listing");
	                    	return false;
	                    });


	                    //now, for all the experience listing here.
	                    var exp = memData.positions.values;
	                    console.log(exp);

	                    var expMarkup = "";

	                    //for removing the previous entry
	                    $('.experience').children('table').remove();

	                    for(var i = 0;i<exp.length;i++) {
	                    	if(exp[i].startDate == undefined) {
	                        	exp[i].startDate = {year: ""};
	                        }
	                        if(exp[i].endDate == undefined) {
	                        	exp[i].endDate = {year: ""};	
	                        }
	                        if(exp[i].company == undefined) {
	                        	exp[i].company = {name: ""};	
	                        }
	                        if(exp[i].title == undefined || exp[i].title == "") {
	                        	exp[i].title = "";	
	                        }
	                        if(exp[i].summary == undefined) {
                        		exp[i].summary = "Summary here";
	                        }
	                        if(exp[i].isCurrent == true) {
	                        	exp[i].endDate = {year: "Currently Working Here"};
	                        }

	                    	console.log(exp[i].company.name + " -> " + exp[i].title + " -> " + exp[i].startDate.year + " -> " + exp[i].endDate.year + " -> " );

	                    	//here, add each experience listing to the HTML Markup.
	                        expMarkup += "<table class='table table-responsive table-striped expTable'><tr><td><p id='eduCompanyName class='companyName' data-content='" + exp[i].company.name + "'><span>" + exp[i].company.name + "</span><a class='glyphicon glyphicon-pencil expEditButton' aria-hidden='true'></a></p></td><tr><td><p id='expDate' class='date' data-content='" + exp[i].startDate.year + " - " + exp[i].endDate.year + "'><span>" + exp[i].startDate.year + " - " + exp[i].endDate.year + "</span><a class='glyphicon glyphicon-pencil expEditButton' aria-hidden='true'></a></p></td></tr><tr><td><p id='expTitle' class='title' data-content='" + exp[i].title +  "'><span>" + exp[i].title +  "</span><a class='glyphicon glyphicon-pencil expEditButton' aria-hidden='true'></a></p></tr><tr></td><td><p id='expSummary' class='summary' data-content='" + exp[i].summary + "'><span>" + exp[i].summary + "</span><a class='glyphicon glyphicon-pencil expEditButton' aria-hidden='true'></a></p>	</td></tr></table>";
	                    }   //end of for loop
	                    $('.experience').append(expMarkup);

	                    //for all the events that happen to the dynamic elements in the experience listings page!
	                    var expEditButton = $('.expEditButton').hide();
	                    var expTable = $('.expTable');

	                    //for the on mouse over event on the experience Div
	                    expTable.on('mouseover', function() {
	                    	expEditButton.show();
	                    	return false;
	                    });

	                    //for the on mouse out event on the experience Listings Div
	                    expTable.on('mouseout', function() {
	                    	expEditButton.hide();
	                    	return false;
	                    });

	                    var expEditModal = $('.expEditModal');

	                    //for the click event of the edit button in the Experience Div!
	                    expEditButton.on('click', function() {
	                    	//show the update modal for the education Div here.

	                		//get all the previous values in the Education Div here!!
	                		/*var school = $(this).parent().attr('data-content');
	                		var date = $(this).parent().attr('data-content');
	                		var degree = $(this).parent().attr('data-content');
	                		var fos = $(this).parent().attr('data-content');

	                		alert(school + " -> " + date + " -> " + degree + " -> " + fos);  */

	                		expEditModal.modal('show');
	                		$('.editExpModalTitle').html("Edit Your Experience Listings");

	                    	return false;
	                    });

	                    //for the update button in the update Education Listings!
	                    $('.expBtnUpdate').on('click', function() {
	                    	alert("This is the update button for Experience listing");
	                    	return false;
	                    });


	                }).error(function (data) {
	                    console.log(data);
	                });
	        }
	    </script>

		<script type="text/javascript">
			$(document).ready(function() {

				//for the scrolling thing!
				$('.scrolly').scrolly();

				//for making the labels editable
				var basicProfile = $('#basicProfile');
				var educationDiv = $('#educationDiv');

				//for the edit buttons that appear on mouse over.
				var editButton = $('.editButton').hide();
				//var eduEditButton = $('.eduEditButton').hide();

				var editModal = $('.editModal');

				//for the on mouse over event on the basic Profile Div
				basicProfile.on('mouseover', function() {
					editButton.show();
					return false;
				});

				//for the on mouse out event on the basic Profile Div
				basicProfile.on('mouseout', function() {
					editButton.hide();
					return false;
				});

				//for the click event of the edit buttons
				editButton.on('click', function() {
					var prev = $(this).parent().attr('data-content');
					
					editModal.modal('show');
					$('.editModalTitle').html("Edit Your Basic Info");
					$('.editModalBody').children('.updateForm').remove();

					$('.editModalBody').append("<div class='updateForm'><form><table class='table table-striped'><tr><td><label>Edit:</label></td><td><input type='text' class='form-control updateNewVal' value='" + prev + "' placeholder='New Value here' /></td></tr></table></form><button class='btn btn-lg btn-primary btnUpdateBasic' data-value='" + prev + "'>Update</button></div>");

				});

				//for the update button of the basic info thing
				$('.editModalBody').delegate('.btnUpdateBasic', 'click', function() {
					var prevVal = $(this).attr('data-value');

					var newVal = $('.updateNewVal').val();

					alert(prevVal + " -> " + newVal);
					return false;
				});

				//this is for the toggling effect of the interest areas!
              $('.interest a').on('click', function () {
                  var a = $(this);
                  if (a.hasClass('list-group-item-success')) {
                      if (a.children('input').is(':focus')) {
                      }
                      else {
                          $(this).removeClass('list-group-item-success');
                      }
                  }
                  else {
                      $(this).addClass('list-group-item-success');
                  }
                  return false;
              });

			});
		</script>
	</head>

	<body id="bodyTop">

		<!--  this is for the main first div -->
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 head" id="headDiv">

			<!-- for the name as heading thing (centred) -->
			<h1 class="page-header text-center headingName" id="headName">
				
			</h1>

			<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2 navigationDiv">
				<div class="profileNav">
					<ul class="nav nav-pills">
						<li role="presentation">
							<a class="scrolly" href="#basicProfile">Basic Info</a>
						</li>
						<li role="presentation">
							<a class="scrolly" href="#educationDiv">Education</a>
						</li>
						<li role="presentation">
							<a class="scrolly" href="#experienceDiv">Work Experience</a>
						</li>
						<li role="presentation">
							<a class="scrolly" href="#interestDiv">Interests</a>
						</li>
					</ul>
				</div>
			</div>

			<!-- for the image div -->
			<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 imageDiv">
				<img src="img/dp.jpg" class="displayImg" width="225" height="225">
			</div>
		</div>   <!--- end of the main first div -->


		<!-- this is the div for all the content of the 4 tabs -->
		<div id="main" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-wrapper">

			<div class="col-lg-8 col-md-8 col-sm-11 col-xs-11 basic" id="basicProfile">
				<h1 class="page-header page-heading">Basic Profile Info</h1>

				<table class="table table-responsive table-striped">
					<tr>
						<td>
							<p id="basicName" class="name" data-content="">
								<span></span>
								<a class="glyphicon glyphicon-pencil editButton" aria-hidden="true"></a>
							</p>	
						</td>
					</tr>
					<tr>
						<td>
							<p id="basicEmail" class="email" data-content="">
								<span></span>
								<a class="glyphicon glyphicon-pencil editButton" aria-hidden="true"></a>
							</p>	
						</td>
					</tr>
					<tr>
						<td>
							<p id="basicContact" class="contact" data-content="">
								<span></span>
								<a class="glyphicon glyphicon-pencil editButton" aria-hidden="true"></a>
							</p>			
						</td>
					</tr>
					<tr>
						<td>
							<p id="basicAdd" class="address" data-content="">
								<span></span>
								<a class="glyphicon glyphicon-pencil editButton" aria-hidden="true"></a>
							</p>	
						</td>
					</tr>
					<tr>
						<td>
							<p id="basicProfile" class="profile" data-content="">
								<span><a href="#" target="_blank">Your LinkedIn Profile</a></span>
								<a class="glyphicon glyphicon-pencil editButton" aria-hidden="true"></a>
							</p>	
						</td>
					</tr>
					<tr>
						<td>
							<!-- this is for the twitter handle -->
							<p id="basicBlog" class="blog" data-content="">
								<span></span>
								<a class="glyphicon glyphicon-pencil editButton" aria-hidden="true"></a>
							</p>
						</td>
					</tr>
				</table>

				<p id="basicLastAss" class="lastAss" data-content="">
					<span>Last Associated with ERI in: </span>
					<select class="form-control">
						<option value="S2011">
							ERI Spring 2011
						</option>
						<option value="F2011">
							ERI Fall 2011
						</option>
						<option value="S2012">
							ERI Spring 2012
						</option>
						<option value="F2012">
							ERI Fall 2012
						</option>
						<option value="S2013">
							ERI Spring 2013
						</option>
						<option value="F2012">
							ERI Fall 2013
						</option>
						<option value="S2012">
							ERI Spring 2014
						</option>
						<option value="F2012">
							ERI Fall 2014
						</option>
						<option value="S2012">
							ERI Spring 2015
						</option>
					</select>
					<span>As: </span>
					<select class="form-control">
						<option value="1">
							Director
						</option>
						<option value="2">
							Mentor
						</option>
						<option value="3">
							Mentee
						</option>
						<option value="0">
							Not Applicable
						</option>
					</select>
					<!-- <a class="glyphicon glyphicon-pencil editButton" aria-hidden="true"></a> -->
				</p> 
			</div>   <!-- end of the Basic Profile div -->

			<!-- this is for the education listings div -->
			<div class="col-lg-8 col-md-8 col-sm-11 col-xs-11 education" id="educationDiv">
				<h1 class="page-header page-heading">Education Listings</h1>

				<!-- data will come dynamically -->

			</div>   <!-- end of the education div -->

			<!-- this is for the experience listings div -->
			<div class="col-lg-8 col-md-8 col-sm-11 col-xs-11 experience" id="experienceDiv">
				<h1 class="page-header page-heading">Experience Listings</h1>

				<!-- data will come dynamically -->

			</div>   <!-- end of the Experince Listings div -->

			<!-- this is for the interest areas div -->
			<div class="col-lg-8 col-md-8 col-sm-11 col-xs-11 interest" id="interestDiv">
				<h1 class="page-header page-heading">Your Interests</h1>
				<small>
                	Let us know your areas of interest for which one should contact you for help/guidance. Please choose from among the ones below. If your domain of expertise is not stated here, please share the same through the *other* feature. If there are more such domains, please separate them using a Semi-Colon. 
                </small>

                <br />
                <br />

				<div class="list-group">
                    <a href="#" class="list-group-item" id="intArea1">
                        <h4 class="list-group-item-heading">G.M.A.T.</h4>
                        <p class="list-group-item-text">Scored a 700+? Can help someone bring his/her dreams of studying in an Ivy League school to reality? Please select this option</p>
                        <input type="hidden" value="GMAT" runat="server" id="txtGmatIntArea" />
                    </a>
                    <a href="#" class="list-group-item" id="intArea2">
                        <h4 class="list-group-item-heading">C.A.T./X.A.T.</h4>
                        <p class="list-group-item-text">i.	99%iler? Studying in one of the IIMs or XLRI? Enthused to share prep tips and your strategy with someone who wishes to ace the entrance examination? Please select this option</p>
                        <input type="hidden" value="CAT/XAT" runat="server" id="txtCatIntArea" />
                    </a>
                    <a href="#" class="list-group-item" id="intArea3">
                        <h4 class="list-group-item-heading">Education</h4>
                        <p class="list-group-item-text">Alumnus or student of a top-notch school? Can share general information about the school, interview tips to get into that school with an aspirant? Please select this option
                        </p>
                        <br />
                        <input type="text" runat="server" class="form-control" id="txtEducationIntArea" placeholder="School Name you attended, separated by commas" />
                    </a>
                    <a href="#" class="list-group-item" id="intArea4">
                        <h4 class="list-group-item-heading">Work Experience</h4>
                        <p class="list-group-item-text">Can help someone know more about the organization you worked for or are currently working with? Can help him/her with a referral? Have sound knowledge of your domain you are keen on sharing with others? Please select this option.</p>
                        <br />
                        <input type="text" runat="server" class="form-control" id="txtWorkExpIntArea" placeholder="Company you worked for, separated by commas" />
                    </a>
                    <a href="#" class="list-group-item" id="intArea5">
                        <h4 class="list-group-item-heading">C.F.A.</h4>
                        <p class="list-group-item-text">Can help someone know more about the organization you worked for or are currently working with? Can help him/her with a referral? Have sound knowledge of your domain you are keen on sharing with others? Please select this option.</p>
                        <br />
                        <input type="hidden" runat="server" class="form-control" id="txtCfaIntArea"  />
                    </a>
                    <a href="#" class="list-group-item" id="intArea6">
                        <h4 class="list-group-item-heading">F.R.M.</h4>
                        <p class="list-group-item-text">Can help someone know more about the organization you worked for or are currently working with? Can help him/her with a referral? Have sound knowledge of your domain you are keen on sharing with others? Please select this option.</p>
                        <br />
                        <input type="hidden" runat="server" class="form-control" id="txtFrmIntArea"  />
                    </a>
                </div>

                <button class="btn btn-lg btn-primary btn-block btnSaveInterest">
                	Save/Update Interest Areas
                </button>

			</div>   <!-- end of the interest Areas div -->

			<footer class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
	            <ul class="nav navbar-nav navbar-left">
	                <li>
	                    <a href="#">&copy; Mentored-Research</a>
	                </li>
	            </ul>
	            <ul class="nav navbar-nav navbar-right">
	                <li>
	                	<a class="scrolly" href="#bodyTop">Back to Top</a>
	                </li>
	            </ul>
	        </footer>

			<!-- This is for the Request thing. Will be done later -->
			<!-- <div class="col-lg-3 col-lg-offset-0 col-md-3 col-md-offset-0 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 requestDiv" id="request">
				this is ok and working!
			</div>   -->

		</div>   <!-- end of main-wrapper -->

		<!-- this is for the edit modal that appears when edit button is clicked -->
		<div class="modal fade editModal">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title editModalTitle"></h4>
		      </div>
		      <div class="modal-body editModalBody">
		        
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<!-- this is for the edit modal in the EDUCATION Div that appears when edit button is clicked -->
		<div class="modal fade eduEditModal">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title editEduModalTitle"></h4>
		      </div>
		      <div class="modal-body editEduModalBody">
		        	<table class="table editEduTable">
		        		<tr>
		        			<td>
		        				School Name:
		        			</td>
		        			<td>
		        				<input type="text" id="editSchoolName" class="form-control" placeholder="School Name" value="">
		        			</td>
		        		</tr>
		        		<tr>
		        			<td>
		        				Start Date - End Date:
		        			</td>
		        			<td>
		        				<input type="text" id="editDate" class="form-control" placeholder="Dates Attended" value="">
		        			</td>
		        		</tr>
		        		<tr>
		        			<td>
		        				Degree
		        			</td>
		        			<td>
		        				<input type="text" id="editDegree" class="form-control" placeholder="Degree" value="">
		        			</td>
		        		</tr>
		        		<tr>
		        			<td>
		        				Field Of Study:
		        			</td>
		        			<td>
		        				<input type="text" id="editFOS" class="form-control" placeholder="Field Of Study" value="">
		        			</td>
		        		</tr>
		        	</table>
		        	<button class="btn btn-lg btn-primary eduBtnUpdate">
		        		Update
		        	</button>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<!-- this is for the edit modal in the EDUCATION Div that appears when edit button is clicked -->
		<div class="modal fade expEditModal">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title editExpModalTitle"></h4>
		      </div>
		      <div class="modal-body editExpModalBody">
		        	<table class="table editExpTable">
		        		<tr>
		        			<td>
		        				Company Name:
		        			</td>
		        			<td>
		        				<input type="text" id="editCompanyName" class="form-control" placeholder="Company Name" value="">
		        			</td>
		        		</tr>
		        		<tr>
		        			<td>
		        				Start Date - End Date:
		        			</td>
		        			<td>
		        				<input type="text" id="editDate" class="form-control" placeholder="Dates Attended" value="">
		        			</td>
		        		</tr>
		        		<tr>
		        			<td>
		        				Title
		        			</td>
		        			<td>
		        				<input type="text" id="editTitle" class="form-control" placeholder="Title" value="">
		        			</td>
		        		</tr>
		        		<tr>
		        			<td>
		        				Summary:
		        			</td>
		        			<td>
		        				<input type="text" id="editSummary" class="form-control" placeholder="Summary" value="">
		        			</td>
		        		</tr>
		        	</table>
		        	<button class="btn btn-lg btn-primary expBtnUpdate">
		        		Update
		        	</button>
		      </div>
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
	
	</body>

</html> 