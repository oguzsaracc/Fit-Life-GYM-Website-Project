<?php
require_once 'db.php';

// check if this page requested by admin
session_start();

// reject if user is not admin
if ($_SESSION['userType'] != 'admin') {
  die('no');
}

// get class id(safe)
$class_id = mysqli_real_escape_string($db, $_GET["id"]);

$result = $db->query("SELECT * FROM class WHERE id = '$class_id'");

// if there is no results, send not found error 
if ($result->num_rows < 1) {
  http_response_code(404);
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
    <!-- Class Information Section -->
    <div class="jumbotron bg-light">
      <div id="classInfo">
        <div class="container-fluid padding center-block">
     
        <!-- Pre-filled Form by class data -->
          <form action="edit_class.php?id=<?php echo $class_id ?>" method="POST" style="padding: 12px 75px">

            <div class="form-group">
              <label for="name">Name:</label><br>
              <input type="text" id="name" name="name" value="<?php echo $class['name'] ?>" required />
            </div>

            <div class="form-group">
              <label for="summary">Summary:</label><br>
              <textarea class="form-control" id="summary" rows="5" name="summary" required /><?php echo $class['summary'] ?></textarea>
            </div>

            <div class="form-group">
              <label for="day">Day:</label><br>
              <input type="text" id="day" name="day" pattern="(Mo(n(day)?)?|Tu(e(sday)?)?|We(d(nesday)?)?|Th(u(rsday)?)?|Fr(i(day)?)?|Sa(t(urday)?)?|Su(n(day)?)?)" value="<?php echo $class['day'] ?>" required />
            </div>

            <button class="btn btn-sm btn-success" type="submit">Update</button>
          </form>
          <br>

          <!-- Image Update Form -->
          <form action="edit_class_image.php?id=<?php echo $class_id ?>" method="POST" style="padding: 12px 75px" enctype="multipart/form-data">

            <div class="form-group">
              <div class="custom-file">
                <label for="image">Select Image:</label><br>
                <input type="file" id="image" name="image" required>
              </div>
            </div>

            <button class="btn btn-sm btn-success" type="submit">Update Image</button>
          </form>
        </div>

      </div>
    </div>
    <!-- End Class Information Section -->

    <!-- Footer -->
    <?php include("footer.html") ?>
</body>

</html>