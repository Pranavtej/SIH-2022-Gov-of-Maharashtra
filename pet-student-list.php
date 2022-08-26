<?php session_start();

error_reporting(E_ALL ^ E_NOTICE);  
include'connect.php';
if(empty($_SESSION['TEACHER_ID']))
{
    header('location:index.php');
}
else{

    $school_id= $_SESSION['SCHOOL_ID'];

    $std=" select *from student where school_id='$school_id'";

    
// if(isset($_POST['submit'])) {
//     $class=$_POST['select'];
//     if($_POST['select']=='6th') {   //<=========== 'select'
//         $std=" select * from student where school_id='$school_id' and class_id=ANY(select class_id from classes where class=6) ";
//     }
//     elseif($_POST['select']=='7th') {   //<=========== 'select'
//         $std=" select * from student where school_id='$school_id' and class_id=ANY(select class_id from classes where class=7) ";
//     }
//     elseif($_POST['select']=='8th'){
//         $std=" select * from student where school_id='$school_id' and class_id=ANY(select class_id from classes where class=8) ";
//     }
//     elseif($_POST['select']=='9th'){
//         $std=" select * from student where school_id='$school_id' and class_id=ANY(select class_id from classes where class=9) ";
//     }
//     elseif($_POST['select']=='10th'){
//         $std=" select *from student where school_id='$school_id' and class_id=ANY(select class_id from classes where class=10) ";
//     }
    
//      $result=mysqli_query($con,$std) or die(mysqli_error);
//     $counter=mysqli_num_rows($result);
    
// }
$result=mysqli_query($con,$std) or die(mysqli_error);
    
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Students</title>

<link rel="shortcut icon" href="assets/img/favicon.png">

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&display=swap">

<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">

<link rel="stylesheet" href="assets/css/style.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js" type="text/javascript" charset="utf-8"></script>

      <!-- save the modal script on your server and link to it -->
      <script src="/path/to/jquery.modal.min.js" type="text/javascript" charset="utf-8"></script>
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
<h3 class="page-title">Students</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="pet-dashboard.php">Dashboard</a></li>
<li class="breadcrumb-item active">Students</li>
</ul>
</div>
<!-- <div class="col-auto text-end float-end ms-auto">
<a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
<a href="add-student.html" class="btn btn-primary"><i class="fas fa-plus"></i></a>
</div>
</div>
</div> -->
<div>
<h5>Search</h5>


<input type="text" class="form-control"  name="name" id="myInput" onkeyup="searchFun()">
<!-- <button class="btn" type="submit"><i class="fas fa-search"></i></button> -->
<br>
</div>
<!-- <h5>Select</h5> -->
<!-- <form class="filteroption" action="" method="post">
    <select id="select" class="form-control form-select" name="select" >

        <option value="6th" >6</option>
        <option value="7th" >7</option>
        <option value="8th" >8</option>
        <option value="9th" >9</option>
        <option value="10th" >10</option>
        <option value=0 selected="selected">select class</option>
    </select>
    <br>
    <input  class="btn btn-primary" type="submit" name="submit" value="submit">
          </form> -->


<div class="row">
<div class="col-sm-12">
<div class="card card-table">
<div class="card-body">
<div class="table-responsive">
<table id="myTable" class="table table-hover table-center mb-0 datatable">
<thead>
<tr>
<th>ID</th>
<th>Name</th>
<th>Class</th>
<th>Gender</th>
<th>Kabbadi</th>
<th>Football</th>
<th>Basketball</th>
<th>Cricket</th>
<th>Totals</th>
<!-- <th class="text-end">Action</th> -->
</tr>
</thead>
<tbody>
<?php
while($data=mysqli_fetch_assoc($result)) 
{
    $stdname=$data['student_name'];
    $std_id=$data['student_id'];
    $class_id=$data['class_id'];
    $gender=$data['gender'];
    echo
    '<tr>
<td>'.$std_id.'</td>
<td>
<a >'.$stdname.'</a>
</h2>
</td>
<td>'.$class_id.'</td>
<td>'.$gender.'</td>';
    $sport = array("SP0001","SP0002","SP0003","SP0004");
    foreach($sport as $spid)
    {
        $luf="select marks from sports_marks where student_id='$std_id' AND sport_id='$spid'";
        $res=mysqli_query($con,$luf);
        $data1=mysqli_fetch_assoc($res);
        if(!empty($data1))
        {
        echo '<td>'.$data1['marks'].'</td>'; 
        }
        else{
            echo '<td>NA</td>';
        }
    }  
 $stat="select totals from sports_totals where student_id='$std_id'";
 $ace=mysqli_query($con,$stat);
 $ace=mysqli_fetch_assoc($ace);
 $total=$ace['totals'];
 echo '<td>'.$total.'</td>';
echo '<td class="text-end">';

}
?>

</div>

</div>
<script>
            const searchFun = () => {
                let filter = document.getElementById('myInput').value.toUpperCase();
                
                let myTable = document.getElementById('myTable');
                
                let tr = myTable.getElementsByTagName('tr');

                for(var i=0;i<tr.length;i++){
                    let td = tr[i].getElementsByTagName('td')[1];
                    let t1 = tr[i].getElementsByTagName('td')[0];
             
                    if(td || t1){
                        let textvlaue = td.textContent || td.innerHTML;
                        let pid = t1.textContent || t1.innerHTML;
                        if(textvlaue.toUpperCase().indexOf(filter)>-1 || pid.toUpperCase().indexOf(filter)>-1){
                            tr[i].style.display = "";
                        }
                        else{
                            tr[i].style.display = "none";
                        }
                    }
                }

            }
        </script>


<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="assets/plugins/datatables/datatables.min.js"></script>

<script src="assets/js/script.js"></script>
</body>
</html>