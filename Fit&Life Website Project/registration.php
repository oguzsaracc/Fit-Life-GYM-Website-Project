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

		<div class="padding jumbotron">
			<div id="membership">
			<?php include("register_table.php") ?>
			</div>
		</div>
		<!-- Bronze Membership Section -->


		<!-- Footer -->
		<?php include("footer.html") ?>



		<div class="modal fade" id="registerModal" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Register</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<!-- Register Form -->
						<form method="POST">
							<div class="form-group">
								<label for="r_username">UserName:</label><br>
								<input type="text" id="r_username" class="swal2-input" name="r_username" minlength="4" required />
							</div>

							<div class="form-group">
								<label for="r_password">Password:</label><br>
								<input type="password" id="r_password" class="swal2-input" name="r_password" minlength="4" required />
							</div>

							<div class="form-group">
								<label for="r_email">Email:</label><br>
								<input type="email" class="swal2-input" id="r_email" name="r_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required />
							</div>

							<div class="form-group">
								<label for="r_name">Full Name:</label><br>
								<input type="text" class="swal2-input" id="r_name" name="r_name" pattern="[a-zA-Z]{2,}\s[a-zA-z]{1,}'?-?[a-zA-Z]{2,}\s?([a-zA-Z]{1,})?" required />
							</div>

							<div class="form-group">
								<label for="r_birth">Birth Date:</label>
								<input type="date" class="swal2-input" id="r_birth" name="r_birth" required />
							</div>
							<div class="form-group">
								<label for="r_gender">Gender:</label>
								<select class="form-control" id="r_gender" name="r_gender">
									<option value="Female">Female</option>
									<option value="Male">Male</option>
									<option value="Other">Other</option>
								</select>
							</div>

							<div class="form-group">
								<label for="r_membership">Membership:</label>
								<select class="form-control" id="r_membership" name="r_membership">
									<!-- List memberhip types -->
									<?php
									require_once "db.php";

									$result = $db->query("SELECT * FROM membership_type");
									if (!$result) {
										$error = mysqli_error($db);
										http_response_code(500);
										die($error);
									}

									// Group memberships by name
									$rows = array();
									if ($result->num_rows > 0) {
										while ($row = $result->fetch_assoc()) {
											echo '<option value="' . $row['id'] . '">' . $row['name'] . ' - ' . $row['sub_type'] . ' (&euro;' . $row['price'] . ')</option>';
										}
									}
									?>
								</select>
							</div>
							<div class="form-group modal-footer">
								<button class="btn btn-primary" type="submit">Register</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<script>
			$('form').on('submit', function(e) {
				e.preventDefault();
				
				// get input data
				const data = {
					username: document.getElementById('r_username').value,
					password: document.getElementById('r_password').value,
					email: document.getElementById('r_email').value,
					name: document.getElementById('r_name').value,
					birth_date: document.getElementById('r_birth').value,
					gender: $("#r_gender option:selected").val(),
					membership_type_id: $("#r_membership option:selected").val(),
				};

				// post user data to php api
				return $.post('register.php', data)
					.then((res) => {
						// show success message then reload page
						Swal.fire({
							icon: 'success',
							animation: false,
							allowOutsideClick: false,
							text: 'Logged In Successfully',
						}).then(() => location.reload());
					})
					.catch((err) => {
            // display error if error exists
						Swal.fire({
							icon: 'error',
							animation: false,
							text: err.responseText,
						});
					});
			});
		</script>
</body>

</html>