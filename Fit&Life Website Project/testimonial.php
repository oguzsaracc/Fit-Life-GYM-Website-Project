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

		<!-- Testimonials Section -->
		<div id="testimonial">
			<div class="jumbotron">
				<br><br>

				<h3 class="heading">Testimonials<br>
				<!-- Show Edit/Add testimonial button depends on user type -->
					<?php
					if ($_SESSION['userType'] == 'admin') {
						echo '<a class="btn btn-secondary btn-sm" href="testimonial_manage.php">Edit Testimonials</a>';
					} else if ($_SESSION['userType'] == 'member') {
						echo '<a class="btn btn-secondary btn-sm" href="testimonial_add.php">Add Testimonial</a>';
					}
					?></h3>
				<div class="row padding">

				<!-- Print testimonials(also join some data from user and membership tables) -->
					<?php
					$result = $db->query("SELECT name, membership, testimonial FROM testimonial LEFT JOIN 
					(SELECT membership_type.name as membership, user.name, username FROM user LEFT JOIN membership_type on user.membership_type_id = membership_type.id)
					 u ON testimonial.username = u.username WHERE is_visible = 1");
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							echo "<div class='col-md-3'>
									<div class='card text-center'>
										<div class='card-body'>
											<h4>{$row['name']}</h4><hr>
											<h5>{$row['membership']}</h5><hr>
											<p>{$row['testimonial']}</p>
										</div>
									</div>
								</div>";
						}
					}
					?>
				</div>
			</div>
		</div>
		<!-- End Testimonials Section -->

		<!-- Footer -->
		<?php include("footer.html") ?>

</body>

</html>