 <?php session_start();


include'connect.php';

if(empty($_SESSION['SCHOOL_ID']))
{
    header('location:index.php');
}
else{

$school_id=$_SESSION['SCHOOL_ID'];
$std=" select s.student_id as student_id , s.student_name as student_name ,s.date_of_birth as date_of_birth,s.address as address,s.email as email,c.class as class,c.section as section from student s,classes c where s.school_id='$school_id' and s.class_id = c.class_id";
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
<!-- <div class="col">
<h3 class="page-title">Students</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="teacher-dashboard.php">Dashboard</a></li>
<li class="breadcrumb-item active">Students</li>
</ul>
</div> -->
<!-- <div class="col-auto text-end float-end ms-auto">
<a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
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
<table id="myTable" class="table table-hover table-center mb-0 datatable">
<thead>
<tr>
<th>ID</th>
<th>Name</th>
<th>Class</th>
<th>Section</th>
<th>DOB</th>
<th>EMAIL</th>
<th>Address</th>
<!-- <th class="text-end">Action</th> -->
</tr>
</thead>
<tbody>
 <?php
foreach ($result as $data) 
{
       $stdname=$data['student_name'];
       $student_id=$data['student_id'];
       $date=$data['date_of_birth'];
       $class=$data['class'];
       $section = $data['section'];
       $addres=$data['address'];
       $mail=$data['email'];
    echo
    '<tr>
<td>'.$student_id.'</td>
<td>
<a href="school-admin-student-dashboard.php?std_id='.$student_id.'">'.$stdname.'</a>
</h2>
</td>
<td>'.$class.'</td>
<td>'.$section.'</td>
<td>'.$date.'</td>
<td>'.$mail.'</td>
<td>'.$addres.'</td>
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

<script>
    const searchFun = () => {
        let filter = document.getElementById('class').value;
        
        let myTable = document.getElementById('myTable');
        
        let tr = myTable.getElementsByTagName('tr');

        for(var i=0;i<tr.length;i++){
            let td = tr[i].getElementsByTagName('td')[2];
        
            if(td){
                let textvlaue = td.textContent || td.innerHTML;
                if(textvlaue.toUpperCase().indexOf(filter)>-1){
                    tr[i].style.display = "";
                }
                else{
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
</body>
</html>