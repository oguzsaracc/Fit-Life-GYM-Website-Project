<?php
require_once 'db.php';

// check if this page requested by logged user
session_start();

// reject if guest
if ($_SESSION['userType'] != 'admin' && $_SESSION['userType'] != 'member') {
  die('no');
}

// get class id(safe)
$class_id = mysqli_real_escape_string($db, $_GET["id"]);
$result = $db->query("SELECT * FROM class WHERE id = '$class_id'");

// if there is no results, send not found error
if ($result->num_rows < 1) {
  die('Class Not Found');
}

// fetch class data with current pointer
$class = $result->fetch_assoc();
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

    <div class="landing">
      <div class="home-wrap">
        <div class="home-inner" style="background-image: url('./<?php echo $class['photo_url'] ?>')">
        </div>
      </div>
    </div>
    <div class="caption3 center-block text-center">
      <!-- Fill all class data -->
      <h3><?php echo $class['name'] ?></h3>
    </div>
    <!-- Class Information Section -->
    <div id="contactWithUs">
      <div class="jumbotron bg-light">
        <div id="classInfo">
          <div class="container-fluid padding center-block">
            <h3 class="heading">About <?php echo $class['name'] ?> Class
              <?php
              if ($_SESSION['userType'] == 'admin') {
                echo '<br><a class="btn btn-secondary btn-sm" href="class_detail_edit.php?id=' . $class_id . '">Edit This Class</a>';
              }
              ?></h3>

            <div class="row no-gutters position-relative text-center center-block">
              <div class="position-static p-4 pl-md-0">
                <blockquote class="blockquote">
                  <?php echo $class['summary'] ?>
                </blockquote>
                <br>
                <p>Class Day: <?php echo $class['day'] ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Class Information Section -->

    <!-- Footer -->
    <?php include("footer.html") ?>

</body>

</html>
