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
	$sql1= mysqli_query($con,"select avg(marks) as av,sct.class_id as cls,max(marks) as max from exam_marks as e,schoolwise_class_subject_teachers as sct,classes as c where sct.teacher_id='$teacher_id' and e.class_id=sct.class_id and e.subject_id=sct.subject_id group by sct.class_id ");
    // $sql2= mysqli_query($con,"select max(marks) from exam_marks as e,schoolwise_class_subject_teachers as sct,classes as c where sct.teacher_id='TE0001' and e.class_id=sct.class_id and e.subject_id=sct.subject_id group by sct.class_id)");
	foreach($sql1 as $d){
  $x[]=$d['av'];
  $y[]=$d['cls'];
  $m[]=$d['max'];

  $sq1= mysqli_query($con,"select class_id as cid,subject_id as sid from schoolwise_class_subject_teachers 
  where teacher_id='$teacher_id' and school_id='$school_id' ");
 
}
$sub=mysqli_query($con,"SELECT subject_name as sn FROM subjects as s WHERE s.subject_id
=any(select subject_id from schoolwise_class_subject_teachers where class_id=any
(select class_id from schoolwise_class_details where teacher_id='$teacher_id'))");
 foreach($sub as $d){
	$s[]=$d['sn'];
    }
 $maxsub=mysqli_query($con,"SELECT max(marks) as m FROM exam_marks e,exam m
  WHERE m.eid=e.eid and m.status=1 and e.subject_id=any(select subject_id from
   schoolwise_class_subject_teachers where class_id=any(select class_id from schoolwise_class_details
    where teacher_id='$teacher_id')) and e.class_id=any(select class_id from schoolwise_class_details
	 where teacher_id='$teacher_id') and school_id='$school_id' group by subject_id");
 foreach($maxsub as $d){
	$mx[]=$d['m'];
 }
 $avgsub=mysqli_query($con,"SELECT avg(marks) as a FROM exam_marks e,exam m WHERE m.eid=e.eid and m.status=1 and  
 e.subject_id=any(select subject_id from schoolwise_class_subject_teachers where class_id=any(select class_id from
  schoolwise_class_details where teacher_id='$teacher_id')) and e.class_id=any(select class_id from schoolwise_class_details 
  where teacher_id='$teacher_id') and school_id='$school_id' group by subject_id");
 foreach($avgsub as $d){
	$ax[]=$d['a'];
 }
 $minsub=mysqli_query($con,"SELECT min(marks) as mn FROM exam_marks e,exam m WHERE m.eid=e.eid and m.status=1 
 and e.subject_id=any(select subject_id from schoolwise_class_subject_teachers where class_id=
 any(select class_id from schoolwise_class_details where teacher_id='$teacher_id')) and 
 e.class_id=any(select class_id from schoolwise_class_details where teacher_id='$teacher_id') 
 and school_id='$school_id' group by subject_id");
 foreach($minsub as $d){
	$mn[]=$d['mn'];
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
<div id="chart-body" >
<canvas id="cpscore"></canvas>
<!-- <canvas id="ccscore"></canvas> -->
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    
const ctx_2 = document.getElementById('cpscore');
const myChart = new Chart(ctx_2, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($s)?>,
        datasets: [{
            label: 'maximum',
            data: <?php echo json_encode($mx)?>,
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
           data:<?php echo json_encode($ax)?>,
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
			borderWidth: 1,
           // this dataset is drawn below0
           border: 2,
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
       }, {
        label: 'Minimum',
        type: 'line',
           data:<?php echo json_encode($mn)?>,
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
			borderWidth: 1,
           // this dataset is drawn below0
           border: 2,
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
<div class="col-12 col-lg-12 col-xl-8 d-flex">
									<div class="card flex-fill">
										<div class="card-header">
											<div class="row align-items-center">
												<div class="col-6">
													<h5 class="card-title">Class Wise Progress</h5>
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
const ctx_1 = document.getElementById('acscore');
const mChart = new Chart(ctx_1, {
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
										</div>
										</div></div>

					<!-- Teacher Dashboard -->
					<div class="col-12 col-lg-4 col-xl-4 d-flex">				
									<!-- Feed Activity -->
									<div class="card flex-fill">
										<div class="card-header">
											<h5 class="card-title">Pass Percentage</h5>
										</div>
										<div class="card-body">
											<ul class="activity-feed">
												<?php
													while($ru1 = mysqli_fetch_assoc($sq1))
													{
													    $sid=$ru1['sid'];
														$cid=$ru1['cid'];	
														$sql5=mysqli_query($con,"select class,section from classes where class_id='$cid'");
														$r=mysqli_fetch_assoc($sql5); 
														$sq2=mysqli_query($con,"select count(m.marks) as count  from exam_marks m , exam e  where m.marks>=35 and 
													    m.school_id='$school_id' and m.eid=e.eid and e.status=1  and m.subject_id='$sid' and m.class_id ='$cid'");
														$nc=0;
														$pc=0;
														$pp=0;
														$ru2 = mysqli_fetch_assoc($sq2);
														$qu3 = "select count(*) as count1 from student  where class_id ='$cid' and school_id = '$school_id'";
														$ru3 = mysqli_query($con,$qu3);
														$count2=mysqli_fetch_assoc($ru3);
														$pc=$ru2['count'];
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