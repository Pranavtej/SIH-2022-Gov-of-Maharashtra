<?php

include 'connect.php';

$query = mysqli_query($con,"select student_id from student");
foreach($query as $data)
{
    $id = $data['student_id'];
    $query2 = mysqli_query($con,"select class_id from student where student_id='$id'");
    $q = mysqli_fetch_assoc($query2);
    $class_id = $q['class_id'];
    
    // $update = mysqli_query($con, "update exam_marks set class_id='$class_id' where student_id='$id'");

}






?>