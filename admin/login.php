<?php include('../config/constants.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Login - Food Order System</title>
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br> <br>
        <?php
         
         if(isset($_SESSION['login']))
         {
             echo $_SESSION['login'];
             unset($_SESSION['login']);
         }

         if(isset($_SESSION['no-login-msg']))
         {
             echo $_SESSION['no-login-msg'];
             unset($_SESSION['no-login-msg']);
         }
         

        ?>
<br> <br>

        <!-- Login Form starts here -->
        <form action="" method="post" class="text-center">

        <label for="username">Username:</label>
        <input type="text" name="username" placeholder="Enter Username">
        <br> <br>
        <label for="password">Password:</label>
        <input type="password" name="password" placeholder="Enter Password">
        <br> <br>
        <input type="submit" name="submit" class="btn-primary" value="Login">

        <br> <br>

        </form>

        <!-- Login Form ends here -->

        <p class="text-center">Created By <a href="www.tahminariya.com">Tahmina Ria</a></p>
    </div>
    
</body>
</html>


<?php
// check whether the submit button is clicked or not.
if(isset($_POST['submit']))
{
    //process for login
    //1. get the data from login form
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $raw_pass= md5($_POST['password']);
    $password = mysqli_real_escape_string($conn,$raw_pass);

    //2. check whether the user with username and password exists or not
    $sql= "SELECT * FROM tbl_admin where username='$username' AND password='$password' ";

    //3. execute the query
    $res = mysqli_query($conn,$sql);

    //4.count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if($count==1)
    {
        // user available & login Success
        $_SESSION['login']="<div class='success'> Login Succuessful. </div>";
        $_SESSION['user']= $username; //to check whether the user is logged in or not
        //Redirect to home page/dashboard
        header("location:" .SITEURL.'admin/');

    }

    else
    {
        //user not available
        $_SESSION['login']="<div class='error text-center'> Username or Password did not match. </div>";
        //Redirect to home page/dashboard
        header("location:" .SITEURL.'admin/login.php');

    }



}
 ?>

