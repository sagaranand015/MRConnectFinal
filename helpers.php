<?php 
	//ob_start();

	//this is the file for all the helper functions needed in this project.

	//these are for the PHP Helper files
	include 'headers/databaseConn.php';

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