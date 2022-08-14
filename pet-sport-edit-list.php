<?php
session_start();
include 'connect.php';
 if(empty($_SESSION['TEACHER_ID'])){
    header('location:index.php');

}
else
{
    $school_id=$_SESSION['SCHOOL_ID'];
    $stat="select * from sports";
    $run=mysqli_query($con,$stat);
}
?>
<DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Coach - Dashboard</title>

<link rel="shortcut icon" href="assets/img/favicon.png">

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&display=swap">

<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="assets/plugins/simple-calendar/simple-calendar.css">

<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php
include 'pet-menu.php';
?>

<div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Sports list</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Sports</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
				
					<div class="row">
						<div class="col-sm-12">
						
							<div class="card card-table">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-hover">
											<thead>
												<tr>
													<th>S. No.</th>
													<th>Sport ID</th>
													<th>Sport Name</th>
												</tr>
											</thead>
											<tbody>
                                                <?php
                                                    $i = 0;
                                                    while($data = mysqli_fetch_array($run))
                                                    {
                                                        echo '<tr>
                                                        <td>'.++$i.'</td>
                                                        <td>'.$data['sport_id'].'</td>
                                                        <td>'.$data['sport_name'].'</td>
                                                        <td><a href="pet-sport-edit.php?sport_id='.$data['sport_id'].'&sport_name='.$data['sport_name'].'">
                                                        <button class="btn btn-primary">
                                                            Edit 
                                                        </button>
                                                        </a></td>
                                                        </tr>';
                                                    }
                                                ?>
                                            </tbody>
										</table>
									</div>
								</div>
							</div>							
						</div>					
					</div>					
				</div>

				<!-- Footer -->
				<!-- <footer>
					<p>Copyright © 2020 Dreamguys.</p>					
				</footer> -->
				<!-- /Footer -->
				
			</div>
            </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="assets/js/jquery-3.6.0.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		
		<!-- Slimscroll JS -->
        <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

		<!-- Datatables JS -->
		<script src="assets/plugins/datatables/datatables.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
    </body>
</html>