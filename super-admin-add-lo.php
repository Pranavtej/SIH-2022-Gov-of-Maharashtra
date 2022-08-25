<?php
session_start();
include 'connect.php';
$subject_id=$_GET['subject_id'];
$class=$_GET['class'];
if(isset($_POST['submit']))
    {
        $loc_id=$_POST['loc_id'];
        $loc=$_POST['loc'];
        $stat2="INSERT INTO `learning_outcomes`(`loc_id`, `class`, `subject_id`, `loc`) VALUES ('$loc_id','$class','$subject_id','$loc')";
        $run2=mysqli_query($con,$stat2);}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title> Subject</title>

<link rel="shortcut icon" href="assets/img/favicon.png">

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&display=swap">

<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>



    <div class="page-wrapper">
        <?php include 'super-admin-menu.php' ?>
            <div class="content container-fluid">
                <div class="page-header">

                    <div class="row align-items-center">
                    <div class="row align-items-center">    
                    <div class="col">
                        <h3 class="page-title">Admin Adding Learning Outcome For <?php echo $subject_id;?> </h3>
                        <ul class="breadcrumb">
                        <li class="breadcrumb-item">SuperAdmin</li>
                        <li class="breadcrumb-item active">Add Learning Outcome</li></ul><br>
                </div>
            </div>
    </div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form method="post">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Learning Outcome_id</label>
                                    <input type="text"  name="loc_id" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label>Learning Outcome_id</label>
                                    <input type="text"  name="loc" class="form-control">
                                </div>
                            </div>
                        </div>

                     <div class="col-12">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                     </div>
                    </div>
                </form>
            </div>
        </div>
   </div>
</div>
<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="assets/js/script.js"></script>
</body>
</html>