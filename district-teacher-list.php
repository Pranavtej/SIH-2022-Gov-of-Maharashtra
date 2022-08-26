<?php session_start();
include 'connect.php';
$did=$_SESSION['DISTRICT_ID'];
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Blocks-list</title>
		
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
         <?php include 'district-menu.php';	?>	
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Teacher List</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="super-admin-dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item active"> Teacher</li>
								</ul>
							</div>
					
						</div>
					</div>
					<!-- /Page Header -->
				
					<div class="row">
						<div class="col-sm-12">
					 
							<div class="card card-table">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-hover table-center mb-0 datatable">
											<thead>
												<tr>
													<th>TEACHER ID</th>
													<th>TEACHER NAME</th>
                                                    <th>TEACHER EMAIL</th>
													<th>TEACHER Subject</th>
                                                    <th>TEACHER MOB</th>
                                                    
													
												</tr>
											</thead>
											<tbody>
													<?php
													$sql2=mysqli_query($con,"select teacher_id,teacher_name,teacher_email,teacher_mob from teacher_info where school_id=ANY(select school_id from school_info where district_id='$did')");
                                                    
												
													foreach($sql2 as $res)
													{
                                                        $did=$res['teacher_id'];
                                                        $sid=$res['teacher_name'];
                                                        $mail=$res['teacher_email'];
                                                        $mob=$res['teacher_mob'];
                                                        $sql="select distinct subject_name from subjects as s,schoolwise_class_subject_teachers as st,teacher_info as t where st.teacher_id='$did' and st.subject_id=s.subject_id";
                                                        $res=mysqli_query($con,$sql);
                                                        $res1=mysqli_fetch_assoc($res);
														if($res1!=null)
														{
                                                        $m=implode("",$res1);
														}
                                                        
                                                    
														echo 
														'<tr><td>'.$did.'</td>
														<td><a href="district-teacher-view.php?tid='.$did.'">'.$sid.'</a><b/td>
                                                        <td>'.$mail.'</td>
                                                        <td>'.$mob.'</td>
                                                        <td>'.$m.'</td>
													
                                                        <td class="text-end">
														<div class="actions">
															
														</div>
													</td>
													</tr>';
                                                     }?>
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