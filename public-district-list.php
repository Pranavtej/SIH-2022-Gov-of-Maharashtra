<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>public-district-list</title>
		
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
         <?php include 'public-menu.php';	?>	
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Districts</h3>
								<ul class="breadcrumb">
									<!-- <li class="breadcrumb-item"><a href="super-admin-dashboard.php">Dashboard</a></li> -->
									<li class="breadcrumb-item active"> District</li>
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
													<th>DISTRICT ID</th>
													<th>DISTRICT NAME</th>
													<th>STATE</th>
												
												</tr>
											</thead>
											<tbody>
													<?php
													$query="SELECT distinct(d.district_id) as did, d.state_id as sid , d.district_name as dname
                                                   from districts as d,blocks as b where d.district_id=b.district_id";
													$run=mysqli_query($con,$query);
													while($res=mysqli_fetch_assoc($run))
													{
                                                        $did=$res['did'];
                                                        $sid=$res['sid'];
                                                         $dname=$res['dname'];
                                
                                                        $query2="SELECT `state_name` FROM `states` WHERE state_id='$sid' ";
                                                        $run2=mysqli_query($con,$query2);
                                                        $res2=mysqli_fetch_assoc($run2);
                                                        
														echo 
														'<tr><td>'.$did.'</td>
														<td><a href="public-district-view.php?did='.$did.'">'.$dname.'</a></td>
												
														<td>'.$res2['state_name'].'</td>
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
           
<!--   
  <div class="card-body">
                                        <canvas id="acscore"></canvas>
                                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                            <script>
												
												const ctx = document.getElementById('acscore');
												const myChart = new Chart(ctx, {
													type: 'pie',
													data: {
														labels: ,
														//echo json_encode($y), 
														datasets: [{
															label: '',
															data:,
														//echo json_encode($x),
                                                        // labelLinks: ["sample-school.php?sid=SC0001","sample-school.php?sid=SC0002"],
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
														}]
													},
													options: {
														//maintainAspectRatio: true,
														indexAxis : 'y',
														scales: {
															y: {
																beginAtZero: true
															}
														}
													}
												});
</script> -->
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