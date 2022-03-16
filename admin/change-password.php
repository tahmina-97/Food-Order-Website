<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br> <br>

        <?php 
           //get the id of selected admin
           if(isset($_GET['id']))
           {
            $id=$_GET['id'];
           }

        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                      <input type="hidden" name="id" value="<?php echo $id; ?>">
                      <input type="submit" name="submit" class="btn-secondary" value="Change Password">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>
<?php
//check whether the submit[change password] button is clicked or not
if(isset($_POST['submit']))
{
    //1. get the data from form
    $id=$_POST['id'];
    $current_password=md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $confirm_password=md5($_POST['confirm_password']);

    //2. check whether the user with current id and current password exist or not
    $sql= "SELECT * FROM tbl_admin WHERE id=$id and password='$current_password'";
    //Execute the query
    $res = mysqli_query($conn, $sql);

    //check whether the query is executed or not
    if($res==TRUE)
    {
        $count = mysqli_num_rows($res);
        if($count==1) //check there is only one data matched 
        {
            //user exists and password can be changed
            //check whether new and confirm password matched or not
            if($new_password==$confirm_password)
            {
                //channge the password
                $sql2= "UPDATE tbl_admin SET
                password='$new_password'
                WHERE id=$id
                ";
                $res2 = mysqli_query($conn, $sql2);
                if($res2==TRUE)
                {
                    //display success message
                    $_SESSION['change-pwd']="<div class='success'> Password Changed Successfully. </div>";
                    //Redirect to manage_admin page
                    header("location:" .SITEURL.'admin/manage-admin.php');

                }
                else
                {
                    //display error message
                    $_SESSION['change-pwd']="<div class='error'> Failed To Change Password. </div>";
                    //Redirect to manage_admin page
                    header("location:" .SITEURL.'admin/manage-admin.php');
                }


            }
            else
            {
                //user doesnt exist
                $_SESSION['not_matched']="<div class='error'> Password Did Not Match. </div>";
                //Redirect to manage_admin page
                header("location:" .SITEURL.'admin/manage-admin.php');
            }
        }
        else
        {   //user doesnt exist
            $_SESSION['user-not-found']="<div class='error'> User Not Found. </div>";
            //Redirect to manage_admin page
            header("location:" .SITEURL.'admin/manage-admin.php');
        }

    }


    
    //4. change password if all above is true
}
?>


<?php include('partials/footer.php') ?>

