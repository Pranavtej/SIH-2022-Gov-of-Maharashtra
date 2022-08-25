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
        <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">


		<!-- Datatables CSS -->
		<link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">

        <script>
			
			const dataT = [];
			<?php 
				$get = "select question_id as ci from teacher_exam_question where exam_id='$exam_id'";
				$run = mysqli_query($con, $get);
                $i = 0;
				while($get = mysqli_fetch_array($run))
				{
					// echo 'dataT.'.$get['ci'].'= '.$get['ca'].'; ';
                    echo 'dataT['.$i.'] = '.$get['ci'].';';
                    $i++;
				}
			?>
		</script>

        <style>
            #signal0 {
				display : none;
			}
            #signal1 {
				display : none;
			}
        </style>
    </head>
    <body>
		
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
         

			
			<!-- Page Wrapper -->
            
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-lg-10">
								<h3 class="page-title" align="center">Learning Outcome Assessment Examination </h3>
</div>      
                        <div class="col-lg-2">
                                <button type="button" class="btn btn-sm btn-default" style="color: red;" id='signal0'><i class="fa fa-signal" aria-hidden="true"></i>&nbsp&nbspNot Connected</button>

                                    <button type="button" class="btn btn-sm btn-default" style="color: green;" id='signal1'><i class="fa fa-signal" aria-hidden="true"></i>&nbsp&nbspConnected</button>
                        
        </div>
        <div class="alert" id="alert" style="font-size: 38px; color: blue"></div>

        <div>
                                <p style="font-weight: bold;">Grade: 1</p>&nbsp&nbsp&nbsp&nbsp<p style="font-weight: bold;">Subject: Mathematics </p>
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
				
                   
                        <form action="" method="post" id="save-later-form">
                        <div class="row">
                            <?php
                                $i = 0;
                                $j = 1;
                                while($run1 = mysqli_fetch_assoc($loc))
                                {
                                    $query = mysqli_query($con, "select loc from learning_outcomes where loc_id='{$run1['loc_id']}'");
                                    $a = mysqli_fetch_assoc($query);
                                    echo'
                                    <div class="col-12 col-md-6 col-lg-4 d-flex">
                                    <div class="card flex-fill">
                                    <div class="card-header">
                                   <h4> Question '.$j++.': '.$run1['question'].'</h4><br>
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
                                    <p class="card-text">Answer: <input type="text" name="'.$run1['question_id'].'" id="'.$run1['question_id'].'"></p>
                                    </div>
                                    </div>
                                    </div>';
                                }
                            ?>
                     
                    </div>	
                    			
				</div>
                <button class="btn btn-info btn-lg" id="submit">Submit</button>
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
        <script >
const formId = "save-later-form"; // ID of the form
    const url = location.href; //  href for the page
    const formIdentifier = `${url} ${formId}`; // Identifier used to identify the form
    // const saveButton = document.querySelector("#save"); // select save button
    const submitButton = document.querySelector("#submit"); // select save button
    const alertBox = document.querySelector(".alert"); // select alert display div
    const signal = document.querySelector(".signal");
    let form = document.querySelector(`#${formId}`); // select form
    let formElements = form.elements; // get the elements in the form
    const getFormData = () => {
  let data = { [formIdentifier]: {} };
  for (const element of formElements) {
    if (element.name.length > 0) {
      data[formIdentifier][element.name] = element.value;
    }
  }
  return data;
};

submitButton.onclick = event => {
        if (navigator.onLine) {
            const dataA = [];
            let k = 0;
            for(let i=0;i<10;i++)
            {
                dataA[k] = document.getElementById(dataT[k]).value;
            }
            alert(dataA);
            alert("Test submitted successfully!!");
            localStorage.clear()
        }
        else{
            event.preventDefault();
            data = getFormData();
            localStorage.setItem(formIdentifier, JSON.stringify(data[formIdentifier]));
            const message = "Form draft has been saved!";
            displayAlert(message);

        }
};

/**
 * This function displays a message
 * on the page for 1 second
 *
 * @param {String} message
 */
const displayAlert = message => {
  alertBox.innerText = message;
  alertBox.style.display = "block";
  setTimeout(function() {
    alertBox.style.display = "none";
  }, 10000);
};

const populateForm = () => {
  if (localStorage.key(formIdentifier)) {
    const savedData = JSON.parse(localStorage.getItem(formIdentifier)); // get and parse the saved data from localStorage
    for (const element of formElements) {
      if (element.name in savedData) {
        element.value = savedData[element.name];
      }
    }
  }
};

document.onload = populateForm();


function updateConnectionStatus() {  
    if(navigator.onLine) {
        document.getElementById('signal0').style.display = "none";
        document.getElementById('signal1').style.display = "block";
    }
    else{
        document.getElementById('signal0').style.display = "block";
        document.getElementById('signal1').style.display = "none";
    }
}
window.addEventListener("load", updateConnectionStatus);
    
// Attaching event handler for the online event
window.addEventListener("online", function(e) {
    updateConnectionStatus();
    hint.innerHTML = "And we're back!";
});

// Attaching event handler for the offline event
window.addEventListener("offline", function(e) {        
    updateConnectionStatus();
    hint.innerHTML = "Hey, it looks like you're offline.";
});


        </script>
    </body>
</html>