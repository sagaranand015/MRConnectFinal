<?php 

	//this is the file that contains all the functions used in AJAX.
	if($_GET["no"] == "1") {
		SaveUser();
	}
	else {
		echo "Nothing to be returned by the AJAX call";
	}

	function SaveUser() {
		$basic = $_GET["basic"];
		$edu = $_GET["education"];

		$eduJson = json_decode($edu, true);

		$res = "";
		foreach($eduJson as $eduItem) {
			$res .= $eduItem['schoolName'] .= ", ";
		}

		echo $res;
	}
	
?>