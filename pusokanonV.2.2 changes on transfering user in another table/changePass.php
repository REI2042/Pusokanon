<?php
	require_once 'include/header.php';
?>
<link rel="stylesheet" href="css/changepass.css">
	<div class="content-wrapper mx-3">
		<div class="container">
			<div class="text-header row px-0">
				<a class="text-light" href="login.php">
				<div class="icon col-sm-1">
					<i class="fa-solid fa-chevron-left"></i>
				</div>
				</a>
				<div class="text-h1 col">
					<h3 class="header-text text-light">Change Password</h3>
				</div>
			</div>
			<hr>
			<div class="form-container">
				<form class="forgot-pass" method="POST" autocomplete="off">
					<div class="row mb-3">
						<div class="col">
							<label for="text" class="form-label">New Password:</label>
                        	<input type="text" class="form-control" name="username" name="useremail" placeholder="Enter your email" required>
						</div><div class="w-100"></div>
						<div class="col mt-3">
							<label for="text" class="form-label">Confirm Password:</label>
                        	<input type="text" class="form-control" name="username" name="useremail" placeholder="Enter your email" required>
						</div>
						<div class="w-100"></div>
						<div class="col text-center">
							<button type="submit" class="btn text-light bg-success" id="submit">Change Password</button>
						</div>
                    </div>
				</form>
			</div>
		</div>
		
	</div>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>