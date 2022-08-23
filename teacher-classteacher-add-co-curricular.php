<?php
session_start();
include 'connect.php';
if(empty($_SESSION['TEACHER_ID'])){
    header('location:index.php');

}
else
{
   $stat="select * from cocircular";
   $run=mysqli_query($con,$stat);
   $student_id=$_GET['student_id'];
   $class_id = $_GET['cid'];  
   $student_name = $_GET['sname']; 
   $st="select sum(marks) as sum from cocircular_marks where student_id='$student_id'";
   $r1=mysqli_query($con,$st);
   $r2=mysqli_fetch_assoc($r1);
   if(!empty($_POST['submit']))
   {
      $cocircular_id=$_POST['cocircular_id'];
      $marks=$_POST['marks'];
      $school_id=$_SESSION['SCHOOL_ID'];
      $stat1="SELECT marks FROM cocircular_marks WHERE student_id='$student_id' AND cocircular_id='$cocircular_id' AND school_id='$school_id'";
      $run1=mysqli_query($con,$stat1);
      $res=mysqli_fetch_array($run1);
      $score=$res['marks'];
      if(!empty($res))
      {
        $total=$score+$marks;
        $stat2="UPDATE `cocircular_marks` SET `marks`= $total WHERE student_id='$student_id' AND cocircular_id='$cocircular_id' and class_id='$class_id'";
        $run2=mysqli_query($con,$stat2);
			header('location:teacher-classteacher-add-co-curricular.php?student_id='.$student_id.'&cid='.$class_id.'&sname='.$student_name.'.php');
      }
      else
      {
        $stat2="INSERT INTO `cocircular_marks`(`student_id`, `class_id`, `school_id`, `cocircular_id`, `marks`)  VALUES ('$student_id','$class_id','$school_id','$cocircular_id','$marks')";
        $run2=mysqli_query($con,$stat2);
		header('location:teacher-classteacher-add-co-curricular.php?student_id='.$student_id.'&cid='.$class_id.'&sname='.$student_name.'.php');
      }

   }
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

<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="page-wrapper">
        <?php include 'teacher-header.php' ?>
        <?php include 'teacher-sidebar.php' ?>
            <div class="content container-fluid">
                <div class="page-header">

                    <div class="row align-items-center">
                    <div class="row align-items-center">    
                    <div class="col">
                        <h3 class="page-title">Teacher Adding Co-Curricular Activities Score for Student</h3>
                        <ul class="breadcrumb">
                        <li class="breadcrumb-item">STUDENT</li>
                        <li class="breadcrumb-item active">Add Performance Marks</li></ul><br>
                        <div class="row">
                        <div class="col-md-12">
                        <h4><b>Name of the Student : </b><?php echo $student_name.'('.$student_id.')';?></h4>
						<h4><b>Current points : </b>
						<?php 
						if(!empty($r2['sum']))
						{echo $r2['sum'];}
						else{ echo '0'; }
						?></h4>
                        </div></div>
                </div>
            </div>
    </div>
				
					<div class="row">
						<div class="col-sm-12">
						
							<div class="card">
								<div class="card-body">
									<form  method="post" class="form-validation">
										<div class="row">
											<div class="co-l-12">
												<h5 class="form-title"><span>Add Performance</span></h5>
											</div>
                                          
											<!-- <div class="col-12 col-sm-6">  
												<div class="form-group">
													<label>Student ID</label>
													<input type="text" name="student_id" value="#" disabled="disabled" class="form-control">
												</div>
											</div> -->
											<!-- <div class="col-12 col-sm-6">
												<div class="form-group">
													<label>Last Name</label>
													<input type="text" class="form-control">
												</div>
											</div> -->
                                            <div class="col-12 col-sm-6"> 
                                            <div class="form-group">
                                                    <label>Curricular Activities</label>
                                                    <?php
                                                        echo '<select name="cocircular_id"  id="cocircular_id" class="form-control form-select" required>
                                                                <option value="">Select Co-Currriculum</option>';
                                                                while($data = mysqli_fetch_assoc($run))
                                                                {
                                                                    echo '<option value='.$data['cocircular_id'].'>'.$data['cocircular_id'].'-'.$data['cocircular_name'].'</option>';
                                                                }
                                                                echo '</select></td>';
                                                         ?>
                                                </div>
                                                            </div>
											<div class="col-12 col-sm-6">  
												<div class="form-group">
													<label>Score</label>
													<input type="number" name="marks" class="form-control">
												</div>
											</div>
											
											</div>
											
											</div>
											
											</div>
										
											</div>
                                            
											</div>
											<div class="col-12">
												<button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
											</div>

										</div>
                                        </form>
								</div>
							</div>							
						</div>					
					</div>					
				</div>				
			</div>
			<!-- /Page Wrapper -->
			
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="assets/js/jquery-3.6.0.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		
		<!-- Slimscroll JS -->
		<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

		<!-- Select2 JS -->
		<script src="assets/plugins/select2/js/select2.min.js"></script>

		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
    </body>
</html>

