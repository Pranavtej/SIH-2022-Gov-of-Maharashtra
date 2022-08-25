<?php

include 'connect.php';

session_start();

$school_id = $_SESSION['SCHOOL_ID'];
$student_id = $_SESSION['STUDENT_ID'];
$class_id = $_SESSION['CLASS_ID'];

$exam_id = $_GET['eid'];

$loc = mysqli_query($con, "SELECT question_id,question,options,loc_id,image_path FROM `teacher_exam_question` WHERE exam_id='$exam_id' order by question_id");

if(isset($_POST['give']))
{
    $loc = mysqli_query($con, "select distinct(loc_id) as loc_id from teacher_exam_question where exam_id='$exam_id'");
    foreach($loc as $id)
    {
        $locid = $id['loc_id'];
        $qid = mysqli_query($con, "select question_id as qid from teacher_exam_question where loc_id='$locid'");
        {
            $correct = 0;
            $count = 0;
            foreach($qid as $id1)
            {
                $ques = $id1['qid'];
                $ans = $_POST[$ques];
                $answer = mysqli_query($con, "select answer from teacher_exam_question where question_id='$ques'");
                $answer2 = mysqli_fetch_assoc($answer);
                if($answer2['answer'] == strtoupper($ans))
                {
                    $correct += 1;
                }
                $count++;
            }
            $markperquestion = 5/$count;
            $credits = $markperquestion * $correct;
            $credits = round($credits);
            $insert = mysqli_query($con,"INSERT INTO `learning_outcomes_credits` (`school_id`, `class_id`, `student_id`, `subject_id`, `loc_id`, `credits`) VALUES ('$school_id', '$class_id', '$student_id', 'SUB0104', '$locid', $credits)") or die(mysqli_error()); 
        }
    }   

}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Preskool - Students</title>
		
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
        <style>
        /* HIDE RADIO */
[type=radio] { 
  position: absolute;
  opacity: 0;
  width: 0;
  height: 0;
}

/* IMAGE STYLES */
[type=radio] + img {
  cursor: pointer;
  width:60px;
}

/* CHECKED STYLES */
[type=radio]:checked + img {
  outline: 2px solid #000000;
  width:100px;
}

/* IMAGE STYLES */
.mno + img {
  cursor: pointer;
  width:100px;
}

/* CHECKED STYLES */
.mno:checked + img {
  outline: 0px solid #000000;
  width:100px;
  background-color:#ffc7b0;
  border-radius:100px;
}

#teams1, #teams2, #teams3, #teams4, #super
{
  width:100%;	
  text-align:center;	
}
</style>

    </head>
    <body>
		
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
         

			
			<!-- Page Wrapper -->
           <div class="page-wrapper">
		
                            
             
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title" align="center">Learning Outcome Assessment Examination </h3>
                               
                                <h5 align="left"  >Grade : 1</h5><h5 align="right">Subject : Mathematics </h5>
								<ul class="breadcrumb">
								</ul>
							</div>
							<!-- <div class="col-auto text-end float-end ms-auto">
								<a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
								<a href="add-student.html" class="btn btn-primary"><i class="fas fa-plus"></i></a>
							</div> -->
						</div>
					</div>
					<!-- /Page Header -->
				
                   
                        <form action="" method="post">
                        <div class="row">
                        <div class="input-group">
    <span class="q">1. identify the shape square ?</span>

<div style='text-align:center;' id='teams1'>
<label id='l1'>
  <input type="radio" name="mno1" id="no1" class="mno" value="mi">
  <img src="exam/img/m.png" class="hvr-wobble-to-top-right" >
</label>
<label id='l2'>
  <input type="radio" name="mno1" id="no2" class="mno" value="dc">
  <img src="exam/img/2.png" class="hvr-wobble-to-top-right" >
</label>
<label id='l3'>
  <input type="radio" name="mno1" id="no3" class="mno" value="rcb">
  <img src="exam/img/3.png" class="hvr-wobble-to-top-right">
</label>
<label id='l4'>
  <input type="radio" name="mno1" id="no4" class="mno" value="srh">
  <img src="exam/img/4.png" class="hvr-wobble-to-top-right" >
</label>
</div>
	
</div>	
                            <?php
                                $i = 0;
                                $j=1;
                                while($run1 = mysqli_fetch_assoc($loc))
                                {
                                    
                                    $query = mysqli_query($con, "select loc from learning_outcomes where loc_id='{$run1['loc_id']}'");
                                    $a = mysqli_fetch_assoc($query);
                                    echo'
                                    <div class="col-12 col-md-6 col-lg-4 d-flex">
                                    <div class="card flex-fill">
                                    <div class="card-header">
                                   <h4> Question '.$j.' : '.$run1['question'].'</h4><br>
                                    <h6>(Learning Outcome : '.$a['loc'].')</h6>              
                                    </div>';
                                    if(!empty($run1['options']))
                                    {
                                        echo '<h6>'.$run1['options'].'</h6>';
                                    }
                                    if(!empty($run1['image_path']))
                                    {
                                        echo '<img src="exam/img/'.$run1['image_path'].'" alt="image not loaded" class="card-img">';
                                    }  
                                    
                                    echo '<div class="card-body">
                                    <p class="card-text">Answer: <input type="text" name="'.$run1['question_id'].'"></p>
                                    </div>
                                    </div>
                                    </div>';
                                    $j++;
                                }
                            ?>
                     
                    </div>	
                    			
				</div>
                <input type="submit" class="btn btn-primary" name="give">
                </form>	

				<!-- Footer -->
				<!-- <footer>
					<p>Copyright © 2020 Dreamguys.</p>					
				</footer> -->
				<!-- /Footer -->				
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