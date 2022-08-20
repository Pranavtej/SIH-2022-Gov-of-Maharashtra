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

        $qu="select e.student_id as sid from exam_totals e,student s where e.eid='$eid' and e.school_id='$school_id' and e.student_id=s.student_id and s.class_id='$class_id' order by e.total desc";
        $re=mysqli_query($con,$qu);
        $var=0;
        foreach($re as $data)
        {
            $var=$var+1;
            if($data['sid']==$student_id)
            {
                $rank = $var;
                break;
            }
        }
    }
}
echo "data:".$rank."\n\n";
?>
