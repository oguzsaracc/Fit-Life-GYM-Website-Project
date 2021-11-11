<?php
require_once 'db.php';

// get data(safe)
$feature_id = mysqli_real_escape_string($db, $_POST["id"]);
$title = mysqli_real_escape_string($db, $_POST["title"]);
$body = mysqli_real_escape_string($db, $_POST["body"]);

// update feature fields
$result = $db->query("UPDATE feature SET title = '$title', body = '$body' WHERE id = '$feature_id'");

// return error to client if error exists
if (!$result) {
  $error = mysqli_error($db);
  http_response_code(500);
  print_r($error);
  die();
}

echo 'ok';
