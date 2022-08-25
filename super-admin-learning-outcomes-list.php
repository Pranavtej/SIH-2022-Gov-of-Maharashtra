<?php
include 'connect.php';
$sql ="SELECT DISTINCT(c.class) as class1   from classes c";
$run=mysqli_query($con,$sql);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>super-admin-classwise-subject-list</title>
		
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
         <?php include 'super-admin-menu.php';	?>	
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Classwise Subjects List</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="super-admin-dashboard.php">SuperAdmin Dashboard</a></li>
									<li class="breadcrumb-item active">Classwise Subjects List</li>
								</ul>
							</div>
							<div class="col-auto text-end float-end ms-auto">
								<a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
				
					<div class="row">
						<div class="col-sm-12">
                        <?php
                        while($res=mysqli_fetch_assoc($run))
                        {
							echo "<div class='card card-table'>
								<div class='card-body'>
									<div class='table-responsive'>
										<table class='table table-hover table-center mb-0 datatable'>";
                                               echo '<b>'.$res['class1'].'</b>';
										       echo'<thead>
												<tr>
													<th>SUBJECT ID</th>
													<th>SUBJECT NAME</th>
													<th>Learning Outcomes List</th>
												</tr>
											   </thead>
											    <tbody>';
                                                    $cid= $res['class1'];
													$sql1="SELECT DISTINCT(s.subject_id) as subject_id , su.subject_name as name FROM schoolwise_class_subject_teachers s,subjects su,
                                                    classes c where c.class_id=s.class_id and c.class='$cid' and s.subject_id=su.subject_id order by s.subject_id";
													$run1=mysqli_query($con,$sql1);
													while($res1=mysqli_fetch_assoc($run1))
													{ 
														echo 
														'<tr><td>'.$res1['subject_id'].'</td>
                                                        <td>'.$res1['name'].'</td>
                                                        <td><a href="super-admin-learning-outcomes.php?subject_id='.$res1['subject_id'].'&cid='.$cid.'">view learning outcomes</a></td>
                                                        </tr>';
                                                     }
											       echo'</tbody>
										</table>
									</div>
								</div>
							</div>';}	?>								
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