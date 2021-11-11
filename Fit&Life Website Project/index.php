<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Fit&amp;Life</title>
	<link href="https://fonts.googleapis.com/css?family=Bebas+Neue|Montserrat:500|Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
</head>

<body data-spy="scroll" data-target="#menu">

	<!-- Home Section -->
	<div id="home">

		<!-- Header -->
		<?php include("header.php") ?>

		<!-- Landing Page Section -->
		<div class="landing">
			<div class="home-wrap">
				<div class="home-inner">
				</div>
			</div>
		</div>

		<!-- Landing Page Caption Section -->
		<div class="caption center-block text-center">
			<h3>Do something today that your future self will thank you for.</h3>
			<a class="btn btn-outline-light" href="#about">Get Started</a>
		</div>

	</div>
	<!-- End Home Section -->

	<!-- About Section -->
	<div id="about">
		<div class="jumbotron">
			<h3 class="heading">About the Fit&amp;Life</h3>
			<div class="row">

				<div class="col-md-4 text-center">
					<img src="img/logo1.png">
					<h4>Worrying About Body Fat?</h4>
					<p>Fat seems to always top the list of things that are "bad" for you. But for good overall health and to lower risk of heart disease, cancer, or even obesity, scrupulously counting how much fat you consume is not a helpful strategy. We are here to help you to do right decision.</p>
				</div>

				<div class="col-md-4 text-center">
					<img src="img/logo2.png">
					<h4>Do you like Zumba?</h4>
					<p>Zumba is a fitness program that combines Latin and international music with dance moves. Zumba routines incorporate interval training — alternating fast and slow rhythms — to help improve cardiovascular fitness. We always recommend to take a free class before you join us!</p>
				</div>

				<div class="col-md-4 text-center">
					<img src="img/logo3.png">
					<h4>Pilates</h4>
					<p>Pilates is a form of exercise emphasizing the balanced development of the body through core strength, flexibility, and awareness to support efficient, graceful movement. It was developed by Joseph Pilates and is also known as the Pilates Method.</p>
				</div>

				<div class="col-md-4 text-center">
					<img src="img/logo4.png">
					<h4>Spinning classes</h4>
					<p> is a form of exercise with classes focusing on endurance, strength, intervals, high intensity (race days) and recovery, and involves using a special stationary exercise bicycle with a weighted flywheel in a classroom setting.</p>
				</div>

				<div class="col-md-4 text-center">
					<img src="img/logo5.png">
					<h4>Yoga</h4>
					<p>Yoga, an ancient practice and meditation, has become increasingly popular in today's busy society. For many people, yoga provides a retreat from their chaotic and busy lives. We believe that, Yoga will decrease your stress level from first class.</p>
				</div>

				<div class="col-md-4 text-center">
					<img src="img/logo6.png">
					<h4>Try our Body Weight Training</h4>
					<p>body weight training is enjoying a surge in popularity these days, it’s the oldest form of exercise. Most people have been fully equipped to do body weight training since the dawn of mankind, but those silly kettlebells and rowing machines didn’t come along until much later.</p>
				</div>

			</div>
		</div>
	</div>
	<!-- End About Section -->

	<!-- Images Section -->
	<div id="gymInfo">
		<div class="container-fluid padding">
			<h3 class="heading">Fit&amp;Life Photos</h3>
			<div class="row no-padding">

				<div class="col-md-6">
					<img class="gymInfo" src="img/gymPhoto1.png">
				</div>

				<div class="col-md-6">
					<img class="gymInfo" src="img/gymPhoto2.png">
				</div>

				<div class="col-md-6">
					<img class="gymInfo" src="img/gymPhoto3.png">
				</div>

				<div class="col-md-6">
					<img class="gymInfo" src="img/gymPhoto4.png">
				</div>

			</div>
		</div>
	</div>
	<!-- End Images Section -->

	<!-- Features Section -->
	<div id="features">
		<div class="jumbotron">
			<h3 class="heading">Features<br>
				<!-- Show edit features button if user is admin -->
				<?php
				if ($_SESSION['userType'] == 'admin') {
					echo '<a class="btn btn-secondary btn-sm" href="index_edit.php">Edit Features</a>';
				}
				?></h3>
			<div class="row padding">
				<!-- Print Features -->
				<?php
				$result = $db->query("SELECT * FROM feature");
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						echo "<div class='col-md-6' style='margin-bottom:16px;'>
									<div class='card text-center'>
										<div class='card-body'>
											<h4>{$row['title']}</h4><hr>
											<p>{$row['body']}</p>
										</div>
									</div>
								</div>";
					}
				}
				?>
			</div>
		</div>
	</div>
	<!-- End Features Section -->

	<!-- Footer -->
	<?php include("footer.html") ?>

</body>

</html>