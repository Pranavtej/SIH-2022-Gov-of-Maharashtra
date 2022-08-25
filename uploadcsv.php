<?php
include 'connect.php';
// if(isset($_POST['submit']))
// {
// 	if(empty($_POST['teacher_id']))
// 	{
	
// 	class Common
// 	{
// 	  public function uploadData($connection,$student_id,$school_id,  $name, $dob, $gender,$email,$ads,$class_id)
// 	  {
		
		 
// 	$insert = "INSERT INTO student ( student_id,school_id, student_name, date_of_birth, gender,email,address,class_id) 
// 	VALUES ('$student_id','$school_id',  '$name', '$dob', '$gender','$email','$ads','$class_id')";
// 		  $result1 = $connection->query($insert) or die("Error in main Query".$connection->error);
// 		  return $result1;
		
// 	  }
// 	}
// 	if($_FILES['file']['name']) {
// 		$arrFileName = explode('.', $_FILES['file']['name']);
// 		if ($arrFileName[1] == 'csv') {
// 			$handle = fopen($_FILES['file']['tmp_name'], "r");
// 			$count = 0;
// 			while (($data = fgetcsv($handle, ",")) !== FALSE) {
// 				$count++;
// 				if ($count == 1) {
// 					continue; // skip the heading header of sheet
// 				}
// 					$student_id = $con->real_escape_string($data[0]);
// 					$name = $con->real_escape_string($data[1]);
// 					$dob = $con->real_escape_string($data[2]);
// 					$gender = $con->real_escape_string($data[3]);
// 					$email = $con->real_escape_string($data[4]);
// 					$ads=$con->real_escape_string($data[5]);
// 					$school_id=$_SESSION['SCHOOL_ID'];
// 					$class_id=$con->real_escape_string($data[6]);
// 					$common = new Common();
// 					$SheetUpload = $common->uploadData($con,$student_id,$school_id,  $name, $dob, $gender,$email,$ads,$class_id);
// 			}
// 			if ($SheetUpload){
// 				return "file upload successfull";
// 			}
// 		}
// 	}		
// 	}
// 	else
// 	{
// 	$name = $_POST['name'];
// 	$class_id = $_POST['classid'];
 
//     $student_id=$_POST['student_id'];
//     $email=$_POST['mail'];
//     $dob=$_POST['dob'];
//     $gender=$_POST['gender'];
//     $ads=$_POST['ads'];

	
// 	$insert = "INSERT INTO student ( student_id,school_id, student_name, date_of_birth, gender,email,address,class_id) 
// 			VALUES ('$student_id','$school_id',  '$name', '$dob', '$gender','$email','$ads','$class_id')";
// 	$insert2 = mysqli_query($con,$insert);

//   }
// }
if(isset($_GET['download']))
{
	$DB_TBLName = "sports_marks"; 
$filename = "sports";  //your_file_name
$file_ending = "xls";   //file_extention

header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=$filename.'.'.$file_ending");  
header("Pragma: no-cache"); 
header("Expires: 0");

$sep = "\t";

$sql="SELECT * FROM $DB_TBLName"; 
$resultt = $con->query($sql);
while ($property = mysqli_fetch_field($resultt)) { //fetch table field name
    echo $property->name."\t";
}
}
?>
<html>
	<body>
		<form method="get">
			download:<input type="button" name="download">
</form>
</body>
</html>



