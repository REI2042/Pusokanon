<?php require_once 'include/header.php';?>
<link rel="stylesheet" href="css/stylesLogin.css">
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
                                    <a href="forgotPass.php" class="link"><small>Forgot Password</small></a>
                                </div>
                                <div class="text-center d-grid col-8 mx-auto mt-2">
                                    <button type="submit" class="btn btn-success">Login</button>
                                </div>
                                <div class="text-center mt-3">
                                    <small class="smallText">Don't have an account?</small><a href="registration.php" class="link-warning"> Sign Up</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>