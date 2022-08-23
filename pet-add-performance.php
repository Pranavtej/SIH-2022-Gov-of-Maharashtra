<?php
session_start();
include 'connect.php';
if(empty($_SESSION['TEACHER_ID'])){
    header('location:index.php');

}
else
{
   $stat="select * from sports";
   $run=mysqli_query($con,$stat);
   $student_id=$_GET['student_id'];
   $class_id = $_GET['cid'];
   if(!empty($_POST['submit']))
   {
      $sport_id=$_POST['sport_id'];
      $sport_score=$_POST['sport_score'];
      $school_id=$_SESSION['SCHOOL_ID'];
      $stat1="SELECT * FROM sports_marks WHERE student_id='$student_id' AND sport_id='$sport_id' AND school_id='$school_id'";
      $run1=mysqli_query($con,$stat1);
      $res=mysqli_fetch_array($run1);
      $score=$res['marks'];
      if(!empty($res))
      {
        $total=$score+$sport_score;
        $stat2="UPDATE `sports_marks` SET `marks`='$total' WHERE student_id='$student_id' AND sport_id='$sport_id' and class_id='$class_id'";
        $run2=mysqli_query($con,$stat2);
      }
      else
      {
        $stat2="INSERT INTO sports_marks (student_id,class_id,school_id,sport_id,marks) VALUES ('$student_id','$class_id','$school_id','$sport_id',$sport_score)";
        $run2=mysqli_query($con,$stat2);
      }
      
	  $ace="select totals from sports_totals where student_id='$student_id'";
	  $red=mysqli_query($con,$ace);
	  $red=mysqli_fetch_assoc($red);
	  $total1=$red['totals']+$sport_score;
	  $ace1="UPDATE sports_totals SET totals='$total1' WHERE student_id='$student_id'";
	  $shanks=mysqli_query($con,$ace1);
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

<?php
include 'pet-menu.php';
?>
<div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Add Performance</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="school-admin-student-list.php">Sport</a></li>
									<li class="breadcrumb-item active">student</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
				
					<div class="row">
						<div class="col-sm-12">
						
							<div class="card">
								<div class="card-body">
									<form  method="post" class="form-validation">
										<div class="row">
											<div class="co-l-12">
												<h5 class="form-title"><span>Add Performance</span></h5>
											</div>
                                          
											<div class="col-12 col-sm-6">  
												<div class="form-group">
													<label>Student ID</label>
													<input type="text" name="student_id" value="<?php echo $student_id ?>" disabled="disabled" class="form-control">
												</div>
											</div>
											<!-- <div class="col-12 col-sm-6">
												<div class="form-group">
													<label>Last Name</label>
													<input type="text" class="form-control">
												</div>
											</div> -->
                                            <div class="col-12 col-sm-6"> 
                                            <div class="form-group">
                                                    <label>Sports</label>
                                                    <?php
                                                        echo '<select name="sport_id"  id="sport_id" class="form-control form-select" required>
                                                                <option value="">Select Sport</option>';
                                                                while($data = mysqli_fetch_assoc($run))
                                                                {
                                                                    echo '<option value='.$data['sport_id'].'>'.$data['sport_id'].'-'.$data['sport_name'].'</option>';
                                                                }
                                                                echo '</select></td>';
                                                         ?>
                                                </div>
                                                            </div>
											<div class="col-12 col-sm-6">  
												<div class="form-group">
													<label>Score</label>
													<input type="number" name="sport_score" class="form-control">
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

