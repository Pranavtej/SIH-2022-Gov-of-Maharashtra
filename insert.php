<?php
include_once 'connection.php';
if(isset($_POST['submit']))
{    
     $a1 = $_POST['ans1'];
     $a2 = $_POST['ans2'];
     $a3 = $_POST['ans3'];
     $a4 = $_POST['ans4'];
     $a5 = $_POST['ans5'];
     $sql = "INSERT INTO test_data (a1,a2,a3,a4,a5)
     VALUES ('$a1','$a2','$a3','$a4','$a5')";
     if (mysqli_query($conn, $sql)) {
        echo "<h1>New record has been added successfully !</h1>";
        echo "<p>Your answers: </p>";
        echo $a1;
        echo "<br>";
        echo $a2;
        echo "<br>";
        echo $a3;
        echo "<br>";
        echo $a4;
        echo "<br>";
        echo $a5;
     } else {
        echo "Error: " . $sql . ":-" . mysqli_error($conn);
     }
     mysqli_close($conn);
}
?>