<?php

include 'connect.php';
$school_id = $_GET['schoolid'];
$state_id = $_GET['stateid'];
$district_id=$_GET['districtid'];
$school_address=$_GET['schooladdress'];
$school_name=$_GET['schoolname'];
$state_name = $_GET['statename'];
$district_name=$_GET['districtname'];
$query="SELECT state_id , state_name  from states";
$run=mysqli_query($con,$query);
$query1="SELECT district_id , district_name  from districts";
$run1=mysqli_query($con,$query1);

if(isset($_POST['UPDATE-SCHOOL']))
{
    $school_id=$_POST['school_id'];
    $school_name=$_POST['school_name'];
    $state_id=$_POST['state'];
    $district_id=$_POST['district'];
    $school_address=$_POST['school_address'];
    $query3="INSERT INTO `school_info`(`school_id`, `state_id`, `district_id`, `school_name`, `school_address`)
     VALUES ('$school_id','$state_id','$district_id','$school_name','$school_address')";
    $run3=mysqli_query($con,$query3);
    if($run3)
    {
        echo" <script>document.location='super-admin-dashboard.php?pid=$pid'</script>";
    }
    else
    {
        echo "<script>alert(' not inserted successfully')</script>";   
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>SuperAdmin-EDIT-SCHOOL</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" href="assets/img/favicon.png">
		
		
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&display=swap">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

		<!-- Feather CSS -->
		<link rel="stylesheet" href="assets/plugins/icons/feather/feather.css">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
		
		<!-- Datepicker CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="assets/css/style.css">
	</head>
	<body>
        <?php include "super-admin-menu.php";?>
        <div class="page-wrapper">
			
            <div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">SCHOOLS</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="super-admin-dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item active">UPDATE SCHOOL</li>
								</ul>
							</div>
                </div>			
                <BR>    
				<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<form method="post" class="needs-validation" >
										<h5 class="card-title">School Information</h5>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>SCHOOL-ID</label>
													<input type="text" name='school_id' id='school_id' class="form-control"  value='<?php echo $school_id;  ?>' disabled="disabled" required>
												</div>
												<div class="form-group">
													<label>STATE</label>
													<input type="text" name='district_id' id='district_id' class="form-control"  value='<?php echo $state_id.'-'.$state_name;?>' disabled="disabled" required>
												</div>
												<div class="form-group">
													<label>DISTRICT</label>
													<input type="text" name='district_id' id='district_id' class="form-control"  value='<?php echo $district_id.'-'.$district_name;?>' disabled="disabled" required>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>SCHOOL-NAME</label>
													<input  name='school_name' value='<?php echo $school_name; ?>'id='school_name' type="text" class="form-control" required>
												</div>

												<div class="form-group">
													<label>SCHOOL-ADDRESS</label>
													<textarea type="text" name='school_address'  id='school_address' class="form-control" required> <?php echo $school_address; ?> </textarea>
												</div>
											</div>
										</div>
										<div class="text-end">
											<button type="submit" name="UPDATE-SCHOOL" id="UPDATE-SCHOOL" class="btn btn-primary">UPDATE-SCHOOL</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

</div>
</div>

		<script src="assets/js/jquery-3.6.0.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		
		<!-- Feather Icon JS -->
		<script src="assets/js/feather.min.js"></script>
		
		<!-- Slimscroll JS -->
		<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		
		<!-- Select2 JS -->
		<script src="assets/plugins/select2/js/select2.min.js"></script>

		<!-- Datepicker Core JS -->
		<script src="assets/plugins/moment/moment.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>

	</body>
</html>