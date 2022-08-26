<?php  session_start();

include 'connect.php';
if(empty($_SESSION['STUDENT_ID']))
{
    echo '<script>document.location="student-login.php"</script>';
}
else{

    $student_id = $_SESSION['STUDENT_ID'];
	$class_id = $_SESSION['CLASS_ID'];
	$school_id = $_SESSION['SCHOOL_ID'];
 
    $sql="select s.*,c.class,c.section from student s,classes c where s.student_id='$student_id' and s.class_id=c.class_id";
    $run = mysqli_query($con,$sql)or die(''.__LINE__.'<br>'.mysqli_error($con));
    $run = mysqli_fetch_assoc($run);
    if(!empty($run))
    {
        $school_id = $run['school_id'];
        $student_id = $run['student_id'];
        $student_name = $run['student_name'];
        $student_email = $run['email'];
        $student_password = $run['gender'];
        $student_address = $run['address'];
        $student_dob = $run['date_of_birth'];
        $student_classid= $run['class_id'];

	$query1="select eid from exam where status=1";
	$result1=mysqli_query($con,$query1) or die(mysqli_error);
	$res = mysqli_fetch_assoc($result1);
	$eid = $res['eid'];

    $query="select S.subject_name, M.marks from exam_marks M,subjects S where M.student_id='$student_id' and M.subject_id=S.subject_id and eid='$eid'";
    $result=mysqli_query($con,$query) or die(mysqli_error);
     foreach($result as $data)
     {
        $y[] = $data['subject_name'];
        $x[]=$data['marks'];
    }

	$query="select m.cocircular_name as cn,c.marks as marks from cocircular_marks c,cocircular m where c.student_id='$student_id' and c.school_id='$school_id' and c.class_id='$class_id' and c.cocircular_id = m.cocircular_id";
    $result=mysqli_query($con,$query) or die(mysqli_error);
     foreach($result as $data)
     {
        $cn[] = $data['cn'];
        $ma[]=$data['marks'];
    }

	$q="SELECT e.marks,s.sport_name FROM sports_marks e,sports s WHERE student_id='$student_id' AND s.sport_id=e.sport_id;";
    $r=mysqli_query($con,$q) or die(mysqli_error);
     foreach($r as $d)
     {
        $l[] = $d['sport_name'];
        $m[]=$d['marks'];
    }
    }

	$qu="select e.student_id as sid from exam_totals e,student s where e.eid='$eid' and e.school_id='$school_id' and e.student_id=s.student_id and s.class_id='$class_id' order by e.total desc";
    $re=mysqli_query($con,$qu);
    $var=0;
    foreach($re as $data)
    {
        $var=$var+1;
        if($data['sid']==$student_id)
        {
            $rank = $var;
            break;
        }
    }

	$qu1 = mysqli_query($con , "SELECT student_id,sum(marks) as marks from sports_marks where school_id='$school_id' GROUP BY student_id order by marks desc");
	$var3=0;
    foreach($qu1 as $data)
    {
        $var3=$var3+1;
        if($data['student_id']==$student_id)
        {
            $rank3 = $var3;
            break;
        }
    }

	$qu5="select student_id as sid,SUM(marks) as sum from cocircular_marks where class_id='$class_id' and school_id='$school_id' GROUP BY student_id order by sum desc";
	$re5=mysqli_query($con,$qu5);
    $varc=0;
    foreach($re5 as $data)
    {
        $varc=$varc+1;
        if($data['sid']==$student_id)
        {
            $ccarank = $varc;
            break;
        }
    }
	$qu6="select c.student_id as sid,SUM(c.marks+e.total+s.marks) as sum from cocircular_marks c,exam_totals e,sports_marks s where e.class_id='$class_id' and e.school_id='$school_id' and e.student_id=c.student_id and e.student_id=c.student_id and e.student_id = s.student_id GROUP BY e.student_id order by sum desc";
	$re9=mysqli_query($con,$qu6);
    $v = 0;
    foreach($re9 as $data)
    {
        $v = $v+1;
        if($data['sid']==$student_id)
        {
            $ovrank = $v;
            break;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Student - Dashboard</title>
		
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
		
	
		<?php include 'parent-menu.php'; ?>
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
                <div class="content container-fluid">
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Welcome Parent !!</h3>
								<h4>Student name:<?php echo $student_name;?></h4>
								<h6>Class: <?php echo $run['class'].'-'.$run['section'];?></h6>
                                </h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="">Dashboard</a></li>
									<li class="breadcrumb-item active">Student Dashboard</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

					<!-- Overview Section -->
					<div class="row">
						<div class="col-xl-3 col-sm-6 col-12 d-flex">
							<div class="card bg-nine w-100">
								<div class="card-body"><a href="student-view-all-academic-rank.php?ra=<?php echo $rank; ?>">
									<div class="db-widgets d-flex justify-content-between align-items-center">
										<div class="db-icon">
											<i class="fas fa-book-open"></i>
										</div>
										<div class="db-info">
											<h3><?php echo $rank;?></h3>
											<h6>Academic Rank</h6>
										</div>										
									</div>
								</div></a>
							</div>
						</div>

						<div class="col-xl-3 col-sm-6 col-12 d-flex">
							<div class="card bg-six w-100">
								<div class="card-body">
									<div class="db-widgets d-flex justify-content-between align-items-center">
										<div class="db-icon">
											<i class="fas fa-file-alt"></i>
										</div>
										<div class="db-info">
											<h3><?php echo $ccarank; ?></h3>
											<h6>CCA Rank</h6>
										</div>										
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-3 col-sm-6 col-12 d-flex">
							<div class="card bg-ten w-100">
								<div class="card-body">
									<div class="db-widgets d-flex justify-content-between align-items-center">
										<div class="db-icon">
											<i class="fas fa-clipboard-list"></i>
										</div>
										<div class="db-info">
											<h3><?php echo $rank3;?></h3>
											<h6>Sports Rank</h6>
										</div>										
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-3 col-sm-6 col-12 d-flex">
							<div class="card bg-eleven w-100">
								<div class="card-body">
									<div class="db-widgets d-flex justify-content-between align-items-center">
										<div class="db-icon">
											<i class="fas fa-clipboard-check"></i>
										</div>
										<div class="db-info">
											<h3><?php echo $ovrank; ?></h3>
											<h6>Rank</h6>
										</div>										
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Overview Section -->				

					<!-- Student Dashboard -->
					<!-- <div class="row">
						<div class="col-12 col-lg-12 col-xl-9">

							<div class="card flex-fill">
								<div class="card-header">
									<div class="row align-items-center">
										<div class="col-6">
											<h5 class="card-title">Today’s Lesson</h5>
										</div>
										<div class="col-6">
											<span class="float-end view-link"><a href="#">View All Courses</a></span>
										</div>
									</div>						
								</div>

								<div class="dash-circle">
									<div class="row">
										<div class="col-12 col-lg-6 col-xl-6 dash-widget3">
											<div class="card-body dash-widget1">
												<div class="circle-bar circle-bar2">
													<div class="circle-graph2" data-percent="20">
														<b>20%</b>
													</div>
													<h6>Lesson Learned</h6>
													<h4>10 <span>/ 50</span></h4>
												</div>
												<div class="dash-details">
													<h4>Facilisi etiam</h4>
													<ul>
														<li><i class="fas fa-clock"></i> 2.30pm - 3.30pm</li>
														<li><i class="fas fa-book-open"></i> 5 Lessons</li>
														<li><i class="fas fa-hourglass-end"></i> 60 Minutes</li>
														<li><i class="fas fa-clipboard-check"></i> 5 Asignment</li>
													</ul>
													<div class="dash-btn">
														<button type="submit" class="btn btn-info btn-border">Skip</button>
														<button type="submit" class="btn btn-info">Continue</button>
													</div>
												</div>
											</div>
										</div>

										<div class="col-12 col-lg-6 col-xl-6 dash-widget4">
											<div class="card-body dash-widget1 dash-widget2">
												<div class="circle-bar circle-bar3">
													<div class="circle-graph3" data-percent="50">
														<b>50%</b>
													</div>
													<h6>Lesson Learned</h6>
													<h4>25 <span>/ 50</span></h4>
												</div>
												<div class="dash-details">
													<h4>Augue mauris</h4>
													<ul>
														<li><i class="fas fa-clock"></i> 3.30pm - 4.30pm</li>
														<li><i class="fas fa-book-open"></i> 6 Lessons</li>
														<li><i class="fas fa-hourglass-end"></i> 60 Minutes</li>
														<li><i class="fas fa-clipboard-check"></i> 6 Asignment</li>
													</ul>
													<div class="dash-btn">
														<button type="submit" class="btn btn-info btn-border">Skip</button>
														<button type="submit" class="btn btn-info">Continue</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div> -->

							<div class="row">
								<div class="col-12 col-lg-12 col-xl-8 d-flex">
									<div class="card flex-fill">
										<div class="card-header">
											<div class="row align-items-center">
												<div class="col-6">
													<h5 class="card-title">Learning Activity</h5>
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
												const ctx = document.getElementById('acscore');
												const myChart = new Chart(ctx, {
													type: 'bar',
													data: {
														labels: <?php echo json_encode($y) ?>,
														//echo json_encode($y), 
														datasets: [{
															label: 'MARKS SCORED',
															data:<?php echo json_encode($x) ?>,
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
								
								
								<div class="col-12 col-lg-12 col-xl-4 d-flex">
									<div class="card flex-fill">
										<div class="card-header">
											<h5 class="card-title"></h5>
										</div>
										<div class="card-body">
											<div class="teaching-card">
												<ul class="activity-feed">
													<li class="feed-item">
														<div class="feed-date1">Current Academic Year 2021-2022 </div>
														<style>
															.checked {
																color: orange;
																}
														</style>
														<?php
															$exam = array("UT1","FA1","UT2","FA2","AEE");
															foreach($exam as $eid)
															{
																$qu1="select e.total as total,ex.ename as ename from exam_totals e, exam ex where e.eid='$eid' and e.student_id='$student_id' and e.eid = ex.eid";
    															$re1=mysqli_query($con,$qu1);
																$re1 = mysqli_fetch_assoc($re1);
																echo '
																<span class="feed-text1"><a>'.$re1['ename'].'</a></span>
																<p><span><a href="parent-student-marklist-perexam.php?eid='.$eid.'">'.$re1['total'].'</span></p>';
															}
														?>
													</li>
													<li class="feed-item">
														<div class="feed-date1">old  Acdemic Year</div>
														<span class="feed-text1"><a>Score</a></span>
														<p>Completed</p>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
								
							<div class="row">
						<?php
							$query = "SELECT s.subject_name  as subject_name,ROUND(sum(credits)/5) as num,loc.subject_id as subject_id FROM `learning_outcomes_credits` loc,subjects s WHERE class_id='$class_id' and student_id='$student_id' and s.subject_id=loc.subject_id GROUP BY loc.subject_id";
							$run = mysqli_query($con,$query);

							foreach($run as $id)
							{
								$cc = (int)$id['num'];
								$sum = mysqli_query($con, "SELECT type FROM `conclusion` WHERE id='$cc'");
								echo'
								<div class="col-12 col-md-6 col-lg-4 d-flex"><a href="student-detailed-view.php?suid=SUB0603">
									<div class="card flex-fill">
										<div class="card-header">
											<h5 class="card-title mb-0">'.$id['subject_name'].'<br><br>Credits : ';
											for($i=1;$i<=$cc;$i++)
											{
												echo '<span class="fa fa-star checked"></span>';
											}
											$k = 6 - $i;
											for($i=0;$i<$k;$i++)
											{
												echo '<span class="fa fa-star"></span>';
											}
											echo '</h5>
										</div>
										
									</a></div>
								</div>
								';
							}
						?>
					
				</div>
				
						<div class="row">
<div class="col-12 col-lg-12 col-xl-8 d-flex">
<div class="card flex-fill">
<div class="card-header">
<div class="row align-items-center">
<div class="col-6">
<h5 class="card-title">Cocurricular Marks</h5>
</div>
<div class="col-6">
<ul class="list-inline-group text-end mb-0 ps-0">
<li class="list-inline-item">
<!-- <div class="form-group mb-0 amount-spent-select"> -->
<!-- <select class="form-control form-control-sm form-select">
<option>Weekly</option>
<option>Monthly</option>
<option>Yearly</option>
</select> -->
<!-- </div> -->
</li>
</ul>
</div>
</div>
</div> 
<div  id="chart">

<canvas id="cscore"></canvas>
<!-- <canvas id="ccscore"></canvas> -->
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    
const ctxc = document.getElementById('cscore');
const myChartc = new Chart(ctxc, {
    type: 'pie',
    data: {
        labels:  <?php echo json_encode($cn)?>, 
        datasets: [{
            label: 'MARKS SCORED',
            data: <?php echo json_encode($ma)?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
					// 'rgb(255, 99, 132)',
					// 'rgb(54, 162, 235)',
					// 'rgb(255, 205, 86)',
					// 'rgb(255, 99, 13)',
					// 'rgb(54, 162, 23)',
					// 'rgb(255, 205, 8)',
					// 'rgb(255, 205, 899)'super-admin-add-school.php

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
        maintainAspectRatio: false,
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
<div class="col-12 col-lg-12 col-xl-4 d-flex">
<div class="card flex-fill">
<div class="card-header">
<h5 class="card-title">Your Intrests </h5>
</div>

<!-- <div class="circle-bar circle-bar3">
<div class="circle-graph3" data-percent="50"> -->
<!-- <b>50%</b>
</div> -
<h2>Score</h2>
<h2><?php echo $zzz['total']; ?></h2>-->
<div id="chart" >
<canvas id="ccscore" width="750" height="750"></canvas>
<!-- <canvas id="ccscore"></canvas> -->
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    
const ctxcc = document.getElementById('ccscore');
const myChartcc = new Chart(ctxcc, {
    type: 'doughnut',
    data: {
        labels:  <?php echo json_encode($l)?>, 
        datasets: [{
            label: 'MARKS SCORED',
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
        }]
    },
    options: {
        maintainAspectRatio: true,
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
						<!-- <div class="col-12 col-lg-12 col-xl-3 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
									<div class="row align-items-center">
										<div class="col-12">
											<h5 class="card-title">Calendar</h5>
										</div>
									</div>									
								</div>
								<div class="card-body">
									<div id="calendar-doctor" class="calendar-container"></div>
									<div class="calendar-info calendar-info1">
										<div class="calendar-details">
											<p>09 am</p>
											<h6 class="calendar-blue d-flex justify-content-between align-items-center">Fermentum <span>09am - 10pm</span></h6>
										</div>
										<div class="calendar-details">
											<p>10 am</p>
											<h6 class="calendar-violet d-flex justify-content-between align-items-center">Pharetra et <span>10am - 11am</span></h6>
										</div>
										<div class="calendar-details">
											<p>11 am</p>
											<h6 class="calendar-red d-flex justify-content-between align-items-center">Break <span>11am - 11.30am</span></h6>
										</div>
										<div class="calendar-details">
											<p>12 pm</p>
											<h6 class="calendar-orange d-flex justify-content-between align-items-center">Massa <span>11.30am - 12.00pm</span></h6>
										</div>
										<div class="calendar-details">
											<p>09 am</p>
											<h6 class="calendar-blue d-flex justify-content-between align-items-center">Fermentum <span>09am - 10pm</span></h6>
										</div>
									</div>
								</div>
							</div>
						</div>	
					</div> -->
					<!-- /Student Dashboard -->
			
				
				<!-- Footer -->
				
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