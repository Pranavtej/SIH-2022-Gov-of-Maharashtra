<?php
include 'connect.php';
$query    = "select count(school_id) as sc from school_info";
$run      = mysqli_query($con, $query);
$school_count = mysqli_fetch_assoc($run);

$query1    = "select count(student_id) as stc  from student";
$run1      = mysqli_query($con, $query1);
$student_count = mysqli_fetch_assoc($run1);

$query2    = "select count(teacher_id) as tc from teacher_info";
$run2      = mysqli_query($con, $query2);
$teach_count = mysqli_fetch_assoc($run2);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>SuperAdmin-Dashboard</title>
		
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
        <div class="main-wrapper">
		
			<?php include 'super-admin-menu.php';	?><!-- Page Wrapper -->
            <div class="page-wrapper">
			
                <div class="content container-fluid">
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Welcome Block-official!</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item active">Dashboard</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

					<!-- Overview Section -->
					<div class="row">
						<div class="col-xl-3 col-sm-6 col-12 d-flex">
							<div class="card bg-one w-100">
							  
								<div class="card-body"><a href="super-admin-school-list.php">
									<div class="db-widgets d-flex justify-content-between align-items-center">
										<div class="db-icon">
											<i class="fas fa-user-graduate"></i>
										</div>
										<div class="db-info">
											<h3><?php echo $school_count['sc'];?></h3>
											<h6>Total Schools</h6>
										</div>										
									</div>
								</div></a>
							</div>
						</div>

						<div class="col-xl-3 col-sm-6 col-12 d-flex">
							<div class="card bg-two w-100">
							 
								<div class="card-body"><a href="super-admin-students-list.php">
									<div class="db-widgets d-flex justify-content-between align-items-center">
										<div class="db-icon">
											<i class="fas fa-crown"></i>
										</div>
										<div class="db-info">
											<h3><?php echo $student_count['stc'];?></h3>
											<h6>Total Students</h6>
										</div>										
									</div>
								</div>
							</div></a>
						</div>

						<div class="col-xl-3 col-sm-6 col-12 d-flex">
							<div class="card bg-three w-100">
							   
								<div class="card-body"><a href="super-admin-teachers-list.php">
									
									<div class="db-widgets d-flex justify-content-between align-items-center">
										<div class="db-icon">
											<i class="fas fa-building"></i>
										</div>
										<div class="db-info">
											<h3><?php echo $teach_count['tc'];?></h3>
											<h6>Total Teachers</h6>
										</div>										
									</div>
								</div></a>
							</div>
						</div>

						<div class="col-xl-3 col-sm-6 col-12 d-flex">
							<div class="card bg-four w-100">
								<div class="card-body">
									<div class="db-widgets d-flex justify-content-between align-items-center">
										<div class="db-icon">
											<i class="fas fa-file-invoice-dollar"></i>
										</div>
										<div class="db-info">
											<h3>1</h3>
											<h6></h6>
										</div>										
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Overview Section -->				

					<div class="row">
						<div class="col-md-12 col-lg-6">
						
							<!-- Revenue Chart -->
							<div class="card card-chart">
								<div class="card-header">
									<div class="row align-items-center">
										<div class="col-6">
											<h5 class="card-title">Revenue</h5>
										</div>
										<div class="col-6">
											<ul class="list-inline-group text-end mb-0 pl-0">
												<li class="list-inline-item">
													  <div class="form-group mb-0 amount-spent-select">
														<select class="form-control form-control-sm form-select">
														  <option>Today</option>
														  <option>Last Week</option>
														  <option>Last Month</option>
														</select>
													</div>
												</li>
											</ul>                                        
										</div>
									</div>						
								</div>
								<div class="card-body">
									<div id="apexcharts-area"></div>
								</div>
							</div>
							<!-- /Revenue Chart -->
							
						</div>
						
						<div class="col-md-12 col-lg-6">
						
							<!-- Student Chart -->
							<div class="card card-chart">
								<div class="card-header">
									<div class="row align-items-center">
										<div class="col-6">
											<h5 class="card-title">Number of Students</h5>
										</div>
										<div class="col-6">
											<ul class="list-inline-group text-end mb-0 pl-0">
												<li class="list-inline-item">
													  <div class="form-group mb-0 amount-spent-select">
														<select class="form-control form-control-sm form-select">
														  <option>Today</option>
														  <option>Last Week</option>
														  <option>Last Month</option>
														</select>
													</div>
												</li>
											</ul>                                        
										</div>
									</div>									
								</div>
								<div class="card-body">
									<div id="bar"></div>
								</div>
							</div>
							<!-- /Student Chart -->							
						</div>	
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

		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
    </body>
</html>