<?php
// Database parameters
$user = 's2990074';
$password = '31/10/1997';
$db = 's2990074';
$host = 'localhost';

// Open connection
$db = new MySQLi($host, $user, $password, $db);

// Return error if error exists
if ($db->connect_error) {
  die("Database Connection failed: " . $db->connect_error);
}
