<?php
error_reporting(E_ALL ^ E_NOTICE);  
include 'connect.php';?>
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
		<script type="text/javascript" src="Exportcsv.js"></script>
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
								<h3 class="page-title">Students</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Students</li>
								</ul>
							</div>
							<div class="col-auto text-end float-end ms-auto">
		<button id="btnExportToCsv" type="button" class="btn btn-primary">Export to CSV</button>
							<!-- <button class="btn btn-outline-primary me-2" onclick="Export();"><i class="fas fa-download"></i> Download</button> -->
							</div>
						</div>
					</div>
					<!-- /Page Header -->
				
					<div class="row">
						<div class="col-sm-12">
						
							<div class="card card-table">
								<div class="card-body">
									<div class="table-responsive">
										<table  id="dataTable" class="table table-hover table-center mb-0 datatable">
											<thead>
												<tr>
													<th>STUDENT ID</th>
													<th>STUDENT NAME</th>
													<th>SCHOOL NAME</th>
													<th>DOB</th>
													<th>GENDER</th>
													<th>EMAIL</th>
													<th>ADDRESS</th>
													<th>CLASS</th>
                                                    <th>SECTION</th>
												</tr>
											</thead>
											<tbody>
													<?php
													$query1="SELECT `student_id`, `school_id`, `student_name`, 
													`date_of_birth`, `gender`, `email`, `address`, `class_id` FROM `student`";
													$run1=mysqli_query($con,$query1);
													while($res1=mysqli_fetch_assoc($run1))
													{
														$cid=$res1['class_id'];
														$sid=$res1['school_id'];
														$query2="SELECT `class`, `section` FROM `classes` WHERE class_id = '$cid'";
														$run2=mysqli_query($con,$query2);
														$res2=mysqli_fetch_assoc($run2);
														$query3="SELECT `school_name` from school_info WHERE school_id='$sid'";
														$run3=mysqli_query($con,$query3);
														$res3=mysqli_fetch_assoc($run3);
														echo 
														'<tr><td>'.$res1['student_id'].'</td>
														<td><a href="super-admin-student-dashboard.php?student_id='.$res1['student_id'].'">'.$res1['student_name'].'</a></td>
														<td>'.$res3['school_name'].'</td>
														<td>'.$res1['date_of_birth'].'</td>
														<td>'.$res1['gender'].'</td>
														<td>'.$res1['email'].'</td>
														<td>'.$res1['address'].'</td>
														<td>'.$res2['class'].'</td>
														<td>'.$res2['section'].'</td>
														</tr>';}?>
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
<script>
const dataTable = document.getElementById("dataTable");
        const btnExportToCsv = document.getElementById("btnExportToCsv");

        btnExportToCsv.addEventListener("click", () => {
            const exporter = new TableCSVExporter(dataTable);
            const csvOutput = exporter.convertToCSV();
            const csvBlob = new Blob([csvOutput], { type: "text/csv" });
            const blobUrl = URL.createObjectURL(csvBlob);
            const anchorElement = document.createElement("a");

            anchorElement.href = blobUrl;
            anchorElement.download = "table-export.csv";
            anchorElement.click();

            setTimeout(() => {
                URL.revokeObjectURL(blobUrl);
            }, 500);
        });
    </script>
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