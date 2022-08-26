<?php

include "connect.php";

$loc_id = $_GET['locid'];
$eid = $_GET['eid'];

$query = mysqli_query($con, "select s.student_id as student_id,l.credits as credits from student s,learning_outcomes_credits l where l.subject_id='SUB0104' and l.loc_id='$loc_id' and l.student_id = s.student_id order by credits desc");

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Subjects</title>
		
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
								<h3 class="page-title">Learning Outcome: </h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item">Student List</li>
									<li class="breadcrumb-item active">Mark List</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

                    <div class="row">
						<div class="col-sm-12">
						
							<div class="card card-table">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-hover">
											<thead>
												<tr>
													<th>Rank</th>
													<th>Student Name</th>
                                                    <th>Marks Obtained</th>
												</tr>
											</thead>
											<tbody>
                                                <?php
                                                    $i = 0;
													while($ru = mysqli_fetch_assoc($query))
													{  
                                                        echo '<tr>
                                                            <td>'.++$i.'</td>
                                                            <td>'.$ru['student_name'].'</td>
                                                            <td>'.$ru['credits'].'</td>
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