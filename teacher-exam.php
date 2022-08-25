<?php

include 'connect.php';

session_start();

$exam_id = $_GET['eid'];

$loc = mysqli_query($con, "SELECT question_id,question,options,loc_id,image_path FROM `teacher_exam_question` WHERE exam_id='$exam_id'");

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
		
            <?php include 'teacher-header.php'; ?>
			<?php include 'teacher-sidebar.php'; ?>

			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Students</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
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
				
                   
                        <form action="" method="post">
                        <div class="row">
                            <?php
                                $i = 0;
                                while($run1 = mysqli_fetch_assoc($loc))
                                {
                                    // echo '<tr>
                                    // 	<td>'.++$i.'</td>
                                    // 	<td>'.$run1['question'].'</td>
                                    //     <td><input type="number" name="'.$run1['question_id'].'"></td>
                                    // </tr>';

                                    echo'
                                    <div class="col-12 col-md-6 col-lg-4 d-flex">
                                    <div class="card flex-fill">
                                    <div class="card-header">
                                    '.$run1['question'].'
                                    </div>
                                    <div class="card-body">
                                    <p class="card-text"><input type="text" name="'.$run1['question_id'].'"></p>
                                    </div>
                                    </div>
                                    </div>
                                    
                                    ';
                                }
                            ?>
                        <input type="submit" name="give">
                        </form>	
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