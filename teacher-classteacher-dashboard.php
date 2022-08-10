<?php
    
    include 'connect.php';

    session_start();

    $school_id = $_SESSION['SCHOOL_ID'];
    $teacher_id = $_SESSION['TEACHER_ID'];
	$class_id = $_SESSION['CLASS_ID'];

    $sql = mysqli_query($con,"select teacher_name from teacher_info where teacher_id='$teacher_id' and school_id='$school_id'");
    $run = mysqli_fetch_assoc($sql);

	$sql2 = mysqli_query($con,"select count(*) as total from student where school_id='$school_id' and class_id='$class_id'");
	$run2 = mysqli_fetch_assoc($sql2);

	$sql3 = mysqli_query($con,"select class, section from schoolwise_class_details where class_id='$class_id'");
	$run3 = mysqli_fetch_assoc($sql3);

	$sql4 = mysqli_query($con,"select count(*) as male from student where school_id='$school_id' and class_id='$class_id' and gender='M'");
	$run4 = mysqli_fetch_assoc($sql4);

	$sql5 = mysqli_query($con,"select count(*) as female from student where school_id='$school_id' and class_id='$class_id' and gender='F'");
	$run5 = mysqli_fetch_assoc($sql5);


?>






<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Teacher - Dashboard</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" href="assets/img/favicon.png">
	
		<!-- Fontfamily -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&display=swap">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

		<!-- Calendar CSS -->
		<link rel="stylesheet" href="assets/plugins/simple-calendar/simple-calendar.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<?php include 'teacher-header.php' ?>
            			
			<?php include 'teacher-sidebar.php' ?>
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
                <div class="content container-fluid">
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Welcome <?php echo $run['teacher_name']; ?></h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Teacher Dashboard</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

					<!-- Overview Section -->
					<div class="row">
						<div class="col-xl-3 col-sm-6 col-12 d-flex">
							<div class="card bg-five w-100">
								<div class="card-body">
									<div class="db-widgets d-flex justify-content-between align-items-center">
										<div class="db-icon">
											<i class="fas fa-chalkboard"></i>
										</div>
										<div class="db-info">
											<h3><?php echo $run2['total']; ?></h3>
											<h6>Total Students</h6>
										</div>										
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-3 col-sm-6 col-12 d-flex">
							<div class="card bg-six w-100">
								<div class="card-body">
									<div class="db-widgets d-flex justify-content-between align-items-center">
										<div class="db-icon">
											<i class="fas fa-user-graduate"></i>
										</div>
										<div class="db-info">
											<h3><?php echo $run4['male']; ?></h3>
											<h6>Total Boys</h6>
										</div>										
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-3 col-sm-6 col-12 d-flex">
							<div class="card bg-seven w-100">
								<div class="card-body">
									<div class="db-widgets d-flex justify-content-between align-items-center">
										<div class="db-icon">
											<i class="fas fa-book-open"></i>
										</div>
										<div class="db-info">
											<h3><?php echo $run5['female']; ?></h3>
											<h6>Total Girls</h6>
										</div>										
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-3 col-sm-6 col-12 d-flex">
							<div class="card bg-eight w-100">
								<div class="card-body">
									<div class="db-widgets d-flex justify-content-between align-items-center">
										<div class="db-icon">
											<i class="fas fa-clock"></i>
										</div>
										<div class="db-info">
											<h3><?php echo $run3['class'].'-'.$run3['section']; ?></h3>
											<h6>Class & Section</h6>
										</div>										
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Overview Section -->				

					<!-- Teacher Dashboard -->
					<div class="row">
						<div class="col-12 col-lg-12 col-xl-9">

							<div class="row">
								<div class="col-12 col-lg-4 col-xl-4 d-flex">
									<div class="card flex-fill">
										<div class="card-header">
											<div class="row align-items-center">
												<div class="col-12">
													<h5 class="card-title">Semester Progress</h5>
												</div>
											</div>						
										</div>
										<div class="dash-widget">
											<div class="circle-bar circle-bar1">
												<div class="circle-graph1" data-percent="50">
													<b>50%</b>
												</div>
											</div>
											<div class="dash-info">
												<h6>Lesson Progressed</h6>
												<h4>30 <span>/ 60</span></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
					    </div>
                    </div>
					<!-- /Teacher Dashboard -->
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
		
		<!-- Chart JS -->
		<script src="assets/plugins/apexchart/apexcharts.min.js"></script>
		<script src="assets/plugins/apexchart/chart-data.js"></script>

		<!-- Calendar Js -->
		<script src="assets/plugins/simple-calendar/jquery.simple-calendar.js"></script>
		<script src="assets/js/calander.js"></script>

		<!-- Circle Progress JS -->
		<script src="assets/js/circle-progress.min.js"></script>

		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
    </body>
</html>