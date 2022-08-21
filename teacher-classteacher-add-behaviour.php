<?php
    session_start();
    include'connect.php';
    $class_id = $_GET['cid'];
    $student_id = $_GET['sid'];
    $school_id = $_SESSION['SCHOOL_ID'];
    $teacher_id = $_SESSION['TEACHER_ID'];
    $student_name = $_GET['sname'];
    $query="select classroom_behaviour from behaviour_points where student_id='$student_id' and school_id='$school_id'";
    $result=mysqli_query($con,$query);
    $details=mysqli_fetch_assoc($result);
    $oldbehave=(int)$details['classroom_behaviour'];
    $points = 0;
    $points = $oldbehave;
    if(isset($_POST['submit']))
    {
        $nd = 0;
        $nc = 0;
        $nb=$_POST['behave'];
        $re=$_POST['reason'];
        $oldbehave=(int)$oldbehave+(int)$nb;
        $points=$oldbehave;
 
        $query2="update behaviour_points set classroom_behaviour='$oldbehave'
        where student_id='$student_id' and school_id='$school_id'";
        $result2=mysqli_query($con,$query2) or die(mysqli_error);
        if($result2){
             $qu="INSERT INTO `log_classteacher_addbehavior`(`student_id`, `teacher_id`, `points`, `purpose`) 
             VALUES ('$student_id','$teacher_id','$nb','$re')";
             $re=mysqli_query($con,$qu) or die(mysqli_error);
             echo "<script>header.location='teacher-classteacher-add-behaviour.php?sid=$student_id&
             cid=$class_id&sname=$student_name'</script>";
        }
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
                    <div class="row align-items-center">    
                    <div class="col">
                        <h3 class="page-title">Teacher Adding Peformance Score for Student </h3>
                        <ul class="breadcrumb">
                        <li class="breadcrumb-item">STUDENT</li>
                        <li class="breadcrumb-item active">Add Performance Marks</li></ul><br>
                        <div class="row">
                        <div class="col-md-12">
                        <h4><b>Name of the Student : </b><?php echo $student_name.'('.$student_id.')';?></h4>
                        <h4><b>Current Student Points : </b><?php echo $points;?></h4></div></div>
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
                                    <label>Classroom Behaviour Points</label>
                                    <input type="number"  name="behave" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label>Purpose For Adding Points</label>
                                    <input list="reasons" name="reason" id="reason" class="form-control">
                                    <datalist id="reasons">
                                        <option  value="Good behaviour in the class">
                                        <option  value="attentiveness in the class">
                                        <option value="Not so attentive in the class">
                                        <option  value="Rude behaviour in the class">
                                        <option  value="Well dressed">
                                    </datalist>
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