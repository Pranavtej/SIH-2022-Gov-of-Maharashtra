<?php
include "connect.php";
session_start();

$school_id = $_SESSION['SCHOOL_ID'] ;
$student_id = $_SESSION['STUDENT_ID'];
$class_id = $_SESSION['CLASS_ID'] ;

$query = mysqli_query($con, "select * from student_self_assesment where school_id='$school_id' and class_id='$class_id' and student_id='$student_id'");
$count = mysqlI_num_rows($query);

if($count !=0)
{
	echo "<script>alert('Already Given')</script>";
	echo "<script>document.location='student-dashboard.php'</script>";

}

$sql="select question_id as ai,question from assessment_questions where assessment_id='SA'";
$query=mysqli_query($con,$sql);

if(isset($_POST['submit']))
{
	$sql="select question_id as ai from assessment_questions where assessment_id='SA'";
	$query=mysqli_query($con,$sql);
	foreach($query as $data)
	{
		$d = $data['ai'];
		$mark = $_POST[$d];

		$insert = mysqli_query($con,"INSERT INTO `student_self_assesment` (`school_id`, `student_id`, `question_id`, `class_id`, `marks`) VALUES ('$school_id', '$student_id', '$d', '$class_id', '$mark')");
	}
	echo "<script>document.location='student-dashboard.php'</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Student-Self-Assessment</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" href="assets/img/favicon.png">
	
		<!-- Fontfamily -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&display=swap">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

		<!-- Select CSS -->
		<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
		
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
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h5 class="page-title">Student-Self-Assessment</h5>
								<ul class="breadcrumb">
									<!-- <li class="breadcrumb-item"><a href="school-admin-section-list.php">Section-list</a></li>
									<li class="breadcrumb-item active">Add Section</li> -->
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
										<table class="table table-hover table-center">
											<thead>
												<tr>
													<th>S No</th>
													<th>Question</th>
													<th>Mark</th>
												</tr>
											</thead>
											<form method="post">
												<tbody>
													<?php
														$i = 0;
														foreach($query as $data)
														{
															echo
															'<tr>
																<td>'.++$i.'</td>
																<td name="'.$data['ai'].'">'.$data['question'].'</td>
																<td>
																	<div class="form-group">
																	<div>
																		<select name="'.$data['ai'].'" class="form-control form-select"required>
																			<option value="">-- Select --</option>
																			<option value=1>1</option>
																			<option value=2>2</option>
																			<option value=3>3</option>
																			<option value=4>4</option>
																			<option value=5>5</option>
																		</select>
																	</div>
																</td>
															</tr>';
														}
													?>
												</tbody>
												<input type="submit" class="btn btn-primary" name="submit">
											</form>
										</table>
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

		<!-- Select2 JS -->
		<script src="assets/plugins/select2/js/select2.min.js"></script>

		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
    </body>
</html>
