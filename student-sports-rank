<?php 

header("Content-Type:text/event-stream");
header("Cache-Control:no-control");
session_start();
include "connect.php";
  
   
    if(empty($_SESSION['SID'])){
        header('location:index.php');
    
    }
    else{

      

        $_SESSION['SID'];
        $_SESSION['Student_Name'];
        $_SESSION['GENDER'];
        $_SESSION['EMAIL'];
        $_SESSION['CID'];
        $_SESSION['ADDRESS'];

      $sid=$_SESSION['SID'];
      $ci=$_SESSION['CID'];

      $qu1 = mysqli_query($con , "SELECT student_id,sum(marks) as marks from sports_marks where school_id='$school_id' GROUP BY student_id order by marks desc");
      $var3=0;
      foreach($qu1 as $data)
      {
          $var3=$var3+1;
          if($data['student_id']==$student_id)
          {
              $rank3 = $var3;
              break;
          }
      }
    }
echo "data:".$rank3."\n\n";
?>