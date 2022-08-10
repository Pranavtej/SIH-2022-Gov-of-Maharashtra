<?php

include 'connect.php';

$sql = mysqli_query($con,"select school_id,student_id from student");

$exam_id = array("UT1","FA1","UT2","FA2","AEE");

while($data = mysqli_fetch_assoc($sql))
{
    $sid = $data['student_id'];
    $scid = $data['school_id'];
    foreach($exam_id as $eid)
    {
        $sql1 = mysqli_query($con,"select sum(marks) as tot from exam_marks where student_id='$sid' and school_id='$scid' and eid='$eid'");
        $run1 = mysqli_fetch_assoc($sql1);
        $tot = $run1['tot'];      
        
        // $sql2 = "INSERT INTO `exam_totals` (`school_id`, `student_id`, `eid`, `total`) VALUES ('$scid', '$sid', '$eid', '$tot')";
        // $run2 = mysqli_query($con,$sql2);

        if($run2)
        {
            echo "success";
        }
        else
        {
            echo "failed";
        }
    }
}


?>