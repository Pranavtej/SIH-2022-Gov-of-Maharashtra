<?php

include 'connect2.php';

session_start();

$student_id = $_GET['sid'];
$school_id  = $_SESSION['SCHOOL_ID'];

$sql = "select * from test2.student where student_id='$student_id' and school_id='$school_id'";
$run = mysqli_fetch_array(mysqli_query($con, $sql));

$marks = array(1,1,1);
$sql2 = "select total from test3.exam_totals where student_id='$student_id' order by year asc";
$run2 = mysqli_query($con,$sql2);
$i = 0;
while($res2 = mysqli_fetch_assoc($run2))
{
    echo $res2['total'];
    $marks[$i] = $res2['total'];
	$lable[$i]=[" "];
    $i++;																	
}
$a=0
$mark= array(1,1,1); 
while($a<$i)
{
 $mark[$a]=$marks[$i-$a];
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Preskool - Student Details</title>
		
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
		
			<?php include 'teacher-teacher-header.php';
            include 'teacher-teacher-sidebar.php'; ?>
        
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Student Details</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="">Student</a></li>
									<li class="breadcrumb-item active">Student Details</li>
								</ul>
							</div>
						</div>
					</div>
					
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="about-info">
										<h4>About Me</h4>
										
										<div class="media mt-3 d-flex">
											<img src="assets/img/user.jpg" class="me-3 flex-shrink-0" alt="...">
											<div class="media-body flex-grow-1">
												<ul>
                                                    <li>
                                                        <span class="title-span">Full Name : </span>
                                                        <span class="info-span"><?php echo $run['student_name']; ?></span>
                                                    </li>
                                                    <li>
                                                        <span class="title-span">Email : </span>
                                                        <span class="info-span"><?php echo $run['email']; ?></span>
                                                    </li>
                                                    <li>
                                                        <span class="title-span">6th Total : </span>
                                                        <span class="info-span"><?php echo $marks[0]; ?></span>
                                                    </li>
                                                    <li>
                                                        <span class="title-span">7th Total : </span>
                                                        <span class="info-span"><?php echo $marks[1]; ?></span>
                                                    </li>
                                                    <li>
                                                        <span class="title-span">8th Total : </span>
                                                        <span class="info-span"><?php echo $marks[2]; ?></span>
                                                    </li>
                                                </ul>
											</div>
										</div>

										

                                        <div class="row">
								<div class="col-12 col-lg-12 col-xl-8 d-flex">
									<div class="card flex-fill">
										<div class="card-header">
											<div class="row align-items-center">
												<div class="col-6">
													<h5 class="card-title">Learning Curve over Years</h5>
												</div>
											</div>						
										</div>
										<div class="row mt-3">                                           
										</div>
										<div class="card-body">
<canvas id="acscore"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const genericOptions = {
  fill: false,
  interaction: {
    intersect: false
  },
  radius: 0,
};
const skipped = (ctx3, value) => ctx3.p0.skip || ctx3.p1.skip ? value : undefined;
const down = (ctx3, value) => ctx3.p0.parsed.y > ctx3.p1.parsed.y ? value : undefined;
const ctx3 = document.getElementById('acscore');
const myChart = new Chart(ctx3, {
  type: 'line',
  data: {
    labels:<?php echo json_encode($lable) ?> ,
    datasets: [{
      label: '',
      data: <?php echo json_encode($marks) ?>,
      borderColor: 'rgb(0, 129, 0 )',
      segment: {
        borderColor: ctx3 => skipped(ctx3, 'rgb(100,0,0)') || down(ctx3, 'rgb(255,0,0)'),
        borderDash: ctx3 => skipped(ctx3, [6, 6]),
      },
      spanGaps: true
    }]
  },
  options: genericOptions
});
</script>
</div>
										<div class="card-body">
                                        <canvas id="acscore"></canvas>
                                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                            <script>
												// m = JSON.parse(localStorage.m);
												const ctx2 = document.getElementById('acscore');
												const myChart = new Chart(ctx2, {
													type: 'bar',
													data: {
														labels: <?php echo json_encode($y) ?>,
														//echo json_encode($y), 
														datasets: [{
															label: 'MARKS SCORED',
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
									</div>
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