<?php
    include 'include/header.php';
    include 'db/DBconn.php';
?>
<link rel="stylesheet" type="text/css" href="css/EditProfile.css">
<section class="main">
	<form class="form row" action="#" method="POST" enctype="multipart/form-data">
		<div class="col">
			<label for="firstname" class="form-label">First Name</label>
			<input type="text" name="fname" class="form-control" id="firstname" placeholder="<?= htmlspecialchars($_SESSION['res_fname']); ?>" value="<?= htmlspecialchars($_SESSION['res_fname']); ?>" required>
		</div>
		<div class="col ">
			<label for="lastname" class="form-label">Last Name</label>
			<input type="text" name="lname" class="form-control" id="lastname" placeholder="<?= htmlspecialchars($_SESSION['res_lname']); ?>" value="<?= htmlspecialchars($_SESSION['res_lname']); ?>" required>
		</div>
		<div class="col">
            <label for="midname" class="form-label">Middle Name</label>
            <input type="text" name="midname" class="form-control" id="midname" placeholder="<?= htmlspecialchars($_SESSION['res_midname']); ?>" value="<?= htmlspecialchars($_SESSION['res_midname']); ?>">
        </div>
	</form>
</section>
<?php include'include/footer.php'?>