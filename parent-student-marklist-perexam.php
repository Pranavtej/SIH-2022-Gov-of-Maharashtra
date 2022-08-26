<?php

include 'connect.php';

session_start();

$student_id = $_SESSION['STUDENT_ID'];

$exam_id=$_GET['eid'];




?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Preskool - Data Tables</title>
		
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
		
        <?php include 'parent-menu.php'; ?>
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Mark List</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="parent-dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Mark List</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<?php
                            //$eid = array($eid);
                            $eid=$_GET['eid'];
                                $i = 0;
                                $query="select S.subject_name as sn, M.marks as mm from exam_marks M,subjects S where M.student_id='$student_id' and M.subject_id=S.subject_id and eid='$eid'";
                                $result=mysqli_query($con,$query) or die(mysqli_error);
                                $query1="select ename from exam where eid='$eid'";
                                $result2=mysqli_query($con,$query1) or die(mysqli_error);
                                $res = mysqli_fetch_assoc($result2);
                                echo '<div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title mb-2">'.$res['ename'].'</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>S. No.</th>
                                                                <th>Subject</th>
                                                                <th>Marks</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>';
                                                            while($data = mysqli_fetch_array($result))
                                                            {
                                                                echo '
                                                                <tr>
                                                                    <td>'.++$i.'</td>
                                                                    <td>'.$data['sn'].'</td>
                                                                    <td>'.$data['mm'].'</td>
                                                                </tr>';
                                                            }
                                echo '                  </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
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
		
		<!-- Datatables JS -->
		<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="assets/plugins/datatables/datatables.min.js"></script>
		
		<!-- Custom JS -->
		<script  src="assets/js/script.js"></script>
		
    </body>
</html>