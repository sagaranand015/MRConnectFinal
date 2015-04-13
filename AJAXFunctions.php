<?php
	ob_start();
	//these are for the PHP Helper files
	include('headers/databaseConn.php');
	include('helpers.php');
	
	//this is the file that contains all the functions used in AJAX.
	if(isset($_POST["no"]) && $_POST["no"] == "1") {
		//this is to save the details of the user coming first time to the MR Connect Portal
		SaveUser($_POST["basic"], $_POST["education"], $_POST["experience"], $_POST["contact"], $_POST["picture"]);
	}
	else if(isset($_GET["no"]) && $_GET["no"] == "2") {
		//this is the function to load the data from the database and show it to the Front end.
		LoadData($_GET["email"], $_GET["id"]);
	}
	else if(isset($_GET["no"]) && $_GET["no"] == "3") {   //for saving/updating the interests thing.
		SaveUpdateInterests($_GET["id"], $_GET["email"], $_GET["i1"], $_GET["i2"], $_GET["i3"], $_GET["i4"], $_GET["i5"], $_GET["i6"], $_GET["i7"]);
	}
	else if(isset($_GET["no"]) && $_GET["no"] == "4") {   //for getting all the users from the database
		GetAllUsers();
	}
	else if(isset($_GET["no"]) && $_GET["no"] == "5") {   //for getting all the users from the database
		UserExists($_GET["email"], $_GET["id"]);
	}
	else if(isset($_GET["no"]) && $_GET["no"] == "6") {   //for getting all the users from the database
		SetCookieID($_GET["email"]);
	}
	else if(isset($_GET["no"]) && $_GET["no"] == "7") {   //for getting all the users from the database
		GetSearchList($_GET["searchKey"]);
	}
	else if(isset($_GET["no"]) && $_GET["no"] == "8") {   //for getting all the users from the database
		GetSearchByExpertise($_GET["i1"], $_GET["i2"], $_GET["i5"], $_GET["i6"], $_GET["i7"]);
	}
	else if(isset($_GET["no"]) && $_GET["no"] == "9") {   
		SendConnectionRequestToAdmin($_GET["requestFrom"], $_GET["requestForEmail"], $_GET["requestForId"], $_GET["requestText"]);
	}
	else if(isset($_GET["no"]) && $_GET["no"] == "10") {   
		UpdateUserAssociation($_GET["email"], $_GET["id"], $_GET["userAssoc"]);
	}
	else {
		echo "Nothing to be returned by the AJAX call. No Parameter does not match any value.";
	}

	//this is the function to update user Association with MR
	function UpdateUserAssociation($email, $id, $userAssoc) {
		global $connection;
		$res = "";
		try {
			$query = "update Users set UserAssociation='$userAssoc' where UserEmail='$email' and UserID='$id'";
			$rs = mysql_query($query);
			if(!$rs) {
				$res = "-1";
			}
			else {
				$res = "1";
			}
			echo $res;
		}
		catch(Exception $e) {
			$res = "-1";
			echo $res;
		}
	}

	//this is the function to send the connection request by mail TO ADMIN
	function SendConnectionRequestToAdmin($requestFrom, $requestForEmail, $requestForId, $requestText) {
		$res = "";
		$mailbody = "";
		$requestFromName = GetUserName($requestFrom);
		$requestForName = GetUserName($requestForEmail);
		if($requestFromName == "-1" || $requestForName == "-1") {
			$res = "-1";
			echo $res;
			return;
		}

		// for getting the interests of the requested person.
		$requestedInt = "<div class='list-group'><br />";
		$interests = getInterests($requestForEmail, $requestForId);
		$in = explode(" @I ", $interests);
		foreach ($in as $i) {
			if($i == "-" || $i == " " || $i == "") {

			}
			else {
				//$interests .= $i . ", ";
				$requestedInt .= "<div class='list-group-item'>" . $i . "</div>";
			}
		}
		$requestedInt .= "</div>";  

		try {

			$mailbody .= "<h1>MR - Connect Request</h1><br />";
			$mailbody .= "Dear Admin, <br /> MR - Connect Request from <b>" . $requestFromName . "(" . $requestFrom . ")</b> has been received. <br /><br />";
			$mailbody .= "This request has been made FOR <b>" . $requestForName .  "(" . $requestForEmail . ")</b>. Following are the Areas of Expertise of the Requested Person: ";
			$mailbody .= $requestedInt;
			$mailbody .= "<br /><br/>Here is the Request Text associated with this request: <b>" . $requestText . "</b>";

			$mailbody .= "<br /><br />Please take the necessary actions as required. Thank You.<br />Sent from the Tech Team Server.";

			$Header = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$Header .= 'From: MR - Connect test mail <sagar.anand@live.in>' . "\r\n";
			$to = "guide@mentored-research.com";
			$message = $mailbody;
			$subject = "MR - Connect Connection Request Received";
			if(mail($to,$subject,$message,$Header) == true) {
				if(SendConfirmationOfRequest($requestFrom, $requestFromName, $requestForEmail, $requestForName) == "1") {
					$res = "1";
				}
				else {
					$res = "-1";
				}
			}
			else {
				$res = "-1";
			}
			echo $res;
		}
		catch(Exception $e) {
			$res = "-1";
			echo $res;
		}
	}

	//this is the function to get the list of searched contacts by interests.
	function GetSearchByExpertise($i1, $i2, $i5, $i6, $i7) {
		global $connection;
		$res = "";
		try {
			$res = SearchByExpertise($i1, $i2, $i5, $i6, $i7);
			echo $res;
		}
		catch(Exception $e) {
			$res = "-1";
			echo $res;
		}
	}

	//this is the function to get the list of all the searched contacts.
	function GetSearchList($search) {
		global $connection;
		$res = "";
		try {
			$res = SearchList($search);
			echo $res;
		}
		catch(Exception $e) {
			$res = "-1";
			echo $res;
		}
	}

	//this is the function to return the id of the user based on the email address to javascript. (for varied functions.)
	function SetCookieID($email) {
		$res = "";
		try {
			$res = getUserID($email);
			echo $res;
		}
		catch(Exception $e) {
			$res = "-1";
			echo $res;
		}
	}

	//this is the function to check if the user exists in the database or not.
	//Returns -1 if the user does not exists!
	function UserExists($email, $id) {
		$res = "";
		try {
			if(checkIfUserExists($email) == "-1") {
				$res = "-1";
			}
			else if(checkIfUserExists($email) == "1") {
				$res = "1";
			}
			else {
				$res = "-2";
			}
			echo $res;
		}
		catch(Exception $e) {
			$res = "-2";
			echo $res;
		}
	}

	//this is the function to get all the list of the users from the database.
	function GetAllUsers() {
		global $connection;
		$res = "";
		try {
			$res = GetAllUsersList();
			echo $res;
		}
		catch(Exception $e) {
			$res = "-1";
			echo $res;
		}
	}

	//this is the function to save/update the Interest of the users in the Interests table.
	function SaveUpdateInterests($id, $email, $i1, $i2, $i3, $i4, $i5, $i6, $i7) {
		global $connection;
		$res = "";
		$date = date("Y-m-d H:i:s");		
		try {
			if(getInterests($email, $id) == "" || getInterests($email, $id) == "-3") {
				// insert here. User record does not exists in the database.
				if(InsertInterests($id, $email, $i1, $i2, $i3, $i4, $i5, $i6, $i7, $date) == "1") {
					$res = "1";
				}
				else {
					$res = "-1";
				}
			}
			else {
				// update here. User record exists in the database.
				if(UpdateInterests($id, $email, $i1, $i2, $i3, $i4, $i5, $i6, $i7, $date) == "1") {
					$res = "1";
				}
				else {
					$res = "-1";
				}
			}
			echo $res;
		}
		catch(Exception $e) {
			$res = "-1";
			echo $res;
		}
	}


	//this is the function to load the data from the database and show it to the Front end.
	function LoadData($email, $id) {
		$res = "";
		$res2 = "";
		$id = "";
		$per = ""; 
		$edu = ""; 
		$exp = ""; 
		$intr = "";
		try {

			//assign the id here first.
			$id = getUserID($email);
			if($id == "-1") {
				$res = "-3";
				echo $res;
				return;
			}

			if(checkIfUserExists($email) == "-1") {
				$res = "-2";  //user does not exists. Add the user here.
			}
			else {
				$per = getPersonalData($email, $id);
				$edu = getEducationData($email, $id);
				$exp = getExperienceData($email, $id);
				$intr = getInterests($email, $id);

				if($per == "" || $per == "-1") {
					$res2 = "-4";
					$res .= "-4" . " @bk ";
					// echo $res;
					// return;
				}
				else {
					$res .= $per . " @bk ";
				}

				if($edu == "" || $edu == "-1") {
					$res2 = "-4";
					$res .= "-4" . " @bk ";
					// echo $res;
					// return;
				}
				else {
					$res .= $edu . " @bk ";
				}

				if($exp == "" || $exp == "-1") {
					$res2 = "-4";
					$res .= "-4" . " @bk ";
					// echo $res;
					// return;
				}
				else {
					$res .= $exp . " @bk ";
				}

				if($intr == "" || $intr == "-1") {
					$res2 = "-4";
					$res .= "-4" . " @bk ";
					// echo $res;
					// return;
				}
				else if($intr == "-3") {
					$res .= "-5" . " @bk ";    // -5 is for when the data row does not exists.
				}
				else {
					$res .= $intr . " @bk ";
				}
			}
			echo $res . " ~ " . $res2;
		}
		catch(Exception $e) {
			$res = "-1";
			echo $res;
		}
	}

	// function SaveUser($basic, $edu, $exp, $phoneNo, $pic) {

	// 	$res2 = "Initial thing!!";
	// 	$email = "";
	// 	$expJson = json_decode($exp, true);

	// 	$email = $basic["emailAddress"];

	// 	$userID = getUserID($email);
	// 	if($userID == "-1") {
	// 		$res2 = "-2";
	// 		echo $res;
	// 		return;
	// 	}

	// 	$date = date("Y-m-d H:i:s");

	// 	//now, save the Experience listings to the database.
	// 	if(is_array($expJson)) {
	// 		foreach ($expJson as $expItem) {
	// 			if(!isset($expItem["company"]["name"])) {
	// 				$expItem["company"]["name"] = "";
	// 			}
	// 			if(!isset($expItem["startDate"]["year"])) {
	// 				$expItem["startDate"]["year"] = "";
	// 			}
	// 			if(!isset($expItem["endDate"]["year"])) {
	// 				$expItem["endDate"]["year"] = "";
	// 			}
	// 			if(!isset($expItem["title"])) {
	// 				$expItem["title"] = "";
	// 			}
	// 			if(!isset($expItem["summary"])) {
	// 				$expItem["summary"] = "";
	// 			}
	// 			if(!isset($expItem["isCurrent"]) && $expItem["isCurrent"] == true) {
	// 				$expItem["endDate"]["year"] = "current";	
	// 			}
	// 			$expDate = $expItem["startDate"]["year"] . "-" . $expItem["endDate"]["year"];

	// 			if(saveExperience($userID, $expItem["company"]["name"], $expDate, $expItem["title"], $expItem["summary"], $date) == "1") {
	// 				$res2 = "1Experience Saved.";
	// 				// echo $res;
	// 				// return;
	// 			}
	// 			else {
	// 				$res2 = "-1Experience NOT Saved.";
	// 				// echo $res;
	// 				// return;
	// 			}
	// 		}
	// 	}
	// 	else {    //$expJson is not an array.
	// 		$res2 = "This is the else part.";

	// 	}
	// 	echo $res2;
	// }


	// //this is the function to save the data to the database from the Linkedin Data
	function SaveUser($basic, $edu, $exp, $phoneNo, $pic) {

		$res2 = "";

		$contactJson = json_decode($phoneNo, true);
		$eduJson = json_decode($edu, true);
		$expJson = json_decode($exp, true);
		$picJson = json_decode($pic, true);
		$res = "";

		$res2 = "";

		$email = $basic["emailAddress"];
		$name = $basic["firstName"] . " " . $basic["lastName"];
		$contact = $contactJson["phoneNumber"];

		$date = date("Y-m-d H:i:s");
		$userID = "";

		global $connection;
		try {
			if(checkIfUserExists($email) == "-1") {
				//go ahead and insert the user with all the data here.
				if(savePersonalDetails($email, $name, $picJson, $contact, $basic["publicProfileUrl"], $basic["location"]["name"], $basic["primaryTwitterAccount"]["providerAccountName"], "", "", $date) == "1") {
					$res = "1";   //for saving into the database correctly!

					$userID = getUserID($email);
					if($userID == "-1") {
						$res = "-2";
						echo $res;
						return;
					}

					//now,save all the education details here.
					foreach ($eduJson as $eduItem) {
						if(!isset($eduItem["degree"])) {
							$eduItem["degree"] = "";
						}
						if(!isset($eduItem["startDate"]["year"])) {
							$eduItem["startDate"]["year"] = "";
						}
						if(!isset($eduItem["endDate"]["year"])) {
							$eduItem["endDate"]["year"] = "";
						}
						if(!isset($eduItem["fieldOfStudy"])) {
							$eduItem["fieldOfStudy"] = "";
						}
						if(!isset($eduItem["schoolName"])) {
							$eduItem["schoolName"] = "";
						}
						$eduDate = $eduItem["startDate"]["year"] . "-" . $eduItem["endDate"]["year"];

						if(saveEducation($userID, $eduItem["schoolName"], $eduDate, $eduItem["degree"], $eduItem["fieldOfStudy"], $date) == "1") {
							$res = "1";
						}
						else {
							$res = "-1";
						}
					}   //end of foreach loop for education.

					//now, save the Experience listings to the database.
					foreach ($expJson as $expItem) {
						if(!isset($expItem["company"]["name"])) {
							$expItem["company"]["name"] = "";
						}
						if(!isset($expItem["startDate"]["year"])) {
							$expItem["startDate"]["year"] = "";
						}
						if(!isset($expItem["endDate"]["year"])) {
							$expItem["endDate"]["year"] = "";
						}
						if(!isset($expItem["title"])) {
							$expItem["title"] = "";
						}
						if(!isset($expItem["summary"])) {
							$expItem["summary"] = "";
						}
						if(!isset($expItem["isCurrent"]) && $expItem["isCurrent"] == true) {
							$expItem["endDate"]["year"] = "current";	
						}
						$expDate = $expItem["startDate"]["year"] . "-" . $expItem["endDate"]["year"];

						if(saveExperience($userID, $expItem["company"]["name"], $expDate, $expItem["title"], $expItem["summary"], $date) == "1") {
							$res2 = "1";
							// echo $res;
							// return;
						}
						else {
							$res2 = "-1";
							// echo $res;
							// return;
						}
					}   //end of foreach loop for experience.
				}
				else {
					$res = "-1";    //not saved into the database
				}
			}
			else if(checkIfUserExists($email) == "1") {
				$res = "2";
			}
			else {
				//Error in checking if the user already exists or not.
				$res = "Error in checking if the user already exists or not.";
			}
		}
		catch(Exception $e) {
			$res = "-1";
		}
		echo $res . ", " . $email . ", " . $userID;
	}

?>