<?php
    
    include 'connect.php';

    session_start();

    $school_id = $_SESSION['SCHOOL_ID'];
    $teacher_id = $_SESSION['TEACHER_ID'];

    $sql = mysqli_query($con,"select teacher_name from teacher_info where teacher_id='$teacher_id' and school_id='$school_id'");
    $run = mysqli_fetch_assoc($sql);
	$sql1= mysqli_query($con,"select avg(marks) as av,sct.class_id as cls,max(marks) as max from exam_marks as e,
	schoolwise_class_subject_teachers as sct,classes as c where sct.teacher_id='$teacher_id' and
	 e.class_id=sct.class_id and e.subject_id=sct.subject_id group by sct.class_id ");
	foreach($sql1 as $d){
		$x[]=$d['av'];
		$y[]=$d['cls'];
		$m[]=$d['max'];
		}
     $sql2= mysqli_query($con,"select class_id as cid,subject_id as sid from schoolwise_class_subject_teachers 
	 where teacher_id='$teacher_id' and school_id='$school_id' ");
	
	
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Preskool - Dashboard</title>
		
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
		<?php include 'teacher-teacher-header.php' ?>		
		<?php include 'teacher-teacher-sidebar.php' ?>
		<!-- Page Wrapper -->
		<div class="page-wrapper">
			<div class="content container-fluid">
				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="page-title">Welcome <?php echo $run['teacher_name'];  ?></h3>
							<ul class="breadcrumb">
								<h4><li class="breadcrumb-item active">Teacher</li></h4>
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
										<h3>04/06</h3>
										<h6>Total Classes</h6>
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
											<h3>40/60</h3>
											<h6>Total Students</h6>
										</div>										
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12 d-flex">
							<div class="card bg-seven w-100">
								<a href="teacher-lo-assesment.php"><div class="card-body">
									<div class="db-widgets d-flex justify-content-between align-items-center">
										<div class="db-icon">
											<i class="fas fa-clock"></i>
										</div>
										<div class="db-info">
											<h3>Learning Outcomes</h3>
										</div>										
									</div>
								</div></a>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12 d-flex">
							<div class="card bg-eight w-100">
								<a href="teacher-rating-class-list.php"><div class="card-body">
									<div class="db-widgets d-flex justify-content-between align-items-center">
										<div class="db-icon">
											<i class="fas fa-clock"></i>
										</div>
										<div class="db-info">
											<h3>Class Decorum</h3>
										</div>										
									</div>
								</div></a>
							</div>
						</div>
					</div>
					<!-- /Overview Section -->	
					<!-- Teacher Dashboard -->
					<div class="row">
						<div class="col-12 col-lg-12 col-xl-8 d-flex">
							 <div class="card flex-fill">
								<div class="card-header">
									<div class="row align-items-center">
										<div class="col-6">
											<h5 class="card-title">Class Wise Progress</h5>
										</div>
									</div>						
							  </div>
						           <div class="card-body">
                                        <canvas id="acscore"></canvas>
                                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                            <script>
												const ctx_2 = document.getElementById('acscore');
												const myChart = new Chart(ctx_2, {
												type: 'bar',
												data: {
												labels: <?php echo json_encode($y)?> ,
												datasets: [{
												label: 'Highest Marks',
												data: <?php echo json_encode($m)?>,
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
												data:<?php echo json_encode($x)?>,
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
										</div></div></div> 	
								  
							<div class="col-12 col-lg-4 col-xl-4 d-flex">				
									<!-- Feed Activity -->
									<div class="card flex-fill">
										<div class="card-header">
											<h5 class="card-title">Pass Percentage</h5>
										</div>
										<div class="card-body">
											<ul class="activity-feed">
												<?php
													while($run1 = mysqli_fetch_assoc($sql2))
													{
													    $sid=$run1['sid'];
														$cid=$run1['cid'];	 
													    $sql5=mysqli_query($con,"select class,section from classes where class_id='$cid'");
														$r=mysqli_fetch_assoc($sql5);
														$sql3=mysqli_query($con,"select count(m.marks) as count  from exam_marks m , exam e  where m.marks>=35 and 
													 m.school_id='$school_id' and m.eid=e.eid and e.status=1  and m.subject_id='$sid' and m.class_id ='$cid'");
														$nc=0;
														$pc=0;
														$pp=0;
														$run3 = mysqli_fetch_assoc($sql3);
														$qu3 = "select count(*) as count1 from student  where class_id ='$cid' and school_id = '$school_id'";
														$run2 = mysqli_query($con,$qu3);
														$count2=mysqli_fetch_assoc($run2);
														$pc=$run3['count'];
														$nc=$count2['count1'];
														$pp=($pc/$nc)*100;
														echo '<li class="feed-item">
														<div class="feed-date">'.$r['class'].''.$r['section'].'</div>
														<span class="feed-text"><a>'.round($pp).'%</a></span>
														</li>';
													
													}
												?>
											</ul>
										</div>					
									</div>
								</div>
							</div>

					<!-- <div class="col-12 col-lg-4 col-xl-4 d-flex">
						<div class="card flex-fill">
							<div class="card-header">
								<div class="row align-items-center">
									<div class="col-12">
										<h5 class="card-title">Semester Progres</h5>
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
					</div> -->
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