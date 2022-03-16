<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br> <br>

        <?php
           if(isset($_SESSION['add']))
           {
               echo $_SESSION['add'];
               unset($_SESSION['add']);
           }

           if(isset($_SESSION['upload']))
           {
               echo $_SESSION['upload'];
               unset($_SESSION['upload']);
           }
        ?>


        <!-- Add category forms starts  -->
        <form action="" method="POST" enctype="multipart/form-data">
               <table class="tbl-30">
                   <tr>
                       <td>Title: </td>
                       <td><input type="text" name="title" placeholder="Category Title"></td>
                   </tr>

                   <tr>
                       <td>Select Image: </td>
                       <td><input type="file" name="image"></td>
                   </tr>

                   <tr>
                       <td>Featured: </td>
                       <td>
                       <input type="radio" name="featured" value="Yes"> Yes 
                       <input type="radio" name="featured" value="No"> No 
                       </td>
                   </tr>

                   <tr>
                       <td>Active: </td>
                       <td>
                       <input type="radio" name="active" value="Yes"> Yes 
                       <input type="radio" name="active" value="No"> No 
                       </td>
                   </tr>
                  
                   <tr>
                       <td colspan="2">
                           <input type="submit"  name="submit" class="btn-secondary" value="Add Category">
                       </td>
                   </tr>
               </table>

           </form>
        <!-- Add category forms ends  -->

    </div>
</div>

<?php

//Check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
    //1. get the value from Category Form
    $title = $_POST['title'];
    
    //for radio input we need to check whether the button is checked or not

    if(isset($_POST['featured']))
    {
        //get the value from form
        $featured = $_POST['featured'];
    }
    else
    {
        //set the default value
        $featured = "No";
    }

    if(isset($_POST['active']))
    {
        //get the value from form
        $active = $_POST['active'];
    }
    else
    {
        //set the default value
        $active = "No";
    }

        //whether image is selected or not and set the value for image name accordingly
        if(isset($_FILES['image']['name']))
        {
            //upload the image
            //to upload image we need image name, source path and destination path

            $image_name = $_FILES['image']['name'];

            //upload the image only if img is selected
            if($image_name!="")
        {
            //auto-renaming the image(jpg, png, gif etc) e.g. "food1.jpg"
            $ext= end(explode('.', $image_name));
            $image_name = "Food-Category".rand(000,999).'.'.$ext;

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/".$image_name;

            //finally upload the image
            $upload= move_uploaded_file($source_path, $destination_path);

            //whether image is uploaded or not
            //if not uploaded we will stop process and redirect with erroe msg
            if($upload==FALSE)
            {
                //set mssg
                $_SESSION['upload']= "<div class='error'> Failed To Upload Image </div>";
                //redirect page to Add category page
                header("location:".SITEURL.'admin/add-category.php');
                die();
            }

        }
        }

    else
    {
        //dont upload image and set the image name value as blank
        $image_name="";
    }
    // print_r($_FILES['image']);

    // die();

    //2.create SQL query to insert category data into database
    $sql= "INSERT INTO tbl_category SET
        title='$title',
        image_name= '$image_name',
        featured='$featured',
        active='$active'
       ";
    
    //3. Execute the query and save in database
    $res= mysqli_query($conn, $sql);

    //4. check whether the query executed or not and data added or not
    if($res==TRUE){
        //query executed and category added
        //create a session method to display message
        $_SESSION['add']=" <div class='success'>Category Added Successfully </div>";
        //redirect page to Manage Category page
        header("location:".SITEURL.'admin/manage-category.php');
    }

    else{
        //Failed to add category
         //create a session method to display message
         $_SESSION['add']= "<div class='error'>Failed To Add category </div>";
         //redirect page to Add category page
         header("location:".SITEURL.'admin/add-category.php');
     }

}

?>


<?php include('partials/footer.php') ?>