<?php
// Database configuration
$dbHost     = "localhost";
$dbUsername = "samson";
$dbPassword = "password";
$dbName     = "codexworld";

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
