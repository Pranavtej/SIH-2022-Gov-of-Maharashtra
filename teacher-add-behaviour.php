<?php
    session_start();
    include'connect.php';
    $class_id = $_GET['cid'];
    $student_id = $_GET['sid'];
    $school_id = $_SESSION['SCHOOL_ID'];
    
    $query="select classroom_behaviour,classroom_attentiveness from behaviour_points where student_id='$student_id' and school_id='$school_id'";
    $result=mysqli_query($con,$query);
    $details=mysqli_fetch_assoc($result);
    $oldbehave=(int)$details['classroom_behaviour'];
    $oldclasss=(int)$details['classroom_attentiveness'];
    $points = 0;
    $points = $oldbehave+$oldclasss;
    if(isset($_POST['submit']))
    {
        $nd = 0;
        $nc = 0;
        $nb=$_POST['behave'];
        $nc=$_POST['ca'];
        $oldbehave=(int)$oldbehave+(int)$nb;
        $oldclasss=(int)$oldclasss+(int)$nc;
        $points=$oldbehave+$oldclasss;
        $query2="update behaviour_points set classroom_behaviour='$oldbehave', classroom_attentiveness='$oldclasss' where student_id='$student_id' and school_id='$school_id'";
        $result2=mysqli_query($con,$query2) or die(mysqli_error);
        echo "<script>header.location='teacher-add-behaviour.php?sid=$student_id&cid=$class_id'</script>";
    }
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
<?php include 'teacher-header.php' ?>
<?php include 'teacher-sidebar.php' ?>
<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">Add Performance</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item">STUDENT</li>
<li class="breadcrumb-item active">Add Performance Marks</li>
</ul>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card">
<div class="card-body">
<form method="post">
<div class="row">
<div class="col-12">
<h5 class="form-title"><span>Academic Points</span></h5>
</div>
<div class="col-12 col-sm-6">
<div class="form-group">
<label>Student ID</label>
<input type="text"  class="form-control" disabled="disabled" value=<?php echo  $student_id;?>>
</div>
</div>
<div class="col-12 col-sm-6">
<div class="form-group">
<label>Classroom Behaviour</label>
<input type="number"  name="behave" class="form-control">
</div>
</div>
<div class="col-12 col-sm-6">
<div class="form-group">
<label>Classroom Attentiveness</label>
<input type="number" name="ca" class="form-control">
</div>
</div>
<div class="col-12 col-sm-6">
<div class="form-group">
<label>Current Points</label>
<input type="number" name="cp" value="<?php echo $points; ?>" disabled="disabled" class="form-control">
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
</div>
</div>

</div>


<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="assets/js/script.js"></script>
</body>
</html>