<?php

//include constants.php file here

include('../config/constants.php');

//1. check whether the id and image_name is set or not
if( isset($_GET['id']) AND isset($_GET['image_name']))
{
   //get gthe value and delete
   $id = $_GET['id'];
   $image_name = $_GET['image_name'];
   if($image_name != "")// image is available
   {
       //remove it
       $path="../images/category/".$image_name;
       $remove=unlink($path);
       if($remove==FALSE)
       {
           //redirect to manage_category page
           $_SESSION['remove']=" <div class='error'>Failed To Remove Category Image</div>";
           //redirect page to Manage Category page
           header("location:".SITEURL.'admin/manage-category.php');
           die();
       }
   }

   //2. Create SQL query to delete admin

$sql= "DELETE FROM tbl_category WHERE id= $id";

//Execute the query
$res = mysqli_query($conn, $sql);

//check whether the query executed successfully or not

 if($res==TRUE)
 {
  //query executed successfully
  //create sesson variable to display msg
  $_SESSION['delete']= "<div class='success'> Category Deleted Successfully.</div>";
  //Redirect to manage_admin page
  header("location:" .SITEURL.'admin/manage-category.php');
 }

 else
 {
    //failed to delete
    //echo "failed to delete";
    //create sesson variable to display msg
  $_SESSION['delete']= "<div class='error'> Failed To Delete. Try Again Later.</div>";
  //Redirect to manage_admin page
  header("location:" .SITEURL.'admin/manage-category.php');
 }

}

 else
 {
    //redirect page to Manage Category page
    header("location:".SITEURL.'admin/manage-category.php');
}

?>