<?php
include 'connect2.php';
session_start();
$school_id = $_SESSION['SCHOOL_ID'];
$teacher_id = $_SESSION['TEACHER_ID'];
$class_id = $_SESSION['CLASS_ID'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Students Lists</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" href="assets/img/favicon.png">
	
		<!-- Fontfamily -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&display=swap">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

		<!-- Datatables CSS -->
		<link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">

		
    </head>
    <body>
         <?php include 'teacher-sidebar.php';
         include 'teacher-header.php';	?>	
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Students</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="teacher-classteacher-dashboard.php">ClassTeacher Dashboard</a></li>
									<li class="breadcrumb-item active">Students</li>
								</ul>
							</div>
							<div class="col-auto text-end float-end ms-auto">
								<form method="post">
									<button class="btn btn-outline-primary me-2" name="generate">Genratate</button>
								</form>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
				
					<div class="row">
						<div class="col-sm-12">
						
							<div class="card card-table">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-hover table-center mb-0">
											<thead>
												<tr>
													<th>STUDENT ID</th>
													<th>STUDENT NAME</th>
													<th>Prediction</th>
												</tr>
											</thead>
											<tbody>
													<?php
                                                        if(isset($_POST['generate']))
														{
															$query1="SELECT s.student_id as student_id,s.school_id as school_id, s.student_name as student_name, 
															s.date_of_birth as date_of_birth, s.gender as gender, s.email as email, s.address as address,sc.school_name as school_name,
															c.class as class, c.section as section,s.class_id as class_id FROM test2.student s,test2.classes c,test2.school_info sc WHERE
															c.class_id=s.class_id and sc.school_id=s.school_id and s.class_id='$class_id' and s.school_id='$school_id'";
															$run1=mysqli_query($con,$query1);
															$j = 0;
															while($res1=mysqli_fetch_assoc($run1))
															{
																$sid = $res1['student_id'];
																$marks = array(0,0,0);
																$query2 = "select total from test3.exam_totals where student_id='$sid' order by year asc";
																$run2=mysqli_query($con,$query2);
																$i = 0;
																while($res2=mysqli_fetch_assoc($run2))
																{
																	$marks[$i] = $res2['total'];
																	$i++;																	
																}
																echo '
																	<script>
																		generate('.$marks[0].','.$marks[1].','.$marks[2].');
																		function generate(a,b,c) {
																			var xmlhttp=new XMLHttpRequest();
																			xmlhttp.onreadystatechange=function() {
																				if (this.readyState==4 && this.status==200) {
																					console.log(this.responseText);
																					document.getElementById("'.$j.'").innerHTML=this.responseText;
																				}
																			}
																			xmlhttp.open("GET","https://stdpyml.herokuapp.com/?m1="+a+"&m2=1&m3="+b+"&m4=1&m5="+c+"&m6=1",true);
																			xmlhttp.send();
																		}
																	</script>
																';
																echo 
																'<tr><td>'.$res1['student_id'].'</td>
																<td>'.$res1['student_name'].'</td>
																<td><span id="'.$j.'" class="badge badge-info"></span></td>
																</tr>';
																$j++;
															}
														}
                                                    ?>
											</tbody>
										</table>
									</div>
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
		
		<!-- Datatables JS -->
		<script src="assets/plugins/datatables/datatables.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
    </body>
</html>