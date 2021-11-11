<?php
require_once 'db.php';

// get class id(safe)
$result = $db->query("SELECT * FROM class");

// if there is no results, send not found error
if ($result->num_rows < 1) {
	die('Classes Not Found');
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
		<!-- Class Information Section -->

		<div id="contactWithUs">
			<div class="jumbotron">

				<br><br>
				<h2 class="heading">Classes</h2>
				<!-- print class row for every class returned from query above -->
				<?php
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						echo '<div id="classInfo">
						<div class="container-fluid padding">';
						echo '<h3 class="heading">' . $row['name'] . '</h3>';
						echo '<div class="row no-gutters position-relative">
				<div class="col-md-6 mb-md-0 p-md-4">';
						echo '<img src="./' . $row['photo_url'] . '" class="img-fluid img-thumbnail rounded mx-auto d-block"></div>';
						echo '<div class="col-md-6 position-static p-4 pl-md-0">
				<h5 class="mt-0">Summary</h5>' . $row['summary'];
						// if user logged in, print class detail page link
						echo ($_SESSION['userType'] == 'admin' || $_SESSION['userType'] == 'member')
							? '<br><a href="class_detail.php?id=' . $row['id'] . '" class="stretched-link">More information...</a>'
							: '<br><a href="javascript:login()" class="stretched-link">More information...</a>';
						echo '</div></div></div></div>';
					}
				}
				?>
				<!-- End Class Information Section -->
			</div>
		</div>
		<!-- Footer -->
		<?php include("footer.html") ?>
</body>

</html>
