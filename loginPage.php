<?php
	include 'navbar.php';
	include("database/databaseConnect.php");
    
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['userPassword'];

        $log_request = mysqli_query($connect_db, "SELECT * from accounts_user where user_email ='$username' and user_password = '$password'");
        $log_result = mysqli_fetch_assoc($log_request);



        if ($log_result) {
            $type_user = $log_result["type_user"];

            if ($type_user == "Resident") {
                header("Location: residentsLandingPage.php");
                exit();

            } elseif ($type_user == "admin") {
                header("Location: adminPusokanon.php");
                exit();

            } else {
                echo "<script>alert('no user!');</script>";
            }

        } else {
            echo "<script>alert('Invalid username or password!');</script>";
        }
        
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login To Pusokanon</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/stylesLogin.css">
    <link href="https://fonts.googleapis.com/css?family=Titan+One" rel="stylesheet">
</head>
<body>
	<div class="content-wrapper">
		<main>
            <section class="holder-section mt-4">
                <div class="container mt-4">
                    <div class="card">
                        <div class="card-header bg-#48BF91 text-white">
                            <h4 class="text-center mt-2" id="loginText">Login</h4>
                            <hr>
                        </div>
                        <div class="card-body mt-3">
                            <form method="POST">
                                <div class="mb-3">
                                    <label for="text" class="form-label">Email</label>
                                    <input type="text" class="form-control" name="username" id="email" placeholder="Enter your email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="userPassword" id="password" placeholder="Enter your password" required>
                                </div>
                                <div class="text-center mt-4">
                                    <a href="#" class="link"><small>Forgot Password</small></a>
                                </div>
                                <div class="text-center d-grid col-8 mx-auto mt-2">
                                    <button type="submit" class="btn btn-success">Login</button>
                                </div>
                                <div class="text-center mt-3">
                                    <small class="smallText">Don't have an account?</small><a href="registerPage.php" class="link-warning"> Sign Up</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </main>    
    </div>

</body>
</html>