<?php session_start(); 

include 'connect.php';

if(isset($_POST['login']))
{
    if(true)
    {
        $_SESSION['DISTRICT_ID'] = $_POST['username'];
        echo "<script>document.location='district-dashboard.php'</script>";
    }
    else
    {
        echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Invalid login credentials. Please retry or contact your administrator.
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';
    }

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>District Official Login</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" href="assets/img/favicon.png">
	
		<!-- Fontfamily -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&display=swap">

		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
	
		<!-- Main Wrapper -->
        <div class="main-wrapper login-body">
            <div class="login-wrapper">
            	<div class="container">
                	<div class="loginbox">
                    	<div class="login-left">
							<img class="img-fluid" src="assets/img/logo-white.png" alt="Logo">
                        </div>
                        <div class="login-right">
							<div class="login-right-wrap">
								<h1>District Official Login</h1>
								<p class="account-subtitle">Access to our dashboard</p>
								
								<!-- Form -->
								<form method="post">
									<div class="form-group">
										<input class="form-control"  id="username" name="username"type="text" placeholder="username">
									</div>
									<div class="form-group">
										<input class="form-control" id="password" name="password" type="password" placeholder="Password">
									</div>
									<div class="form-group">
										<button class="btn btn-primary btn-block" name="login" type="submit">Login</button>
									</div>
								</form>
								<div class="text-center forgotpass"><a href="index.php">Go back </a></div>

							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="assets/js/jquery-3.6.0.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
    </body>
</html>