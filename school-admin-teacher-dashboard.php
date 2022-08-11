
<?php
include 'connect.php';
$teacher_id = $_GET['teacher_id'];
$sql = "select school_id from teacher_info where teacher_id='$teacher_id'";
    $run = mysqli_query($con,$sql);
    $run = mysqli_fetch_assoc($run);
    if(!empty($run))
    {
        $sid = $run['school_id'];
        //$_SESSION['TEACHER_ID'] = $_POST['teacher_id'];
		$sql = "select class_id from schoolwise_class_details where teacher_id='$teacher_id' and school_id='$sid'";
    	$run1 = mysqli_query($con,$sql);
    	$run1 = mysqli_fetch_assoc($run1);
		if(!empty($run1))
		{
			//$_SESSION['CLASS_ID'] = $run1['class_id'];
			echo "<script>document.location='school-admin-teacher-classteacher-dashboard.php?teacher_id=$teacher_id'</script>";
		}
		else
		{
			echo "<script>document.location='school-admin-teacher-teacher-dashboard.php?teacher_id=$teacher_id'</script>";
		}
    }
    ?>