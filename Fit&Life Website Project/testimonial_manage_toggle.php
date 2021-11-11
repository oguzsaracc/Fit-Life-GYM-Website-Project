<?php
require_once 'db.php';

// get data(safe)
$testimonial_id = mysqli_real_escape_string($db, $_POST["id"]);
$is_visible = mysqli_real_escape_string($db, $_POST["isVisible"]);

// update testimonial fields
$result = $db->query("UPDATE testimonial SET is_visible = $is_visible WHERE id = $testimonial_id");

// return error to client if error exists
if (!$result) {
  $error = mysqli_error($db);
  http_response_code(500);
  print_r($error);
  die();
}

echo 'ok';
