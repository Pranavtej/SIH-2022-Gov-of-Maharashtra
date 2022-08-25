<?php
session_start();
$state_id=$_SESSION['STATE_ID'];
include 'connect.php';?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Statewise-Schools-list</title>
		
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
         <?php include 'state-menu.php';	?>	
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Schools</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="super-admin-dashboard.php">List</a></li>
									<li class="breadcrumb-item active"> SCHOOLS</li>
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
													<th>SCHOOL ID</th>
													<th>SCHOOL NAME</th>
													<th>SCHOOL ADDRESS</th>
                                                    <th>DISTRICT NAME </th>
												
												</tr>
											</thead>
											<tbody>
													<?php
													$query="SELECT s.school_id,s.school_name,s.school_address,e.district_name FROM school_info s,districts e WHERE e.district_id=s.district_id AND s.state_id='$state_id'";
													$run=mysqli_query($con,$query);
													while($res=mysqli_fetch_assoc($run))
													{
                                                        $did=$res['school_id'];
                                                        $sid=$res['school_name'];
                                                         $dname=$res['school_address'];
                                                         $dis=$res['district_name'];
                                
                                                        // $query2="SELECT `state_name` FROM `states` WHERE state_id='$sid' ";
                                                        // $run2=mysqli_query($con,$query2);
                                                        // $res2=mysqli_fetch_assoc($run2);
                                                        
														echo 
														'<tr><td>'.$did.'</td>
														<td><a href="state-student-list.php?school_id='.$did.'">'.$sid.'</a></td>
												
														<td>'.$dname.'</td>
                                                        <td>'.$dis.'</td>
                                                        
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