<?php include('partials/menu.php') ?>

    <!-- main-content section starts -->
    <div class="main-content">
       <div class="wrapper">
           <h1>Add Admin</h1>
           <br> <br>

           <?php
           if(isset($_SESSION['add']))
           {
               echo $_SESSION['add'];
               unset($_SESSION['add']);
           }
           ?>

           <br> <br>


           <form action="" method="post">
               <table class="tbl-30">
                   <tr>
                       <td>Full Name: </td>
                       <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                   </tr>

                   <tr>
                       <td>Username: </td>
                       <td><input type="text" name="username" placeholder="Your Username"></td>
                   </tr>

                   <tr>
                       <td>Password: </td>
                       <td><input type="password" name="password" placeholder="Your Password" id=""></td>
                   </tr>
                  
                   <tr>
                       <td colspan="2">
                           <input type="submit"  name="submit" class="btn-secondary" value="Add Admin">
                       </td>
                   </tr>
               </table>

           </form>
    </div>
    </div>

<?php include('partials/footer.php') ?>

<?php 
// process the value from form and save it in database.
// checked whether the submit button is clicked or not.
if(isset($_POST["submit"]))
{
    // button clicked
    // echo "Button Clicked";

    //1. get the data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //md5 for encrypted password 

    //2. SQL Query to save the data into database
   $sql= "INSERT INTO tbl_admin SET
        full_name='$full_name',
        username='$username',
        password='$password'
       ";
    //3. Executing query and saving data into database

    $res= mysqli_query($conn, $sql) or die(mysqli_error());
    
    //4. Check whether the data(Query is executed) is inserted or not and display appropriate message
    if($res==TRUE){
        //Data inserted successfully
        //create a session method to display message
        $_SESSION['add']=" <div class='success'>Admin Added Successfully </div>";
        //redirect page to Manage Admin
        header("location:" .SITEURL.'admin/manage-admin.php');
    }

    else{
        //Failed to insert data
         //create a session method to display message
         $_SESSION['add']= "<div class='error'>failed To Add Admin </div>";
         //redirect page to Add Admin
         header("location:" .SITEURL.'admin/add-admin.php');
     }
       
    }


?>