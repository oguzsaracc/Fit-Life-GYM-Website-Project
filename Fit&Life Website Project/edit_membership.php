<?php
require_once 'db.php';

// get data(safe)
$membership_id = mysqli_real_escape_string($db, $_POST["id"]);
$name = mysqli_real_escape_string($db, $_POST["name"]);
$sub_type = mysqli_real_escape_string($db, $_POST["sub_type"]);
$price = mysqli_real_escape_string($db, $_POST["price"]);

// update feature fields
$result = $db->query("UPDATE membership_type SET name = '$name', sub_type = '$sub_type', price = '$price' WHERE id = '$membership_id'");

// return error to client if error exists
if (!$result) {
  $error = mysqli_error($db);
  http_response_code(500);
  print_r($error);
  die();
}

echo 'ok';
