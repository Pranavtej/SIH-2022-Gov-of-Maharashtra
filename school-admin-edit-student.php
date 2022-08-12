<?php session_start();


include'connect.php';

if(empty($_SESSION['SCHOOL_ID']))
{
    header('location:index.php');
}
else{

$school_id=$_SESSION['SCHOOL_ID'];
$std=" select student_id , student_name ,date_of_birth,address,email,class_id,gender from student where school_id='$school_id'";
if(isset($_POST['submit'])) {
    if($_POST['select']=='6th') {   //<=========== 'select'
        $std=" select student_id , student_name ,date_of_birth,address,email,class_id,gender from student where school_id='$school_id' and (class_id='CL0601' or class_id='CL0602' or class_id='CL0603' or class_id='CL0604') ";
    }
    elseif($_POST['select']=='7th') {   //<=========== 'select'
        $std=" select student_id , student_name ,date_of_birth,address,email,class_id,gender from student where school_id='$school_id' and class_id='CL0701' or class_id='CL0702' or class_id='CL0703' or class_id='CL0704' ";
    }
    elseif($_POST['select']=='8th'){
        $std=" select student_id , student_name ,date_of_birth,address,email,class_id,gender from student where school_id='$school_id' and class_id='CL0801' or class_id='CL0802' or class_id='CL0803' or class_id='CL0804' ";
    }
    elseif($_POST['select']=='9th'){
        $std=" select student_id , student_name ,date_of_birth,address,email,class_id,gender from student where school_id='$school_id' and class_id='CL0901' or class_id='CL0902' or class_id='CL0903' or class_id='CL0904' ";
    }
    elseif($_POST['select']=='10th'){
        $std=" select student_id , student_name ,date_of_birth,address,email,class_id,genderfrom student where school_id='$school_id' and class_id='CL1001' or class_id='CL1002' or class_id='CL1003' or class_id='CL1004' ";
    }
    else{

    }

    $result=mysqli_query($con,$std) or die(mysqli_error);
    $counter=mysqli_num_rows($result);
    
}
$result=mysqli_query($con,$std) or die(mysqli_error);
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
			
            <?php include 'school-admin-header.php';?>
			<?php include 'school-admin-sidebar.php';?>
		
				
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Edit Student</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="school-admin-section-list.php">Student-list</a></li>
									<li class="breadcrumb-item active">Edit Student</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
<div>
<form class="filteroption" action="" method="post">
    <select id="select" class="form-select" name="select" >
        
        <option value="6th" selected="selected">6</option>
        <option value="7th" selected="selected">7</option>
        <option value="8th" selected="selected">8</option>
        <option value="9th" selected="selected">9</option>
        <option value="10th" selected="selected">10</option>
        <option value=0 selected="selected">select class</option>
    </select>
    <br>
    <input  class="btn btn-primary" type="submit" name="submit" value="submit">
        
</form>
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
<th>Class</th>
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
<a href="school-admin-student-dashboard.php?student_id='.$std_id.'">'.$stdname.'</a>
</h2>
</td>
<td>'.$class_id.'</td>
<td><a href="school-admin-student-edit.php?student_id='.$std_id.'&student_name='.$stdname.'&dob='.$date.'&class_id='.$class_id.'&gender='.$gender.'&address='.$address.'&email='.$mail.'">
<button class="btn btn-primary">
    Edit Student
</button>
</a></td>
<td class="text-end">';
}
?> 
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

		<!-- Select2 JS -->
		<script src="assets/plugins/select2/js/select2.min.js"></script>

		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
    </body>
</html>

