<?php session_start();
include "connect.php";



$did=$_SESSION['DISTRICT_ID'];
$sql8=mysqli_query($con,"select count(school_id) as total from school_info where district_id='$did'");
$sql9=mysqli_fetch_assoc($sql8);
$sql2=mysqli_query($con,"select count(block_id) as total from blocks where district_id='$did'");
$sql3=mysqli_fetch_assoc($sql2);
$sql4=mysqli_query($con,"select count(teacher_id) as total from teacher_info where school_id=ANY(select school_id from school_info where district_id='$did')");
$sql5=mysqli_fetch_assoc($sql4);
$sql6=mysqli_query($con,"select count(student_id) as total from student where school_id=ANY(select school_id from school_info where district_id='$did')");
$sql7=mysqli_fetch_assoc($sql6);

$sql10=mysqli_query($con,"select count(student_id) as total from student where school_id=ANY(select school_id from school_info where district_id='$did') group by school_id"); 
foreach($sql10 as $data)
{
   
   $x[]=$data['total'];
}
$sql11=mysqli_query($con,"select school_name from school_info where district_id='$did'");
foreach($sql11 as $data1)
{
   $y[] = $data1['school_name'];
}
$sql12=mysqli_query($con,"select count(student_id) as total from exam_totals where  eid='AEE' and status='p' and school_id=ANY(select school_id from school_info where district_id='$did') group by school_id"); 
$i=0;
foreach($sql12 as $data2)
{
   
   $m[]=($data2['total']/$x[$i])*100;
   $i=$i+1;
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>State-Official-Dashboard</title>
		
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
		
			<?php include 'district-menu.php';	?><!-- Page Wrapper -->
            <div class="page-wrapper">
			
                <div class="content container-fluid">
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Welcome Ritesh-Sir!</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item active">DEO</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
											
					<script>
			function redirect() {
				let year = document.getElementById('year').value;
				document.location = "student-dashboard-test.php?year="+year;

			}
		</script>

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
                                        <h3> <?php echo $sql9['total'] ?>
                                                
                                                </h3> 
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
                                                <h3><?php echo $sql7['total'] ?></h3>
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
                                                <h3><?php echo $sql5['total'] ?></h3>
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
                                                <h3><?php echo $sql3['total'] ?></h3>
                                                <h6>Total Blocks</h6>
                                            </div>										
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					<!-- /Overview Section -->				

                    <div class="row">
								<div class="col-12 col-lg-12 col-xl-8 d-flex">
									<div class="card flex-fill">
										<div class="card-header">
											<div class="row align-items-center">
												<div class="col-6">
													<h5 class="card-title">School Wise no.of Students</h5>
												</div>
												<!-- <div class="col-6">
													<ul class="list-inline-group text-end mb-0 ps-0">
														<li class="list-inline-item">
															  <div class="form-group mb-0 amount-spent-select">
																<select class="form-control form-control-sm form-select">
																  <option>Weekly</option>
																  <option>Monthly</option>
																  <option>Yearly</option>
																</select>
															</div>
														</li>
													</ul>                                        
												</div> -->
											</div>						
										</div>
										<div class="card-body">
                                        <canvas id="acscore"></canvas>
                                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                            <script>
												// m = JSON.parse(localStorage.m);
												const ctx = document.getElementById('acscore');
												const myChart = new Chart(ctx, {
													type: 'bar',
													data: {
														labels: <?php echo json_encode($y) ?>,
														//echo json_encode($y), 
														datasets: [{
															label: 'NO.OF STUDENTS',
															data:<?php echo json_encode($x)?>,
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
                                        <div class="card-body">
                                        <canvas id="pacore"></canvas>
                                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                            <script>
												// m = JSON.parse(localStorage.m);
												const ctx1 = document.getElementById('pacore');
												const myChart1 = new Chart(ctx1, {
													type: 'line',
													data: {
														labels: <?php echo json_encode($y) ?>,
														//echo json_encode($y), 
														datasets: [{
															label: 'NO.OF STUDENTS',
															data:<?php echo json_encode($m)?>,
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