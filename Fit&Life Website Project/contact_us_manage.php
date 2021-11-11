<?php
// check if this page requested by admin
session_start();
// reject if user is not admin
if ($_SESSION['userType'] != 'admin') {
  die('no');
}
?>
<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fit&amp;Life</title>
  <link href="https://fonts.googleapis.com/css?family=Bebas+Neue|Montserrat:500|Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
</head>

<!-- Header -->
<?php include("header.php") ?>

<body data-spy="scroll" data-target="#menu">

  <!-- Home Section -->
  <div id="home">

    <div id="contacts">
      <div class="jumbotron">
        <br><br>
        <h3 class="heading">Messages</h3>
        <div class="table-responsive">
          <table class="table table-sm">
            <thead class="thead-light">
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
              </tr>
            </thead>
            <tbody>
              <!-- Print all messages as rows -->
              <?php
              $result = $db->query("SELECT * FROM message");
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo '<tr>';
                  echo '<td>' . $row["id"] . '</td>';
                  echo '<td>' . $row["name"] . '</td>';
                  echo '<td>' . $row["email"] . '</td>';
                  echo '<td>' . $row["phone"] . '</td>';
                  echo '<td>' . $row["message"] . '</td>';
                  echo '</tr>';
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <?php include("footer.html") ?>
</body>

</html>