<?php session_start();


include'connect.php';

if(empty($_SESSION['SCHOOL_ID']))
{
    header('location:index.php');
}
else{

$school_id=$_SESSION['SCHOOL_ID'];
$std=" select  c.class, section,subject_name,teacher_name  from classes as c,schoolwise_class_subject_teachers as sc,teacher_info as t,subjects as s where sc.school_id='$school_id' and sc.class_id=c.class_id and sc.teacher_id=t.teacher_id and sc.subject_id=s.subject_id";

if(isset($_POST['submit'])) {
    if($_POST['select']=='6th') {   //<=========== 'select'
        $std=" select  c.class, section,subject_name,teacher_name  from classes as c,schoolwise_class_subject_teachers as sc,teacher_info as t,subjects as s where sc.school_id='$school_id' and sc.class_id=c.class_id and sc.teacher_id=t.teacher_id and sc.subject_id=s.subject_id and (sc.class_id='CL0601' or sc.class_id='CL0602' or sc.class_id='CL0603' or sc.class_id='CL0604')" ;
    }
    elseif($_POST['select']=='7th') {   //<=========== 'select'
        $std="  select  c.class, section,subject_name,teacher_name  from classes as c,schoolwise_class_subject_teachers as sc,teacher_info as t,subjects as s where sc.school_id='$school_id' and sc.class_id=c.class_id and sc.teacher_id=t.teacher_id and sc.subject_id=s.subject_id  and (sc.class_id='CL0701' or sc.class_id='CL0702' or sc.class_id='CL0703' or sc.class_id='CL0704')";
  }
    elseif($_POST['select']=='8th'){
        $std="  select  c.class, section,subject_name,teacher_name  from classes as c,schoolwise_class_subject_teachers as sc,teacher_info as t,subjects as s where sc.school_id='$school_id' and sc.class_id=c.class_id and sc.teacher_id=t.teacher_id and sc.subject_id=s.subject_id and (sc.class_id='CL0801' or sc.class_id='CL0802' or sc.class_id='CL0803' or sc.class_id='CL0804')";
    }
    elseif($_POST['select']=='9th'){
        $std="  select  c.class, section,subject_name,teacher_name  from classes as c,schoolwise_class_subject_teachers as sc,teacher_info as t,subjects as s where sc.school_id='$school_id' and sc.class_id=c.class_id and sc.teacher_id=t.teacher_id and sc.subject_id=s.subject_id and (sc.class_id='CL0901' or sc.class_id='CL0902' or sc.class_id='CL0903' or sc.class_id='CL0904')";
    }
    elseif($_POST['select']=='10th'){
        $std="  select  c.class, section,subject_name,teacher_name  from classes as c,schoolwise_class_subject_teachers as sc,teacher_info as t,subjects as s where sc.school_id='$school_id' and sc.class_id=c.class_id and sc.teacher_id=t.teacher_id and sc.subject_id=s.subject_id and (sc.class_id='CL1001' or sc.class_id='CL1002' or sc.class_id='CL1003' or sc.class_id='CL1004')";
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

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">Section Wise</h3>
<ul class="breadcrumb">
<!-- <li class="breadcrumb-item"><a href="teacher-dashboard.php"></a></li>
<li class="breadcrumb-item active">Students</li> -->
</ul>
</div>
<!-- <div class="col-auto text-end float-end ms-auto"> -->
<!-- <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
<a href="add-student.php" class="btn btn-primary"><i class="fas fa-plus"></i></a>
</div> -->
</div>
</div>


<div>
<form class="filteroption" action="" method="post">
    <select id="select" name="select" >
        
        <option value="6th" selected="selected">6</option>
        <option value="7th" selected="selected">7</option>
        <option value="8th" selected="selected">8</option>
        <option value="9th" selected="selected">9</option>
        <option value="10th" selected="selected">10</option>
        <option value=0 selected="selected">select class</option>
    </select>
    <input  class="btn btn-primary" type="submit" name="submit" value="submit">
          </form>


</div>

<div class="row">
<div class="col-sm-12">
<div class="card card-table">
<div class="card-body">
<div class="table-responsive">
<table class="table table-hover table-center mb-0 datatable">
<thead>
<tr>
<th>class</th>
<th>section</th>
<th>Subject Name</th>
<!--  <th>DOB</th> -->
<th>Teacher Name</th>
<!-- <th>EMAIL</th> -->
<!-- <th>Address</th> --> 
<!-- <th class="text-end">Action</th> -->
</tr>
</thead>
<tbody>
 <?php
foreach ($result as $data) 
{
       $stdname=$data['subject_name'];
       $std_id=$data['class'];
       $date=$data['section'];
       $teacher=$data['teacher_name'];
    //    $addres=$data['address'];
    //    $mail=$data['email'];
    echo
    '<tr>
<td>'.$std_id.'</td>
<td>'.$date.'</td>
<td>'.$stdname.'</td>
<td>'.$teacher.'</td>
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


<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="assets/plugins/datatables/datatables.min.js"></script>

<script src="assets/js/script.js"></script>
</body>
</html>