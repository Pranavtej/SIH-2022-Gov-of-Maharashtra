<?php

include "connect.php";
session_start();

$student_id=$_GET['sid'];
$sport_id=$_GET['spid'];
$sport_score=$_GET['ss'];
$school_id=$_SESSION['SCHOOL_ID'];
$stat1="SELECT * FROM sports_marks WHERE student_id='$student_id' AND sport_id='$sport_id' AND school_id='$school_id'";
$run1=mysqli_query($con,$stat1);
$res=mysqli_fetch_array($run1);
$score=$res['marks'];
if(!empty($res))
{
    $total=$score+$sport_score;
    $stat2="UPDATE `sports_marks` SET `marks`='$total' WHERE student_id='$student_id' AND sport_id='$sport_id'";
    $run2=mysqli_query($con,$stat2);
    if($run2)
    {
        echo 'Added';
    }
    else
    {
        echo 'Error';
    }
}
else
{
    $stat2="INSERT INTO sports_marks (student_id,school_id,sport_id,marks) VALUES ('$student_id','$school_id','$sport_id',$sport_score)";
    $run2=mysqli_query($con,$stat2);
    if($run2)
    {
        echo 'Added';
    }
    else
    {
        echo 'Error';
    }
}



?>