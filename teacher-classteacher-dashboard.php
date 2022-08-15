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

	$quer="SELECT distinct e.sid,(e.TOTAL+a.TOTAL+c.TOTAL+s.TOTAL) as TOT
    FROM exam_totals e,academic_points a,ccapoints c, spoints s,student t,class cl 
    WHERE e.sid=a.sid and a.sid=c.sid and c.sid=s.SID and s.sid=t.sid and t.cid='$ci'";
    $re=mysqli_query($con,$quer) or die(mysqli_error());
    
    $total=0;
    foreach($re as $data)
    {
        $y[] = $data['sid'];
        $x[] = $data['TOT'];
        $total=$total+$data['TOT'];
    }
    $count=mysqli_num_rows($re);
    $total=$total/$count;
    $i=0;
    while($i<=$count)
    {
        $z[]=$total;
        $i=$i+1;
    }

    

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
					<div class="row">
<div class="col-12 col-lg-12 col-xl-8 d-flex">
<div class="card flex-fill">
<div class="card-header">
<div class="row align-items-center">
<div class="col-6">
<h5 class="card-title">Class Performance</h5>
</div>
<div class="col-6">
<ul class="list-inline-group text-end mb-0 ps-0">
<li class="list-inline-item">
<div class="form-group mb-0 amount-spent-select">
<!-- <select class="form-control form-control-sm form-select">
<option>Weekly</option>
<option>Monthly</option>
<option>Yearly</option>
</select> -->
</div>
</li>
</ul>
</div>
</div>
</div> 

<div id="chart-body" >
<canvas id="cpscore"></canvas>
<!-- <canvas id="ccscore"></canvas> -->
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    
const ctx_2 = document.getElementById('cpscore');
const myChart = new Chart(ctx_2, {
    type: 'line',
    data: {
        labels:  <?php echo json_encode($y)?>, 
        datasets: [{
            label: 'class performance',
            data: <?php echo json_encode($x)?>,
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
        },
        {
        label: 'Average',
        type: 'line',
           data:<?php echo json_encode($z)?>,
           // this dataset is drawn below0
           order: 2,
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