<?php 
	//ob_start();

	//this is the file for all the helper functions needed in this project.

	//these are for the PHP Helper files
	include 'headers/databaseConn.php';

	// this is the function to change the isVerified status of the user to 1 or 0, as passed.
	// returns 1 on Success. -1 on error.
	function VerifyUser($email, $status) {
		global $connection;
		$res = "-1";
		try {
			$query = "update Users set IsVerified='$status' where UserEmail='$email'";
			$rs = mysql_query($query);
			if(!$rs) {
				$res = "-1";
			}
			else {
				$res = "1";
			}
			return $res;
		}
		catch(Exception $e) {
			$res = "-1";
			return $res;
		}
	}

	// this is the function to check for the verified user or not.
	// returns 1 on Verified user. 0 on  Not verified. -1 on error.
	function IsVerifiedUser($email) {
		global $connection;
		$resp = "-1";
		try {
			$query = "select * from Users where UserEmail='$email'";
			$rs = mysql_query($query);
			if(!$rs) {
				$resp = "-1";
			}
			else {
				while ($res = mysql_fetch_array($rs)) {
					if($res["IsVerified"] == "1") {
						$resp = "1";
					}
					else if($res["IsVerified"] == "0") {
						$resp = "0";	
					}
					else {
						$resp = "-1";		
					}
				}
			}
			return $resp;
		}
		catch(Exception $e) {
			$resp = "-1";
			return $resp;
		}
	}

	// this is the function to check coupon validity!!
	// returns 1 if the coupon is valid. 0 if invalid. -1 on error.
	function IsCouponValid($code) {
		global $connection;
		$resp = "-1";
		try {
			$query = "select * from Coupons where CouponCode='$code'";
			$rs = mysql_query($query);
			if(!$rs) {
				$resp = "-1";
			}
			else {
				if(mysql_num_rows($rs) == 1) {
					while ($res = mysql_fetch_array($rs)) {
						if($res["IsValid"] == "1") {
							$resp = "1";
						}
						else {
							$resp = "0";
						}
					}
				}   // end of if.
				else {
					$resp = "0";
				}
			}
			return $resp;
		}
		catch(Exception $e) {
			$resp = "-1";
			return $resp;
		}
	}

	// this is the function to check coupon existence and validity!
	// returns 1 if the coupon exists and is valid. 2 if the coupon does not exist. 3 if an invalid coupon exists. -1 on error.
	function CheckCouponCode($code) {
		global $connection;
		$resp = "-1";
		try {

			if(IsCouponValid($code) == "1") {
				$query = "select * from Coupons where CouponCode='$code'";
				$rs = mysql_query($query);
				if(!$rs) {
					$resp = "-1";
				}
				else {
					if(mysql_num_rows($rs) == 0) {   // coupon does not exists.
						$resp = "2";
					}
					else if(mysql_num_rows($rs) >= 1) { 
						$resp = "1";   // coupon  exists and valid.
					}
					else {
						$resp = "-1";
					}
				}
			}
			else if(IsCouponValid($code) == "0") {
				$resp = "3";
			}
			else {
				$resp = "-1";
			}
			return $resp;
		}
		catch(Exception $e) {
			$resp = "-1";
			return $resp;
		}
	}

	// this is to submit the question to database based on category
	function SubmitAskedQuestions($id, $email, $category, $question, $date) {
		global $connection;
		$response = "-1";
		try {
			$query = "insert into AskQuestions(UserID, QuesCategory, QuestionAsked, UpdatedOn) values('$id', '$category', '$question', '$date')";
			$rs = mysql_query($query);
			if(!$rs) {
				$response = "-1";
			}
			else {
				$response = "1";
			}
			return $response;
		}
		catch(Exception $e) {
			$response = "-1";
			return $response;
		}
	}

	// this is to get the count of all the votes in a question
	function GetVoteCountPollQuestions() {
		global $connection;
		$response = "-1";
		try {
			$query = "select * from PollQuestions";
			$rs = mysql_query($query);
			if(!$rs) {
				$response = "-1";
			}
			else {
				$response = "";
				while ($res = mysql_fetch_array($rs)) {
					$response .= $res["Question"] . " -> " . $res["Votes"] . " && ";
				}
			}
			return $response;
		}
		catch(Exception $e) {
			$response = "-1";
			return $response;
		}
	}

	// this is the helper function to increase the number of votes for a particualr pll question.
	function IncreaseVotes($checked, $checkedName) {
		global $connection;
		$response = "-1";

		$newVotes = 0;

		$votesNo = GetVotesNumber($checked, $checkedName);
		if($votesNo == -1) {
			$response = "-1";
			return $response;
		}
		else {
			$newVotes = $votesNo + 1;
		}

		try {
			$query = "update PollQuestions set Votes='$newVotes' where PollID='$checked' and Question='$checkedName'";
			$rs = mysql_query($query);
			if(!$rs) {
				$response = "-1";
			}
			else {
				$response = "1";
			}
			return $response;
		}
		catch(Exception $e) {
			$response = "-1";
			return $response;
		}
	}

	// this is the heler function to get the number of votes that a poll question already has.
	function GetVotesNumber($checked, $checkedName) {
		global $connection;
		$response = 0;
		try {
			$query = "select * from PollQuestions where PollID='$checked' and Question='$checkedName'";
			$rs = mysql_query($query);
			if(!$rs) {
				$response = -1;
			}
			else {
				while ($res = mysql_fetch_array($rs)) {
					$response = $res["Votes"];
				}
			}
			return $response;
		}
		catch(Exception $e) {
			$response = -1;
			return $response;
		}
	}

	// this is the helper function to change the voted Status for a user. 0 for not voted and 1 for voted.
	function SetVotedStatusOfUser($email, $id, $newVal) {
		global $connection;
		$response = "-1";
		try {
			$query = "update Users set IsVoted='$newVal' where UserEmail='$email'";
			$rs = mysql_query($query);
			if(!$rs) {
				$response = "-1";
			}
			else {
				$response = "1";
			}
			return $response;
		}		
		catch(Exception $e) {
			$response = "-1";
			return $response;
		}
	}

	// this is the helper function to check if the user has already voted or not.
	// Returns 1 if the user has voted. Otherwise, 0. -1 on Error.
	function IsVoted($email, $id) {
		global $connection;
		$response = "-1";
		try {
			$query = "select * from Users where UserEmail='$email'";
			$rs = mysql_query($query);
			if(!$rs) {
				$response = "-1";
			}
			else {
				while ($res = mysql_fetch_array($rs)) {
					if($res["IsVoted"] == 1) {
						$response = "1";
					}
					else if($res["IsVoted"] == 0) {
						$response = "0";
					}
					else {
						$response = "-1";
					}
				}
			}
			return $response;
		}		
		catch(Exception $e) {
			$response = "-1";
			return $response;
		}
	}

	// this is the function to get all the poll questions from the database.
	function GetPollQuestionsRadioList() {
		global $connection;
		$response = "<div class='list-group-item'><table class='table table-responsive'>";
		try {
			$query = "select * from PollQuestions";
			$rs = mysql_query($query);
			if(!$rs) {
				$response = "-1";
			}
			else {
				while($res = mysql_fetch_array($rs)) {
					$response .= "<tr><td><input type='radio' name='pollQues' class='pQuestion' id='pollQuestion" . $res["PollID"] . "' data-id='" . $res["PollID"] . "' data-name='" . $res["Question"] . "' /></td><td> <label for='pollQuestion" . $res["PollID"] . "'>" . $res["Question"] . "</label>  </td></tr>";
				}
			}
			$response .= "</table><button id='btnPollVote' class='btn btn-lg btn-primary btn-block btnVote'>Vote Now</button></div>";
			return $response;
		}
		catch(Exception $e) {
			$response = "-1";
			return $response;
		}
	}

	//this is the function to send the mail to the user who requested the connection, as a confirmation.
	function SendConfirmationOfRequest($requestFrom, $requestFromName, $requestForEmail, $requestForName) {
		$res = "";
		$mailbody = "";
		try{

			$mailbody .= "<h1>MR - Connect Request Received</h1><br />";
			$mailbody .= "Dear " . $requestFromName . "<br />";
			$mailbody .= "Your Request of Connecting you to " . $requestForName . " has been successfully registered. We'll be contacting you real soon for further correspondance. Till then, please be patient.";
			$mailbody .= "<br /><br />Thank You.";
			$mailbody .= "<br />MR - Connect";
			$mailbody .= "<br /><a href='http://mentored-research.com'>Mentored-Research</a>";

			$Header = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$Header .= 'From: MR - Connect (Mentored-Research)<guide@mentored-research.com>' . "\r\n";
			$to = $requestFrom;
			$message = $mailbody;
			$subject = "MR - Connect Connection Request Confirmed";
			if(mail($to,$subject,$message,$Header) == true) {
				$res = "1";
			}
			else {
				$res = "-1";	
			}
			return $res;
		}	
		catch(Exception $e) {
			$res = "-1";
			return $res;
		}
	}

	//this is the function to get the name of the user who's email has been passed.
	// returns -1 when the user does not exists or in case of error.
	function GetUserName($email) {
		$name = "";
		try {
			$query = "select * from Users where UserEmail='$email'";
			$rs = mysql_query($query);
			if(!$rs) {
				return "-1";
			}
			else{
				while($res = mysql_fetch_array($rs)) {
					$name = $res["UserName"];
				}
			}
			return $name;
		}
		catch(Exception $e) {
			return "-1";
		}
	}

	//this is the helper function to get all the user data based on UserID
	function GetUserDataList($userID) {
		global $connection;
		$response = "";
		try {
			$query = "select * from Users where UserID='$userID'";
			$rs = mysql_query($query);
			if(!$rs) {
				$response = "-1";
			}
			else {
				while ($res = mysql_fetch_array($rs)) {
					$id = $res["UserID"];
					$email = $res["UserEmail"];

					$interests = getInterests($email, $id);
					$in = explode(" @I ", $interests);
					$interests = "";
					foreach ($in as $i) {
						if($i == "-" || $i == " " || $i == "") {

						}
						else {
							$interests .= $i . ", ";
						}
					}  
					$interests = substr($interests, 0, strlen($interests) - 2);
					//$response .= "<img src='" . $res["UserPic"] . "' class='userImage' width='130' height='130' /><div class='userItem'><p class='userName'>" . $res["UserName"] . "</p><p class='userLocation'> <span>Currently at: </span> <u>" . $res["UserLocation"] . "</u> <br /> <span>Expertise in: </span> <u>" . $interests . "</u> </p><p class='userReadMore'><a class='readMoreLink' data-id='" . $id . "' data-email='" . $email . "' href='#'>Read More...</a></p></div>";				
					if(strlen($interests) >= 15) {
						$interests = substr($interests, 0, 15);
						$interests .= "...";
					}
					$response .= "<div class='col-lg-6 col-md-6'><div class='thumbnail'><img class='media-object userImage' width='130' height='130' src='" . $res["UserPic"] . "' /><div class='caption'><p class='userName'>" . $res["UserName"] . "</p><p class='userLocation'><span>Expertise in: </span> <u>" . $interests . "</u> </p><p class='userReadMore'><a class='readMoreLink' data-id='" . $id . "' data-email='" . $email . "' href='#'>Read More...</a></p></div><button class='btn btn-lg btn-primary btn-block btnConnRequest' data-id='" . $id . "' data-email='" . $email . "' data-profile='" . $res["UserProfile"] . "'>Connect on LinkedIn</button></div></div>";
				}
			}
			return $response;
		}
		catch(Exception $e) {
			$response = "-1";
			return $response;
		}
	}

	//this is the function to search by Expertise.
	function SearchByExpertise($i1, $i2, $i5, $i6, $i7) {
		global $connection;
		//$response = "<div class='list-group-item'>";
		$response = "<div class='row'>";
		try {

			if($i1 == "")	
				$i1 = "~~";
			if($i2 == "")	
				$i2 = "~~";
			if($i5 == "")	
				$i5 = "~~";
			if($i6 == "")	
				$i6 = "~~";
			if($i7 == "")	
				$i7 = "~~";

			$query = "select * from Interests where Interest1 like '%$i1%' or Interest2 like '%$i2%' or Interest5 like '%$i5%' or Interest6 like '%$i6%' or Interest7 like '%$i7%' or Interest4 like '%$i7%' or Interest3 like '%$i7%'";
			$rs = mysql_query($query);
			if(!$rs) {
				$response = "-1";
			}
			else {
				while ($res = mysql_fetch_array($rs)) {
					$id = $res["UserID"];
					$response .= GetUserDataList($id);
				}
			}
			$response .= "</div>";
			return $response;
		}
		catch(Exception $e) {
			$response = "-1";
			return $response;
		}
	}

	//this is the function to get all the Search results in the List format.
	function SearchList($searchKey) {
		global $connection;
		$response = "<div class='list-group'>";
		$id = "";
		$email = "";
		$interests = "";
		try {
			$query = "select * from Users where UserName like '%$searchKey%' or UserEmail like '%searchKey%'";
			$rs = mysql_query($query);
			if(!$rs) {
				$response = "-1";
			}
			else {
				while ($res = mysql_fetch_array($rs)) {
					$id = $res["UserID"];
					$email = $res["UserEmail"];

					$interests = getInterests($email, $id);
					$in = explode(" @I ", $interests);
					$interests = "";
					foreach ($in as $i) {
						if($i == "-" || $i == " " || $i == "" || $i == "-3") {

						}
						else {
							$interests .= $i . ", ";
						}
					}  
					$interests = substr($interests, 0, strlen($interests) - 2);

					if($interests == "") {
						$interests = "-1";
					}

					if($res["UserPic"] == "") {
						$res["UserPic"] = "img/dp.jpg";
					}

					if($interests == "-1") {
						//$response .= "<div class='list-group-item item'><div class='media-left media-top'><img src='" . $res["UserPic"] . "' class='media-object userImage' width='120' height='120' /></div><div class='userItem'><p class='userName'>" . $res["UserName"] . "</p><p class='userReadMore'><a class='readMoreLink' data-id='" . $id . "' data-email='" . $email . "' href='#'>Read More...</a></p></div><button class='btn btn-lg btn-primary btn-block btnConnRequest' data-id='" . $id . "' data-email='" . $email . "' data-profile='" . $res["UserProfile"] . "'>Connect on LinkedIn</button></div>" . " (BR) ";
						$response .= "<div class='col-lg-6 col-md-6'><div class='thumbnail'><img class='media-object userImage' width='130' height='130' src='" . $res["UserPic"] . "' /><div class='caption'><p class='userName'>" . $res["UserName"] . "</p><p class='userLocation'><span>Expertise in: </span> <u>" . "None" . "</u> </p><p class='userReadMore'><a class='readMoreLink' data-id='" . $id . "' data-email='" . $email . "' href='#'>Read More...</a></p></div><button class='btn btn-lg btn-primary btn-block btnConnRequest' data-id='" . $id . "' data-email='" . $email . "' data-profile='" . $res["UserProfile"] . "'>Connect on LinkedIn</button></div></div>";
					}
					else {
						//$response .= "<div class='list-group-item item'><div class='media-left media-top'><img src='" . $res["UserPic"] . "' class='media-object userImage' width='120' height='120' /></div><div class='userItem'><p class='userName'>" . $res["UserName"] . "</p><p class='userLocation'><span>Expertise in: </span> <u>" . $interests . "</u> </p><p class='userReadMore'><a class='readMoreLink' data-id='" . $id . "' data-email='" . $email . "' href='#'>Read More...</a></p></div><button class='btn btn-lg btn-primary btn-block btnConnRequest' data-id='" . $id . "' data-email='" . $email . "' data-profile='" . $res["UserProfile"] . "'>Connect on LinkedIn</button></div>"  . " (BR) ";
						if(strlen($interests) >= 15) {
							$interests = substr($interests, 0, 15);
							$interests .= "...";
						}
						$response .= "<div class='col-lg-6 col-md-6'><div class='thumbnail'><img class='media-object userImage' width='130' height='130' src='" . $res["UserPic"] . "' /><div class='caption'><p class='userName'>" . $res["UserName"] . "</p><p class='userLocation'><span>Expertise in: </span> <u>" . $interests . "</u> </p><p class='userReadMore'><a class='readMoreLink' data-id='" . $id . "' data-email='" . $email . "' href='#'>Read More...</a></p></div><button class='btn btn-lg btn-primary btn-block btnConnRequest' data-id='" . $id . "' data-email='" . $email . "' data-profile='" . $res["UserProfile"] . "'>Connect on LinkedIn</button></div></div>";
					}

					//$response .= "<div class='list-group-item item'><img src='" . $res["UserPic"] . "' class='userImage' width='120' height='120' /><div class='userItem'><p class='userName'>" . $res["UserName"] . "</p><p class='userLocation'> <span>Expertise in: </span> <u>" . $interests . "</u> </p><p class='userReadMore'><a class='readMoreLink' data-id='" . $id . "' data-email='" . $email . "' href='#'>Read More...</a></p></div><button class='btn btn-lg btn-primary btn-block btnConnRequest' data-id='" . $id . "' data-email='" . $email . "' data-profile='" . $res["UserProfile"] . "'>Connect on LinkedIn</button></div>";
				}
			}
			$response .= "</div>";
			return $response;
		}
		catch(Exception $e) {
			$response = "-1";
			return $response;
		}
	}

	// this is to get all the users in the list as thumbnails. Just a try thing.
	function GetAllUsersList($mailAdd) {
		global $connection;
		$response = "<div class='row'>";
		$id = "";
		$email = "";
		$interests = "";
		try {

			if(checkIfUserExists($mailAdd) == "1") {

				$query = "select * from Users";
				$rs = mysql_query($query);
				if(!$rs) {
					$response = "-1";
				}
				else {
					while ($res = mysql_fetch_array($rs)) {
						$id = $res["UserID"];
						$email = $res["UserEmail"];

						$interests = getInterests($email, $id);
						$in = explode(" @I ", $interests);
						$interests = "";
						foreach ($in as $i) {
							if($i == "-" || $i == " " || $i == "" || $i == "-3") {

							}
							else {
								$interests .= $i . ", ";
							}
						}  
						$interests = substr($interests, 0, strlen($interests) - 2);

						if($interests == "") {
							$interests = "-1";
						}

						if($res["UserPic"] == "") {
							$res["UserPic"] = "img/dp.jpg";
						}

						// <p class='userLocation'><span>Expertise in: </span> <u>" . $interests . "</u> </p>
						if($interests == "-1") {
							//$response .= "<div class='list-group-item item'><div class='media-left media-top'><img src='" . $res["UserPic"] . "' class='media-object userImage' width='120' height='120' /></div><div class='userItem'><p class='userName'>" . $res["UserName"] . "</p><p class='userReadMore'><a class='readMoreLink' data-id='" . $id . "' data-email='" . $email . "' href='#'>Read More...</a></p></div><button class='btn btn-lg btn-primary btn-block btnConnRequest' data-id='" . $id . "' data-email='" . $email . "' data-profile='" . $res["UserProfile"] . "'>Connect on LinkedIn</button></div>" . " (BR) ";
							$response .= "<div class='col-lg-6 col-md-6'><div class='thumbnail'><img class='media-object userImage' width='130' height='130' src='" . $res["UserPic"] . "' /><div class='caption'><p class='userName'>" . $res["UserName"] . "</p><p class='userLocation'><span>Expertise in: </span> <u>" . "None" . "</u> </p><p class='userReadMore'><a class='readMoreLink' data-id='" . $id . "' data-email='" . $email . "' href='#'>Read More...</a></p></div><button class='btn btn-lg btn-primary btn-block btnConnRequest' data-id='" . $id . "' data-email='" . $email . "' data-profile='" . $res["UserProfile"] . "'>Connect on LinkedIn</button></div></div>" . " (BR) ";
						}
						else {
							//$response .= "<div class='list-group-item item'><div class='media-left media-top'><img src='" . $res["UserPic"] . "' class='media-object userImage' width='120' height='120' /></div><div class='userItem'><p class='userName'>" . $res["UserName"] . "</p><p class='userLocation'><span>Expertise in: </span> <u>" . $interests . "</u> </p><p class='userReadMore'><a class='readMoreLink' data-id='" . $id . "' data-email='" . $email . "' href='#'>Read More...</a></p></div><button class='btn btn-lg btn-primary btn-block btnConnRequest' data-id='" . $id . "' data-email='" . $email . "' data-profile='" . $res["UserProfile"] . "'>Connect on LinkedIn</button></div>"  . " (BR) ";
							if(strlen($interests) >= 15) {
								$interests = substr($interests, 0, 15);
								$interests .= "...";
							}
							$response .= "<div class='col-lg-6 col-md-6'><div class='thumbnail'><img class='media-object userImage' width='130' height='130' src='" . $res["UserPic"] . "' /><div class='caption'><p class='userName'>" . $res["UserName"] . "</p><p class='userLocation'><span>Expertise in: </span> <u>" . $interests . "</u> </p><p class='userReadMore'><a class='readMoreLink' data-id='" . $id . "' data-email='" . $email . "' href='#'>Read More...</a></p></div><button class='btn btn-lg btn-primary btn-block btnConnRequest' data-id='" . $id . "' data-email='" . $email . "' data-profile='" . $res["UserProfile"] . "'>Connect on LinkedIn</button></div></div>" . " (BR) ";
						}
					}
				}
				$response .= "</div>";
			}
			else if(checkIfUserExists($mailAdd) == "-1") {   // user does not exists.
				$response = "-1";
			}
			else {
				$response = "-2";
			}
			return $response;
		}
		catch(Exception $e) {
			$response = "-2";
			return $response;
		}
	}

	//this is the function to get all the users in the list format for showing.
	// function GetAllUsersList() {
	// 	global $connection;
	// 	$response = "<div class='list-group'>";
	// 	$id = "";
	// 	$email = "";
	// 	$interests = "";
	// 	try {
	// 		$query = "select * from Users";
	// 		$rs = mysql_query($query);
	// 		if(!$rs) {
	// 			$response = "-1";
	// 		}
	// 		else {
	// 			while ($res = mysql_fetch_array($rs)) {
	// 				$id = $res["UserID"];
	// 				$email = $res["UserEmail"];

	// 				$interests = getInterests($email, $id);
	// 				$in = explode(" @I ", $interests);
	// 				$interests = "";
	// 				foreach ($in as $i) {
	// 					if($i == "-" || $i == " " || $i == "" || $i == "-3") {

	// 					}
	// 					else {
	// 						$interests .= $i . ", ";
	// 					}
	// 				}  
	// 				$interests = substr($interests, 0, strlen($interests) - 2);

	// 				if($interests == "") {
	// 					$interests = "-1";
	// 				}

	// 				if($res["UserPic"] == "") {
	// 					$res["UserPic"] = "img/dp.jpg";
	// 				}

	// 				// <p class='userLocation'><span>Expertise in: </span> <u>" . $interests . "</u> </p>
	// 				if($interests == "-1") {
	// 					$response .= "<div class='list-group-item item'><div class='media-left media-top'><img src='" . $res["UserPic"] . "' class='media-object userImage' width='120' height='120' /></div><div class='userItem'><p class='userName'>" . $res["UserName"] . "</p><p class='userReadMore'><a class='readMoreLink' data-id='" . $id . "' data-email='" . $email . "' href='#'>Read More...</a></p></div><button class='btn btn-lg btn-primary btn-block btnConnRequest' data-id='" . $id . "' data-email='" . $email . "' data-profile='" . $res["UserProfile"] . "'>Connect on LinkedIn</button></div>" . " (BR) ";
	// 				}
	// 				else {
	// 					$response .= "<div class='list-group-item item'><div class='media-left media-top'><img src='" . $res["UserPic"] . "' class='media-object userImage' width='120' height='120' /></div><div class='userItem'><p class='userName'>" . $res["UserName"] . "</p><p class='userLocation'><span>Expertise in: </span> <u>" . $interests . "</u> </p><p class='userReadMore'><a class='readMoreLink' data-id='" . $id . "' data-email='" . $email . "' href='#'>Read More...</a></p></div><button class='btn btn-lg btn-primary btn-block btnConnRequest' data-id='" . $id . "' data-email='" . $email . "' data-profile='" . $res["UserProfile"] . "'>Connect on LinkedIn</button></div>"  . " (BR) ";
	// 				}
	// 			}
	// 		}
	// 		$response .= "</div>";
	// 		return $response;
	// 	}
	// 	catch(Exception $e) {
	// 		$response = "-1";
	// 		return $response;
	// 	}
	// }

	//this is the function to update the data into the interests table.
	function UpdateInterests($id, $email, $i1, $i2, $i3, $i4, $i5, $i6, $i7, $date) {
		global $connection;
		$res = "";
		try {
			$query = "update Interests set Interest1 = '$i1', Interest2 = '$i2', Interest3 = '$i3', Interest4 = '$i4', Interest5 = '$i5', Interest6 = '$i6', Interest7 = '$i7', UpdatedOn = '$date' where UserID = '$id'";
			$rs = mysql_query($query);
			if(!$rs) {
				$res = "-1";
			}
			else {
				$res = "1";
			}
			return $res;
		}
		catch(Exception $e) {
			$res = "-1";
			return $res;
		}
	}

	//this is the function to insert the data into the interests table.
	function InsertInterests($id, $email, $i1, $i2, $i3, $i4, $i5, $i6, $i7, $date) {
		global $connection;
		$res = "";
		try {
			$query = "insert into Interests(UserID, Interest1, Interest2, Interest3, Interest4, Interest5, Interest6, Interest7, UpdatedOn) values('$id', '$i1', '$i2', '$i3', '$i4', '$i5', '$i6', '$i7', '$date')";
			$rs = mysql_query($query);
			if(!$rs) {
				$res = "-1";
			}
			else {
				$res = "1";
			}
			return $res;
		}
		catch(Exception $e) {
			$res = "-1";
			return $res;
		}
	}

	//this is the function to get the experience data of the user. Returns an empty String if the user does not exists in the Table.
	function getInterests($userEmail, $userID) {
		global $connection;
		$response = "";
		try {
			$query = "select * from Interests where UserID='$userID'";
			$rs = mysql_query($query);
			if(!$rs) {
				$response = "-1";
			}
			else {
				if(mysql_num_rows($rs) == 0) {
					$response = "-3";
				}
				else {
					while ($res = mysql_fetch_array($rs)) {
						$response .= $res["Interest1"] . " @I " . $res["Interest2"] . " @I " . $res["Interest3"] . " @I " . $res["Interest4"] . " @I " . $res["Interest5"] . " @I " . $res["Interest6"] . " @I " . $res["Interest7"] . " @I ";
					}					
				}
			}
			return $response;
		}
		catch(Exception $e) {
			$response = "-1";
			return $response;
		}
	}

	//this is the function to get the experience data of the user.
	function getExperienceData($userEmail, $userID) {
		global $connection;
		$response = "";
		try {
			$query = "select * from ExperienceListings where UserID='$userID'";
			$rs = mysql_query($query);
			if(!$rs) {
				$response = "-1";
			}
			else {
				while ($res = mysql_fetch_array($rs)) {
					$response .= $res["CompanyName"] . " @Ex " . $res["Date"] . " @Ex " . $res["Title"] . " @Ex " . $res["Summary"] . " @Ex ";
				}
			}
			return $response;
		}
		catch(Exception $e) {
			$response = "-1";
			return $response;
		}
	}

	//this is the function to get the Education data of the user.
	function getEducationData($userEmail, $userID) {
		global $connection;
		$response = "";
		try {
			$query = "select * from EducationListings where UserID='$userID'";
			$rs = mysql_query($query);
			if(!$rs) {
				$response = "-1";
			}
			else {
				while ($res = mysql_fetch_array($rs)) {
					$response .= $res["SchoolName"] . " @E " . $res["Date"] . " @E " . $res["Degree"] . " @E " . $res["FieldOfStudy"] . " @E ";
				}
			}
			return $response;
		}
		catch(Exception $e) {
			$response = "-1";
			return $response;
		}
	}

	//this is the function to get the user Personal Details in a string.
	function getPersonalData($userEmail, $userID) {
		global $connection;
		$response = "";
		try {
			$query = "select * from Users where UserID='$userID' and UserEmail='$userEmail'";
			$rs = mysql_query($query);
			if(!$rs) {
				$response = "-1";
			}
			else {
				while ($res = mysql_fetch_array($rs)) {
					$response .= $res["UserEmail"] . " ,& " . $res["UserName"] . " ,& " . $res["UserPic"] . " ,& " . $res["UserContact"] . " ,& " . $res["UserProfile"] . " ,& " . $res["UserLocation"] . " ,& " . $res["UserTwitter"] . " ,& " . $res["UserLastAss"] . " ,& " . $res["UserType"] . " ,& " . $res["UserAssociation"] . " ,& ";
				}
			}
			return $response;
		}
		catch(Exception $e) {
			$response = "-1";
			return $response;
		}
	}


	//this is the function to check if the user with a given Email ID already exists in the database.
	//Returns 1 if the userEmail already exists. Returns -1 if does not exists. Returns -2 on Error.
	function checkIfUserExists($email) {
		global $connection;
		try {
			$query = "select count(*) as numUsers from Users where UserEmail='$email'";
			$rs = mysql_query($query);
			if(!$rs) {
				return "-2";
			}
			else {
				$res = mysql_fetch_array($rs);
				if($res["numUsers"] == 0) {
					return "-1";
				}
				else {
					return "1";
				}
			}
		}
		catch(Exception $e) {
			return "-2";
		}
	}

	//this is to get the userID of the user whose Email is passed. -1 is returned on error!
	function getUserID($email) {
		global $connection;
		$userID = "-1";
		try {
			$query = "select * from Users where UserEmail='$email'";
			$rs = mysql_query($query);
			if(!$rs) {
				$userID = "-1";
				return $userID;
			}
			else {
				while ($res = mysql_fetch_array($rs)) {
					$userID = $res["UserID"];
				}
			}
			return $userID;
		}
		catch(Exception $e) {
			$userID = "-1";
			return $userID;
		}
	}

	//this is the function to save all the personal details into the Users Table.
	function savePersonalDetails($email, $name, $pic, $contact, $profile, $location, $twitter, $lastAss, $type, $updatedOn) {
		global $connection;
		try {
			//$date = date("Y-m-d H:i:s");
			$query = "insert into Users(UserEmail, UserName, UserPic, UserContact, UserProfile, UserLocation, UserTwitter, UserLastAss, UserType, UpdatedOn, IsVerified) values('$email', '$name', '$pic', '$contact', '$profile', '$location', '$twitter', '$lastAss', '$type', '$updatedOn', '1')";
			$rs = mysql_query($query);
			if(!$rs) {
				return "-1";
			}
			else {
				return "1";
			}
		}
		catch(Exception $e) {
			return "-1";
		}
	}

	//this is the function to save the education fields for the user. Returns 1 if successful. Otherwise, returns -1.
	function saveEducation($userID, $schoolName, $date, $degree, $fos, $updatedOn) {
		global $connection;
		try {
			$query = "insert into EducationListings(UserID, SchoolName, Date, Degree, FieldOfStudy, UpdatedOn) values('$userID', '$schoolName', '$date', '$degree', '$fos', '$updatedOn')";
			$rs = mysql_query($query);
			if(!$rs) {
				return "-1";
			}
			else {
				return "1";
			}
		}
		catch(Exception $e) {
			return "-1";
		}
	}

	//this is the function to save the Experience fields for the user. Returns 1 if successful. Otherwise, returns -1.
	function saveExperience($userID, $companyName, $date, $title, $summary, $updatedOn) {
		global $connection;
		try {
			$query = "insert into ExperienceListings(UserID, CompanyName, Date, Title, Summary, UpdatedOn) values('$userID', '$companyName', '$date', '$title', '$summary', '$updatedOn')";
			$rs = mysql_query($query);
			if(!$rs) {
				return "-1";
			}
			else {
				return "1";
			}
		}
		catch(Exception $e) {
			return "-1";
		}
	}

	// this is the helper function to save the details to the log file.
	function WriteToLog($txt) {
		$logFile = fopen("log/log.txt", "a");
		if(!$logFile) {
			die("Cannot write to log.");
		}
		else {
			$date = date("Y-m-d H:i:s");
			fwrite($logFile, $date . " --> " . $txt . "\n");
		}
		fclose($logFile);
	}
?>