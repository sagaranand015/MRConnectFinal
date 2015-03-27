<?php
	ob_start();
	//these are for the PHP Helper files
	include('headers/databaseConn.php');
	include('helpers.php');

	//this is the file that contains all the functions used in AJAX.
	if($_GET["no"] == "1") {
		//this is to save the details of the user coming first time to the MR Connect Portal
		SaveUser();
	}
	if($_GET["no"] == "2") {
		//this is the function to load the data from the database and show it to the Front end.
		LoadData($_GET["email"], $_GET["id"]);
	}
	else {
		echo "Nothing to be returned by the AJAX call. No Parameter does not match any value.";
	}


	//this is the function to load the data from the database and show it to the Front end.
	function LoadData($email, $id) {
		try {
			echo $email . " --> " . $id;
		}
		catch(Exception $e) {

		}
	}

	//this is the function to save the data to the database from the Linkedin Data
	function SaveUser() {
		$basic = $_GET["basic"];
		$edu = $_GET["education"];
		$exp = $_GET["experience"];
		$phoneNo = $_GET["contact"];
		$pic = $_GET["picture"];

		$contactJson = json_decode($phoneNo, true);
		$eduJson = json_decode($edu, true);
		$expJson = json_decode($exp, true);
		$picJson = json_decode($pic, true);
		$res = "";

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
							$res = "1";
						}
						else {
							$res = "-1";
						}
					}   //end of foreach loop for experience.
				}
				else {
					$res = "-1";    //not saved into the database
				}
			}
			else if(checkIfUserExists($email) == "1") {
				//User Email Already exist. this should not be reached.
				$res = "//User Email Already exist. this should not be reached. Or else, this should be for loading the data from the database and then showing it into the Profile page.";
				//here, return something to show that the record already exists. After that, load data from the datanase!!
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