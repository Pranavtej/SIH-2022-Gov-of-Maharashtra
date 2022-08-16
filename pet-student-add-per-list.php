<?php session_start();


include 'connect.php';
if(empty($_SESSION['TID']))
{
    header('location:index.php');
}
else{

    $class_id= $_SESSION['cid'];

    $std=" select sid , Student_Name ,dob, cid ,address,email from student where cid='$class_id'";
    $result=mysqli_query($con,$std) or die(mysqli_error);
    $counter=mysqli_num_rows($result);
    
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Preskool - Students</title>

<link rel="shortcut icon" href="assets/img/favicon.png">

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&display=swap">

<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">

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
<h3 class="page-title">Students</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
<li class="breadcrumb-item active">Students</li>
</ul>
</div>
<div class="col-auto text-end float-end ms-auto">
<a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
<a href="add-student.html" class="btn btn-primary"><i class="fas fa-plus"></i></a>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card card-table">
<div class="card-body">
<div class="table-responsive">
<table class="table table-hover table-center mb-0 datatable">
<thead>
<tr>
<th>ID</th>
<th>Name</th>
<th>Class</th>
<th>DOB</th>
<th>Parent Name</th>
<th>EMAIL</th>
<th>Address</th>
<!-- <th class="text-end">Action</th> -->
</tr>
</thead>
<tbody>
<?php
foreach ($result as $data) 
{
       $stdname=$data['Student_Name'];
       $std_id=$data['sid'];
       $date=$data['dob'];
       $class_id=$data['cid'];
       $addres=$data['address'];
       $mail=$data['email'];
    echo
    '<tr>
<td>'.$std_id.'</td>
<td>
<a href="teacher-add-performance.php?data='.$std_id.'">'.$stdname.'</a>
</h2>
</td>
<td>'.$class_id.'</td>
<td>'.$date.'</td>
<td>NAME</td>
<td>'.$mail.'</td>
<td>'.$addres.'</td>
<td class="text-end">';
}
?>
<!-- <tr>
<td>PRE2209</td>
<td>
<a href="student-details.html">Aaliyah</a>
</h2>
</td>
<td>10 A</td>
<td>2 Feb 2002</td>
<td>Jeffrey Wong</td>
<td>097 3584 5870</td>
<td>911 Deer Ridge Drive,USA</td>
<td class="text-end">
<div class="actions">
<a href="edit-student.html" class="btn btn-sm bg-success-light me-2">
<i class="fas fa-pen"></i>
</a>
<a href="#" class="btn btn-sm bg-danger-light">
<i class="fas fa-trash"></i>
</a>
</div>
</td>
</tr>
<tr>
<td>PRE2213</td>
<td>
<h2 class="table-avatar">
<a href="student-details.html" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/profiles/avatar-03.jpg" alt="User Image"></a>
<a href="student-details.html">Malynne</a>
</h2>
</td>
<td>8 A</td>
<td>3 June 2010</td>
 <td>Fields Malynne</td>
<td>242 362 3100</td>
<td>Bacardi Rd P.O. Box N-4880, New Providence</td>
<td class="text-end">
<div class="actions">
<a href="edit-student.html" class="btn btn-sm bg-success-light me-2">
<i class="fas fa-pen"></i>
</a>
<a href="#" class="btn btn-sm bg-danger-light">
<i class="fas fa-trash"></i>
</a>
</div>
</td>
</tr>
<tr>
<td>PRE2143</td>
<td>
<h2 class="table-avatar">
<a href="student-details.html" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/profiles/avatar-02.jpg" alt="User Image"></a>
<a href="student-details.html">Levell Scott</a>
</h2>
</td>
<td>10 A</td>
<td>12 Apr 2002</td>
<td>Jeffrey Scott</td>
<td>026 7318 4366</td>
<td>P.O. Box: 41, Gaborone</td>
<td class="text-end">
<div class="actions">
<a href="edit-student.html" class="btn btn-sm bg-success-light me-2">
<i class="fas fa-pen"></i>
</a>
<a href="#" class="btn btn-sm bg-danger-light">
<i class="fas fa-trash"></i>
</a>
</div>
</td>
</tr>
<tr>
<td>PRE2431</td>
<td>
<h2 class="table-avatar">
<a href="student-details.html" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/profiles/avatar-03.jpg" alt="User Image"></a>
<a href="student-details.html">Minnie</a>
</h2>
</td>
<td>11 C</td>
<td>24 Feb 2000</td>
<td>J Shaffer</td>
<td>952 512 4909</td>
<td>4771 Oral Lake Road, Golden Valley</td>
<td class="text-end">
<div class="actions">
<a href="edit-student.html" class="btn btn-sm bg-success-light me-2">
<i class="fas fa-pen"></i>
</a>
<a href="#" class="btn btn-sm bg-danger-light">
<i class="fas fa-trash"></i>
</a>
</div>
</td>
</tr>
<tr>
<td>PRE1534</td>
<td>
<h2 class="table-avatar">
<a href="student-details.html" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/profiles/avatar-04.jpg" alt="User Image"></a>
<a href="student-details.html">Lois A</a>
</h2>
</td>
<td>10 A</td>
<td>22 Jul 2006</td>
<td>Cleary Wong</td>
<td>413 289 1314</td>
<td>2844 Leverton Cove Road, Palmer</td>
<td class="text-end">
<div class="actions">
<a href="edit-student.html" class="btn btn-sm bg-success-light me-2">
<i class="fas fa-pen"></i>
</a>
<a href="#" class="btn btn-sm bg-danger-light">
<i class="fas fa-trash"></i>
</a>
</div>
</td>
</tr>
<tr>
<td>PRE2153</td>
<td>
<h2 class="table-avatar">
<a href="student-details.html" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/profiles/avatar-05.jpg" alt="User Image"></a>
<a href="student-details.html">Calvin</a>
</h2>
</td>
<td>9 B</td>
<td>8 Dec 2003</td>
<td>Minnie J Shaffer</td>
<td>701 753 3810</td>
<td>1900 Hidden Meadow Drive, Crete</td>
<td class="text-end">
<div class="actions">
<a href="edit-student.html" class="btn btn-sm bg-success-light me-2">
<i class="fas fa-pen"></i>
</a>
<a href="#" class="btn btn-sm bg-danger-light">
<i class="fas fa-trash"></i>
</a>
</div>
</td>
</tr>
<tr>
<td>PRE1252</td>
<td>
<h2 class="table-avatar">
<a href="student-details.html" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/profiles/avatar-06.jpg" alt="User Image"></a>
<a href="student-details.html">Joe Kelley</a>
</h2>
</td>
<td>11 C</td>
<td>7 Oct 2000</td>
<td>Vincent Howard</td>
<td>402 221 7523</td>
<td>3979 Ashwood Drive, Omaha</td>
<td class="text-end">
<div class="actions">
<a href="edit-student.html" class="btn btn-sm bg-success-light me-2">
<i class="fas fa-pen"></i>
</a>
<a href="#" class="btn btn-sm bg-danger-light">
<i class="fas fa-trash"></i>
</a>
</div>
</td>
</tr>
<tr>
<td>PRE1434</td>
<td>
<h2 class="table-avatar">
<a href="student-details.html" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/profiles/avatar-07.jpg" alt="User Image"></a>
<a href="student-details.html">Vincent</a>
</h2>
</td>
<td>10 A</td>
<td>4 Jan 2002</td>
<td>Kelley Joe</td>
<td>402 221 7523</td>
<td>3979 Ashwood Drive, Omaha</td>
<td class="text-end">
<div class="actions">
<a href="edit-student.html" class="btn btn-sm bg-success-light me-2">
<i class="fas fa-pen"></i>
</a>
<a href="#" class="btn btn-sm bg-danger-light">
<i class="fas fa-trash"></i>
</a>
</div>
</td>
</tr>
<tr>
<td>PRE2345</td>
<td>
<h2 class="table-avatar">
<a href="student-details.html" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/profiles/avatar-08.jpg" alt="User Image"></a>
<a href="student-details.html">Kozma  Tatari</a>
</h2>
</td>
<td>9 A</td>
<td>1 Feb 2006</td>
<td>Lombardi</td>
<td>04 2239 968</td>
<td>Rruga E Kavajes, Condor Center, Tirana</td>
<td class="text-end">
<div class="actions">
<a href="edit-student.html" class="btn btn-sm bg-success-light me-2">
<i class="fas fa-pen"></i>
</a>
<a href="#" class="btn btn-sm bg-danger-light">
<i class="fas fa-trash"></i>
</a>
</div>
</td>
</tr>
<tr>
<td>PRE2365</td>
<td>
<h2 class="table-avatar">
<a href="student-details.html" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/profiles/avatar-09.jpg" alt="User Image"></a>
<a href="student-details.html">John Chambers</a>
</h2>
</td>
<td>11 B</td>
<td>13 Sept 2003</td>
<td>Wong Jeffrey</td>
<td>870 663 2334</td>
<td>4667 Sunset Drive, Pine Bluff</td>
<td class="text-end">
<div class="actions">
<a href="edit-student.html" class="btn btn-sm bg-success-light me-2">
<i class="fas fa-pen"></i>
</a>
<a href="#" class="btn btn-sm bg-danger-light">
<i class="fas fa-trash"></i>
</a>
</div>
</td>
</tr>
<tr>
<td>PRE1234</td>
<td>
<h2 class="table-avatar">
<a href="student-details.html" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/profiles/avatar-10.jpg" alt="User Image"></a>
<a href="student-details.html">Nathan Humphries</a>
</h2>
</td>
<td>10 B</td>
<td>26 Apr 1994</td>
<td>Stephen Marley</td>
<td>077 3499 9959</td>
<td>86 Lamphey Road, Thelnetham</td>
<td class="text-end">
<div class="actions">
<a href="edit-student.html" class="btn btn-sm bg-success-light me-2">
<i class="fas fa-pen"></i>
</a>
<a href="#" class="btn btn-sm bg-danger-light">
<i class="fas fa-trash"></i>
</a>
</div>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>

<footer>
<p>Copyright © 2020 Dreamguys.</p>
</footer> -->

</div>

</div>


<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="assets/plugins/datatables/datatables.min.js"></script>

<script src="assets/js/script.js"></script>
</body>
</html>