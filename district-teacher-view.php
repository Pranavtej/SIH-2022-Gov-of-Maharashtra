<?php

include 'connect.php';

session_start();

$teacher_id = $_GET['teacher_id'];

$sql = "SELECT s.school_id as school_id,s.school_name as school_name, t.teacher_id as teacher_id, t.teacher_name as teacher_name, 
t.teacher_dob as teacher_dob, t.teacher_email as teacher_email, t.teacher_mob as teacher_mob
FROM teacher_info t,school_info s WHERE teacher_id='$teacher_id' and s.school_id = t.school_id";
$run = mysqli_fetch_array(mysqli_query($con, $sql));
$sid=$run['school_id'];
$sql1=" SELECT DISTINCT(s.subject_name) from schoolwise_class_subject_teachers sw,subjects s 
where sw.teacher_id='$teacher_id' and sw.school_id='$sid' and sw.subject_id=s.subject_id ";
$run1 = mysqli_query($con, $sql1);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Teacher Details</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" href="assets/img/favicon.png">
	
		<!-- Fontfamily -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&display=swap">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

		<!-- Datatables CSS -->
		<link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<?php include 'district-menu.php'; ?>
        
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Teacher Details</h3>
								<ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="super-admin-dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item"><a href="super-admin-teachers-list.php">Teacher</a></li>
									<li class="breadcrumb-item active">Teacher Details</li>
								</ul>
							</div>
						</div>
					</div>
					
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="about-info">
										<h4>About Teacher</h4>
										
										<div class="media mt-3 d-flex">
											<img src="assets/img/user.jpg" class="me-3 flex-shrink-0" alt="...">
											<div class="media-body flex-grow-1">
												<ul>
                                                    <li>
                                                        <span class="title-span">Teacher Name :</span>
                                                        <span class="info-span"><?php echo $run['teacher_name']; ?></span>
                                                    </li>
                                                    <li>
                                                        <span class="title-span">School Name :</span>
                                                        <span class="info-span"><?php echo $run['school_name']; ?></span>
                                                    </li>
                                                    <li>
                                                        <span class="title-span">Email :</span>
                                                        <span class="info-span"><?php echo $run['teacher_email']; ?></span>
                                                    </li>
                                                    <li>
                                                        <span class="title-span">DOB :</span>
                                                        <span class="info-span"><?php echo $run['teacher_dob']; ?></span>
                                                    </li>
                                                    <li>
                                                        <span class="title-span">Mobile Number :</span>
                                                        <span class="info-span"><?php echo $run['teacher_mob']; ?></span>
                                                    </li>
                                                    <li>
                                                        <span class="title-span">SUBJECTS :</span>
                                                        <?php
                                                             echo'<ul>';
                                                             while($data = mysqli_fetch_array($run1)){
                                                                 echo'<li><span class="info-span">'.$data['subject_name'].'</span></li>';
                                                                }
                                                             echo'</ul>';                                                         ?>
                                                    </li>
                                                </ul>
											</div>
										</div>

										<div class="row mt-3">                                           
										</div>
										
									
										
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
			<!-- /Page Wrapper -->
		
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="assets/js/jquery-3.6.0.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		
		<!-- Slimscroll JS -->
        <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		
		<!-- Custom JS -->
		<script  src="assets/js/script.js"></script>
		
    </body>
</html>