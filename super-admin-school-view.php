<?php

include 'connect.php';

session_start();

$school_id = $_GET['school_id'];
$sql = "select * from school_info where school_id='$school_id'";
$run = mysqli_fetch_array(mysqli_query($con, $sql));
$did=$run['district_id'];
$sql1 = "select * from districts  where district_id='$did'";
$run1 = mysqli_fetch_array(mysqli_query($con, $sql1));

$sql2= mysqli_query($con,"select sc.class_id as class_id,c.class as cname,c.section as 
section from school_info  s , classes c , schoolwise_class_details sc where 
s.school_id ='$school_id' and  sc.class_id = c.class_id and sc.school_id=s.school_id");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Student Details</title>
		
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
		
			<?php include 'super-admin-menu.php'; ?>
        
			Page Wrapper
             <div class="page-wrapper">
                <div class="content container-fluid">
				
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Student Details</h3>
								<ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="super-admin-dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item"><a href="super-admin-school-list.php">SCHOOLS	</a></li>
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
                                                        <span class="title-span">School Name : </span>
                                                        <span class="info-span"><?php echo $run['school_name']; ?></span>
                                                    </li>
                                                    <li>
                                                        <span class="title-span">District : </span>
                                                        <span class="info-span"><?php echo $run['district_id'].'-'.$run1['district_name'];; ?></span>
                                                    </li>
                                                </ul>
											</div>
										</div>
										<div class="col-12 col-lg-4 col-xl-4 d-flex">				

									<div class="card flex-fill">
										<div class="card-header">
											<h5 class="card-title"><?php echo $run['school_name'];?> Classwise Performance</h5>
										</div>
										<div class="card-body">
											<ul class="activity-feed">
												<?php
													while($run2 = mysqli_fetch_assoc($sql2))
													{
														$cid=$run2['class_id'];
														$cname=$run2['cname'];
														$sec=$run2['section']; 
														$sql3=mysqli_query($con,"SELECT e.student_id  as student_id, max(e.total) as total from exam_totals e,exam m where e.school_id='$school_id' and e.eid=m.eid and m.status=1 and e.class_id='$cid' 
														and total=any(select max(e.total) as total from exam_totals e,exam m where e.school_id='$school_id' and e.eid=m.eid and m.status=1 and e.class_id='$cid')");
														$run3 = mysqli_fetch_assoc($sql3);
														$sid=$run3['student_id'];
														echo '<li class="feed-item">
														<div class="feed-date">'.$cname.'-'.$sec.'</div>
														<span class="feed-text"><a>'.$sid.'</a></span>
														</li>';
													
													}
												?>
											</ul>
										</div>					
									</div>
								</div>
							</div>
				
<!-- 
										<div class="row mt-3">                                           
										</div>
										
										<div class="row follow-sec">
                                            <div class="col-md-4 mb-3">
                                                <div class="blue-box">
                                                    <h3>2850</h3>
                                                    <p>Followers</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="blue-box">
                                                    <h3>2050</h3>
                                                    <p>Following</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="blue-box">
                                                    <h3>2950</h3>
                                                    <p>Friends</p>
                                                </div>
                                            </div>
										</div>
										
										<div class="row mt-2">
											<div class="col-md-12">
												<h5>Permanent Address</h5>
												<p><?php echo $run['address']; ?></p>
											</div>                                            
                                        </div>

                                        <div class="row mt-2">
											<div class="col-md-12">
												<h5>Present Address</h5>
												<p><?php echo $run['address']; ?></p>
											</div>                                            
                                        </div>
									</div> -->
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