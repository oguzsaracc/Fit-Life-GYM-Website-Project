<?php
require_once 'db.php';

// get membership id
$membership_id = mysqli_real_escape_string($db, $_GET["id"]);

// delete membership_type from database
$result = $db->query("DELETE FROM membership_type WHERE id = '$membership_id'");

// return error to client if error exists
if (!$result) {
  $error = mysqli_error($db);
  http_response_code(500);
  print_r($error);
  die();
}

echo 'ok';
