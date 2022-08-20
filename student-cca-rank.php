<?php  
header("Content-Type:text/event-stream");
header("Cache-Control:no-control");
session_start();
include 'connect.php';
if(empty($_SESSION['STUDENT_ID']))
{
    echo '<script>document.location="student-login.php"</script>';
}
else{

    $student_id = $_SESSION['STUDENT_ID'];
	$class_id = $_SESSION['CLASS_ID'];
	$school_id = $_SESSION['SCHOOL_ID'];
 
    $sql="select * from student where student_id='$student_id'";
    $run = mysqli_query($con,$sql)or die(''.__LINE__.'<br>'.mysqli_error($con));
    $run = mysqli_fetch_assoc($run);
    if(!empty($run))
    {
        $school_id = $run['school_id'];
        $student_id = $run['student_id'];
        $student_name = $run['student_name'];
        $student_email = $run['email'];
        $student_password = $run['gender'];
        $student_address = $run['address'];
        $student_dob = $run['date_of_birth'];
        $student_classid= $run['class_id'];
        $qu5="select student_id as sid,SUM(marks) as sum from cocircular_marks where class_id='$class_id' and school_id='$school_id' GROUP BY student_id order by sum desc";
        $re5=mysqli_query($con,$qu5);
        $varc=0;
        foreach($re5 as $data)
        {
            $varc=$varc+1;
            if($data['sid']==$student_id)
            {
                $ccarank = $varc;
                break;
            }
        }
    }
}
echo "data:".$ccarank."\n\n";
?>
