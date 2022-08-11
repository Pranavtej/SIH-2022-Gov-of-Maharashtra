<?php session_start();


include 'connect.php';
include "school-admin-sidebar.php";

if(empty($_SESSION['SCHOOL_ID']))
{
    header('location:index.php');
}
else{

$school_id=$_SESSION['SCHOOL_ID'];
$std=" select c.class, c.section,c.class_id,sc.teacher_id  from classes as c,schoolwise_class_details as sc where sc.school_id='$school_id' and sc.class_id=c.class_id";

if(isset($_POST['submit'])) {
    if($_POST['select']=='6th') {   //<=========== 'select'
        $std=" select class , section ,c.class_id,sc.teacher_id  from classes as c,schoolwise_class_details as sc where sc.school_id='$school_id' and sc.class_id=c.class_id and (sc.class_id='CL0601' or sc.class_id='CL0602' or sc.class_id='CL0603' or sc.class_id='CL0604')" ;
    }
    elseif($_POST['select']=='7th') {   //<=========== 'select'
        $std=" select class , section,c.class_id,sc.teacher_id   from classes as c,schoolwise_class_details as sc where sc.school_id='$school_id' and sc.class_id=c.class_id  and (sc.class_id='CL0701' or sc.class_id='CL0702' or sc.class_id='CL0703' or sc.class_id='CL0704')";
  }
    elseif($_POST['select']=='8th'){
        $std=" select class , section,c.class_id,sc.teacher_id   from classes as c,schoolwise_class_details as sc where sc.school_id='$school_id' and sc.class_id=c.class_id and (sc.class_id='CL0801' or sc.class_id='CL0802' or sc.class_id='CL0803' or sc.class_id='CL0804')";
    }
    elseif($_POST['select']=='9th'){
        $std=" select class , section ,c.class_id,sc.teacher_id  from classes as c,schoolwise_class_details as sc where sc.school_id='$school_id' and sc.class_id=c.class_id and (sc.class_id='CL0901' or sc.class_id='CL0902' or sc.class_id='CL0903' or sc.class_id='CL0904')";
    }
    elseif($_POST['select']=='10th'){
        $std=" select class , section ,c.class_id,sc.teacher_id  from classes as c,schoolwise_class_details as sc where sc.school_id='$school_id' and sc.class_id=c.class_id and (sc.class_id='CL1001' or sc.class_id='CL1002' or sc.class_id='CL1003' or sc.class_id='CL1004')";
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
								<h3 class="page-title">Edit Sections</h3>
								<ul class="breadcrumb">
									<!-- <li class="breadcrumb-item"><a href="school-admin-subject-list.php">Subjects-list</a></li> -->
									<li class="breadcrumb-item active">Edit Section</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
									
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
<th>Class id</th>
<th>Edit Section Details</th>
<!-- <th>DOB</th>
<th>Parent Name</th>
<th>EMAIL</th>
<th>Address</th> -->
<!-- <th class="text-end">Action</th> -->
</tr>
</thead>
<tbody>
 <?php
foreach ($result as $data) 
{
       $class_id=$data['class_id'];
       $teacher_id=$data['teacher_id'];
       $class=$data['class'];
       $section=$data['section'];
    //    $class_id=$data['class_id'];
    //    $addres=$data['address'];
    //    $mail=$data['email'];
    echo
    '<tr>
    
    <td>'.$class.'</td>
    <td>'.$section.'</td>
    <td>'.$class_id.'</td>
<td> <a href="school-admin-section-edit.php?class_id='.$class_id.'&teacher_id='.$teacher_id.'&class='.$class.'&section='.$section.'">
<button class="btn btn-primary">
    Edit Section
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

