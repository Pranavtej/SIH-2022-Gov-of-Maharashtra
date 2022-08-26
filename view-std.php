<?php

include 'connect.php';

$student_id = $_GET['sid']; 
$loc_id = $_GET['loc_id'];
$exam_id = $_GET['eid'];


$loc = mysqli_query($con, "SELECT question_id,question,options,loc_id,image_path FROM `teacher_exam_question` WHERE exam_id='$exam_id' and loc_id='$loc_id' order by question_id");


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
		
         

			
			<!-- Page Wrapper -->
            
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title" align="center">Learning Outcome Assessment Examination </h3>
                               
                                <h5 align="left"  >Grade : 1</h5><h5 align="right">Subject : Mathematics </h5>
								<ul class="breadcrumb">
									
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
                            <?php
                                $i = 0;
                                $j = 1;
                                while($run1 = mysqli_fetch_assoc($loc))
                                {
                                    $qid = $run1['question_id'];
                                    $query = mysqli_query($con, "select loc from learning_outcomes where loc_id='{$run1['loc_id']}'");
                                    $aa = mysqli_fetch_assoc($query);
                                    $query2 = mysqli_query($con,"select answer from exam_answers where exam_id='$exam_id' and student_id='$student_id' and question_id='$qid'");
                                    $a = mysqli_fetch_assoc($query2);
                                    $query3 = mysqli_query($con, "select answer from teacher_exam_question where exam_id='$exam_id' and question_id='$qid'");
                                    $b = mysqli_fetch_assoc($query3);

                                    echo'
                                    <div class="col-12 col-md-6 col-lg-4 d-flex">
                                    <div class="card flex-fill">
                                    <div class="card-header">
                                   <h4> Question '.$j++.': '.$run1['question'].'</h4><br>
                                    <h6>(Learning Outcome : '.$aa['loc'].')</h6>              
                                    </div>';
                                    if(!empty($run1['options']))
                                    {
                                        echo '<h6>'.$run1['options'].'</h6>';
                                    }
                                    if(!empty($run1['image_path']))
                                    {
                                        echo '<img src="exam/img/'.$run1['image_path'].'" alt="image not loaded" class="card-img">';
                                    }
                                    echo '<div class="card-body">
                                    <p class="card-text">Right Answer: '.$b['answer'].'</p>
                                    <p class="card-text">Student Answer: '.$a['answer'].'</p>';
                                    if(strtoupper($b['answer'])==strtoupper($a['answer']))
                                    {
                                        echo '<p class="card-text" style="color:green"><b>Correct</b></p>';
                                    }
                                    else
                                    {
                                        echo '<p class="card-text" style="color:red"><b>Wrong</b></p>';

                                    }
                                    echo '</div>
                                    </div>
                                    </div>';
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
		
		<!-- Datatables JS -->
		<script src="assets/plugins/datatables/datatables.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
    </body>
</html>