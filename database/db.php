<?php
	//Create Server Variables
	$user = "samson";
	$pass = "password";
	$dbname = "unity";
	$host = "localhost";

	//Establish a connection to the database
	$mysqli = new mysqli($host, $user, $pass, $dbname);

	//Check if connection was established successfully
	if ($mysqli->connect_error) {
		die("Connection could not be established <br>".$mysqli->connect_error);
	}
