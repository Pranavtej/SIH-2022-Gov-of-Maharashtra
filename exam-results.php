<?php

include 'connect.php';


$query = mysqli_query($con, "select l.student_id as student_id,o.loc as loc,l.credits as credits from learning_outcomes_credits l,learning_outcomes o where l.subject_id='SUB0104' and l.loc_id = o.loc_id group by l.student_id");



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
                                                        echo '<tr>
                                                    <td>'.$r['student_id'].'</td>
                                                    <td>'.$r['loc'].'</td>
                                                    <td>'.$r['credits'].'</td>
                                                    </tr>';
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