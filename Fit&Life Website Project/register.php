<?php
require_once 'db.php';

// get data(safe)
$username = mysqli_real_escape_string($db, $_POST["username"]);
$name = mysqli_real_escape_string($db, $_POST["name"]);
$email = mysqli_real_escape_string($db, $_POST["email"]);
$gender = mysqli_real_escape_string($db, $_POST["gender"]);
$membership_type_id = mysqli_real_escape_string($db, $_POST["membership_type_id"]);
$password_hash =  password_hash($_POST["password"], PASSWORD_BCRYPT);
$birth_date = mysqli_real_escape_string($db, $_POST["birth_date"]);

// insert user
$result = $db->query("INSERT INTO user 
(username, password_hash, user_type, name, email, gender, membership_type_id, birth_date) 
values('$username', '$password_hash', 'member', '$name', '$email', '$gender', 
'$membership_type_id', CAST('$birth_date' AS DATE))");
// return error to client if error exists
if (!$result) {
  $error = mysqli_error($db);
  if (preg_match("/duplicate/i", $error)) {
    http_response_code(409);
    die();
  }

  http_response_code(500);
  die($error);
}

// session will be alive for a week
session_set_cookie_params(3600 * 24 * 7);

// start session
session_start();

//init session data
$_SESSION['username'] = $username;
$_SESSION['userType'] = 'member';

echo 'ok';