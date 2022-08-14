<?php

session_start();
unset($_SESSION['Student_id']);
unset($_SESSION['SCHOOL_ID']);
unset($_SESSION['CLASS_ID']);
header('location:index.php');
?>