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
        $query1="select eid from exam where status=1";
	$result1=mysqli_query($con,$query1) or die(mysqli_error);
	$res = mysqli_fetch_assoc($result1);
	$eid = $res['eid'];
        $query="select S.subject_name, M.marks from exam_marks M,subjects S where M.student_id='$student_id' and M.subject_id=S.subject_id and eid='$eid'";
        $result=mysqli_query($con,$query) or die(mysqli_error);
         foreach($result as $data)
         {
            $y[] = $data['subject_name'];
            $x[]=$data['marks'];
        }
    }
}
echo "data:".json_encode($x)."\n\n";
?>
