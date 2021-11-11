<?php
require_once "db.php";

// init session data
session_start();

// Print Edit or Register button depends on user type
if ($_SESSION['userType'] == 'admin') {
  echo '<div class="jumbotron" style="margin-bottom:0;padding-bottom:0;">
  <div class="center-block text-center">
    <a class="btn btn-outline-dark" href="registration_edit.php">Edit Membership Types</a>
  </div>
</div>';
} else if ($_SESSION['userType'] != 'member') {
  echo '<div class="jumbotron" style="margin-bottom:0;padding-bottom:0;">
  <div class="caption2 center-block text-center">
    <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#registerModal">
    Register Now
  </button>
  </div>
</div>';
}

// get membership types
$result = $db->query("SELECT * FROM membership_type");
// return error to client if error exists
if (!$result) {
  $error = mysqli_error($db);
  http_response_code(500);
  die($error);
}

// Group memberships by name
$rows = array();
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    if (!$rows[$row['name']]) {
      $rows[$row['name']] = array();
    }
    $rows[$row['name']][$row['sub_type']] = $row;
    $rows[$row['name']]['detail'] = $row['detail'];
    unset($rows[$row['name']][$row['sub_type']]['name']);
  }
}

// print membership type tables
foreach ($rows as $membership_type => $sub_types) {
  echo '<div class="jumbotron">';
  echo "<h3>$membership_type</h3>";
  echo '<p>' . $sub_types["detail"] . '</p>';
  echo '<h5 class="underlinePrice">' . $membership_type . ' Price</h5>';
  echo '<div class="table-responsive-sm">';
  echo '<table class="table table-light">';
  echo '<thead><tr><th></th><th>Direct Debit</th></tr></thead><tbody>';
  
  // print membership sub type rows
  foreach ($sub_types as $sub_type => $sub_type_data) {
    if ($sub_type != 'detail') {
      echo '<tr><th scope="row">' . $sub_type_data['sub_type'] . '</th>
          <td>&euro;' .  $sub_type_data['price'] . '</td></tr>';
    }
  }
  // finish table
  echo '</tbody></table></div>';
  echo "<a href='contact_us.php'>Contact us for more information on $membership_type</a>";
  echo '</div>';
}
