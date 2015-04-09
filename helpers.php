<?php 
	//ob_start();

	//this is the file for all the helper functions needed in this project.

	//these are for the PHP Helper files
	include 'headers/databaseConn.php';

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
					$response .= "<div class='list-group-item item'><img src='" . $res["UserPic"] . "' class='userImage' width='170' height='170' /><div class='userItem'><p class='userName'>" . $res["UserName"] . "</p><p class='userLocation'> <span>Currently at: </span> <u>" . $res["UserLocation"] . "</u> <br /> <span>Expertise in: </span> <u>" . $interests . "</u> </p><p class='userReadMore'><a class='readMoreLink' data-id='" . $id . "' data-email='" . $email . "' href='#'>Read More...</a></p></div></div>";				
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
	function SearchByExpertise($i1, $i2, $i5, $i6) {
		global $connection;
		$response = "<div class='list-group-item'>";
		try {

			if($i1 == "")	
				$i1 = "~~";
			if($i2 == "")	
				$i2 = "~~";
			if($i5 == "")	
				$i5 = "~~";
			if($i6 == "")	
				$i6 = "~~";

			$query = "select * from Interests where Interest1 like '%$i1%' or Interest2 like '%$i2%' or Interest5 like '%$i5%' or Interest6 like '%$i6%'";
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
			$query = "select * from Users where UserName like '%$searchKey%'";
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
					$response .= "<div class='list-group-item item'><img src='" . $res["UserPic"] . "' class='userImage' width='170' height='170' /><div class='userItem'><p class='userName'>" . $res["UserName"] . "</p><p class='userLocation'> <span>Currently at: </span> <u>" . $res["UserLocation"] . "</u> <br /> <span>Expertise in: </span> <u>" . $interests . "</u> </p><p class='userReadMore'><a class='readMoreLink' data-id='" . $id . "' data-email='" . $email . "' href='#'>Read More...</a></p></div><button class='btn btn-lg btn-primary btn-block btnConnRequest' data-id='" . $id . "' data-email='" . $email . "'>Send a Connection Request</button></div>";
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

	//this is the function to get all the users in the list format for showing.
	function GetAllUsersList() {
		global $connection;
		$response = "<div class='list-group'>";
		$id = "";
		$email = "";
		$interests = "";
		try {
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
						if($i == "-" || $i == " " || $i == "") {

						}
						else {
							$interests .= $i . ", ";
						}
					}  
					$interests = substr($interests, 0, strlen($interests) - 2);
					$response .= "<div class='list-group-item item'><img src='" . $res["UserPic"] . "' class='userImage' width='170' height='170' /><div class='userItem'><p class='userName'>" . $res["UserName"] . "</p><p class='userLocation'> <span>Currently at: </span> <u>" . $res["UserLocation"] . "</u> <br /> <span>Expertise in: </span> <u>" . $interests . "</u> </p><p class='userReadMore'><a class='readMoreLink' data-id='" . $id . "' data-email='" . $email . "' href='#'>Read More...</a></p></div><button class='btn btn-lg btn-primary btn-block btnConnRequest' data-id='" . $id . "' data-email='" . $email . "'>Send a Connection Request</button></div>";
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
					$response = "";
				}
				else {
					while ($res = mysql_fetch_array($rs)) {
						$response .= $res["Interest1"] . " @I " . $res["Interest2"] . " @I " . $res["Interest3"] . " @I " . $res["Interest4"] . " @I " . $res["Interest5"] . " @I " . $res["Interest6"] . " @I " . $res["Interest7"];
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
					$response .= $res["UserEmail"] . " ,& " . $res["UserName"] . " ,& " . $res["UserPic"] . " ,& " . $res["UserContact"] . " ,& " . $res["UserProfile"] . " ,& " . $res["UserLocation"] . " ,& " . $res["UserTwitter"] . " ,& " . $res["UserLastAss"] . " ,& " . $res["UserType"];
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
		try {
			$query = "select * from Users where UserEmail='$email'";
			$rs = mysql_query($query);
			if(!$rs) {
				return "-1";
			}
			else {
				$res = mysql_fetch_array($rs);
				return $res["UserID"];
			}
		}
		catch(Exception $e) {
			return "-1";
		}
	}

	//this is the function to save all the personal details into the Users Table.
	function savePersonalDetails($email, $name, $pic, $contact, $profile, $location, $twitter, $lastAss, $type, $updatedOn) {
		global $connection;
		try {
			//$date = date("Y-m-d H:i:s");
			$query = "insert into Users(UserEmail, UserName, UserPic, UserContact, UserProfile, UserLocation, UserTwitter, UserLastAss, UserType, UpdatedOn) values('$email', '$name', '$pic', '$contact', '$profile', '$location', '$twitter', '$lastAss', '$type', '$updatedOn')";
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
?>