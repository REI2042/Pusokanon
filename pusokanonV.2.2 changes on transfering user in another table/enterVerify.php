<?php
	require_once 'include/header.php';
?>
	<link rel="stylesheet" href="css/enterVerify.css">
	<div class="content-wrapper mx-3">
		<div class="container">
			<div class="text-header row px-0">
				<a class="text-light" href="forgotpass.php">
				<div class="icon col-sm-1">
					<i class="fa-solid fa-chevron-left"></i>
				</div>
				</a>
				<div class="text-h1 col">
					<h3 class="header-text text-light">Forgot Password</h3>
				</div>
			</div>
			<hr>
			<div class="form-container">
				<form class="forgot-pass" method="POST" autocomplete="off">
					<div class="row mb-3">
						<span class="text-center p-3 mt-3 mb-5">Enter the 4 digits code that <br>you received on your email.</span>
						<div class="col">
							<div class="form-holder row">
								<div class="col-auto px-1">
									<input type="text" class="form-control" name="digit1" id="digit1" name="useremail" required>
								</div>
								<div class="col-auto px-1">
									<input type="text" class="form-control" name="digit2" id="digit2" name="useremail"  required>
								</div>
								<div class="col-auto px-1">
									<input type="text" class="form-control" name="digit2" id="digit3" name="useremail"  required>
								</div>
								<div class="col-auto px-1">
									<input type="text" class="form-control" name="digit2" id="digit4" name="useremail"  required>
								</div>
							</div>
						</div><div class="w-100"></div>
						<div class="text-link col text-center mt-3"><a href="#" class="text-warning">Send Verification Again</a></div>
						<div class="w-100"></div>
						<div class="col text-center">
							<button type="submit" class="btn text-light bg-success" id="submit">Proceed</button>
						</div>
                    </div>
				</form>
			</div>
		</div>
		
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>