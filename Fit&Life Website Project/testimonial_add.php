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

		<!-- Testimonial_add Section -->
		<div id="testimonial_add">
			<div class="jumbotron">

				<br><br>
				<h3 class="heading">Please send us your Feedback for testimonial</h3>
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<div class="modal-body">
								<form method="POST">
									<div class="form-group">
										<img class="form-img" src="img/testimonialadd1.png">
									</div>
									<div class="form-group">
										<label for="comment">Comment:</label>
										<textarea id="testimonial_comment" class="form-control" rows="5" name="testimonial_comment" pattern="[a-zA-Z0-9 ]{1,50}" placeholder="Your Comment..." required /></textarea>
									</div>

									<button class="btn btn-sm" type="submit">Send Feedback</button>
								</form>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
		<!-- End Testimonial_add Section -->

		<!-- Footer -->
		<?php include("footer.html") ?>
		<script>
			$('form').on('submit', function(e) {
				e.preventDefault();
				// get comment input
				const comment = $('#testimonial_comment').val();
				// post to api
				$.post('testimonial_add_script.php', {
						comment
					}).then((res) => {
						// show success message and reload page
						Swal.fire({
							icon: 'success',
							animation: false,
							text: 'Thanks for your comment!',
						}).then(() => location.href = '/');
					})
					.catch((err) => {
						// show error message
						Swal.fire({
							icon: 'error',
							animation: false,
							text: err.responseText,
						}).then(() => location.href = '/');
					});
			});
		</script>
</body>

</html>