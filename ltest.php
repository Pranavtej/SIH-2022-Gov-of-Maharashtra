<?php

include 'connect.php';

session_start();

$school_id = $_SESSION['SCHOOL_ID'];
$student_id = $_SESSION['STUDENT_ID'];
$class_id = $_SESSION['CLASS_ID'];

$exam_id = $_GET['eid'];

//$loc = mysqli_query($con, "SELECT question_id,question,options,loc_id,image_path FROM `teacher_exam_question` WHERE exam_id='$exam_id' order by question_id");

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
    echo "<script>document.location='index.php'</script>";
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
    </head>
    <style>
body {
    font-family: 'Montserrat';font-size: 22px;
}
</style>
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
    <body>
		
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
         

			
			<!-- Page Wrapper -->
            
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
                            
                        <div class="col-12 col-md-6 col-lg-4 d-flex" style="background-color: #e6ffff;">
                                    <div class="card flex-fill" style="background-color:  #e6ffff;">
                                    <div class="card-header" style="background-color:  #e6ffff;">
                                   <h4> Question:1. Find the shape Rectangle from Below</h4><br>
                                    <h6>(Learning Outcome : able to identify shapes)</h6>              
                                    </div>
                                    <div id='q10'>
<label id='l1'>
  <input type="radio" name="Q22" id="no1" class="mno" value="1">
  <img src="exam/img/1/1.png" class="hvr-wobble-to-top-right">
</label>
<label id='l2'>
  <input type="radio"   name="Q22" id="no2" class="mno" value="2">
  <img src="exam/img/1/2.png" class="hvr-wobble-to-top-right">
</label>
<label id='l3'>
  <input type="radio" name="Q22" id="no3" class="mno" value="3">
  <img src="exam/img/1/3.png" class="hvr-wobble-to-top-right">
</label>
<label id='l4'>
  <input type="radio" name="Q22" id="no4" class="mno" value="4">
  <img src="exam/img/1/4.png" class="hvr-wobble-to-top-right">
</label>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4 d-flex" style="background-color: #e6ffff;">
                                    <div class="card flex-fill" style="background-color:  #e6ffff;">
                                    <div class="card-header" style="background-color:  #e6ffff;">
                                   <h4> Question 2: Find the result of this addition?</h4><br>
                                    <h6>(Learning Outcome : able to add,subtract,multiply numbers)</h6>              
                                    </div><h2>4+4= </h2><div class="card-body">
                                    <p class="card-text">Answer: <input type="text" name="Q23"></p>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4 d-flex" style="background-color: #e6ffff;">
                                    <div class="card flex-fill" style="background-color:  #e6ffff;">
                                    <div class="card-header" style="background-color:  #e6ffff;">
                                   <h4> Question 3:Match the appropriate comparison symbol</h4><br>
                                    <h6>(Learning Outcome : able to distingush between larger and smaller numbers)</h6>              
                                    </div><div class="card-body">
                                    <p class="card-text">Answer: <div id='q12'>

<h2>39 
<select name='Q24' id='q12'>
<option value='='>=</option>
<option value='>'>></option>
<option value='<'><</option>
</select>
41</h2>
</div></p>  
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4 d-flex" style="background-color: #e6ffff;">
                                    <div class="card flex-fill" style="background-color:  #e6ffff;">
                                    <div class="card-header" style="background-color:  #e6ffff;">
                                   <h4> Question 4: Find the number of green apples from below.</h4><br>
                                    <h6>(Learning Outcome : able to count the objects using numbers)</h6>              
                                    </div><div class="card-body">
                                    <p class="card-text">Answer: <img src="exam/img/2/1.png" class="hvr-wobble-to-top-right"> <input type="text" name="Q25">
</p>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4 d-flex" style="background-color: #e6ffff;">
                                    <div class="card flex-fill" style="background-color:  #e6ffff;">
                                    <div class="card-header" style="background-color:  #e6ffff;">
                                   <h4> Question 5: Match the following</h4><br>
                                    <h6>(Learning Outcome : able to indentify the numbers)</h6>              
                                    </div><div class="card-body">
                                    <p class="card-text">Answer: 

1) ONE -
<select name='Q26' id='q131'>
<option value='1'>1</option>
<option value='5'>5</option>
<option value='8'>8</option>
</select> <br>

2) FIVE -
<select name='q132' id='q132'>
<option value='1'>1</option>
<option value='5'>5</option>
<option value='8'>8</option>
</select> <br>

3) EIGHT -
<select name='q133' id='q133'>
<option value='1'>1</option>
<option value='5'>5</option>
<option value='8'>8</option>
</select></p>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4 d-flex" >
                                    <div class="card flex-fill" >
                                    <div class="card-header" >
                                   <h4> Question 6 : Identify the number by listening to the tiger audio</h4><br>
                                    <h6>(Learning Outcome : able to indentify the numbers)</h6>              
                                    </div><div class="card-body">
                                    <p class="card-text"><img src="exam/img/tiger.png"  onclick="sound('one')"> <input type="text" name="Q28">
</p> <script>
  var audio;
  audio = new Audio("exam/img/one.mp3");
  
  function sound(snd)
  {
    audio.pause();
    audio.currentTime = 0;
    audio = new Audio("exam/img/" + snd +".mp3");
    audio.play();
  }
 </script> 
                                    </div>
                                    </div>
                                    </div>
                                    

                                                         
                    </div>	
                    			
				</div>
        <div class="col-12 col-md-6 col-lg-4 d-flex" style="background-color: #e6ffff;">
                                    <div class="card flex-fill" style="background-color:  #e6ffff;">
                                    <div class="card-header" style="background-color:  #e6ffff;">
                                   <h4> Question 7: Find the result of this multiplication?</h4><br>
                                    <h6>(Learning Outcome : able to add,subtract,multiply numbers)</h6>              
                                    </div><h2>2*2= </h2><div class="card-body">
                                    <p class="card-text">Answer: <input type="text" name="Q29"></p>
                                    </div>
                                    </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-4 d-flex" style="background-color: #e6ffff;">
                                    <div class="card flex-fill" style="background-color:  #e6ffff;">
                                    <div class="card-header" style="background-color:  #e6ffff;">
                                   <h4> Question 8: Find the result of this subtraction?</h4><br>
                                    <h6>(Learning Outcome : able to add,subtract,multiply numbers)</h6>              
                                    </div><h2>4-2= </h2><div class="card-body">
                                    <p class="card-text">Answer: <input type="text" name="Q30"></p>
                                    </div>
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