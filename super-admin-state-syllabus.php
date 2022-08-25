<?php
include 'connect.php';?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>super-admin-Schools-list</title>
		
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
								<h3 class="page-title">Schools</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="super-admin-dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item active"> SCHOOLS</li>
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
					 
							<div class="card card-table">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-hover table-center mb-0 datatable">
											<thead>
												<tr>
													<th>SCHOOL ID</th>
													<th>SCHOOL NAME</th>
													<th>ADDRESS</th>
													<th>DISTRICT</th>
                                                    <th>STATE</th>
												</tr>
											</thead>
											<tbody>
													<?php
													$query="SELECT `school_id`, `state_id`, `district_id`,
                                                     `school_name`, `school_address` FROM `school_info` ";
													$run=mysqli_query($con,$query);
													while($res=mysqli_fetch_assoc($run))
													{
                                                        $did=$res['district_id'];
                                                        $sid=$res['state_id'];
                                                        $query1="SELECT  `district_name` FROM `districts`
                                                         WHERE district_id='$did' AND state_id= '$sid' ";
                                                         $run1=mysqli_query($con,$query1);
                                                         $res1=mysqli_fetch_assoc($run1);
                                                        $query2="SELECT `state_name` FROM `states` WHERE state_id='$sid' ";
                                                        $run2=mysqli_query($con,$query2);
                                                        $res2=mysqli_fetch_assoc($run2);
                                                        
														echo 
														'<tr><td>'.$res['school_id'].'</td>
														<td><a href="super-admin-school-view.php?school_id='.$res['school_id'].'">'.$res['school_name'].'</a></td>
														<td>'.$res['school_address'].'</td>
														<td>'.$res1['district_name'].'</td>
														<td>'.$res2['state_name'].'</td>
                                                        <td class="text-end">
														<div class="actions">
															<a href="super-admin-edit-school.php?statename='.$res2['state_name'].'&districtname='.$res1['district_name'].'&schoolid='.$res['school_id'].'&stateid='.$res['state_id'].'&districtid='.$res['district_id'].'&schooladdress='.$res['school_address'].'&schoolname='.$res['school_name'].'" class="btn btn-sm bg-success-light me-">
																<i class="fas fa-pen"></i>
															</a>
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