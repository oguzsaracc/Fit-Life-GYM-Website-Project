<?php
require_once 'db.php';

// init session data
session_start();

// get data(safe)
$comment = mysqli_real_escape_string($db, $_POST["comment"]);
$username = $_SESSION['username'];

// insert testimonial to database
$result = $db->query("INSERT INTO testimonial (username, testimonial) values ('$username', '$comment')");

// return error if error exists
if (!$result) {
  $error = mysqli_error($db);
  http_response_code(500);
  print_r($error);
  die();
}

echo 'ok';
