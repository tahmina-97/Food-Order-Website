<?php include('partials/menu.php'); ?>

    <!-- main-content section starts -->
    <div class="main-content">
       <div class="wrapper">
           <h1>Manage Admin</h1>
           <br> 

        <?php
           if(isset($_SESSION['add']))
           {
               echo $_SESSION['add'];
               unset($_SESSION['add']);
           }

           if(isset($_SESSION['delete']))
           {
               echo $_SESSION['delete'];
               unset($_SESSION['delete']);
           }

           if(isset($_SESSION['update']))
           {
               echo $_SESSION['update'];
               unset($_SESSION['update']);
           }

           if(isset($_SESSION['user-not-found']))
           {
               echo $_SESSION['user-not-found'];
               unset($_SESSION['user-not-found']);
           }

           if(isset($_SESSION['not-matched']))
           {
               echo $_SESSION['not-matched'];
               unset($_SESSION['not-matched']);
           }

           if(isset($_SESSION['change-pwd']))
           {
               echo $_SESSION['change-pwd'];
               unset($_SESSION['change-pwd']);
           }


?>
<br><br>
<a class="btn-primary" href="add-admin.php">Add Admin</a>
<br><br>
    <table class="tbl-full">
        <tr>
         <th>S.N</th>
         <th>Full Name</th>
         <th>Username</th>
         <th>Actions</th>
        </tr>
<?php 
    // query to get all admin
    $sql= "SELECT * FROM  tbl_admin";
  
    //execute the query
    $res= mysqli_query($conn, $sql);

    //check whether the query is executed or not
    if($res==TRUE)
       {
    //count rows to check whether we have data in database or not  
    $count = mysqli_num_rows($res);
    $sn = 1; //create a variable and initialize with 1

    //check the number of rows
    if($count>0)
       {
        while($rows=mysqli_fetch_assoc($res))
            {
            // while loop to get all the data from database
            // it will run as long as we have data in database
                $id=$rows['id'];
                $full_name=$rows['full_name'];
                $username=$rows['username'];
                              
            //display the values in our table

?>

        <tr>
            <td> <?php echo $sn++; ?> </td>
            <td> <?php echo $full_name; ?></td>
            <td> <?php echo $username; ?> </td>
            <td>

            <a class="btn-primary" href="<?php echo SITEURL;?>admin/change-password.php?id=<?php echo $id;?>">Change Password</a>

            <a class="btn-secondary" href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>">Update Admin</a>

            <a class="btn-danger" href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>">Delete Admin</a> 

            </td>
        </tr>

<?php

               }
        }

        else
        {
            ?>
            <tr>
                <td colspan="7"><div class='error'>No Admin Added Yet</div></td>
            </tr>

            <?php 

        }

        }
?>

    </table>

       </div>
    </div>    
    <!-- main-content section ends -->

    <?php include('partials/footer.php'); ?>