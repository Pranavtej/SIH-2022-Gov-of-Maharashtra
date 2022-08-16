<?php 

include'connect.php';
session_start();
$school_id = $_SESSION['SCHOOL_ID'];
$teacher_id = $_SESSION['TEACHER_ID'];
$class_id = $_SESSION['CLASS_ID'];

if(empty($_SESSION['SCHOOL_ID']))
{
    header('location:index.php');
}
else{

$school_id=$_SESSION['SCHOOL_ID'];
$std=" select s.student_id as student_id ,c.class as class, c.section as section, s.student_name as student_name ,s.date_of_birth as date_of_birth,s.address as address,s.email as email,s.class_id as class_id,s.gender as gender from student s,classes c where s.school_id='$school_id' and s.class_id ='$class_id' and s.class_id=c.class_id";
$result=mysqli_query($con,$std) or die(mysqli_error);
$res=mysqli_fetch_array($result);
$counter=mysqli_num_rows($result);
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
			
        <?php include 'teacher-header.php' ?>
        <?php include 'teacher-sidebar.php' ?>
		
				
			<!-- Page Wrapper -->
            <div class="page-wrapper">
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title"><?php echo $res['class'].'-'.$res['section']; ?> Class Students</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="teacher-classteacher-dashboard.php">ClassTeacher Dashboard</a></li>
                                <li class="breadcrumb-item active">Student List</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
              <div>
              <br>
              </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0 datatable">
                                        <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Edit Student Details</th>
                                                <!-- <th class="text-end">Action</th> -->
                                                </tr>
                                            </thead>
                                        <tbody>
                                        <?php
                                        foreach ($result as $data) 
                                        {
                                            $stdname=$data['student_name'];
                                            $std_id=$data['student_id'];
                                            $date=$data['date_of_birth'];
                                            $class_id=$data['class_id'];
                                            $gender=$data['gender'];
                                            $address=$data['address'];
                                            $mail=$data['email'];
                                            echo
                                            '<tr>
                                                <td>'.$std_id.'</td>
                                                <td>
                                                <a href="teacher-student-view.php?student_id='.$std_id.'">'.$stdname.'</a>
                                                </td>
                                                <td><a href="teacher-classteacher-student-edit-profile.php?student_id='.$std_id.'&student_name='.$stdname.'&dob='.$date.'&class_id='.$class_id.'&gender='.$gender.'&address='.$address.'&email='.$mail.'" class="btn btn-primary">
                                                 <i class="fas fa-edit "></i>Edit Student
                                                </a></td>
                                                <td class="text-end">';
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

