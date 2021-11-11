<?php
require_once 'db.php';

// get data(safe)
$title = mysqli_real_escape_string($db, $_POST["title"]);
$body = mysqli_real_escape_string($db, $_POST["body"]);

// insert feature to database
$result = $db->query("INSERT INTO feature (title, body) values('$title', '$body')");

// return error to client if error exists
if (!$result) {
  $error = mysqli_error($db);
  http_response_code(500);
  print_r($error);
  die();
}

echo 'ok';
