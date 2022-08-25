<?php

include 'connect.php';


$query = mysqli_query($con, "select distinct(student_id) as student_id from learning_outcomes_credits where subject_id='SUB0104'");



?>

<html>
    <meta http-equiv="refresh" content="1" > 




<div class="row">
						<div class="col-sm-12">
						
							<div class="card card-table">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-hover table-center mb-0">
											<thead>
												<tr>
													<th>STUDENT ID</th>
													<th>Learning Outcome</th>
													<th>Credits</th>
												</tr>
											</thead>
											<tbody>
												<?php
													foreach($query as $r)
                                                    {
														$sid = $r['student_id'];
                                                        $run = mysqli_query($con, "select s.student_name as student_name,o.loc as loc,l.credits as credits from learning_outcomes_credits l,student s,learning_outcomes o where l.student_id='$sid' and l.subject_id='SUB0104' and l.loc_id = o.loc_id and l.student_id = s.student_id");
														foreach($run as $rr)
														{
															echo '<tr>
															<td>'.$rr['student_name'].'</td>
															<td>'.$rr['loc'].'</td>
															<td>'.$rr['credits'].'</td>
															</tr>';
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

					</html>