<?php
require_once 'db.php';

// get class id
$class_id = mysqli_real_escape_string($db, $_GET["id"]);

// get class by id
$result = $db->query("SELECT * FROM class WHERE id = '$class_id'");
if ($result->num_rows < 1) {
  die('Class Not Found');
}
$class = $result->fetch_assoc();

// file's target folder
$target_dir = "img/";

// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["image"]["tmp_name"]);
if ($check == false) {
  die("File is not an image.");
}

// detect image extention
$imageFileType = explode('/', $check["mime"] )[1];

// file's name with a unique id
$target_file = $target_dir . uniqid() . '.' . $imageFileType;

// write file
if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
  echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";

  // update image url field on database
  $result = $db->query("UPDATE class SET photo_url = '/$target_file' WHERE id = '$class_id'");

  // delete file and return error to client if error exists
  if (!$result) {
    unlink($target_file);
    $error = mysqli_error($db);
    http_response_code(500);
    print_r($error);
    die();
  }
} else {
  echo "Sorry, there was an error uploading your file.";
}

// redirect user to class page
header("Location: /class.php");

exit();