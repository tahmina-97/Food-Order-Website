<?php 
include('../config/constants.php');

//1.Destroy the session
session_destroy(); //unset $_SESSION['user']

//2.redirect to our login page
header("location:" .SITEURL.'admin/login.php');

?>