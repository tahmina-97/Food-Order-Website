<?php

//include constants.php file here

include('../config/constants.php');

//1. get the ID of admin to be deleted

$id = $_GET["id"];

//2. Create SQL query to delete admin

$sql= "DELETE FROM tbl_admin WHERE id= $id";

//Execute the query
$res = mysqli_query($conn, $sql);

//check whether the query executed successfully or not

if($res==TRUE)
{
  //query executed successfully
  //create sesson variable to display msg
  $_SESSION['delete']= "<div class='success'> Admin Deleted Sccessfully.</div>";
  //Redirect to manage_admin page
  header("location:" .SITEURL.'admin/manage-admin.php');
}

else
{
    //failed to delete
    //echo "failed to delete";
    //create sesson variable to display msg
  $_SESSION['delete']= "<div class='error'> Failed To Delete. Try Again Later.</div>";
  //Redirect to manage_admin page
  header("location:" .SITEURL.'admin/manage-admin.php');
}

?>