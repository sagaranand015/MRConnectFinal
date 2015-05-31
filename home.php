<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<meta name="Mentored-Research Connect" content="MR Connect, Mentored-Research">
		<meta name="author" content="Sagar anand, Mentored-Research Tech Team, MR Connect">

		<title>MR-Connect Home</title>

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

	    	.mainWrapper {
	    		background-color: rgb(233, 233, 233);
	    		min-height: 700px;
	    	}

	    	.mainHeading {
	    		text-align: center;
	    		font-family: boldText;
	    		font-size: 4em;
	    	}

	    	.navDiv {
	    		margin: 2% 0 0 0%;
	    		font-family: regularText;
	    	}

	    	.mainContent {
	    		margin: 2% 0% 0 0%;
	    	}

	    	.personItem {
	    		border: 1px solid gray;
	    		border-radius: 10px;
	    		padding: 1% 1% 1% 1%;
	    		z-index: 10;
	    		box-shadow: 5px 5px rgb(180, 180, 180);
	    	}

	    	/*.userItem {
	    		float: left;
	    	}*/

	    	.item {
	    		margin-bottom: 2%;
	    	}

	    	.userName {
	    		font-size: 2.2em;
	    		font-family: boldText;
	    	}
	    	.userLocation {
	    		font-size: 1.4em;
	    		font-family: regularText;
	    	}
	    	.userExpertise {
	    		font-size: 1.4em;
	    		font-family: regularText;
	    	}
	    	.userImage {
	    		/*float: left;*/
	    		margin: 1% 2% 1% 1%;
	    	}
	    	.userReadMore {
	    		font-size: 1.2em;
	    		font-family: lightText;
	    	}
	    	span {
	    		font-family: lightText;
	    	}

	    	#txtSearch {
	    		height: 45px;
	    		font-size: 1.4em;
	    		font-family: regularText;
	    	}
	    	/*.searchHeader {
	    		font-family: regularText;
	    	}*/

	    	.searchBtn {
	    		font-family: boldText;
	    		margin-top: 2%;
	    		/*margin-left: 38%;*/
	    		margin-bottom: 2%;
	    	}

	    	#exSearch {
	    		margin-top: 2%;
	    		margin-bottom: 2%;
	    		font-family: boldText;
	    	}

	    	.advSearch {
	    		margin: 2% 0 0 0%;
	    	}


			#alertMsg {
				z-index:9999; 
				margin: 2% 2% 2% 2%;
				font-family: boldText;
				position: fixed;
			}

			#popup {
				z-index:9999; 
				margin: 2% 2% 2% 2%;	
				font-family: boldText;
				position: fixed;
			}

			.btnConnRequest {
				font-family: regularText;
				/*margin: 1% 1% 1% 1%;*/
			}

			#btnAdvSearch {
				font-family: regularText;
			}

			.advSearch {
				font-family: regularText;
			}

			.modalText, .connModalTitle {
				font-family: boldText;
			}

			.tableLabel {
				width: 30%;
				font-family: regularText;
			}

			.tableContent {
				font-family: boldText;	
			}

			.pollList a {
				font-family: regularText;
			}

			#btnPollVote {
				font-family: boldText;
			}

			.pollQuesDisplay {
				font-family: boldText;
			}

			#askQuestion {
				margin: 2% 0 2% 0%;
			}

			.searchList {
				margin: 2% 0 0 0%;
			}

			.btnSeeMore {
				margin: 3% 0 0 0%;
			}

			.lblAdvSearch {
				font-family: boldText;
				font-size: 1.2em;
			}
     	</style>

    	<script type="text/javascript">

		// this is the function to get the See More button in the markup.
		function getSeeMoreButton(n) {
			$('.btnSeeMore').remove();
			var btnMarkup = "";

			n = Number(n);
			if(n == 10) {
				n = 10;
			}
			else if(n%10 == 0) {
				n += 10;
			}

			btnMarkup = "<button class='btn btn-lg btn-primary btn-block btnSeeMore' data-number='" + n + "'>See More Records</button>";
			return btnMarkup;
		}

		// this is the function to get 'n' users only at a time.
		function getUsers(response, n) {
			var users = response.split(" (BR) ");
			var res = "";
			var seeMore = "";

			var counter = 0;
			var en = true;

			n = Number(n);
			if(n == 10) {
				for(var i=0;i<10;i++) {
					if(users[i] == undefined) {
						counter++;
					}
					else {
						res += users[i];
					}
				}
			}
			else if(n%10 == 0) {
				res = "<div class='row'>";
				for(var i=n-10;i<=n;i++) {
					if(users[i] == undefined) {
						counter++;
					}	
					else {
						res += users[i];
					}
				}
				res += "</div>";
			}
			else {
				//alert("Please try again.Y0011");
				res = "<div class='row'>";
				for(var i=n-10;i<=n;i++) {
					if(users[i] == undefined) {
						counter++;
					}	
					else {
						res += users[i];
					}
				}
				res += "</div>";
			}

			seeMore = getSeeMoreButton(n);
			return res + seeMore;
		}

		// this is the function to get all the data as list in the first go.
		function populateUserData(noRecords) {

			var alertMsg = $('#alertMsg').fadeOut();
			var popup = $('#popup').fadeOut();    

			$('#btnExitPopup').on('click', function() {
				popup.children('p').remove();
				popup.fadeOut();
				return false;
			});

			//this is to get all the users from the database and show it in the list format.
			// $('.allList').children('div.list-group-item').remove();
			// $('.allList').children('div.list-group').remove();
			// $('.allList').children('.btn').remove();

			console.log(getCookie('userEmail'));

			// remove the h3 headings, in case they appear.
			$('.allList').children('h3').remove();

			alertMsg.children('p').remove();
			alertMsg.append("<p>Building the MR - Network... Please wait</p>").fadeIn();
			$.ajax({
				type: "GET",
				url: "AJAXFunctions.php",
				data: {
					no: "4", email: getCookie('userEmail')
				},
				success: function(response) {
					if(response == "-1") {
						alertMsg.children('p').remove();
						alertMsg.fadeOut();

						popup.children('p').remove();
						popup.append("<p>You need to be a part of MR - Connect to view the network. Please <a href='http://mentored-research.com/MRConnect'>Signup Here.</a> Thank You.</p>").fadeIn();
					}
					else {
						var users = getUsers(response, noRecords);
						$('.allList').append(users);
						$('.allList').fadeIn(1000);

						// for the popus and notifications.
						alertMsg.children('p').remove();
						alertMsg.fadeOut();
					}
				},
				error: function() {
					alert("This is the error in ajax.");
				}
			});
		}

    	// this is the function to show the poll Results on the RHS of the page.
    	function getPollResults() {

    		var alertMsg = $('#alertMsg').fadeOut();
			var popup = $('#popup').fadeOut();    

			$('#btnExitPopup').on('click', function() {
				popup.children('p').remove();
				popup.fadeOut();
				return false;
			});

    		// show the questions and the votes incurred.
    		$('.pollList').children('div.list-group-item').remove();
			$.ajax({
				type: "GET",
				url: "AJAXFunctions.php",
				data: {
					no: "14"
				},
				success: function(resp) {
					if(resp == "-1") {
						popup.children('p').remove();
						popup.append("<p>We could not load the Questions for your Poll. Please try again.</p>").fadeIn();
					}
					else {
						
						// put it to view here.!!
						var r = resp.split(" && ");
						var ques = "";
						var votes = "";
						var p = "";
						var res = "<div class='list-group-item'>";
						for(var i=0;i<r.length;i++) {
							p = r[i].split(" -> ");
							if(p == undefined || p == "") {

							}
							else {
								ques = p[0];
								votes = p[1];
								res += "<p class='pollQuesDisplay'>" + ques + "<span style='float:right;'>(" + votes + " Votes)</span></p><div class='progress'><div class='progress-bar' role='progressbar'  aria-valuenow='" + votes + "' aria-valuemin='0' aria-valuemax='23' style='width:" + (votes/23)*100 + "%'></div></div>";
							}
						}

						res += "</div>";
						$('.pollList').append(res);

					}
				},
				error: function() {
					popup.children('p').remove();
					popup.append("<p>We could not load the Questions for your Poll. Please try again.</p>").fadeIn();
				}
			});

    	}

    	// this is the function to show the Poll area on RHS. Either questions come or the number of votes casted.
    	function populatePollArea() {

    		var alertMsg = $('#alertMsg').fadeOut();
			var popup = $('#popup').fadeOut();    

			$('#btnExitPopup').on('click', function() {
				popup.children('p').remove();
				popup.fadeOut();
				return false;
			});

    		// this is to get all the poll Questions from Database and show them!!
			$('.pollList').children('div.list-group-item').remove();
			// check if the user has voted or not. If no, show the questions. Otherwise the results.
			$.ajax({
				type: "GET",
				url: "AJAXFunctions.php",
				data: {
					no: "13", id: getCookie("userID"), email: getCookie("userEmail")
				},
				success: function(response) {

					if(response == "0") {   // DID NOT cast the vote yet!

						$.ajax({
							type: "GET",
							url: "AJAXFunctions.php",
							data: {
								no: "11"
							},
							success: function(response) {
								if(response == "-1") {
									popup.children('p').remove();
									popup.append("<p>We could not load the Questions for your Poll. Please try again.</p>").fadeIn();
								}
								else {
									$('.pollList').append(response);
								}
							},
							error: function() {
								popup.children('p').remove();
								popup.append("<p>We could not load the Questions for your Poll. Please try again.</p>").fadeIn();
							}
						});

					}
					else if(response == "1") {  // already casted the vote.
						getPollResults();
					}
					else {   // error case.
						popup.children('p').remove();
						popup.append("<p>We could not load the Questions for your Poll. Please try again.</p>").fadeIn();
					}
				}, 
				error: function() {
					popup.children('p').remove();
					popup.append("<p>We could not load the Questions for your Poll. Please try again.</p>").fadeIn();
				}
			});

    	}   // end of populatePollArea.

    	// this is the function to check the verification status of the user on logging into the home page. if the user is verified, go ahead. Otherwise, show an error message.
    	// returns 0 on not verified. 1 on verified.
    	// function CheckVerifiedUser() {

    	// 	var isVerified = "0";

    		
    	// 	return isVerified;
    	// }

    		$(document).ready(function() {

    			//for clearing the search bar
    			$('#txtSearch').val("");

    			//for the scrolling thing!
				$('.scrolly').scrolly();

    			var alertMsg = $('#alertMsg').fadeOut();
				var popup = $('#popup').fadeOut();    

				$('#btnExitPopup').on('click', function() {
					popup.children('p').remove();
					popup.fadeOut();
					return false;
				});

    			var ourNetworkDiv = $('.ourNetworkDiv').hide();
    			var searchDiv = $('.searchDiv').hide();
    			var pollQuestionDiv = $('#pollQuestion');

    			//for the click events of the list on LHS
    			$('.ourNetwork').on('click', function() {
    				changeActiveState(this);
    				showDiv(ourNetworkDiv);

    				var finalNetworkLink = $('#finalNetworkLink');
    				// finalNetworkLink.trigger('click');

    				if ($(window).width() >= 1200) {
				    } 
				    else if ($(window).width() >= 992) {
				    } 
				    else if ($(window).width() >= 768) {
				    } 
				    else if ($(window).width() >= 480) {
				        finalNetworkLink.trigger('click');
				    } 
				    else {
				        finalNetworkLink.trigger('click');
				    }
    				return false;
    			});

    			$('.search').on('click', function() {
    				changeActiveState(this);
    				showDiv(searchDiv);
    				
    				var finalSearchLink = $('#finalSearchLink');

    				if ($(window).width() >= 1200) {
				    } 
				    else if ($(window).width() >= 992) {
				    } 
				    else if ($(window).width() >= 768) {
				    } 
				    else if ($(window).width() >= 480) {
				        finalSearchLink.trigger('click');
				    } 
				    else {
				        finalSearchLink.trigger('click');
				    }

    				return false;
    			});

    			//this is to get all the users from the database and show it in the list format.
    			// 10 is the first time the page is getting loaded.
    			// here, first check if the user logged in is verified or not. If not, then show a blank page with an Error message.
    			// var isVerified = CheckVerifiedUser();
    			// alert(isVerified);
    	// 		alert(CheckVerifiedUser());
    	// 		if(CheckVerifiedUser() == "1") {
    	// 			populateUserData(10);     // for displaying the network, after user verification has been checked.
    	// 		}
    	// 		else if(CheckVerifiedUser() == "0") {
    	// // 			popup.children('p').remove();
					// // popup.append("<p>Oops! 2. Looks like your MR - Connect Account is not yet verified. Please go to the <a href='profile.php'>Profile Page</a> for Account Verification. Thank you.</p>").fadeIn();
					// $('.allList').append("<h3>Oops! Looks like your MR - Connect Account is not yet verified. Please go to the <a href='profile.php'>Profile Page</a> for Account Verification. Thank you.</h3>");
    	// 		}
    	// 		else {
    	// 			popup.children('p').remove();
					// popup.append("<p>Oops! We encountered an error while checking for user authentication. Please try again.</p>").fadeIn();		
    	// 		}

    			//to show the network tab on page load.
    			$('.ourNetwork').trigger('click');

    			$('#alertMsg').children('p').remove();
	    		$('#alertMsg').append("<p>Checking user Verification, Please wait for a moment...</p>").fadeIn();

	    		$.ajax({
	    			type: "GET",
	    			url: "AJAXFunctions.php",
	    			data: {
	    				no: "18", email: getCookie("userEmail")
	    			},
	    			success: function(response)  {

	    				$('#alertMsg').children('p').remove();
						$('#alertMsg').fadeOut();

	    				if(response == "1") {
	    					//isVerified = "1";
	    					populateUserData(10);
	    				}
	    				else if(response == "0") {
	    					//isVerified = "0";
	    					$('#popup').children('p').remove();
	    					popup.append("<p>Oops! 2. Looks like your MR - Connect Account is not yet verified. Please go to the <a href='profile.php'>Profile Page</a> for Account Verification. Thank you.</p>").fadeIn();
	    				}
	    				else {
	    					$('#popup').children('p').remove();
							$('#popup').append("<p>Oops! We encountered an error while checking for user authentication. Please try again.</p>").fadeIn();		
	    				}
	    			},
	    			error: function() {
	    				$('#alertMsg').children('p').remove();
						$('#alertMsg').fadeOut();
						$('#popup').children('p').remove();
						$('#popup').append("<p>Oops! We encountered an error while checking for user authentication. Please try again.</p>").fadeIn();	
	    			}
	    		});



    			//for the read more click link
    			$('.allList, .searchList').delegate('.readMoreLink', 'click', function() {
    				var id = $(this).attr('data-id');
    				var email = $(this).attr('data-email');

    				$('.detailsModal').modal('show');

    				//get all the data from the ajax and show it in the modal for this user.
    				//$('.detailsModalBody').html("");
    				alertMsg.children('p').remove();
    				alertMsg.append("<p>Getting Profile Data... Please wait</p>").fadeIn();
    				$.ajax({
    					type: "GET",
    					url: "AJAXFunctions.php",
    					data: {
    						no: "2", email: email, id: id
    					},
    					success: function(response) {
    						//$('.detailsModalBody').append(response);

    						alertMsg.children('p').remove();
		                    alertMsg.fadeOut();

    						if(response == "-5") {
    							$('#popup').children('p').remove();
    							$('#popup').append("<p>The user you requested is has not yet been Verified by the MR-Connect Team. Please wait for a while before this user's information can be displayed. Thank You.</p>").fadeIn();
    						}
    						else {

    							var pers = response.split(" @bk ")[0];
		        				var educ = response.split(" @bk ")[1];
		        				var expr = response.split(" @bk ")[2];
		        				var intr = response.split(" @bk ")[3];

		        				console.log(pers + " --> " + educ + " --> " + expr + " --> " + intr);

		        				if(pers == undefined || pers == "-4") {
		        					var markup = "";
			        				$('.personal').children('table,h2,b').remove();
			        				markup += "<h2>Personal Details</h2><b>No Relevant Data found.</b>";
			        				$('.personal').append(markup);
			        			}
			        			else {
			        				//for the personal contact thing of the user
			        				var perDetails = pers.split(" ,& ");

			        				$('.detailsModalTitle').html(perDetails[1] + " - Details");

			        				var markup = "";
			        				$('.personal').children('table,h2,b').remove();
			        				// <tr><td>Twitter Handle: </td><td>" + perDetails[6] + "</td></tr><tr><td>Last Association in: </td><td>" + perDetails[7] + "</td></tr><tr><td>Attended ERI as: </td><td>" + perDetails[8] + "</td></tr>

			        				//for the last association thing:
			        				var last = "";
			        				if(perDetails[9] == "1")
			        					last = "ERI Alumnus";
			        				else if(perDetails[9] == "2")
			        					last = "BSE Alumnus";
			        				else if(perDetails[9] == "3")
			        					last = "Technical Analysis Alumnus";
			        				else if(perDetails[9] == "4")
			        					last = "Other";
			        				else
			        					last = "Not Defined";

			        				markup += "<h2>Personal Details</h2><table class='table perTable'><tr><td class='tableLabel'>Name: </td><td class='tableContent'>" + perDetails[1] + "</td></tr><tr><td class='tableLabel'>Location: </td><td class='tableContent'>" + perDetails[5] + "</td></tr><tr><td class='tableLabel'>LinkedIn Profile: </td><td class='tableContent'>" + perDetails[4] + "</td></tr><tr><td class='tableLabel'>Last Associated with M-R: </td><td class='tableContent'>" + last + "</td></tr></table>";
			        				$('.personal').append(markup);
			        			}


			        			if(educ == undefined || educ == "-4") {
			        				var eduMarkup = "";
			                    	$('.educationListings').children('table,h2,b').remove();
			                    	eduMarkup += "<h2>Education Listings</h2><b>No Relevant Data found.</b>";
			                    	$('.educationListings').append(eduMarkup);
			        			}
			        			else {
			        				var e = educ.split(" @E ");
				                    //for removing the tables!
				                    var eduMarkup = "";
			                    	$('.educationListings').children('table,h2,b').remove();
			                    	eduMarkup += "<h2>Education Listings</h2>";
				                    for(var i = 0;i<=e.length-4;i+=4) {
										eduMarkup += "<table class='table'><tr><td class='tableLabel'>School Name: </td><td class='tableContent'>" + e[i] + "</td></tr><tr><td class='tableLabel'>Dates Attended: </td><td class='tableContent'>" + e[i+1] + "</td></tr><tr><td class='tableLabel'>Degree: </td><td class='tableContent'>" + e[i+2] + "</td></tr><tr><td class='tableLabel'>Field of Study: </td><td class='tableContent'>" + e[i+3] + "</td></tr></table>";
				                    }
				                    $('.educationListings').append(eduMarkup);
			        			}


			        			if(expr == undefined || expr == "-4") {
			        				$('.experienceListings').children('table,h2,b').remove();
			        				var expMarkup = "";
				                    $('.experienceListings').children('table,h2,b').remove();
				                    expMarkup += "<h2>Experience Listings</h2><b>No Relevant Data found.</b>";
				                    $('.experienceListings').append(expMarkup);
			        			}
			        			else {
			        				//for populating the Experience Fields
				                    var ex = expr.split(" @Ex ");
				                    var expMarkup = "";
				                    $('.experienceListings').children('table,h2,b').remove();
				                    expMarkup += "<h2>Experience Listings</h2>";
				                    for(var i = 0;i<=ex.length-4;i+=4) {
				                    	expMarkup += "<table class='table'><tr><td class='tableLabel'>Company Name: </td><td class='tableContent'>" + ex[i] + "</td></tr><tr><td class='tableLabel'>Dates Attended: </td><td class='tableContent'>" + ex[i+1] + "</td></tr><tr><td class='tableLabel'>Title: </td><td class='tableContent'>" + ex[i+2] + "</td></tr><tr><td class='tableLabel'>Summary: </td><td class='tableContent'>" + ex[i+3] + "</td></tr></table>";
				                    }
				                    $('.experienceListings').append(expMarkup);
			        			}


			        			if(intr == undefined || intr == "-5") {
			        				var intMarkup = "";

				                    $('.interestListings').children('div,h2,b').remove();
				                    intMarkup += "<h2>Areas of Expertise</h2><b>No Relevant Data found.</b>";
				                    $('.interestListings').append(intMarkup);
			        			}
			        			else {
			        				//this is for the interest listings.
				                    var interests = intr.split(" @I ");
				                    var intMarkup = "";

				                    $('.interestListings').children('div,h2,b').remove();
				                    intMarkup += "<h2>Areas of Expertise</h2>";
				                    intMarkup += "<div class='list-group'>";
				                    for(var i = 0;i<interests.length;i++) {
				                    	if(interests[i] == "" || interests[i] == " " || interests[i] == "-" || interests[i] == " ~ " || interests[i] == "-5") {

				                    	}
				                    	else {
				                    		intMarkup += "<a class='list-group-item active' style='margin: 1% 0 0 0%;'><h4>" + interests[i] + "</h4></a>";
				                    	}
				                    }
				                    intMarkup += "</div>";
				                    $('.interestListings').append(intMarkup);
			        			}

    						}   // end of else.
    					},
    					error: function() {
    						alert("Error in ajax.");
    					}
    				});
    				return false;
    			});

				//for the connection request button.
				$('.allList, .searchList').delegate('.btnConnRequest', 'click', function() {
					var requestForEmail = $(this).attr('data-email');
					var requestForId = $(this).attr('data-id');

					var profile = $(this).attr('data-profile');
					window.open(profile, "_blank");

					// //alert(getCookie("userEmail") + " --> " + requestForEmail + " --> " + id);

					// $('.modalText').html("<h3>Just a step more!<br /> Please let us know the reason you want to send the connection request to the concerned person. It'll help us in keeping things sorted.</h3>");
					// $('.connModal').modal('show');

					// //write the AJAx Request to send the connection request to the MR connect admins.

					// $('#btnSendConnRequest').on('click', function() {

					// 	var requestText = $('#connBody').val().trim();

					// 	if(requestText == "") {
					// 		popup.children('p').remove();
					// 		popup.fadeOut();
					// 		popup.append("<p>Please provide a small write-up for the request.</p>").fadeIn();
					// 	}
					// 	else {
					// 		alertMsg.children('p').remove();
		   //  				alertMsg.append("<p>Sending Connection Request... Please wait</p>").fadeIn();
					// 		$.ajax({
					// 			type: "GET",
					// 			url: "AJAXFunctions.php",
					// 			data: {
					// 				no: "9", requestFrom: getCookie("userEmail"), requestForEmail: requestForEmail, requestForId: requestForId, requestText: requestText
					// 			},
					// 			success: function(response) {
					// 				alertMsg.children('p').remove();
				 //                    alertMsg.fadeOut();
					// 				if(response == "1") {
					//                     popup.append("<p>Thank You for your Connection Request. Please check your inbox for more details.</p>").fadeIn();

					//                     //hide the modal now.
					// 					$('.connModal').modal('show');					                    
					// 				}
					// 				else {
					// 					popup.append("<p>Sorry, but we encountered an error in Sending your connection Request. Please try again.</p>").fadeIn();
					// 				}
					// 			},
					// 			error: function() {
					// 				alert("Error in ajax. ");
					// 			}
					// 		});
					// 	}

					// 	return false;
					// });

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

				// //for the search button thing!
				// var searchTerm = $('#txtSearch').val();
				// $('.searchList').children('div').remove();

				//for the basic searching functionality!!
				$('#btnSearch').on('click', function() {

					//for the search button thing!
					var searchTerm = $('#txtSearch').val();
					$('.advSearch').slideUp();

					if(searchTerm == "") {
						popup.children('p').remove();
						popup.append("<p>Please enter a name/Email Address for the search to be complete.</p>").fadeIn();
					}
					else {
						$('.searchList').children('div').remove();

						//to remove the older results.
						$('.searchList').children('div').remove();

						alertMsg.children('p').remove();
						alertMsg.append("<p>Getting Search Results... Please wait</p>").fadeIn();
						$.ajax({
							type: "GET",
							url: "AJAXFunctions.php",
							data: {
								no: "7", searchKey: searchTerm
							},
							success: function(response) {
								if(response == "-1") {
									alert("Sorry, no results found!");
								}
								else {
									$('.searchList').append(response);
									alertMsg.children('p').remove();
									alertMsg.fadeOut();

									// var results = getUsers(response, 10);
									// $('.searchList').append(results);
									// alertMsg.children('p').remove();
									// alertMsg.fadeOut();								

								}	
							},
							error: function(response) {
								alert("Error in searching. " + response);
							}
						});
					}

					return false;
				});

				//for advanced search
				var advSearchDiv = $('.advSearch').slideUp();
				$('#exSearch').on('click', function() {
					advSearchDiv.slideToggle('fast');
					return false;
				});

				$('#btnAdvSearch').on('click', function() {
					
					//$('#txtCustomIntArea').val("");

					var i1 = "", i2 = "", i3 = "", i4 = "", i5 = "", i6 = "", i7 = "";
					if ($('#txtGmatIntArea').parent('a').hasClass('list-group-item-success')) {
						i1 = "G.M.A.T.";
					}
					if ($('#txtCatIntArea').parent('a').hasClass('list-group-item-success')) {
						i2 = "C.A.T./X.A.T.";
					}
					// if ($('#txtEducationIntArea').parent('a').hasClass('list-group-item-success')) {
					// 	i3 = $('#txtEducationIntArea').val();
					// 	if (i3 == "") {
					// 		i3 = "Education";
					// 	}
					// }
					// if ($('#txtWorkExpIntArea').parent('a').hasClass('list-group-item-success')) {
					// 	i4 = $('#txtWorkExpIntArea').val();
					// 	if (i4 == "") {
					// 		i4 = "WorkExperience";
					// 	}
					// }
					if ($('#txtCfaIntArea').parent('a').hasClass('list-group-item-success')) {
						i5 = "C.F.A.";
					}
					if ($('#txtFrmIntArea').parent('a').hasClass('list-group-item-success')) {
						i6 = "F.R.M.";
					}
					// if ($('#txtCustomIntArea').parent('a').hasClass('list-group-item-success')) {
					// 	i7 = $('#txtCustomIntArea').val();
					// }

					// for the final custom search by School/Company
					i7 = $('#txtCustomIntArea').val();

					//to remove the previous results.
					$('.searchList').children('div').remove();

					//now, save the data into the Intersts table with the given values.
					//i3: i3, i4: i4
					alertMsg.children('p').remove();
					alertMsg.append("<p>Getting Search Results... Please wait</p>").fadeIn();
					$.ajax({
						type: "GET",
						url: "AJAXFunctions.php",
						data: {
							no: "8", i1: i1, i2: i2, i5: i5, i6: i6, i7: i7
						},
						success: function(response) {
							if(response == "-1") {
								alert("Sorry, no results found. Please try again.");
							}
							else {

								$('#exSearch').trigger('click');

								$('.searchList').append(response);
								alertMsg.children('p').remove();
								alertMsg.fadeOut();
							}
						},
						error: function() {
							alert("Error in getting in results by Expertise.");
						}
					});
					return false;
				});

				
				// to populate the poll area on RHS.
				populatePollArea();

				// this is for the voting button that comes from AJAX.
				$('.pollList').delegate('.btnVote', 'click', function() {
					var poll = $('.pQuestion');
					var checked = "";
					var checkedName = "";

					$.each(poll, function() {
						if($(this).is(':checked')) {
							checked = $(this).attr('data-id');
							checkedName = $(this).attr('data-name');
						}
					});  

					// now, make ajax request to increase the number of votes.
					alertMsg.children('p').remove();
					alertMsg.append("<p>Please wait while we record your Vote. Please wait...</p>").fadeIn();
					$.ajax({
						type: "GET",
						url: "AJAXFunctions.php",
						data: {
							no: "12", id: getCookie("userID"), email: getCookie("userEmail"), checked: checked, checkedName: checkedName
						},
						success: function(response) {
							alertMsg.children('p').remove();
							alertMsg.fadeOut();
							if(response == "1") {
								popup.children('p').remove();
								popup.append("<p>Your Response has been recorded. Thank You.</p>").fadeIn();

								// now, here is the space for showing the current number of votes.
								getPollResults();
							}
							else if(response == "-2") {
								popup.children('p').remove();
								popup.append("<p>Oops! We encountered an error. Please try again.</p>").fadeIn();								
							}
							else if(response == "-3") {
								popup.children('p').remove();
								popup.append("<p>Oops! We encountered an error. Please try again.</p>").fadeIn();								
							}
							else if(response == "-4") {
								popup.children('p').remove();
								popup.append("<p>You have already casted your vote. Please wait for the results.</p>").fadeIn();								
							}
							else {
								popup.children('p').remove();
								popup.append("<p>Oops! We encountered an error. Please try again.</p>").fadeIn();								
							}
						},
						error: function() {
							alert("Error in ajax function.");
						}
					});
					return false;
				});

				// this is to submit the questio asked according to categories.
				$('#btnAskQuestion').on('click', function() {

					var category = $('#ddlCategories').val();
					var question = $('#askQuestion').val();

					if(category == "0") {
						popup.children('p').remove();
						popup.append("<p>Please select the Question category before submitting.<p>").fadeIn();
					}
					else if(question == "") {
						popup.children('p').remove();
						popup.append("<p>Please put in some question before submitting.<p>").fadeIn();	
					}
					else {

						// put in the ajax to save the question to the database.
						alertMsg.children('p').remove();
						alertMsg.append("<p>Please wait while we submit your Question to our Experts Team...</p>").fadeIn();
						$.ajax({
							type: "GET",
							url: "AJAXFunctions.php",
							data: {
								no: "15", id: getCookie("userID"), email: getCookie("userEmail"), category: category, question: question
							},
							success: function(response) {
								alertMsg.children('p').remove();
								alertMsg.fadeOut();
								if(response == "1") {
									popup.children('p').remove();
									popup.append("<p>Your question has been recorded. Thank You.</p>").fadeIn();
								}
								else if(reponse == "-1") {
									popup.children('p').remove();
									popup.append("<p>Oops! We encountered an error recording your question. Please try again.</p>").fadeIn();
								}
								else {
									popup.children('p').remove();
									popup.append("<p>Oops! We encountered an error recording your question. Please try again.</p>").fadeIn();	
								}
							},
							error: function() {
								popup.children('p').remove();
								popup.append("<p>Oops! We encountered an error recording your question. Please try again.</p>").fadeIn();
							}
						});

					}

					return false;
				});

				// this is for the poll List item that shows the poll Questions div on clicking.
				$('#pollQuesList').on('click', function() {
					changeActiveState(this);
					showDiv(pollQuestionDiv);
					pollQuestionDiv.removeClass('hidden-xs hidden-sm');
					//$(this).trigger('click');
					$('#pollHidden').trigger('click');
					return false;
				});

				// this is for the see more button to show more records.
				$('.allList, .searchList').delegate('.btnSeeMore', 'click', function() {
					var no = $(this).attr('data-number');
					no = Number(no);
					populateUserData(no + 10);
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

	<body id="bodyTop">

		<div id="alertMsg" class="alert alert-warning" role="alert">
		</div>

		<div id="popup" class="alert alert-danger" role="alert">
			  <button type="button" class="close" id="btnExitPopup" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mainWrapper">

		<h1 class="mainHeading">
			<img src="img/MRLogo.png" class="imgLogo" width="75" height="75" />
			MR - Connect
		</h1>

		<!-- for the list group on the LHS -->
		<div class="col-lg-2 col-md-2 col-sm-3 navDiv">
			<div class="list-group">
				<a href="#" class="list-group-item ourNetwork scrolly">Our Network</a>
				<a href="#" class="list-group-item search scrolly">Search Network</a>
			</div>

			<div class="list-group">
				<a href="profile.php" class="list-group-item profile">Profile</a>
			</div>

			<div class="list-group">
				<p style="font-style: bold; text-align:center; font-family: regularText;">
					We also Offer:
				</p>
				<a href="http://mentored-research.com" class="list-group-item MRMainPage">Equity Research Initiative</a>
				<a href="http://mentored-research.com/theCompendium.php" class="list-group-item compendium">The Compendium</a>
			</div>

			<!-- This is only for the tablets and the phone devices. -->
			<div class="list-group">
				<a href="" id="pollQuesList" class="list-group-item hidden-lg hidden-md scrolly">Poll Questions</a>
				<a href="#pollQuestion" id="pollHidden" class="scrolly" style="display: none;" />
			</div>

			<div class="list-group" id="askQuesDiv" >
				<a href="#askQuesDiv" style="background-color: #428bca; color: white;" class="list-group-item scrolly">Ask a Question</a>				

				<div class="list-group-item askQuestionDiv" >
					
					<select class="form-control" id="ddlCategories">
						<option value="0">
							-- Select Category --
						</option>
						<option value="1">
							G.M.A.T.
						</option>
						<option value="2">
							C.A.T./X.A.T.
						</option>
						<option value="3">
							F.R.M.
						</option>
					</select>

					<textarea id="askQuestion" class="form-control" rows="10" placeholder="Ask a Question pertaining to the selected Category"></textarea>

					<button id="btnAskQuestion" class="btn btn-lg btn-primary btn-block">
						Submit
					</button>
				</div>
			</div>

		</div>

		<a href="#finalNetwork" id="finalNetworkLink" style="display: none;" class="hidden-lg hidden-md scrolly" ></a>
		<a href="#finalSearch" id="finalSearchLink" style="display: none;" class="hidden-lg hidden-md scrolly" ></a>

		<div class="col-lg-10 col-md-10 col-sm-9 mainContent" id="finalNetwork">

			<div class="ourNetworkDiv divsMain" >

				<div class="col-lg-9 col-md-9 allList">



				</div>
			</div>

			<div class="col-lg-9 col-md-9 searchDiv divsMain" id="finalSearch">

				<!-- <div> -->
				<div class="row">
					<input type="text" id="txtSearch" class="form-control searchBox" placeholder="Enter Search Name/Email Address" />

					<button id="btnSearch" class="btn btn-lg btn-primary searchBtn">
						Search MR - Connect
					</button>

					<button id="exSearch" class="btn btn-lg btn-primary" style="float:right;">
						Advanced Search
					</button>
				</div>

					<div class="advSearch">
						<!-- <div class="list-group interest">
		                    <a href="#" class="list-group-item" id="intArea1">
		                        <h4 class="list-group-item-heading">G.M.A.T.</h4>
		                        <input type="hidden" value="GMAT" id="txtGmatIntArea" />
		                    </a>
		                    <a href="#" class="list-group-item" id="intArea2">
		                        <h4 class="list-group-item-heading">C.A.T./X.A.T.</h4>
		                        <input type="hidden" value="CAT/XAT" id="txtCatIntArea" />
		                    </a>
		                    <a href="#" class="list-group-item" id="intArea5">
		                        <h4 class="list-group-item-heading">C.F.A.</h4>
		                        <input type="hidden" class="form-control" id="txtCfaIntArea"  />
		                    </a>
		                    <a href="#" class="list-group-item" id="intArea6">
		                        <h4 class="list-group-item-heading">F.R.M.</h4>
		                        <input type="hidden" class="form-control" id="txtFrmIntArea"  />
		                    </a>
		                    <a href="#" class="list-group-item" id="intArea7">
		                        <h4 class="list-group-item-heading">Search a school/Company/Institution</h4>
		                        <input type="text" class="form-control" id="txtCustomIntArea" placeholder="Search a school/Company/Institution"  />
		                    </a>
                		</div> -->

                		<!-- Make the table for advanced Searching -->
                		<table class="table table-striped">
            				<tr>
            					<td>
        							<label class="lblAdvSearch">Search by Area Of Expertise: </label>
            					</td>
            					<td>
            						<div class="list-group interest">
					                    <a href="#" class="list-group-item" id="intArea1">
					                        <h4 class="list-group-item-heading">G.M.A.T.</h4>
					                        <input type="hidden" value="GMAT" id="txtGmatIntArea" />
					                    </a>
					                    <a href="#" class="list-group-item" id="intArea2">
					                        <h4 class="list-group-item-heading">C.A.T./X.A.T.</h4>
					                        <input type="hidden" value="CAT/XAT" id="txtCatIntArea" />
					                    </a>
					                    <a href="#" class="list-group-item" id="intArea5">
					                        <h4 class="list-group-item-heading">C.F.A.</h4>
					                        <input type="hidden" class="form-control" id="txtCfaIntArea"  />
					                    </a>
					                    <a href="#" class="list-group-item" id="intArea6">
					                        <h4 class="list-group-item-heading">F.R.M.</h4>
					                        <input type="hidden" class="form-control" id="txtFrmIntArea"  />
					                    </a>
					                    <!-- <a href="#" class="list-group-item" id="intArea7">
					                        <h4 class="list-group-item-heading">Search a school/Company/Institution</h4>
					                        <input type="text" class="form-control" id="txtCustomIntArea" placeholder="Search a school/Company/Institution"  />
					                    </a> -->
			                		</div>
            					</td>
            				</tr>
            				<tr>
            					<td>
            						<label class="lblAdvSearch">Search by School/Company: </label>
            					</td>
            					<td>
            						<input type="text" class="form-control" id="txtCustomIntArea" placeholder="Search a school/Company/Institution"  />
            					</td>
            				</tr>
                		</table>

                		<button id="btnAdvSearch" class="btn btn-lg btn-primary">
                			Search by Expertise
                		</button>
					</div>
				<!-- </div> -->

				<!-- this is for the list of the searched contacts -->
				<div class="searchList">

				</div>

			</div>   <!-- end of searchDiv -->

			<!-- This is for the Polling Question thing on the RHS. -->
			<div id="pollQuestion" class="col-lg-3 col-md-3 hidden-xs hidden-sm poll">

				<div class="list-group pollList">
					<a href="#" class="list-group-item active">
						Please Vote for the Webinar you'd like to attend in the near future.
					</a>
				</div>

			</div>

		</div>   <!-- end of mainContent Div -->

	</div>     <!-- ./MainWrapper -->


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

	<!-- for all the modals here -->
	<div class="modal fade detailsModal">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title detailsModalTitle"></h4>
	      </div>
	      <div class="modal-body detailsModalBody">

	        <div class="personal">
	        	<!-- load the data from AJAX in the form of table -->
	        </div>

	        <div class="educationListings">
	        	<!-- load the data from AJAX in the form of table -->
	        </div>

	        <div class="experienceListings">
	        	<!-- load the data from AJAX in the form of table -->
	        </div>

	        <div class="interestListings">
	        	<!-- load the data from AJAX in the form of table -->
	        	<!-- <div class="list-group">
	        		<a href="#" class="list-group-item">
	        			<h4>this is ok and working!!</h4>
	        		</a>
	        		<a href="#" class="list-group-item">
	        			<h4>this is ok and working!!</h4>
	        		</a>
	        		<a href="#" class="list-group-item">
	        			<h4>this is ok and working!!</h4>
	        		</a>
	        		<a href="#" class="list-group-item">
	        			<h4>this is ok and working!!</h4>
	        		</a>
	        	</div> -->

	        </div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


	<!-- for all the modals here -->
	<div class="modal fade connModal">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title connModalTitle">
	        	Send a Connection Request
	        </h4>
	      </div>
	      <div class="modal-body connModalBody">
		      <div>

			      <h3 class="modalText">
			      	
			      </h3>

				<br />

				<textarea id="connBody" class="form-control" placeholder="A small write-up stating the need for connection." rows="8"></textarea>

		      </div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" id="btnSendConnRequest" class="btn btn-default btn-primary" data-dismiss="modal">Send Request</button>
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