<?php
require_once 'db.php';

// get feature id
$feature_id = mysqli_real_escape_string($db, $_GET["id"]);

// delete feature from database
$result = $db->query("DELETE FROM feature WHERE id = '$feature_id'");

// return error to client if error exists
if (!$result) {
  $error = mysqli_error($db);
  http_response_code(500);
  print_r($error);
  die();
}

echo 'ok';
