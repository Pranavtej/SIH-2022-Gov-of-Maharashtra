<?php

include 'connect.php';

session_start();

$class_id = $_GET['cid'];
$school_id = $_SESSION['SCHOOL_ID'];
$subject_id = $_GET['sid'];

$sql = "select student_id from student where class_id='$class_id' AND school_id='$school_id'";
$run = mysqli_query($con,$sql);
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Preskool - Students</title>
		
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
		
            <?php include 'teacher-teacher-header.php'; ?>
			<?php include 'teacher-teacher-sidebar.php'; ?>

			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Students</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item active">Dashboard</a></li>
									<li class="breadcrumb-item active">Students</li>
								</ul>
							</div>
							<!-- <div class="col-auto text-end float-end ms-auto">
								<a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
								<a href="add-student.html" class="btn btn-primary"><i class="fas fa-plus"></i></a>
							</div> -->
						</div>
					</div>
					<!-- /Page Header -->
				
					<div class="row">
						<div class="col-sm-12">
						
							<div class="card card-table">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-hover table-center">
											<thead>
												<tr>
													<th>ID</th>
													<th>Name</th>
													<th>Status</th>
                                                    <th>Give Rating</th>
												</tr>
											</thead>
                                            <tbody>
                                                <?php
													foreach($run as $id)
													{
														$id = $id['student_id'];
														$query = "select student_name from student where school_id='$school_id' and class_id='$class_id' and student_id='$id'";
														$run1 = mysqli_fetch_assoc(mysqli_query($con,$query));
														echo '<tr>
															<td>'.$id.'</td>
															<td>'.$run1['student_name'].'</td>';
                                                        $sql = mysqli_query($con, "select * from learning_outcomes_credits where student_id='$id' and class_id='$class_id' and subject_id='$subject_id'");
														$cc = mysqli_num_rows($sql);
														if($cc==0)
														{
															echo '<td><span class="badge badge-danger">Not Completed</span></td>';
															echo '<td><a href="teacher-student-give-rating.php?cid='.$class_id.'&sid='.$id.'&suid='.$subject_id.'">Give Credits Now!!</a></td>';
														}
														else
														{
															echo '<td><span class="badge badge-success">Completed</span></td>';
															echo '<td>Already Given</td>';
														}
														echo '</tr>';
													}
                                                ?>
                                            </tbody>
										</table>
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
		
		<!-- Datatables JS -->
		<script src="assets/plugins/datatables/datatables.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
    </body>
</html>
