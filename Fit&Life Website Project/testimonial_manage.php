<?php
// init session data
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

    <div id="testimonial">
      <div class="jumbotron">
        <br><br>
        <h3 class="heading">Testimonials</h3>
        <div class="table-responsive">
          <table class="table table-sm">
            <thead class="thead-light">
              <tr>
                <th>User Name</th>
                <th>Membership Type</th>
                <th>testimonial</th>
                <th>Status</th>
                <th>Toggle Visibilty</th>
              </tr>
            </thead>
            <tbody>
              <!-- Print testimonial rows -->
              <?php
              $result = $db->query("SELECT testimonial.id as id, name, membership, testimonial, is_visible FROM testimonial LEFT JOIN 
              (SELECT membership_type.name as membership, user.name, username FROM user LEFT JOIN membership_type on user.membership_type_id = membership_type.id)
               u ON testimonial.username = u.username");
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo '<tr>';
                  echo '<td>' . $row["name"] . '</td>';
                  echo '<td>' . $row["membership"] . '</td>';
                  echo '<td>' . $row["testimonial"] . '</td>';
                  echo $row["is_visible"] == 1 ? '<td>Yes</td>' : '<td>No</td>';
                  echo '<td><a class="btn btn-secondary btn-sm" 
                  href="javascript:toggleVisibilty(' . $row["id"] . ',' . $row["is_visible"] . ')">Toggle</a></td>';
                  echo '</tr>';
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- End Testimonials Section -->

    <!-- Footer -->
    <?php include("footer.html") ?>
    <script>
      function toggleVisibilty(id, isVisible) {
        // toggle visibility data
        isVisible = !isVisible;
        // send visibility data to api
        $.post('testimonial_manage_toggle.php', {
            id,
            isVisible
          })
          .then((res) => {
            // reload page
            return location.href = '/testimonial_manage.php';
          })
          .catch((err) => {
            // display error if error exists then reload page
            Swal.fire({
              icon: 'error',
              animation: false,
              text: err.responseText,
            }).then(() => location.href = '/testimonial_manage.php');
          });
      }
    </script>
</body>

</html>