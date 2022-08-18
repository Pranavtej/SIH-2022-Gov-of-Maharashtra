<?php 
     
    session_start();
    include 'connect.php';
   


    if(empty($_SESSION['TEACHER_ID'])){
        header('location:index.php');
    
    }
    else
    {

     $tid=$_SESSION['TEACHER_ID'];
     $res="select * from teacher_info where teacher_id='$tid'";
     $run=mysqli_query($con,$res);
     $run=mysqli_fetch_assoc($run);
     $sid=$_SESSION['SCHOOL_ID']=$run['school_id'];
     $teacher_name=$_SESSION['TEACHER_NAME']=$run['teacher_name'];
     $teacher_dob=$_SESSION['DOB']=$run['teacher_dob'];
     $teacher_mobile=$_SESSION['MOBILE']=$run['teacher_mob'];
     $teacher_email=$_SESSION['EMAIL']=$run['teacher_email'];

     $stat="SELECT e.details,s.student_name,s.class_id FROM achievements e,student s WHERE e.student_id=s.student_id AND e.school_id='$sid'";
     $res=mysqli_query($con,$stat);


    

    // $quer="SELECT distinct e.student_id,(e.total+a.TOTAL+c.TOTAL+s.TOTAL) as TOT
    // FROM exam_totals e,academic_points a,ccapoints c, spoints s,student t,class cl 
    // WHERE e.student_id=a.sid and a.sid=c.sid and c.sid=s.SID and s.sid=t.sid and t.cid='$ci'";
    // $re=mysqli_query($con,$quer) or die(mysqli_error());
    
    // $total=0;
    // foreach($re as $data)
    // {
    //     $y[] = $data['sid'];
    //     $x[] = $data['TOT'];
    //     $total=$total+$data['TOT'];
    // }
    // $count=mysqli_num_rows($re);
    // $total=$total/$count;
    // $i=0;
    // while($i<=$count)
    // {
    //     $z[]=$total;
    //     $i=$i+1;
    // }*/

     }
?>






<DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Coach - Dashboard</title>

<link rel="shortcut icon" href="assets/img/favicon.png">

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&display=swap">

<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="assets/plugins/simple-calendar/simple-calendar.css">

<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php
include 'pet-menu.php';
?>



<div class="page-wrapper">
<div class="content container-fluid">
<div class="page-header">
<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Achivements </h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Sports teacher </a></li>
									<li class="breadcrumb-item active">Achivements</li>
								</ul>
							</div>
                            <br>
                                
                            <br>

<br>
                                
<br><div class="row"><?php 
while($data=mysqli_fetch_assoc($res))
{
    echo'
								<div class="col-12 col-md-6 col-lg-4 d-flex">
									<div class="card flex-fill">
<div class="card-header">
    <div class="col-auto profile-image">
<a href="#">
<img class="rounded-circle" alt="User Image" src="assets/img/profiles/avatar-02.jpg">
</a>
</div>
<div class="col ms-md-n2 profile-user-info">
<h4 class="user-name mb-0">Student Name:'.$data['student_name'].' </h4>
<h6 class="text-muted">Class Id :'.$data['class_id'].' </h6>
<h6 class="text-muted">Achivement :'.$data['details'].' </h6>


</div></div>										
</div>										
								
										
</div>

';
}
?>


<!-- <footer>
<p>Copyright © 2020 Dreamguys.</p>
</footer> -->

</div>

</div>




<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="assets/plugins/apexchart/apexcharts.min.js"></script>
<script src="assets/plugins/apexchart/chart-data.js"></script>

<script src="assets/plugins/simple-calendar/jquery.simple-calendar.js"></script>
<script src="assets/js/calander.js"></script>

<script src="assets/js/circle-progress.min.js"></script>

<script src="assets/js/script.js"></script>
</body>
</html>