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

		<title>MR-Connect Profile</title>

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

	    	@font-face {
	    		font-family: writingText;
	    		src: url('fonts/SEGOEUIL.ttf');
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
				width: 200px;
				height: 200px;
				margin-right: 5%;
				margin-top: 15%;
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

			.linksDiv {
				font-family: regularText;
				margin-top: 3%;
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

	        	var alertMsg = $('#alertMsg').fadeOut();
				var popup = $('#popup').fadeOut();    			

	        	//set the "id" cookie here.
	        	// alertMsg.children('p').remove();
	        	// alertMsg.append("<p>Getting profile info... Please wait</p>").fadeIn();
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
				// 		//alert("ERROR in setting ID Cookie.");
				// 	}
				// });

				//check for queryStrings here.
        		if(qs["exist"] == "1") {    //if both the cookies exist. User exists in the database.
        			//IN.User.authorize(onlyAuthenticate);
        			// this is without the linkedIn authorization Call.
        			onlyAuthenticate();
        		}
        		else if(qs["exist"] == "-1") {

        			// $('#popup').children('p').remove();
        			// $('#popup').append("<p>Please wait for a moment while we verify your account and save your data to our servers. This might take a minute or two, Please be patient...</p>").fadeIn();

        			// do all the coupon related stuff here. If the coupon code is correct, go to linkedIn authentication and save the user in the database.
        			// if incorrect, keep the modal box open and keep asking for the coupon code.
        			$('.couponModal').modal('show');
        			// NOTE: if linkedIn authentication is reached, go ahead and mark the user as activated in the database.

        			$('#popup').children('p').remove();
        			$('#popup').fadeOut();

        			//IN.User.authorize(linkedInAuth);	
        		}
        		else {
        			//IN.User.authorize(onlyAuthenticate);
        			onlyAuthenticate();
        		} 
	        }   //end of the onLinkedInLoad function!!

	        function populateData(response) {

	        	var loaded = true;

	        	console.log("I m in the populateData function.");

	        	var alertMsg = $('#alertMsg').fadeOut();
				var popup = $('#popup').fadeOut();    	

				if(response == "-1") {
    				alert("Error in Executing the function.");
    			}
    			else if(response == "") {
    				alert("Could not retrieve the data from the database. Please try again.");
    			}
    			else if(response == "-2") {    // this is when data does not exists in the database.
    				IN.User.authorize(linkedInAuth);
    			}
    			else {

    				var pers = response.split(" @bk ")[0];
    				var educt = response.split(" @bk ")[1];
    				var expr = response.split(" @bk ")[2];
    				var intr = response.split(" @bk ")[3];

    				console.log(pers + " --> " + educt  + " --> " + expr  + " --> " + intr);

    				if(pers == undefined || pers == "-4") {
    					loaded = false;
    					// popup.children('p').remove();
    					// popup.append("<p>Unable to retrieve your profile data. Please try again.</p>").fadeIn();
    				}
    				else {
    					//for the personal contact thing of the user
	    				var perDetails = pers.split(" ,& ");

	    				$('#headName').text(perDetails[1]);
	                    $('.displayImg').attr('src', perDetails[2]);  

	                    $('.name').children('span').html(perDetails[1]);
	                    $('.name').attr('data-content', perDetails[1]);

	                    $('.email').children('span').html(perDetails[0]);
	                    $('.email').attr('data-content', perDetails[0]);

	                    $('.contact').children('span').html(perDetails[3]);
	                	$('.contact').attr('data-content', perDetails[3]);

	                    $('.address').children('span').html(perDetails[5]);
	                    $('.address').attr('data-content', perDetails[5]);	    

	                    $('.profile').children('span').children('a').attr("href", perDetails[4]);
	                    $('.profile').attr('data-content', perDetails[4]);	

	                    $('.blog').children('span').html(perDetails[6]);
	                    $('.blog').children('span').html(perDetails[6]);

	                    $('.lastAssoc').val(perDetails[9]);
	                    $('.lastAssoc').attr('data-content', perDetails[9]);
    				}

    				if(educt == undefined || educt == "-4") {
    					loaded = false;
    					// popup.children('p').remove();
    					// popup.append("<p>Unable to retrieve your profile data. Please try again.</p>").fadeIn();
    				}
    				else {
    					//now, for populating the Education fields.
	                    var e = educt.split(" @E ");
	                    //for removing the tables!
	                	$('.education').children('table').remove();
	                    var markup = "";
	                    for(var i = 0;i<=e.length-4;i+=4) {
							markup += "<table class='table table-responsive table-striped eduTable'><tr><td><p id='eduSchoolName class='schoolName' data-content='" + e[i] + "'><span>" + e[i] + "</span><a class='glyphicon glyphicon-pencil eduEditButton' aria-hidden='true'></a></p></td><tr><td><p id='eduDate' class='date' data-content='" + e[i+1] + " - " + e[i+1] + "'><span>" + e[i+1] + " - " + e[i+1] + "</span><a class='glyphicon glyphicon-pencil eduEditButton' aria-hidden='true'></a></p></td></tr><tr><td><p id='eduDegree' class='degree' data-content='" + e[i+3] +  "'><span>" + e[i+3] +  "</span><a class='glyphicon glyphicon-pencil eduEditButton' aria-hidden='true'></a></p></tr><tr></td><td><p id='eduFOS' class='fos' data-content='" + e[i+2] + "'><span>" + e[i+2] + "</span><a class='glyphicon glyphicon-pencil eduEditButton' aria-hidden='true'></a></p>	</td></tr></table>";		                    	
	                    }
	                    $('.education').append(markup);

	                    //for all the events that happen to the dynamic elements!
	                    var eduEditButton = $('.eduEditButton').hide();
	                    var eduTable = $('.eduTable');

	                    // //for the on mouse over event on the Education Div
	                    // eduTable.on('mouseover', function() {
	                    // 	eduEditButton.show();
	                    // 	return false;
	                    // });

	                    // //for the on mouse out event on the Education Listings Div
	                    // eduTable.on('mouseout', function() {
	                    // 	eduEditButton.hide();
	                    // 	return false;
	                    // });

	                    var eduEditModal = $('.eduEditModal');
	                    //for the click event of the edit button in the education Div!
	                    eduEditButton.on('click', function() {

	                		eduEditModal.modal('show');
	                		$('.editEduModalTitle').html("Edit Your Education Listings");

	                    	return false;
	                    });
	                    //for the update button in the update Education Listings!
	                    $('.eduBtnUpdate').on('click', function() {
	                    	alert("This is the update button for education listing");
	                    	return false;
	                    });
    				}

                    
    				if(expr == undefined || expr == "-4") {
    					loaded = false;
    					// popup.children('p').remove();
    					// popup.append("<p>Unable to retrieve your profile data. Please try again.</p>").fadeIn();
    				}
    				else {
    					//for populating the Experience Fields
	                    var ex = expr.split(" @Ex ");
	                    var expMarkup = "";

	                    $('.experience').children('table').remove();

	                    for(var i = 0;i<=ex.length-4;i+=4) {
							expMarkup += "<table class='table table-responsive table-striped expTable'><tr><td><p id='eduCompanyName class='companyName' data-content='" + ex[i] + "'><span>" + ex[i] + "</span><a class='glyphicon glyphicon-pencil expEditButton' aria-hidden='true'></a></p></td><tr><td><p id='expDate' class='date' data-content='" + ex[i+1] + " - " + ex[i+1] + "'><span>" + ex[i+1] + " - " + ex[i+1] + "</span><a class='glyphicon glyphicon-pencil expEditButton' aria-hidden='true'></a></p></td></tr><tr><td><p id='expTitle' class='title' data-content='" + ex[i+2] +  "'><span>" + ex[i+2] +  "</span><a class='glyphicon glyphicon-pencil expEditButton' aria-hidden='true'></a></p></tr><tr></td><td><p id='expSummary' class='summary' data-content='" + ex[i+3] + "'><span>" + ex[i+3] + "</span><a class='glyphicon glyphicon-pencil expEditButton' aria-hidden='true'></a></p>	</td></tr></table>";
	                    }
	                    $('.experience').append(expMarkup);

	                    //for all the events that happen to the dynamic elements in the experience listings page!
	                    var expEditButton = $('.expEditButton').hide();
	                    var expTable = $('.expTable');

	                    // //for the on mouse over event on the experience Div
	                    // expTable.on('mouseover', function() {
	                    // 	expEditButton.show();
	                    // 	return false;
	                    // });

	                    // //for the on mouse out event on the experience Listings Div
	                    // expTable.on('mouseout', function() {
	                    // 	expEditButton.hide();
	                    // 	return false;
	                    // });

	                    var expEditModal = $('.expEditModal');

	                    //for the click event of the edit button in the Experience Div!
	                    expEditButton.on('click', function() {
	                		expEditModal.modal('show');
	                		$('.editExpModalTitle').html("Edit Your Experience Listings");
	                    	return false;
	                    });

	                    //for the update button in the update Education Listings!
	                    $('.expBtnUpdate').on('click', function() {
	                    	alert("This is the update button for Experience listing");
	                    	return false;
	                    });
    				}

    				if(intr == undefined || intr == "-4") {
    					loaded = false;
    					// popup.children('p').remove();
    					// popup.append("<p>Unable to retrieve your profile data in Interests. Please try again.</p>").fadeIn();
    				}
    				else if(intr == "-5") {  //this is when the data row does not exists.
    					loaded = false;
    					$('#AOE').trigger('click');
    					popup.children('p').remove();
    					popup.append("<p>Please fill in your Areas of Expertise for the MR - Connect member community.</p>").fadeIn();
    				}
    				else {
    					//to load the data from the Interest Table and show it on the Page.
	                    var interests = intr.split(" @I ");
	                   	if(interests[0] == "") {
	                   	}
	                   	else {
	                   		$('#txtGmatIntArea').parent('a').addClass('list-group-item-success');
	                   	}
	                   	if(interests[1] == "") {
	                   	}
	                   	else {
	                   		$('#txtCatIntArea').parent('a').addClass('list-group-item-success');
	                   	}
	                   	if(interests[2] == "") {
	                   	}
	                   	else {
	                   		$('#txtEducationIntArea').parent('a').addClass('list-group-item-success');
	                	 	$('#txtEducationIntArea').val(interests[2]);
	                   	}
	                   	if(interests[3] == "") {
	                   	}
	                   	else {
	                   	 	$('#txtWorkExpIntArea').parent('a').addClass('list-group-item-success');
	                     	$('#txtWorkExpIntArea').val(interests[3]);
	                   	}
	                    if(interests[4] == "") {
	                   	}
	                   	else {
	                   		$('#txtCfaIntArea').parent('a').addClass('list-group-item-success');
	                   	}
	                   	if(interests[5] == "") {
	                   	}
	                   	else {
	                   		$('#txtFrmIntArea').parent('a').addClass('list-group-item-success');
	                   	}
	                   	if(interests[6] == "") {
	                   	}
	                   	else {
	                   		$('#txtCustomIntArea').parent('a').addClass('list-group-item-success');
	                   		$('#txtCustomIntArea').val(interests[6]);
	                   	}	
    				}
                    
    			}
    			alertMsg.children('p').remove();
    			alertMsg.fadeOut();

    			//to show the interests here. Trigger the interest click here, for scrolling.
    			if(loaded == true) {
    				popup.children('p').remove();
	    			popup.append("<p class='expertisePopup'>We hope you have filled in your Areas of Expertise. Please do so, to help build a better MR - Connect. Ignore if already done.&nbsp;&nbsp;<a class='scrolly backToTop' href='#bodyTop'>Back to Top</a></p>").fadeIn();
	    			$('#AOE').trigger('click');
    			}

	        }    //end of populateData()

	        //this is the function for only authentication.
	        function onlyAuthenticate() {

	        	var alertMsg = $('#alertMsg').fadeOut();
				var popup = $('#popup').fadeOut();    	

	        	//here, all the data needs to be loaded from the database!
	        	console.log("I m in the onlyAuthenticate function. Data to be loaded from Database!");

	        	//now, get data from the database here and show it appropriately!!
	        	alertMsg.children('p').remove();
	        	alertMsg.append("<p>Getting profile info... Please wait</p>").fadeIn();
	        	$.ajax({
	        		type: "GET",
	        		url: "AJAXFunctions.php/LoadData",
	        		data: {
	        			no: "2", email: getCookie("userEmail"), id: getCookie("userID")
	        		},
	        		success: function(response) {

	        			var res = response.split(" ~ ");
	        			response = res[0];
	        			var res2 = res[1];

	        			if(response == "-5") {    // for non-verified user.
	        				alertMsg.children('p').remove();
        					alertMsg.fadeOut();
        					popup.children('p').remove();
        					popup.append("<p>We're sorry, but we could not verify your Account on MR - Connect. Please go ahead and Enter the Coupon Code for Account Verification.</p>").fadeIn();

        					// show the coupons Modal here for updating the Verification Status of the user.
        					$('.couponUpdateModal').modal('show');
	        			}
	        			else {
	        				if(res2 == "-4") {    //data not loaded successfully.
	        					// populateData(response);
	        					alertMsg.children('p').remove();
	        					alertMsg.fadeOut();
	        					popup.children('p').remove();
	        					popup.fadeOut();
	        					//popup.append("<p>Oops! We enountered an error in getting your profile data. Please refresh or try again later.</p>").fadeIn();
		        			}
		        			else {    //data is loaded successfully and ready to be shown to the user.
		        			}
		        			//to show the data to the page 
		        			populateData(response);
	        			}
	        		},
	        		error: function(response) {
	        			alert("Error in getting the data from the database. " + response.responseText);
	        		}
	        	});
	        }    //end of onlyAuthenticate function

	        function linkedInAuth() {
	            console.log("Data to be loaded from linkedin because the user record does not exists in the database.");

	            var alertMsg = $('#alertMsg').fadeOut();
				var popup = $('#popup').fadeOut();    	

	            //this is how to get all the data from the user's linkedin Profile!
	            IN.API.Profile("me").fields("first-name", "last-name", "email-address", "picture-url", "location", "public-profile-url", "summary", "educations", "pictureUrls::(original)", "phone-numbers", "primary-twitter-account", "positions").result(function (data) {
	                    console.log(data);

	                    var memData = data.values[0];

	                    var jsonPhone = "", jsonPic = "", jsonEdu = "", jsonExp = "";

	                    //var jsonBasic = JSON.stringify(memData);
	                    if(memData.phoneNumbers == undefined || memData.phoneNumbers.values == undefined) {
	                    }
	                    else {
	                    	jsonPhone = JSON.stringify(memData.phoneNumbers.values[0]);
	                    }
	                    if(memData.pictureUrls == undefined || memData.pictureUrls.values == undefined) {
	                    }
	                    else {
	                    	jsonPic = JSON.stringify(memData.pictureUrls.values[0]);
	                    }
	                    if(memData.educations == undefined || memData.educations.values == undefined) {
	                    }
	                    else {
	                    	jsonEdu = JSON.stringify(memData.educations.values);
	                    }
	                    if(memData.positions == undefined || memData.positions.values == undefined) {
	                    }
	                    else {
	                    	jsonExp = JSON.stringify(memData.positions.values);
	                    }

	                    // save the Email Cookie here first.
	                    var mail = memData.emailAddress;
	                    console.log("This is saving the cookie in the profile when data comes from linkedin: " + mail);
	                    setCookie("userEmail", mail, 150);

	                    // hide the coupon modal here. The below code runs only after the user has clicked the activate button in the coupons modal.
	                    $('.couponModal').modal('hide');
	                    $('.couponUpdateModal').modal('hide');

	                    //all the data from the user's linkedin profile goes here into the AJAx call and then saved in to the database.
	                    alertMsg.children('p').remove();
	                    alertMsg.append("<p>Getting profile info... Please wait</p>").fadeIn();
	                    $.ajax({
	                    	type: "POST",
	                    	url: "AJAXFunctions.php/SaveUser",
	                    	data: {
	                    		no: "1", basic: memData, contact: jsonPhone, picture: jsonPic, education: jsonEdu, experience: jsonExp
	                    	},
	                    	success: function(response) {

	                    		//here, save the cookies in javaScript!
	                    		var resArr = response.split(", ");
	                    		response = resArr[0];

	                    		var userEmail = resArr[1];
	                    		var userID = resArr[2];

	                    		// in case, the cookies do not exist on client's computer, but the user is there in the database.
	                    		setCookie("userEmail", userEmail, 150);
	                    		setCookie("userID", userID, 150);

	                    		if(response == "1") {
	                    			alertMsg.children('p').remove();
	                    			popup.append("<p>Data saved Successfully. Please go ahead and fill in your areas of Expertise.</p>").fadeIn();
	                    		}
	                    		else if(response == "2") {
	                    			alertMsg.children('p').remove();
	                    			alertMsg.append("<p>Getting Profile Data... Please wait</p>");
	                    			onlyAuthenticate();
	                    		}
	                    		else {
	                    			alert("Error in saving the data. Please try again." + response);	
	                    		}
	                    	},
	                    	error: function(response) {
	                    		console.log( "Response in Error Promise." + response);
	                    		var res = response.responseText.split(', ');
	                    		var r = res[0];

	                    		var userEmail = res[1];
	                    		var userID = res[2];

	                    		if(r == "1") {
	                    			alertMsg.children('p').remove();
	                    			popup.append("<p>Data saved Successfully. Please go ahead and fill in your areas of Expertise.</p>").fadeIn();
	                    		}
	                    		else {
	                    			alert("Error in saving data!  " + r);
	                    		}
	                    	}
	                    });   // end of the AJAX call saving user data to the database.

						if(memData.firstName == undefined) {
						}
						else {
							$('#headName').text(memData.firstName + "  " + memData.lastName);
							$('.name').children('span').html(memData.firstName + " " + memData.lastName);
	                    	$('.name').attr('data-content', memData.firstName + " " + memData.lastName);	
						}

						if(memData.pictureUrls == undefined || memData.pictureUrls.values == undefined) {
						}
						else {
							$('.displayImg').attr('src', memData.pictureUrls.values[0]);  
						}

						if(memData.emailAddress == undefined) {
						}
						else {
							$('.email').children('span').html(memData.emailAddress);
	                    	$('.email').attr('data-content', memData.emailAddress);
						}

	                    // $('.contact').children('span').html(phno);
                    	// $('.contact').attr('data-content', phno);

                    	var ph = "";
                    	if(memData.phoneNumbers == undefined || memData.phoneNumbers.values == undefined) {
                    	}
                    	else {
                			ph = memData.phoneNumbers.values;
                			var phno = ph[0].phoneNumber;
		                    if(phno == "undefined" || phno == "") {
		                    	$('.contact').children('span').html("<b>Add Contact Number</b>");
		                    	$('.contact').attr('data-content', "");
		                    }
		                    else {
		                    	$('.contact').children('span').html(phno);
		                    	$('.contact').attr('data-content', phno);
		                    }
                    	}

                		if(memData.location == undefined) {

                		}
                		else {
                			$('.address').children('span').html(memData.location.name);
	                    	$('.address').attr('data-content', memData.location.name);	    
                		}

                		if(memData.publicProfileUrl == undefined) {
                		}
                		else {
                			$('.profile').children('span').children('a').attr("href", memData.publicProfileUrl);
	                    	$('.profile').attr('data-content', memData.publicProfileUrl);	
                		}

                		if(memData.primaryTwitterAccount == undefined) {
                			
                		}
                		else {
                			$('.blog').children('span').html(memData.primaryTwitterAccount.providerAccountName);
	                    	$('.blog').children('span').html(memData.primaryTwitterAccount.providerAccountName);
                		}

	                    //now, for the education listing from linkedin API
	                    if(memData.educations == undefined || memData.educations.values == undefined) {

	                    }
	                    else {
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

	                    }   // end of else.

	                    //for all the events that happen to the dynamic elements!
	                    var eduEditButton = $('.eduEditButton').hide();
	                    var eduTable = $('.eduTable');

	                    //for the on mouse over event on the Education Div
	                    // eduTable.on('mouseover', function() {
	                    // 	eduEditButton.show();
	                    // 	return false;
	                    // });

	                    //for the on mouse out event on the Education Listings Div
	                    // eduTable.on('mouseout', function() {
	                    // 	eduEditButton.hide();
	                    // 	return false;
	                    // });

	                    var eduEditModal = $('.eduEditModal');

	                    //for the click event of the edit button in the education Div!
	                  //   eduEditButton.on('click', function() {
	                  //   	//show the update modal for the education Div here

	                		// eduEditModal.modal('show');
	                		// $('.editEduModalTitle').html("Edit Your Education Listings");

	                  //   	return false;
	                  //   });

	                    //for the update button in the update Education Listings!
	                    $('.eduBtnUpdate').on('click', function() {
	                    	alert("This is the update button for education listing");
	                    	return false;
	                    });


	                    //now, for all the experience listing here.
	                    if(memData.positions == undefined || memData.positions.values == undefined) {
	                    }
	                    else {
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

	                    }   // end of else.
	                    

	                    //for all the events that happen to the dynamic elements in the experience listings page!
	                    var expEditButton = $('.expEditButton').hide();
	                    var expTable = $('.expTable');

	                    //for the on mouse over event on the experience Div
	                    // expTable.on('mouseover', function() {
	                    // 	expEditButton.show();
	                    // 	return false;
	                    // });

	                    // //for the on mouse out event on the experience Listings Div
	                    // expTable.on('mouseout', function() {
	                    // 	expEditButton.hide();
	                    // 	return false;
	                    // });

	                    var expEditModal = $('.expEditModal');

	                    //for the click event of the edit button in the Experience Div!
	                  //   expEditButton.on('click', function() {
	                  //   	//show the update modal for the education Div here.

	                		// expEditModal.modal('show');
	                		// $('.editExpModalTitle').html("Edit Your Experience Listings");

	                  //   	return false;
	                  //   });

	                    //for the update button in the update Education Listings!
	                    $('.expBtnUpdate').on('click', function() {
	                    	alert("This is the update button for Experience listing");
	                    	return false;
	                    });

	                    alertMsg.children('p').remove();
	                    alertMsg.fadeOut();
            			//popup.append("<p>Data saved Successfully.</p>").fadeIn();

	                    //to show the interests here. Trigger the interest click here, for scrolling.
	                    $('#AOE').trigger('click');


	                }).error(function (data) {
	                    console.log(data);
	                });
	        }
	    </script>

		<script type="text/javascript">
			$(document).ready(function() {

				var alertMsg = $('#alertMsg').fadeOut();
				var popup = $('#popup').fadeOut();    			

				$('#btnExitPopup').on('click', function() {
					popup.children('p').remove();
					popup.fadeOut();
					return false;
				});

				var qs = getQueryStrings();
        		if(qs["exist"] == "-1") {
        			popup.children('p').remove();
					popup.append("<p>Please wait while we collect your Profile data and Check for Account Verification. This might take a minute or two, please be patient...</p>").fadeIn();
        		}

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
				// basicProfile.on('mouseover', function() {
				// 	editButton.show();
				// 	return false;
				// });

				// //for the on mouse out event on the basic Profile Div
				// basicProfile.on('mouseout', function() {
				// 	editButton.hide();
				// 	return false;
				// });

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

					//alert(prevVal + " -> " + newVal);
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

				//for the logout button.
				$('#btnLogout').on('click', function() {
					setCookie("userID", "", -1);
					setCookie("userEmail", "", -1);
					window.location.href = "logout.php";
					return false;
				});

				//this is for the saving/updating of the interests
				$('#btnInterest').on('click', function() {

					popup.children('p').remove();
					popup.fadeOut();

					var i1 = "", i2 = "", i3 = "", i4 = "", i5 = "", i6 = "", i7 = "";
					if ($('#txtGmatIntArea').parent('a').hasClass('list-group-item-success')) {
						i1 = "G.M.A.T.";
					}
					if ($('#txtCatIntArea').parent('a').hasClass('list-group-item-success')) {
						i2 = "C.A.T./X.A.T.";
					}
					if ($('#txtEducationIntArea').parent('a').hasClass('list-group-item-success')) {
						i3 = $('#txtEducationIntArea').val();
						if (i3 == "") {
							i3 = "EducationDefined";
						}
					}
					if ($('#txtWorkExpIntArea').parent('a').hasClass('list-group-item-success')) {
						i4 = $('#txtWorkExpIntArea').val();
						if (i4 == "") {
							i4 = "WorkExperienceDefined";
						}
					}
					if ($('#txtCfaIntArea').parent('a').hasClass('list-group-item-success')) {
						i5 = "C.F.A.";
					}
					if ($('#txtFrmIntArea').parent('a').hasClass('list-group-item-success')) {
						i6 = "F.R.M.";
					}
					if ($('#txtCustomIntArea').parent('a').hasClass('list-group-item-success')) {
						i7 = $('#txtCustomIntArea').val();
						if(i7 == "") {
							i7 = "CustomDefined";
						}
					}

					//now, save the data into the Intersts table with the given values.
					if(i3 == "EducationDefined") {
						popup.children('p').remove();
						popup.append("<p>Please fill in your Education Expertise in a bit more detail before we save it to MR - Connect.</p>").fadeIn();
					}
					else if(i4 == "WorkExperienceDefined") {
						popup.children('p').remove();
						popup.append("<p>Please fill in your Experience Expertise in a bit more detail before we save it to MR - Connect.</p>").fadeIn();	
					}
					else if(i7 == "CustomDefined") {
						popup.children('p').remove();
						popup.append("<p>Please explain your Custom Expertise field in a bit more detail before we save it to MR - Connect.</p>").fadeIn();							
					}
					else {

						alertMsg.children('p').remove();
						alertMsg.append("<p>Saving your Area(s) of expertise... Please wait</p>").fadeIn();
						$.ajax({
							type: "GET",
							url: "AJAXFunctions.php/SaveUpdateInterests",
							data: {
								no: "3", id: getCookie("userID"), email: getCookie("userEmail"), i1: i1, i2: i2, i3: i3, i4: i4, i5: i5, i6: i6, i7: i7
							},
							success: function(response) {
								if(response == "1") {
									alertMsg.children('p').remove();
									alertMsg.fadeOut();
									popup.append("<p>And We have updated/added your interests. Thank You.</p>").fadeIn();
								}
								else {
									alertMsg.children('p').remove();
									alertMsg.fadeOut();
									popup.append("<p>Oops! We encountered an error. Please try again.</p>").fadeIn();
								}
							},
							error: function() {
								alertMsg.children('p').remove();
								alertMsg.fadeOut();
								popup.append("<p>Oops! We encountered an error. Please try again.</p>").fadeIn();
							}
						});

					}
					return false;
				});

				// to save the user Association thing
				$('#btnUserAssociation').on('click', function() {

					var userAssoc = $('#userAssoc').val();

					alertMsg.children('p').remove();
					alertMsg.append("<p>Please wait while we update your Association Status with Mentored-Research... Please wait</p>").fadeIn();
					$.ajax({
						type: "GET",
						url: "AJAXFunctions.php",
						data: {
							no: "10", email: getCookie("userEmail"), id: getCookie("userID"), userAssoc: userAssoc
						},
						success: function(response) {
							if(response == "1") {
								alertMsg.children('p').remove();
								alertMsg.fadeOut();
								//popup.children('p').remove();
								popup.append("<p>Successfully updated your Association. Please continue exploring the MR - Connect.</p>").fadeIn();
							}
							else {
								alertMsg.children('p').remove();
								alertMsg.fadeOut();
								popup.children('p').remove();
								popup.append("<p>Oops! We had an error updating your Association. Please try again.</p>").fadeIn();	
							}
						},
						error: function() {
							alert("Error in AJAX.");
						}
					});
				});

				$('#btnCouponCode').on('click', function() {
					alertMsg.children("p").remove();
					alertMsg.append("<p>Please wait for a moment while we verify your coupon code...</p>").fadeIn();

					var couponCode = $('#txtCouponCode').val();

					// for verifying the coupon code.
					$.ajax({
						type: "GET",
						url: "AJAXFunctions.php",
						data: {
							no: "16", couponCode: couponCode
						},
						success: function(response) {

							response = $.trim(response);

							alertMsg.children('p').remove();
							alertMsg.fadeOut();

							if(response == "1") {
								// make the call to the linkedin Authorization function.
								IN.User.authorize(linkedInAuth);	
							}
							else if(response == "2") {
								popup.children('p').remove();
								popup.append("<p>Oops! The coupon code you entered does not seem to be correct. Please try again with the correct coupon code.</p>").fadeIn();	
							}
							else if(response == "3") {
								popup.children('p').remove();
								popup.append("<p>Oops! The coupon code you entered seems to have expired. Please try again with the Valid Coupon Code.</p>").fadeIn();									
							}
							else {
								popup.children('p').remove();
								popup.append("<p>Oops! We encountered an error while checking for your Coupon code. Please try again.</p>").fadeIn();		
							}
						},
						error: function() {
							alertMsg.children('p').remove();
							alertMsg.fadeOut();
							popup.children('p').remove();
							popup.append("<p>Oops! We encountered an error while checking for your Coupon code. Please try again.</p>").fadeIn();	
						}
					});
					return false;
				});

				// for the Coupon update Modal button.
				$('#btnCouponCodeUpdate').on('click', function() {

					alertMsg.children("p").remove();
					alertMsg.append("<p>Please wait for a moment while we verify your coupon code...</p>").fadeIn();

					var couponCode = $('#txtCouponCodeUpdate').val();
					// for verifying the coupon code and updating the verification Status of the user.
					$.ajax({
						type: "GET",
						url: "AJAXFunctions.php",
						data: {
							no: "17", couponCode: couponCode, email: getCookie("userEmail")
						},
						success: function(response) {
							response = $.trim(response);

							r = response.split(" ~ ");
							response = r[0];
							res2 = r[1];

							alertMsg.children('p').remove();
							alertMsg.fadeOut();

							if(response == "1") {
								// make the call to the linkedin Authorization function.
								IN.User.authorize(linkedInAuth);	
							}
							else {
								if(res2 == "1") {
									popup.children('p').remove();
									popup.append("<p>Oops! We could not verify your MR - Connect due to an error. Please try again.</p>").fadeIn();	
								}
								else if(res2 == "2") {
									popup.children('p').remove();
									popup.append("<p>Oops! The coupon code you entered does not seem to be correct. Please try again with the correct coupon code.</p>").fadeIn();	
								}
								else if(res2 == "3") {
									popup.children('p').remove();
									popup.append("<p>Oops! The coupon code you entered seems to have expired. Please try again with the Valid Coupon Code.</p>").fadeIn();									
								}
								else {
									popup.children('p').remove();
									popup.append("<p>Oops! We encountered an error while checking for your Coupon code. Please try again.</p>").fadeIn();		
								}
							} 
						},
						error: function() {
							alertMsg.children('p').remove();
							alertMsg.fadeOut();
							popup.children('p').remove();
							popup.append("<p>Oops! We encountered an error while checking for your Coupon code. Please try again.</p>").fadeIn();	
						}
					});

					return false;
				});

				// for the Request invite button.
				$('#btnRequestInvite, #btnRequestInviteUpdate').on('click', function() {

					$('.modal').modal('hide');
					$('.inviteModal').modal('show');

					return false;
				});

				$('#btnInvite').on('click', function() {

					var name = $('#txtName').val();
					var email = $('#txtEmail').val();
					var tel = $('#txtTel').val();

					if(name == "" || email == "" || tel == "") {
						popup.children('p').remove();							
						popup.append("<p>Oops! Looks like you did not fill all the Required Fields. Please try again.</p>").fadeIn();							
					}
					else if(!isValidEmailAddress(email)) {
						popup.children('p').remove();							
						popup.append("<p>Oops! Looks like you did not fill the Email Address correctly. Please try again.</p>").fadeIn();								
					}
					else {
						alertMsg.children("p").remove();
						alertMsg.append("<p>Please wait while we register your Request for MR - Connect Invite...</p>").fadeIn();
						$.ajax({
							type: "GET",
							url: "AJAXFunctions.php",
							data: {
								no: "19", email: email, name: name, tel: tel
							},
							success: function(response) {
								alertMsg.children('p').remove();
								alertMsg.fadeOut();

								if(response == "1") {
									popup.children('p').remove();							
									popup.append("<p>Your Request has been forwarded to the MR - Connect Team and We'll contact you in 48 hours. Thank You.</p>").fadeIn();	
								}
								else if(response == "0") {
									popup.children('p').remove();							
									popup.append("<p>Your Request has been forwarded to the MR - Connect Team and We'll contact you in 48 hours. Thank You.</p>").fadeIn();	
								}
								else {
									popup.children('p').remove();							
									popup.append("<p>Oops! We encountered an error while processing your Request for an invite. Please try again.</p>").fadeIn();								
								}
							},
							error: function() {
								alertMsg.children('p').remove();
								alertMsg.fadeOut();
								popup.children('p').remove();							
								popup.append("<p>Oops! We encountered an error while processing your Request for an invite. Please try again.</p>").fadeIn();
							}
						});   // end of ajax.

					}   // end of else

					return false;
				});

			});   // end of document ready.
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
			<button id="btnExitPopup" type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</div>

		<!--  this is for the main first div -->
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 head" id="headDiv">

			<!-- for the name as heading thing (centred) -->
			<h1 class="page-header text-center headingName" id="headName">
				
			</h1>

			<!-- for the link on the LHS -->
			<div class="col-lg-2 col-md-2 col-sm-3 linksDiv">
				<div class="list-group">
					<a href="#basicProfile" class="list-group-item scrolly">Basic Info</a>
					<a href="#educationDiv" class="list-group-item scrolly">Educational Qualifications</a>
					<a href="#experienceDiv" class="list-group-item scrolly">Experiences</a>
					<a id="AOE" href="#interestDiv" class="list-group-item scrolly">Areas of Expertise</a>
					<a id="btnLogout" class="list-group-item">Logout</a>
				</div>

				<div class="list-group">
					<a href="home.php" class="list-group-item">Network Page</a>
					<a href="index.php" class="list-group-item">Home Page</a>
					<!-- <a href="http://mentored-research.com" target="_blank" class="list-group-item">Mentored Research</a> -->
				</div>
			</div>

			<!-- for the image div -->
			<div class="imageDiv" style="float:right;">
				<img src="img/dp.jpg" class="displayImg" width="200" height="200">
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
					<span>Association with Mentored-Research</span>

					<select class="form-control lastAssoc" id="userAssoc">
						<option value="1">
							ERI Alumnus
						</option>
						<option value="2">
							BSE Alumnus
						</option>
						<option value="3">
							Technical Analysis Alumnus
						</option>
						<option value="4">
							Other
						</option>
					</select>

					<button id="btnUserAssociation" class="btn btn-lg btn-primary btn-block" style="margin-top: 2%;">
						Update your Association
					</button>
				</p>

				<!-- <p id="basicLastAss" class="lastAss" data-content="">
					<span>Last Associated with ERI in: </span>
					<select class="form-control lastAssoc">
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
					<select class="form-control lastType">
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
				</p>    -->




			</div>    <!-- end of the Basic Profile div -->

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
                        <input type="hidden" value="GMAT" id="txtGmatIntArea" />
                    </a>
                    <a href="#" class="list-group-item" id="intArea2">
                        <h4 class="list-group-item-heading">C.A.T./X.A.T.</h4>
                        <p class="list-group-item-text">i.	99%iler? Studying in one of the IIMs or XLRI? Enthused to share prep tips and your strategy with someone who wishes to ace the entrance examination? Please select this option</p>
                        <input type="hidden" value="CAT/XAT" id="txtCatIntArea" />
                    </a>
                    <a href="#" class="list-group-item" id="intArea3">
                        <h4 class="list-group-item-heading">Education</h4>
                        <p class="list-group-item-text">Alumnus or student of a top-notch school? Can share general information about the school, interview tips to get into that school with an aspirant? Please select this option
                        </p>
                        <br />
                        <input type="text" class="form-control" id="txtEducationIntArea" placeholder="School Name you attended, separated by commas" />
                    </a>
                    <a href="#" class="list-group-item" id="intArea4">
                        <h4 class="list-group-item-heading">Work Experience</h4>
                        <p class="list-group-item-text">Can help someone know more about the organization you worked for or are currently working with? Can help him/her with a referral? Have sound knowledge of your domain you are keen on sharing with others? Please select this option.</p>
                        <br />
                        <input type="text" class="form-control" id="txtWorkExpIntArea" placeholder="Company you worked for, separated by commas" />
                    </a>
                    <a href="#" class="list-group-item" id="intArea5">
                        <h4 class="list-group-item-heading">C.F.A.</h4>
                        <p class="list-group-item-text">Can you help someone in their preparation for the CFA Level I, Level II, or Level III? Can you share your insights into preparation for this competitive charter?</p>
                        <br />
                        <input type="hidden" class="form-control" id="txtCfaIntArea"  />
                    </a>
                    <a href="#" class="list-group-item" id="intArea6">
                        <h4 class="list-group-item-heading">F.R.M.</h4>
                        <p class="list-group-item-text">Can you help someone in their preparation for the FRM Level 1 or Level II? Can you share your insights into preparation for this competitive exam?</p>
                        <br />
                        <input type="hidden" class="form-control" id="txtFrmIntArea"  />
                    </a>
                    <a href="#" class="list-group-item" id="intArea7">
                        <h4 class="list-group-item-heading">Your Area Of Expertise</h4>
                        <p class="list-group-item-text">Think you can help someone in building his/her dreams. Put in your Area(s) of Expertise and we'll advertise it in MR - Connect.</p>
                        <br />
                        <input type="text" class="form-control" placeholder="Your Area of Expertise, where you can help people" id="txtCustomIntArea"  />
                    </a>
                </div>

                <button class="btn btn-lg btn-primary btn-block btnSaveInterest" id="btnInterest">
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

		<!-- this is for the coupon modal that appears for the user activation -->
		<div class="modal fade couponModal">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title couponModalTitle">
		        	Activate your MR - Connect Account
		        </h4>
		      </div>
		      <div class="modal-body couponModalBody">

		        <table class="table">
		        	<tr>
		        		<td>
		        			<p style="text-align: left; font-family: writingText; font-size: 1.2em;">
								<b>Welcome to MR - Connect!</b>
							</p>

							<p style="text-align: left; font-family: writingText; font-size: 1.2em;">
								Please enter the coupon code for using the services of MR - Connect. In case you don't have the coupon code, please go ahead and request an invite.
							</p>

							<p style="text-align: left; font-family: writingText; font-size: 1.2em;">
								In case of any problems, please drop in a mail to <code>tech@mentored-research.com</code> and we'll get back to you in 48 hours.
							</p>

							<p style="text-align: left; font-family: writingText; font-size: 1.2em;">
								Thank You.
							</p>
		        		</td>
		        	</tr>
            		<tr>
            			<td>
            				<input type="text" id="txtCouponCode" class="form-control" placeholder="Enter Coupon code *" />
            			</td>
            		</tr>
            		<tr>
            			<td>
            				<button class="btn btn-lg btn-block btn-primary" id="btnCouponCode" style="font-family: boldText;">
            					Activate
            				</button>
            			</td>
            		</tr>
            		<tr>
            			<td>
            				<button class="btn btn-lg btn-block btn-primary" id="btnRequestInvite" style="font-family: boldText;">
            					Request an Invite
            				</button>
            			</td>
            		</tr>
                </table>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<!-- this is for the coupon modal that appears for the user activation [for updation]-->
		<div class="modal fade couponUpdateModal">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title couponUpdateModalTitle">
		        	Activate your MR - Connect Account
		        </h4>
		      </div>
		      <div class="modal-body couponUpdateModalBody">

		        <table class="table">
		        	<tr>
		        		<td>
		        			<p style="text-align: left; font-family: writingText; font-size: 1.2em;">
								<b>Welcome to MR - Connect!</b>
							</p>

							<p style="text-align: left; font-family: writingText; font-size: 1.2em;">
								It appears to us that your MR - Connect account has not been activated yet. Please enter the coupon code for Account Activation. In case you don't have the coupon code, please go ahead and request an invite.
							</p>

							<p style="text-align: left; font-family: writingText; font-size: 1.2em;">
								In case of any problems, please drop in a mail to <code>tech@mentored-research.com</code> and we'll get back to you in 48 hours.
							</p>

							<p style="text-align: left; font-family: writingText; font-size: 1.2em;">
								Thank You.
							</p>
		        		</td>
		        	</tr>
            		<tr>
            			<td>
            				<input type="text" id="txtCouponCodeUpdate" class="form-control" placeholder="Enter Coupon code *" />
            			</td>
            		</tr>
            		<tr>
            			<td>
            				<button class="btn btn-lg btn-block btn-primary" id="btnCouponCodeUpdate" style="font-family: boldText;">
            					Activate
            				</button>
            			</td>
            		</tr>
            		<tr>
            			<td>
            				<button class="btn btn-lg btn-block btn-primary btnInvite" id="btnRequestInviteUpdate" style="font-family: boldText;">
            					Request an Invite
            				</button>
            			</td>
            		</tr>
                </table>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

				<!-- this is for the coupon modal that appears for the user activation -->
		<div class="modal fade inviteModal">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title inviteModalTitle">
		        	Request Invite for MR - Connect
		        </h4>
		      </div>
		      <div class="modal-body inviteModalBody">
		      	<table class="table">
		        	<tr>
		        		<td>
		        			<p style="text-align: left; font-family: writingText; font-size: 1.2em;">
								<b>Hey there!</b>
							</p>

							<p style="text-align: left; font-family: writingText; font-size: 1.2em;">
								Please fill in the following details for Requesting an invite for MR - Connect. We'd get back to you as soon as possible with your Invite Code in your provided mailbox.
							</p>

							<p style="text-align: left; font-family: writingText; font-size: 1.2em;">
								Thank You.
							</p>
		        		</td>
		        	</tr>
            		<tr>
            			<td>
            				<input type="text" id="txtName" placeholder="Enter Name*" class="form-control" />
            			</td>
            		</tr>
            		<tr>
            			<td>
            				<input type="text" id="txtEmail" placeholder="Enter Email*" class="form-control" />
            			</td>
            		</tr>
            		<tr>
            			<td>
            				<input type="text" id="txtTel" placeholder="Enter Telephone Number*" class="form-control" />
            			</td>
            		</tr>
            		<tr>
            			<td>
            				<button class="btn btn-lg btn-block btn-primary btnInvite" id="btnInvite" style="font-family: boldText;">
            					Invite Me In!
            				</button>
            			</td>
            		</tr>
                </table>


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