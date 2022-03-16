<?php include('partials/menu.php') ?>
<div class="main-content">
       <div class="wrapper">
           <h1>Update Admin</h1>

           <br> <br>
           <?php 
           //get the id of selected admin
           $id=$_GET['id'];

           //Create SQL query to Get the Details
           $sql= "SELECT * FROM tbl_admin WHERE id=$id";

           //Execute the query
           $res= mysqli_query($conn, $sql);

           //check whether the query is executed or not
           if($res==TRUE)
           {
               $count = mysqli_num_rows($res);
               if($count==1)
               {
                   //get the details
                   //echo "Admin Available;"
                   $row = mysqli_fetch_assoc($res);

                   $full_name = $row['full_name'];
                   $username = $row['username'];

               }
               else
               {
                   //redirect to manage admin page
                   header("location:" .SITEURL.'admin/manage-admin.php');
               }

           }
           ?>

           <form action="" method="post">
               <table class="tbl-30">
                   <tr>
                       <td>Full Name: </td>
                       <td><input type="text" name="full_name" value="<?php echo $full_name ?>"></td>
                   </tr>

                   <tr>
                       <td>Username: </td>
                       <td><input type="text" name="username" value="<?php echo $username ?>" ></td>
                   </tr>

                   <tr>
                       <td colspan="2">
                           <input type="hidden" name="id" value="<?php echo $id; ?>">
                           <input type="submit"  name="submit" class="btn-secondary" value="Update  Admin">
                       </td>
                   </tr>
               </table>

           </form>
        </div>
</div>

<?php 

//check whether the submit[update-admin] button is clicked or not
if(isset($_POST['submit']))
{
    //echo "Button Clicked";
    // get all the values from form to update

    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    //create SQL query to update admin

    $sql2= "UPDATE tbl_admin SET
    full_name= '$full_name',
    username= '$username'
    WHERE id= '$id'
    ";
    //Execute the query
    $res2= mysqli_query($conn, $sql2);

    //check whether the query is executed or not
    if($res2==TRUE)
    {
        //query updated
        $_SESSION['update']="<div class='success'> Admin Updated Successfully. </div>";
        //Redirect to manage_admin page
        header("location:" .SITEURL.'admin/manage-admin.php');

    }

    else
    {
        //failed to update
        $_SESSION['update']="<div class='error'> Failed To Update Admin. </div>";
        //Redirect to manage_admin page
        header("location:" .SITEURL.'admin/manage-admin.php');
    }

}

?>

<?php include('partials/footer.php') ?>