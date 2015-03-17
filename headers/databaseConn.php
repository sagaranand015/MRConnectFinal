<?php 

	//to make the database connection here!
	$connection=mysql_connect("localhost","root","9666836106");
	if(!$connection) {
	    die("Error Establishing connection");
	}
	$db = mysql_select_db("MRConnectFinal",$connection);
	if(!$db) {
	    die("Cannot select the database");
	}

?>