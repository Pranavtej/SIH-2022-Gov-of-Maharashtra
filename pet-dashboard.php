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
     $query="select distinct COUNT(student_id) as cont from `student` where school_id='$sid'";
     $result=mysqli_query($con,$query);
     $result=mysqli_fetch_assoc($result);
     $_SESSION['COUNT_STUDENT']=$result['cont'];
     $count_student=$_SESSION['COUNT_STUDENT'];
     $stat="select distinct count(*) as ts from sports_marks where school_id='$sid'";
     $res=mysqli_query($con,$stat);
     $res=mysqli_fetch_assoc($res);
     $totalstudent_sports=$res['ts'];
     $boy="select count(*) as BC from student where school_id='$sid' AND gender='M'";
     $result1=mysqli_query($con,$boy);
     $bc=mysqli_fetch_assoc($result1);
     $_SESSION['BC']=$bc['BC'];
     $ot="select count(*) as TC from student where school_id='$sid' AND gender='F'";
     $result2=mysqli_query($con,$ot);
     $tc=mysqli_fetch_assoc($result2);
     $_SESSION['GC']=$tc['TC'];

     $stat2="SELECT COUNT(*) as sum,c.class FROM sports_marks e,classes c WHERE e.school_id='$sid' AND e.class_id=c.class_id group by class ";
     $res2=mysqli_query($con,$stat2);
     while($data=mysqli_fetch_assoc($res2))
     {
        $y[] = $data['class'];
        $x[] = $data['sum'];
     }


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
<div class="row">
<div class="col-sm-12">
<h3 class="page-title">Welcome <?php echo $_SESSION['TEACHER_NAME'];?></h3>
<ul class="breadcrumb">
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Coach Dashboard</li>
</ul>
</div>
</div>
</div>


<div class="row">
<div class="col-xl-3 col-sm-6 col-12 d-flex">
<div class="card bg-five w-100">
<a href="pet-achivement.php"><div class="card-body">
<div class="db-widgets d-flex justify-content-between align-items-center">
<div class="db-icon">
<i class="fas fa-chalkboard"></i>
</div>
<div class="db-info">
<h3>Acheivements</h3>
<h6>Of Students</h6>
</div>
</div></a>
</div>
</div>
</div>
<div class="col-xl-3 col-sm-6 col-12 d-flex">
<div class="card bg-six w-100">
<div class="card-body">
<div class="db-widgets d-flex justify-content-between align-items-center">
<div class="db-icon">
<i class="fas fa-user-graduate"></i>
</div>
<div class="db-info">
<h3><?php echo $totalstudent_sports;?>/<?php echo $count_student;?></h3>
<h6>Total Students in sports</h6>
</div>
</div>
</div>
</div>
</div>
<div class="col-xl-3 col-sm-6 col-12 d-flex">
<div class="card bg-seven w-100">
<div class="card-body">
<div class="db-widgets d-flex justify-content-between align-items-center">
<div class="db-icon">
<i class="fas fa-book-open"></i>
</div> 
<div class="db-info">
<h3><?php echo $_SESSION['BC'];?>/<?php echo $_SESSION['GC'];?></h3>
<h6>Total Boys And Girls Ratio</h6>
</div>
</div>
</div>
</div>
</div>
<div class="col-xl-3 col-sm-6 col-12 d-flex">
<div class="card bg-eight w-100">
<a href="pet-sports-list.php"><div class="card-body">
<div class="db-widgets d-flex justify-content-between align-items-center">
<div class="db-icon">
<i class="fas fa-clock"></i>
</div>
<div class="db-info">
<h3>Sports List</h3>
<h6>School wise Sports List</h6>
</div>
</div>
</div>
</div>
</div></a>
</div>


<!-- <div class="row">
<div class="col-12 col-lg-12 col-xl-9">
<div class="row">
<div class="col-12 col-lg-8 col-xl-8 d-flex">
<div class="card flex-fill">
<div class="card-header">
<div class="row align-items-center">
<div class="col-6">
<h5 class="card-title">Top Scorers</h5>
</div>
<div class="col-6">
<span class="float-end view-link"><a href="#">View All Courses</a></span> -
</div>
</div>
</div>
<div class="pt-3 pb-3">
<div class="table-responsive lesson"> -
<table class="table table-center">
<tbody>
<tr>
<td><b>Lessons 30</b>
</td>
<td><a href="#">Confirmed</a></td>
<td><a href="#">Confirmed</a></td>
<td><b>Reschedule</b></td>
</tr>
<!-- <tr>
<td>
<div class="date">
<b>Aug 5, Wednesday</b>
<p>3.00pm - 4.30pm (90min)</p>
</div>
</td>
<td>
<div class="date">
<b>Lessons 31</b>
<p>3.2 Ipsuum dolor</p>
</div>
</td>
<td><a href="#">Confirmed</a></td>
<td><button type="submit" class="btn btn-info">Reschedule</button></td>
</tr>
<tr>
<td>
<div class="date">
<b>Aug 6, Thursday</b>
<p>11.00am - 12.00pm (20min)</p>
</div>
</td>
<td>
<div class="date">
<b>Lessons 32</b>
<p>3.3 Ipsuum dolor</p>
</div>
</td>
<td><a href="#">Confirmed</a></td>
<td><button type="submit" class="btn btn-info">Reschedule</button></td>
</tr> -
</tbody>
</table>
</div>
</div>
</div> -->
<div class="row">
<div class="col-12 col-lg-12 col-xl-8 d-flex">
<div class="card flex-fill">
<div class="card-header">
<div class="row align-items-center">
<div class="col-6">
<h5 class="card-title">Class Performance</h5>
</div>
<div class="col-6">
<ul class="list-inline-group text-end mb-0 ps-0">
<li class="list-inline-item">
<div class="form-group mb-0 amount-spent-select">
<!-- <select class="form-control form-control-sm form-select">
<option>Weekly</option>
<option>Monthly</option>
<option>Yearly</option>
</select> -->
</div>
</li>
</ul>
</div>
</div>
</div> 

<div id="chart-body" >
<canvas id="cpscore"></canvas>
<!-- <canvas id="ccscore"></canvas> -->
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    
const ctx_2 = document.getElementById('cpscore');
const myChart = new Chart(ctx_2, {
    type: 'bar',
    data: {
        labels:  <?php echo json_encode($y) ;?>, 
        datasets: [{
            label: 'Sports Performance',
            data: <?php echo json_encode($x) ;?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        },
    ]},
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});


</script>

</div>
</div>

<div class="col-12 col-lg-12 col-xl-4 d-flex">
    <div class="card flex-fill">
        <div class="card-header">
            <h5 class="card-title">LeaderBoard</h5>
        </div>
        <div class="card-body">
            <div class="teaching-card">
                <ul class="activity-feed">
                    <li class="feed-item">
                        <div class="feed-date1">Current Academic Year 2021-20</div>
                        <?php
                        $exam = array("SP0001","SP0002","SP0003","SP0004");
                            foreach($exam as $spid)
                            {
                                //$qu1="select student_name from student where student_id in (select student_id from sports_marks where marks in (select max(marks) from sports_marks where sport_id='$spid') AND sport_id='$spid') LIMIT 1";
                                $qu1="SELECT e.student_id,e.class_id,e.marks,s.student_name FROM sports_marks e,student s WHERE e.sport_id='$spid' AND e.school_id='$sid' AND e.student_id=s.student_id AND  marks>=ALL(SELECT MAX(marks) from sports_marks where sport_id='$spid' AND school_id='$sid')";
                                $re=mysqli_query($con,$qu1);
                                $re1 = mysqli_fetch_assoc($re);

                                 $name = mysqli_query($con, "select sport_name from sports where sport_id='$spid'");
                                 $nam = mysqli_fetch_assoc($name);

                                echo '
                                <span class="feed-text1"><a>'.$nam['sport_name'].' : </a></span>
                                <p><span>'.$re1['student_name'].'-'.$re1['class_id'].'-'.$re1['marks'].'</span></p>';
                            }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
						</div>

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