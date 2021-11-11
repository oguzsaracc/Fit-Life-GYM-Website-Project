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

		<!-- Contact with us Section -->
		<div id="contactWithUs">
			<div class="jumbotron">
				<br>
				<h3 class="heading">Contact us<br>
					<!-- Show contact us manage page link if user is admin -->
					<?php
					if ($_SESSION['userType'] == 'admin') {
						echo '<a class="btn btn-secondary btn-sm" href="contact_us_manage.php">See Messages</a>';
					}
					?></h3>
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<div class="modal-body">
								<!-- Contact us Form -->
								<form method="POST">
									<div class="form-group">
										<img class="form-img" src="img/contactus1.png">
									</div>

									<div class="form-group">
										<label for="name">Name:</label><br>
										<input type="text" id="guest_name" name="guest_name" pattern="[a-zA-Z]{2,}\s[a-zA-z]{1,}'?-?[a-zA-Z]{2,}\s?([a-zA-Z]{1,})?" placeholder="Name" required />
									</div>

									<div class="form-group">
										<label for="email">Email:</label><br>
										<input type="email" id="guest_email" name="guest_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="E-mail" required />
									</div>

									<div class="form-group">
										<label for="phone">Phone:</label><br>
										<input type="text" id="guest_phone" name="guest_phone" pattern="[0-9]{7,}" placeholder="Phone Number" required />
									</div>

									<div class="form-group">
										<label for="message">Message:</label>
										<textarea class="form-control" id="guest_message" rows="5" name="guest_message" pattern="[a-zA-Z0-9 ]{1,50}" id="message" placeholder="Comment/Question" required /></textarea>
									</div>

									<button class="btn btn-sm" type="submit">Send Message</button>
								</form>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
		<!-- End Contact with us Section -->

		<!-- Footer -->
		<?php include("footer.html") ?>
		<script>
      // post message to php api
			$('form').on('submit', function(e) {
				e.preventDefault();
				const message = $('#guest_message').val();
				const phone = $('#guest_phone').val();
				const email = $('#guest_email').val();
				const name = $('#guest_name').val();
				$.post('message_add.php', {
						message,
						phone,
						email,
						name
					}).then((res) => {
  					// Show success message then reload page
						Swal.fire({
							icon: 'success',
							animation: false,
							text: 'Your message has been sent!',
						}).then(() => location.href = '/');
					})
					.catch((err) => {
						// Display error if error exists, then reload page
						Swal.fire({
							icon: 'error',
							animation: false,
							text: err.responseText,
						}).then(() => location.reload());
					});
			});
		</script>
</body>

</html>