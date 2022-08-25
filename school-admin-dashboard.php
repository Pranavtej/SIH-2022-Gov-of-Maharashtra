<?php session_start();
include "connect.php";
if(empty($_SESSION['SCHOOL_ID'])){
	echo '<script>document.location="school-login.php"</script>';
}else{
	$school_id=$_SESSION['SCHOOL_ID'];
	$sql="select * from school_info where school_id='$school_id'";
	$run = mysqli_query($con,$sql)or die(''.__LINE__.'<br>'.mysqli_error($con));
	$run = mysqli_fetch_assoc($run);
	if(!empty($run))
    {
	$district_id=$run['district_id'];
	$state_id=$run['state_id'];
	$school_name=$run['school_name'];
	$school_address=$run['school_address'];
	$s="select count(*)  as total from student where school_id='$school_id'";
	$res=mysqli_query($con,$s);
	$res= mysqli_fetch_assoc($res);
	$te="select count(*)  as total from teacher_info where school_id='$school_id'";
	$t=mysqli_query($con,$te);
	$t= mysqli_fetch_assoc($t);
	$cl="select count(*)  as total from schoolwise_class_details  where school_id='$school_id'";
	$c=mysqli_query($con,$cl);
	$c= mysqli_fetch_assoc($c);
	$m="select concat(c.class,c.section) as cls from classes as c,schoolwise_class_details as sc where sc.school_id='$school_id' and sc.class_id=c.class_id";
    $result=mysqli_query($con,$m) or die(mysqli_error);
	foreach($result as $data){
		$r[]=$data['cls'];
	}
   $pass="select count(*) as pass from exam_totals where school_id='$school_id' and eid='AEE' and total>245";
   $pas=mysqli_query($con,$pass);
   $pas=mysqli_fetch_assoc($pas);

   
	$query="SELECT count(*) FROM student where school_id='$school_id' group by class_id";
    $result=mysqli_query($con,$query) or die(mysqli_error);
	foreach($result as $data){
		$r1[]=$data['count(*)'];
	}

	}
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>School-Admin-Dashboard</title>
		
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
	     <?php include 'school-admin-header.php';?>
		<?php include 'school-admin-sidebar.php';?>
			<!-- Page Wrapper -->
             <div class="page-wrapper">
			
                <div class="content container-fluid">
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Welcome <?php echo $school_name; ?></h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item active">School Dashboard</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

					<!-- Overview Section -->
					<div class="row">
						<div class="col-xl-3 col-sm-6 col-12 d-flex">
							<div class="card bg-one w-100">
								<a href="school-admin-student-list.php">
								<div class="card-body">
									<div class="db-widgets d-flex justify-content-between align-items-center">
										<div class="db-icon">
											<i class="fas fa-user-graduate"></i>
										</div>
										<div class="db-info">
											<h3> <?php echo $res['total']
												?>
											</h3>
											<h6>Students</h6>
										</div>										
									</div></a>
								</div>
							</div>
						</div>

						<div class="col-xl-3 col-sm-6 col-12 d-flex">
							<div class="card bg-two w-100">
							<a href="school-admin-teacher-list.php">
								<div class="card-body">
									<div class="db-widgets d-flex justify-content-between align-items-center">
										<div class="db-icon">
											<i class="fas fa-crown"></i>
										</div>
										<div class="db-info">
											<h3><?php echo $t['total']
												?></h3>
											<h6>Teachers</h6>
										</div>										
									</div></a>
								</div>
							</div>
				</div>

						<div class="col-xl-3 col-sm-6 col-12 d-flex">
							<div class="card bg-three w-100">
							<a href="school-admin-section-list.php">
								<div class="card-body">
									<div class="db-widgets d-flex justify-content-between align-items-center">
										<div class="db-icon">
											<i class="fas fa-building"></i>
										</div>
										<div class="db-info">
											<h3>6-10</h3>
											<h6>Classes</h6>
										</div>										
									</div></a>
								</div>
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
											<h3><?php echo round(($pas['pass']/$res['total'])*100); echo "%";?></h3>
											<h6>Pass Percentage</h6>
										</div>										
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Overview Section -->				
			
							<!-- Student Chart -->
					  <div class="card">
						 <div class="card-body">
							 <div class="row">
							  <div class="col-md-12">
							  <div class="card-body">
								<canvas id="acscore"></canvas>
									<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
									<script>
										const ctx = document.getElementById('acscore');
										const myChart = new Chart(ctx, {
											type: 'bar',
											data: {
												labels: <?php echo json_encode($r) ?>,
												//echo json_encode($y), 
												datasets: [{
													label: 'No.of Students',
													data:<?php echo json_encode($r1) ?>,
												//echo json_encode($x),

													backgroundColor: [
														'rgba(255, 99, 132, 0.2)',
														'rgba(54, 162, 235, 0.2)',
														'rgba(255, 206, 86, 0.2)',
														'rgba(75, 192, 192, 0.2)',
														'rgba(153, 102, 255, 0.2)',
														'rgba(255, 159, 64, 0.2)'
													],
													borderColor: [
														'rgba(255, 99, 132, 1)',
														'rgba(54, 162, 235, 1)',
														'rgba(255, 206, 86, 1)',
														'rgba(75, 192, 192, 1)',
														'rgba(153, 102, 255, 1)',
														'rgba(255, 159, 64, 1)'
													],
													borderWidth: 1
												}]
											},
											options: {
												//maintainAspectRatio: true,
												scales: {
													y: {
														beginAtZero: true
													}
												}
											}
										});
									</script>
								 </div>
								</div>
								</div>
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