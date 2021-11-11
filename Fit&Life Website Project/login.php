<?php 
require_once 'db.php';

// get data(safe)
$username = mysqli_real_escape_string($db, $_POST["username"]);
$password = $_POST["password"];

// get user from db
$result = $db->query("SELECT username, password_hash, user_type FROM user WHERE username = '$username';");

// return 404 if user not exits
if ($result->num_rows < 1) {
  http_response_code(404);
  die('User not found!');
}

$user = $result->fetch_assoc();

// return error if user password is wrong
if (!password_verify($password, $user['password_hash'])) {
  http_response_code(401);
  die();
}

// don't send password hash to user!
unset($user['password_hash']);

// session will be alive for a week
session_set_cookie_params(3600 * 24 * 7);

// start session
session_start();

// init session data
$_SESSION['username'] = $username;
$_SESSION['userType'] = $user['user_type'];

echo 'ok';