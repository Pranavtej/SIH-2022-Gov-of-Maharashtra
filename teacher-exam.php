<?php

include 'connect.php';

session_start();

$exam_id = $_GET['eid'];

$loc = mysqli_query($con, "SELECT question FROM teacher_exam_question where exam_id='$exam_id'");

?>

