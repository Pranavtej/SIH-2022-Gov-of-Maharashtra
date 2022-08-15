<?php

include 'connect.php';

session_start();

$student_id = $_SESSION['STUDENT_ID'];
$school_id  = $_SESSION['SCHOOL_ID'];
$class_id = $_SESSION['CLASS_ID'];

$sql = "select * from student where student_id='$student_id' and school_id='$school_id'";
$run = mysqli_fetch_array(mysqli_query($con, $sql));

$sql2 = "select class,section from classes where class_id='$class_id'";
$run2 = mysqli_query($con, $sql2);
$run2 = mysqli_fetch_assoc($run2);

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
		
			<?php include 'student-menu.php'; ?>
        
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
                                                        <span class="title-span">CLASS : </span>
                                                        <span class="info-span"><?php echo $run2['class']; ?></span>
                                                    </li>
                                                    <li>
                                                        <span class="title-span">SECTION : </span>
                                                        <span class="info-span"><?php echo $run2['section']; ?></span>
                                                    </li>
                                                    <li>
                                                        <span class="title-span">Email : </span>
                                                        <span class="info-span"><?php echo $run['email']; ?></span>
                                                    </li>
                                                    <li>
                                                        <span class="title-span">Gender : </span>
                                                        <span class="info-span"><?php
																					if($run['gender']== 'M')
																					{
																						echo "MALE";
																					} 
																					else
																					{
																						echo "FEMALE";
																					}
																				?></span>
                                                    </li>
                                                    <li>
                                                        <span class="title-span">DOB : </span>
                                                        <span class="info-span"><?php echo $run['date_of_birth']; ?></span>
                                                    </li>
                                                </ul>
											</div>
										</div>

										<div class="row mt-3">                                           
										</div>
										
										<div class="row">
											<div class="col-xl-3 col-sm-6 col-12">
												<div class="card flex-fill fb sm-box">
													<!-- <i class="fab fa-facebook"></i> -->
													<h6>50,095</h6>
													<p>Likes</p>
												</div>
											</div>
											<div class="col-xl-3 col-sm-6 col-12">
												<div class="card flex-fill twitter sm-box">
													<!-- <i class="fab fa-twitter"></i> -->
													<h6>48,596</h6>
													<p>Follows</p>
												</div>
											</div>
						
											<div class="col-xl-3 col-sm-6 col-12">
												<div class="card flex-fill insta sm-box">
													<!-- <i class="fab fa-instagram"></i> -->
													<h6>52,085</h6>
													<p>Follows</p>
												</div>
											</div>
						
											<div class="col-xl-3 col-sm-6 col-12">
												<div class="card flex-fill linkedin sm-box">
													<!-- <i class="fab fa-linkedin-in"></i> -->
													<h6>69,050</h6>
													<p>Follows</p>
												</div>
											</div>
										</div>
										
										<!-- <div class="row mt-2">
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
                                        </div> -->
									</div>
								</div>								
							</div>
						</div>
					</div>	
					
					<div class="row">
						<?php
							$query = "SELECT s.subject_name as subject_name,ROUND(sum(credits)/5) as num,loc.subject_id as subject_id FROM `learning_outcomes_credits` loc,subjects s WHERE class_id='$class_id' and student_id='$student_id' and s.subject_id=loc.subject_id GROUP BY loc.subject_id";
							$run = mysqli_query($con,$query);

							foreach($run as $id)
							{
								$cc = (int)$id['num'];
								$star = '⭐';
								for($i=1;$i<$cc;$i++)
								{
									$star = $star . '⭐';
								}
								$sum = mysqli_query($con, "SELECT type FROM `conclusion` WHERE id='$cc'");
								echo'
								<div class="col-12 col-md-6 col-lg-4 d-flex">
									<div class="card flex-fill">
										<div class="card-header">
											<h5 class="card-title mb-0">'.$id['subject_name'].'<br><br>Credits : '.$star.'</h5>
										</div>
										<div class="card-body">
											<h6 class="card-text" >Your Score </h6><br>
											<h3 class="card-text" >'.$id['num'].'/5</h3>';
											foreach($sum as $su)
											{
												echo '<p class="card-text">'.$su['type'].'</p>';
											}
											echo '<a class="card-link" href="student-detailed-view.php?suid='.$id['subject_id'].'">View detailed credits</a>
										</div>
									</div>
								</div>
								';
							}
						?>
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