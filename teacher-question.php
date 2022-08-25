<?php
include 'connect.php';
$subject_id=$_GET['subject_id'];
$class_id=$_GET['class_id'];
$school_id=$_GET['school_id'];
$exam_id=autoincemp();
function autoincemp()
{
    global $value2;
    global $con;
    $query = "select exam_id from teacher_exam_question order by exam_id desc LIMIT 1";
    $stmt = mysqli_query($con,$query);
    $rowcount=$stmt->num_rows;
    if ($rowcount > 0) {
        $row = mysqli_fetch_assoc($stmt);
        $value2 = $row['exam_id'];
        $value2 = substr($value2,1);
        $value2 = (int)$value2 + 1;
        $str="E";
        $value2 = "E".sprintf('%s',$value2);
        $value = $value2;
        return $value;
    } else {
        $value2 = "E10";
        $value = $value2;
        return $value;
    }
}
$sql="SELECT * FROM `teacher_exam_question` WHERE  exam_id='$exam_id' and  `class_id`='$class_id' and `school_id`='$school_id'";
$run=mysqli_query($con,$sql);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>super-admin-classwise-subject-list</title>
		
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
         <?php include 'super-admin-menu.php';	?>	
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Classwise Subjects List</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="teacher-classteacher-dashboard.php">Teacher Dashboard</a></li>
									<li class="breadcrumb-item active">exam question list</li>
								</ul>
							</div>
							<div class="col-auto text-end float-end ms-auto">
								<a href="teacher-add-question.php?exam_id=<?php echo $exam_id;?>&class_id=<?php echo $class_id;?>&school_id=<?php echo $school_id;?>&subject_id=<?php echo $subject_id;?>" class="btn btn-outline-primary me-2"><i class="fas fa-add"></i> ADD</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
				
					<div class="row">
						<div class="col-sm-12">
                        <div class='card card-table'>
								<div class='card-body'>
									<div class='table-responsive'>
										<table class='table table-hover table-center mb-0 datatable'>
										       <thead>
												<tr>
													<th>QUESTION ID</th>
                                                    <th>QUESTION</th>
                                                    <th>ANSWER</th>
												</tr>
											   </thead>
											   <?php
											   echo'
											    <tbody>';
													while($res1=mysqli_fetch_assoc($run))
													{ 
														echo 
														'<tr><td>'.$res1['question_id'].'</td>
                                                        <td>'.$res1['question'].'</td>
                                                        <td>'.$res1['answer'].'</td>
                                                        </tr>';
                                                     }
											  echo'</tbody>';?>
										</table>
									</div>
								</div>
							</div>							
						</div>		
					</div>					
				</div>			
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