<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br> <br>

        <?php
          

           if(isset($_SESSION['upload']))
           {
               echo $_SESSION['upload'];
               unset($_SESSION['upload']);
           }
        ?>


        <!-- Add food forms starts  -->
        <form action="" method="POST" enctype="multipart/form-data">
               <table class="tbl-30">
                   <tr>
                       <td>Title: </td>
                       <td><input type="text" name="title" placeholder="Food Title"></td>
                   </tr>

                   <tr>
                       <td>Description: </td>
                       <td> <textarea name="description" cols="22" rows="5" placeholder="Food Description"></textarea></td>
                   </tr>

                   <tr>
                       <td>Price: </td>
                       <td><input type="number" name="price"></td>
                   </tr>

                   <tr>
                       <td>Select Image: </td>
                       <td><input type="file" name="image"></td>
                   </tr>
                   <tr>
                       <td>Category</td>
                       <td>
                           <select name="category">
                            <?php
                            //  add PHP code to display category from database
                            //  1.create sql to get all active categories from database
                            $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                            //executing quries
                            $res= mysqli_query($conn, $sql);
                            //whether we have data in database or not
                            $count = mysqli_num_rows($res);
                            if($count>0)
                            {
                            //we have categories
                                while($row=mysqli_fetch_assoc($res))
                                {
                                // while loop to get all the data from database
                                // it will run as long as we have data in database
                                $id=$row['id'];
                                $title=$row['title'];
                                ?>
                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                                }
            
                            }
                            else
                            {
                                //we dont have category
                                ?>
                                <option value="0">No Category Found</option>
                                <?php 
                            }

                            //  2.display on dropdown  
                            ?>
                           </select>
                       </td>
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
        <!-- Add food forms ends  -->
        <?php
    //check whether the button is clicked or not
 if(isset($_POST['submit']))
{
    //1. get the value from Category Form
    $title = $_POST['title'];
    $description= $_POST['description'];
    $price= $_POST['price'];
    $category= $_POST['category'];

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
    //for radio input we need to check whether the button is checked or not

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
            $image_name = "Food-Name-".rand(000,999).'.'.$ext;

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/food/".$image_name;

            //finally upload the food image
            $upload= move_uploaded_file($source_path, $destination_path);

            //whether image is uploaded or not
            //if not uploaded we will stop process and redirect with error msg
            if($upload==FALSE)
            {
                //set mssg
                $_SESSION['upload']= "<div class='error'> Failed To Upload Image </div>";
                //redirect page to Add category page
                header("location:".SITEURL.'admin/add-food.php');
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

    //2.create SQL query to insert food data into database
    $sql2= "INSERT INTO tbl_food SET
        title='$title',
        description='$description',
        price=$price,  -- cz price is a numeric value
        image_name= '$image_name',
        category_id= $category,
        featured='$featured',
        active='$active'
       ";
    
    //3. Execute the query and save in database
    $res2= mysqli_query($conn, $sql2);

    //4. check whether the query executed or not and data added or not
    if($res2==TRUE){
        //query executed and category added
        //create a session method to display message
        $_SESSION['add']=" <div class='success'>Food Added Successfully </div>";
        //redirect page to Manage Category page
        header("location:".SITEURL.'admin/manage-food.php');
    }

    else{
        //Failed to add category
         //create a session method to display message
         $_SESSION['add']= "<div class='error'>Failed To Add Food </div>";
         //redirect page to Add category page
         header("location:".SITEURL.'admin/add-food.php');
     }

}
        ?>

    </div>
</div>

<?php include('partials/footer.php') ?>