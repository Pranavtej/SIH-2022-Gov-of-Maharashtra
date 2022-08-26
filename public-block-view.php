<?php
include "connect.php";
$bid=$_GET["id"];
$sql1=mysqli_query($con,"select count(student_id) as total from student where school_id=ANY(select school_id from school_info where block_id='$bid') group by school_id");

foreach($sql1 as $data)
{
   
   $x[]=$data['total'];
}
$sql2=mysqli_query($con,"select school_name from school_info where block_id='$bid'");
foreach($sql2 as $data1)
{
   $y[] = $data1['school_name'];
}
$sql3=mysqli_query($con,"select count(student_id) as total from exam_totals where  eid='AEE' and status='p' and school_id=ANY(select school_id from school_info where block_id='$bid') group by school_id");
foreach($sql3 as $data2)
{
   $m[] = ($data2['total']/$data['total'])*100 ;
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>State-Official-Dashboard</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" href="assets/img/favicon.png">
		
		<!-- Fontfamily -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&display=swap">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<?php include 'public-menu.php';	?><!-- Page Wrapper -->
            <div class="page-wrapper">
			
                <div class="content container-fluid">
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">School wise NO.OF Students and Pass Percentage of Each School </h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item active"></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
                    <div class="row">
								<div class="col-12 col-lg-12 col-xl-8 d-flex">
									<div class="card flex-fill">
										<div class="card-header">
											<div class="row align-items-center">
												<div class="col-6">
													<h5 class="card-title">School Wise no.of Students</h5>
												</div>
												<!-- <div class="col-6">
													<ul class="list-inline-group text-end mb-0 ps-0">
														<li class="list-inline-item">
															  <div class="form-group mb-0 amount-spent-select">
																<select class="form-control form-control-sm form-select">
																  <option>Weekly</option>
																  <option>Monthly</option>
																  <option>Yearly</option>
																</select>
															</div>
														</li>
													</ul>                                        
												</div> -->
											</div>						
										</div>
										<div class="card-body">
                                        <canvas id="acscore"></canvas>
                                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                            <script>
												// m = JSON.parse(localStorage.m);
												const ctx = document.getElementById('acscore');
												const myChart = new Chart(ctx, {
													type: 'bar',
													data: {
														labels: <?php echo json_encode($y) ?>,
														//echo json_encode($y), 
														datasets: [{
															label: 'NO.OF STUDENTS',
															data:<?php echo json_encode($x)?>,
														//echo json_encode($x),
                                                        labelLinks: ["sample-school.php?sid=SC0001","sample-school.php?sid=SC0002"],
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
                                                myChart.canvas.addEventListener('click',(e) => {
                                                clickableScales(myChart,e)
                                                   });
                                                   function clickableScales(chart,click){
    const{ctx,canvas,scales:{x,y}}=chart;
   const top=y.top
  const left=y.left
  const right=y.right
  const bottom=y.bottom
  const height=y.height/ y.ticks.length;
  // mouse coordinates
  let rect=canvas.getBoundingClientRect();
  const xCoor=click.clientX-rect.left;
  const yCoor=click.clientY-rect.top;
  for(let i=0;i < y.ticks.length;i++){
    if(xCoor>=left && xCoor<=right && yCoor>=top+(height*i)&&
       yCoor<=top+height+(height*i)){
    window.open(chart.data.datasets[0].labelLinks[i]);
      
}
   }
}
											</script>
										</div>
                                            </div>
                                            </div>
                                           
                                 <div class="col-12 col-lg-12 col-xl-8 d-flex">
									<div class="card flex-fill">
										<div class="card-header">
											<div class="row align-items-center">
												<div class="col-6">
													<h5 class="card-title">School Wise Pass Percentage</h5>
												</div> 
                                            </div>
                                            </div>

                                        <div class="card-body">
                                        <canvas id="pscore"></canvas>
                                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                            <script>
												// m = JSON.parse(localStorage.m);
												const ctx1 = document.getElementById('pscore');
                                                // var ctxP = ctx1.getContext('2d');
												const myChart1 = new Chart(ctx1, {
													type: 'bar',
													data: {
														labels: <?php echo json_encode($y) ?>,
														 
                                                        

														datasets: [{
															label: 'PASS PERCENT FOR EACH SCHOOL',
															data:<?php echo json_encode($m)?>,
													
                                                            labelLinks: ['https//:www.google.com','https//:www.youtube.com'],
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
																'rgba(255, 206, 186, 1)',
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
                                            

											</script>
										</div>
                                        </div>
								</div>
							<!-- /Student Chart -->							
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
		
		<!-- Chart JS -->
		<script src="assets/plugins/apexchart/apexcharts.min.js"></script>
		<script src="assets/plugins/apexchart/chart-data.js"></script>

		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
    </body>
</html>