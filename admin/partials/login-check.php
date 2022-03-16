<?php 

//Authorization
//check whether the user is logged in or not

if(!isset($_SESSION['user']))
{
        $_SESSION['no-login-msg']="<div class='error text-center'> Please Login To Access Admin Panel. </div>";
        //Redirect to homepage/dashboard
        header("location:" .SITEURL.'admin/login.php');
}

?>