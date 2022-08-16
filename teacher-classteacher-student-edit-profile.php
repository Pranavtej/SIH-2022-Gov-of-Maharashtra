<?php
session_start();

include 'connect.php';
	
 include 'school-admin-sidebar.php';	
 $school_id=$_SESSION['SCHOOL_ID'];
 $stdname=$_GET['student_name'];
 $std_id=$_GET['student_id'];
 $dob=$_GET['dob'];
 $class_id=$_GET['class_id'];
 $gender=$_GET['gender'];
 $address=$_GET['address'];
 $mail=$_GET['email'];				
 

if(isset($_POST['submit']))
{

	$name = $_POST['name'];
	$class_id = $_POST['classid'];
    $student_id=$_POST['student_id'];
    $email=$_POST['mail'];
    $dob=$_POST['dob'];
    $gender=$_POST['gender'];
    $ads=$_POST['ads'];

	
	$insert = "UPDATE student SET student_name='$name', date_of_birth='$dob', gender='$gender',email='$email',address='$ads',class_id='$class_id' where student_id='$std_id' ";
	$insert2 = mysqli_query($con,$insert);
    if($insert2)
    {
        echo" <script>document.location='teacher-classteacher-students-edit.php'</script>";
    }
  
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
			
            <?php include 'teacher-header.php';?>
			<?php include 'teacher-sidebar.php';?>
		
				
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Edit Student Profile</h3>
								<ul class="breadcrumb">
								
                                    <li class="breadcrumb-item"><a href="teacher-classteacher-dashboard.php">ClassTeacher Dashboard</a></li>
									<li class="breadcrumb-item"><a href="teacher-classteacher-students-edit.php">Student List</a></li>
									<li class="breadcrumb-item active">Edit Student Profile</li>
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
												<h5 class="form-title"><span>Student Information</span></h5>
											</div>
                                          
											<div class="col-12 col-sm-6">  
												<div class="form-group">
													<label>Name</label>
													<input type="text" name="name" class="form-control" value="<?php echo $stdname ?>" >
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
													<label>Student Id</label>
													<input type="text" name="student_id" class="form-control" value="<?php echo $std_id ?>" disabled>
												</div>
											</div>
											<div class="col-12 col-sm-6">
												<div class="form-group">
													<label>Gender</label>
													<input type="text" name="gender" class="form-control" value="<?php echo $gender ?>">
												</div>
											</div>
											<div class="col-12 col-sm-6">
												<div class="form-group">
													<label>Date of Birth</label>
													<div>
														<input type="date" name="dob" class="form-control" value="<?php echo $dob ?>">
													</div>
												</div>
											</div>
											<div class="col-12 col-sm-6">
												<div class="form-group">
													<label>Class_id</label>
													<input type="text" name="classid" class="form-control" value="<?php echo $class_id ?>">
												</div>
											</div>
											<div class="col-12 col-sm-6">
												<div class="form-group">
													<label>Email</label>
													<input type="email" name="mail" class="form-control" value="<?php echo $mail ?>">
												</div>
											</div>
                                            <div class="col-12 col-sm-6">
												<div class="form-group">
													<label>address</label>
													<input type="text" name="ads" class="form-control" value="<?php echo $address ?>">
												</div>
											</div>
											<!-- <input type="file" name="file" value="Upload File"> -->
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