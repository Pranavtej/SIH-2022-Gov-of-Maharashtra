<?php
session_start();

include 'connect.php';
	
 include 'school-admin-sidebar.php';
	$class_id=$_GET['class_id'];
    $subject_id=$_GET['subject_id'];				
    $subject=$_GET['subject_name'];
     $teacher_id=$_GET['teacher_id'];
     $section=$_GET['section'];
if(isset($_POST['submit']))
{

	$class_id = $_POST['class_id'];
    $school_id=$_SESSION['SCHOOL_ID'];
    $teacher_id=$_POST['teacher_id'];
    $name=$_POST['name'];
   

	
	$insert = "UPDATE subjects SET subject_name='$name' where subject_id='$subject_id'";
	$insert2 = mysqli_query($con,$insert);
    $insert = "UPDATE  schoolwise_class_subject_teachers SET school_id='$school_id',class_id='$class_id',teacher_id='$teacher_id'
			  where subject_id='$subject_id'";
	$insert2 = mysqli_query($con,$insert);
 
}



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

		<!-- Select CSS -->
		<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			
            <?php include 'school-admin-header.php';?>
			<?php include 'school-admin-sidebar.php';?>
           
		
				
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Edit Subject</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="school-admin-subject-list.php">Subjects-list</a></li>
									<li class="breadcrumb-item active">Edit Subject</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
				
					<div class="row">
						<div class="col-sm-12">
						
							<div class="card">
								<div class="card-body">
									<form action="" method="post">
										<div class="row">
											<div class="co-l-12">
												<h5 class="form-title"><span>Section Information</span></h5>
											</div>
                                            <div class="col-12 col-sm-6">
												<div class="form-group">
													<label>Subject id</label>
													<div>
														<input type="constant" name="subject_id" class="form-control" value="<?php echo $subject_id?>" disabled>
													</div>
												</div>
											</div>
										
											<div class="col-12 col-sm-6">
												<div class="form-group">
													<label>Subject name</label>
													<input type="Text" name="name" class="form-control"  value="<?php echo $subject?>" >
												</div>
											</div>
                                          
											<div class="col-12 col-sm-6">  
												<div class="form-group">
													<label>Class id</label>
													<input type="text"  name="class_id" class="form-control"  value="<?php echo $class_id?>">
												</div>
											</div>
											<!-- <div class="col-12 col-sm-6">
												<div class="form-group">
													<label>Last Name</label>
													<input type="text" class="form-control">
												</div>
											</div> -->
											<div class="col-12 col-sm-6">  
												<div class="form-group">
													<label>Teacher Id</label>
													<input type="text" name="teacher_id" class="form-control"  value="<?php echo $teacher_id?>">
												</div>
											</div>
                                           
											<div class="col-12">
												<button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
											</div>

										</div>
                                        </form>
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

