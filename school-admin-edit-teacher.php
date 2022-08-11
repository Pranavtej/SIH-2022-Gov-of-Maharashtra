<?php session_start();


include'connect.php';

if(empty($_SESSION['SCHOOL_ID']))
{
    header('location:index.php');
}
else{

$school_id=$_SESSION['SCHOOL_ID'];
$std=" select teacher_id , teacher_name ,teacher_dob,teacher_email,teacher_mob from teacher_info where school_id='$school_id'";
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
								<h3 class="page-title">Edit Teacher</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="school-admin-teacher-list.php">Teacher-list</a></li>
									<li class="breadcrumb-item active">Edit Teacher</li>
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
<table class="table table-hover table-center mb-0 datatable">
<thead>
<tr>
<th>ID</th>
<th>Name</th>
<th>DOB</th>
<th></th>
<th>Subject</th>
<th>Edit Teacher Details</th>
<!-- <th class="text-end">Action</th> -->
</tr>
</thead>
<tbody>
 <?php
foreach ($result as $data) 
{
       $tname=$data['teacher_name'];
       $t_id=$data['teacher_id'];
       $sql="select distinct subject_name from subjects as s,schoolwise_class_subject_teachers as st,teacher_info as t where st.teacher_id='$t_id' and st.subject_id=s.subject_id";
       $res=mysqli_query($con,$sql);
       $res=mysqli_fetch_assoc($res);
       $m=implode("",$res);
       $date=$data['teacher_dob'];
    //    $class_id=$data['class_id'];
    //    $addres=$data['address'];
       $mail=$data['teacher_email'];
	   $mob=$data['teacher_mob'];
    echo
    '<tr>
<td>'.$t_id.'</td>
<td>
<a href="school-admin-teacher-dashboard.php?teacher_id='.$t_id.'&teacher_name='.$tname.'&teacher_dob='.$date.'&email='.$mail.'">'.$tname.'</a>
</h2>
</td>
<td>'.$date.'</td>
<td></td>
<td>'.$m.'</td>
<td> <a href="school-admin-teacher-edit.php?teacher_id='.$t_id.'&teacher_name='.$tname.'&teacher_dob='.$date.'&email='.$mail.'&mob='.$mob.'">
<button class="btn btn-primary">
    Edit Teacher
</button>
</a></td
<td class="text-end">';
}
?> 
<tbody>
</table>


</div>
</div>
</div>
</div></div>
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

