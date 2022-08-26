<?php

include 'connect.php';

session_start();

$student_id = $_GET['sid'];
$subject_id = $_GET['suid'];

$query = mysqli_query($con,"select student_name as sn from student where student_id='$student_id'");
$run = mysqli_fetch_array($query);


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>VIEW CREDITS</title>
		
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
		
            <?php include 'teacher-header.php'; ?>
			<?php include 'teacher-sidebar.php'; ?>

			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Student Name: <?php echo $run['sn']; ?></h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item active">Class 1</a></li>
									<li class="breadcrumb-item active">Mathematics</li>
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
										<table class="table table-hover table-center mb-0">
											<thead>
												<tr>
													<th>S. No.</th>
													<th>Learning Outcome</th>
													<th>Class</th>
													<th>Subject</th>
													<th>Marks Obtained</th>
													<th>Comparitive Analytics</th>
													<th>Percentage</th>
												</tr>
											</thead>
											<tbody>
											<style>
												.checked {
													color: orange;
													}
											</style>
												<?php
                                                    $query = "select o.loc as loc,o.loc_id as locid,l.credits as credits from learning_outcomes_credits l,learning_outcomes o where l.student_id = '$student_id' and l.subject_id='$subject_id' and l.loc_id = o.loc_id";
                                                    $run = mysqli_query($con, $query);
                                                    $i = 0;
                                                    foreach($run as $d)
                                                    {
														$per = ($d['credits']/5) * 100;
                                                        echo '<tr>
                                                            <td>'.++$i.'</td>
                                                            <td>'.$d['loc'].'</td>
															<td>Class 1</td>
															<td>Mathematics</td>
                                                            <td><a href="view-std.php?sid='.$student_id.'&loc_id='.$d['locid'].'&eid=E10">'.$d['credits'].'/5</a></td>
															<td><a href="view-analytics.php?locid='.$d['locid'].'&eid=E10&sid='.$student_id.'">Compare</a></td>
															<td>'.$per.'%</td>
                                                        </tr>';
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