<?php session_start();


include'connect.php';

if(empty($_SESSION['SCHOOL_ID']))
{
    header('location:index.php');
}
else{

$school_id=$_SESSION['SCHOOL_ID'];
$std=" select teacher_id , teacher_name ,teacher_dob,teacher_email from teacher_info where school_id='$school_id'";
$result=mysqli_query($con,$std) or die(mysqli_error);
$counter=mysqli_num_rows($result);
}
$sql="select school_name from school_info where school_id='$school_id'";
$run = mysqli_fetch_assoc(mysqli_query($con,$sql));
$school_name=$run['school_name'];
?> 


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Preskool - Students</title>

<link rel="shortcut icon" href="assets/img/favicon.png">

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&display=swap">

<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">

<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>


<div class="main-wrapper">
    <?php include 'school-admin-header.php';?>
                <?php include 'school-admin-sidebar.php';?>
    <div class="page-wrapper">
    <div class="content container-fluid">
    <div class="content container-fluid">
    
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title"><?php echo $school_name; ?></h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="school-admin-dashboard.php">SchoolAdmin Dashboard</a></li>
                    <li class="breadcrumb-item active">School Teachers List</li>
                </ul>
            </div>
        </div>
    </div>

<div class="col-auto text-end float-end ms-auto">
<a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
<a href="add-student.php" class="btn btn-primary"><i class="fas fa-plus"></i></a>
</div>
</div>
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
<th>DOB</th>
<th></th>
<th>Subject</th>
<th>EMAIL</th>
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
    echo
    '<tr>
<td>'.$t_id.'</td>
<td>
<a href="school-admin-teacher-view.php?teacher_id='.$t_id.'">'.$tname.'</a>
</h2>
</td>
<td>'.$date.'</td>
<td></td>
<td>'.$m.'</td>
<td>'.$mail.'</td>
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


<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="assets/plugins/datatables/datatables.min.js"></script>

<script src="assets/js/script.js"></script>
</body>
</html>