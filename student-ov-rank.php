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
        $qu6="select c.student_id as sid,SUM(c.marks+e.total+s.marks) as sum from cocircular_marks c,exam_totals e,sports_marks s where e.class_id='$class_id' and e.school_id='$school_id' and e.student_id=c.student_id and e.student_id=c.student_id and e.student_id = s.student_id GROUP BY e.student_id order by sum desc";
	$re9=mysqli_query($con,$qu6);
    $v = 0;
    foreach($re9 as $data)
    {
        $v = $v+1;
        if($data['sid']==$student_id)
        {
            $ovrank = $v;
            break;
        }
    }
}echo "data:".$ovrank."\n\n";

}
?>

