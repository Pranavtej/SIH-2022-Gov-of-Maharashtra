<?php
include 'connect.php';
session_start();

$exam_id=$_GET['exam_id'];
$class_id=$_GET['class_id'];
$subject_id=$_GET['subject_id'];
$school_id=$_GET['school_id'];
$question_id=autoincemp();
function autoincemp()
{
    global $value2;
    global $con;
    $query = "select question_id from teacher_exam_question order by question_id desc LIMIT 1";
    $stmt = mysqli_query($con,$query);
    $rowcount=$stmt->num_rows;
    if ($rowcount > 0) {
        $row = mysqli_fetch_assoc($stmt);
        $value2 = $row['question_id'];
        $value2 = substr($value2,1);
        $value2 = (int)$value2 + 1;
        $str="Q";
        $value2 = "Q".sprintf('%s',$value2);
        $value = $value2;
        return $value;
    } else {
        $value2 = "Q10";
        $value = $value2;
        return $value;
    }
}
 if(isset($_POST['submit']))
    {
        $question=$_POST['question'];
        $answer=$_POST['answer'];
        $loc_id=$_POST['loc_id'];
        $stat2="INSERT INTO `teacher_exam_question` VALUES ('$exam_id','$question_id','$question','$options','$loc_id','$image_path','$class_id','$school_id')";
        $run2=mysqli_query($con,$stat2);
    }
$qu=mysqli_query($con,"select loc_id , loc from learning_outcomes where subject_id = '$subject_id' ");
$data=mysqli_fetch_assoc($qu);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title> Subject</title>

<link rel="shortcut icon" href="assets/img/favicon.png">

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&display=swap">

<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>



    <div class="page-wrapper">
        <?php include 'teacher-header.php'; ?>
        <?php include 'teacher-sidebar.php'; ?>
            <div class="content container-fluid">
                <div class="page-header">

                    <div class="row align-items-center">
                    <div class="row align-items-center">    
                    <div class="col">
                        <h3 class="page-title">Teacher Adding Questions For <?php echo $class_id;?> </h3>
                        <ul class="breadcrumb">
                        <li class="breadcrumb-item">Teacher</li>
                        <li class="breadcrumb-item active">Add Learning Outcome</li></ul><br>
                </div>
            </div>
    </div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form method="post">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>question_id</label>
                                    <input type="text" VALUE=<?php echo $question_id;?> class="form-control" disabled readonly="readonly">
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label>question</label>
                                    <input type="text" name="question" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label>Answer</label>
                                    <input type="text" name="answer" class="form-control">
                                </div>
                            </div>
                        <div class="col-md-6 ">
                        <div class="form-group">
                        <label>Learning Outcomes</label>
                        <?php
                            echo '<select name="loc_id"  id="loc_id" class="form-control form-select">
                                    <option value="">Select Learning Outcomes</option>';
                                    while($data = mysqli_fetch_assoc($qu))
                                    {
                                        echo '<option value='.$data['loc_id'].'>'.$data['loc_id'].'-'.$data['loc'].'</option>';
                                    }
                                    echo '</select>';
                         ?>
                       </div></div>
                     <div class="col-12">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                     </div>
                    </div>
                </form>
            </div>
        </div>
   </div>
</div>
<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="assets/js/script.js"></script>
</body>
</html>