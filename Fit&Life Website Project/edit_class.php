<?php
require_once 'db.php';

// get data(safe)
$class_id = mysqli_real_escape_string($db, $_GET["id"]);
$name = mysqli_real_escape_string($db, $_POST["name"]);
$summary = mysqli_real_escape_string($db, $_POST["summary"]);
$day = mysqli_real_escape_string($db, $_POST["day"]);

// update class fields
$result = $db->query("UPDATE class SET name = '$name', summary = '$summary', day = '$day' WHERE id = '$class_id'");

// return error to client if error exists
if (!$result) {
  $error = mysqli_error($db);
  http_response_code(500);
  print_r($error);
  die();
}

// redirect user to class page
header("Location: /class.php");

exit();
