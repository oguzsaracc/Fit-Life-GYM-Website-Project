<?php
require_once 'db.php';

// get data(safe)
$name = mysqli_real_escape_string($db, $_POST["name"]);
$sub_type = mysqli_real_escape_string($db, $_POST["sub_type"]);
$price = mysqli_real_escape_string($db, $_POST["price"]);

// insert membership_type to database
$result = $db->query("INSERT INTO membership_type (name, sub_type, price) values('$name', '$sub_type', '$price')");

// return error to client if error exists
if (!$result) {
  $error = mysqli_error($db);
  http_response_code(500);
  print_r($error);
  die();
}

echo 'ok';
