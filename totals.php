<?php

include 'connect.php';

$sql = mysqli_query($con,"select school_id,student_id,class_id,academic_year from sports_marks");

//$exam_id = array("UT1","FA1","UT2","FA2","AEE");

while($data = mysqli_fetch_assoc($sql))
{
    $sid = $data['student_id'];
    $scid = $data['school_id'];
    $cid = $data['class_id'];
    $ac_year=$data['academic_year'];
        $sql1 = mysqli_query($con,"select sum(marks) as tot from sports_marks where student_id='$sid' and academic_year='$ac_year'");
        $run1 = mysqli_fetch_assoc($sql1);
        $tot = $run1['tot'];      
        
         $sql2 = "INSERT INTO `sports_totals`(`student_id`, `school_id`, `class_id`, `totals`,`academic_year`) VALUES ('$sid','$scid','$cid','$tot','$ac_year`)";
         $run2 = mysqli_query($con,$sql2);

        if($run2)
        {
            echo "success";
        }
        else
        {
            echo "failed";
        }
}


?>