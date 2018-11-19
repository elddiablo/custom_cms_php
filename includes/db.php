<?php 	
	// TO BRING THE SECURITY TO THE CONNECTION OF THE DATABASE
	$db['db_host'] = "localhost";
	$db['db_user'] = "root";
	$db['db_password'] = "root";
	$db['db_name'] = "cms";

	foreach ($db as $key => $value) {
			
		define(strtoupper($key), $value); // making all above a constant;

	}

	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if(!$con){
		echo "Error: ";
	} else {
		// echo "Connected to the database...";
	}

 ?>