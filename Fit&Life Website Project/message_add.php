<?php
require_once 'db.php';

// init session data
session_start();

// get data(safe)
$message = mysqli_real_escape_string($db, $_POST["message"]);
$phone = mysqli_real_escape_string($db, $_POST["phone"]);
$email = mysqli_real_escape_string($db, $_POST["email"]);
$name = mysqli_real_escape_string($db, $_POST["name"]);

// insert message
$result = $db->query("INSERT INTO message (message, phone, email, name) values ('$message', '$phone', '$email', '$name')");

// return error to client if error exists
if (!$result) {
  $error = mysqli_error($db);
  http_response_code(500);
  print_r($error);
  die();
}

echo 'ok';
