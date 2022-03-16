<?php include('partials/menu.php') ?>
<div class="main-content">
       <div class="wrapper">
           <h1>Update Food</h1>

           <br> <br>
           <?php 
           //chech if the id is set or not
           if( isset($_GET['id']))
        {
            $id=$_GET['id'];
               //Create SQL query to Get the Details
           $sql2= "SELECT * FROM tbl_food WHERE id=$id";

           //Execute the query
           $res2= mysqli_query($conn, $sql2);

           //check whether the query is executed or not
           if($res2==TRUE)
           {
               $count = mysqli_num_rows($res2);
               if($count==1)
               {
                   //get the details
                   
                   $row = mysqli_fetch_assoc($res2);

                   $title = $row['title'];
                   $description = $row['description'];
                   $price = $row['price'];
                   $current_image = $row['image_name'];
                   $current_category = $row['category_id'];
                   $featured = $row['featured'];
                   $active = $row['active'];

               }
               else
               {
                   $_SESSION['no-food-found']="<div class='error'> Food Not Found. </div>";
                   //redirect to manage admin page
                   header("location:" .SITEURL.'admin/manage-food.php');
               }

            }

           }
           else
           {
              //redirect page to Manage Category page
              header("location:".SITEURL.'admin/manage-food.php');
           }

           

        
           ?>

           <form action="" method="post" enctype="multipart/form-data">
               <table class="tbl-30">
                   <tr>
                       <td>Title: </td>
                       <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                   </tr>

                   <tr>
                       <td>Description: </td>
                       <td>
                           <textarea name="description" cols="22" rows="5" > <?php echo $description;?> </textarea>
        
                        </td>
                   </tr>

                   <tr>
                       <td>Price: </td>
                       <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
                   </tr>

                   <tr>
                       <td>Current Image: </td>
                       <td>
                        <?php
                           if($current_image != "")
                           {
                        ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="100px" > 
                         <?php
                          }
                           else
                           {
                               echo "<div class='error'> Image Not Added. </div>";
                           }

                         ?>
                       </td>
                   </tr>
                   <tr>
                       <td>New Image: </td>
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
                                $category_id=$row['id'];
                                $category_title=$row['title'];
                                ?>
                                <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
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
    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes 
    <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No 
                       </td>
                   </tr>

                   <tr>
                       <td>Active: </td>
                       <td>
    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes 
    <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No 
                       </td>
                   </tr>
                  
                   <tr>
                       <td colspan="2">
                           <input type="hidden" name="id" value="<?php echo $id; ?>">
                           <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                           <input type="submit"  name="submit" class="btn-secondary" value="Update Food">
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
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $current_image = $_POST['current_image'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    //1. updating the new image if selected
        
    if(isset($_FILES['image']['name']))
          {
              //upload the image
              //to upload image we need image name, source path and destination path
  
              $image_name = $_FILES['image']['name'];
  
              //upload the image only if img is selected
             if($image_name!="")
                {
              //auto-renaming the image(jpg, png, gif etc) e.g. "food1.jpg"
              $solve= explode('.', $image_name);
              $ext= end($solve);
              $image_name = "Food-Name-".rand(000,999).'.'.$ext;
  
              $source_path = $_FILES['image']['tmp_name'];
              $destination_path = "../images/food/".$image_name;
  
              //finally upload the food image
              $upload= move_uploaded_file($source_path, $destination_path);
  
  
              //whether image is uploaded or not
              //if not uploaded we will stop process and redirect with erroe msg
              if($upload==FALSE)
              {
                  //set mssg
                  $_SESSION['upload']= "<div class='error'> Failed To Upload Image </div>";
                  //redirect page to Add category page
                  header("location:".SITEURL.'admin/manage-food.php');
                  die();
              }
        //remove the current image
        if($image_name!="")
        {
            $path="../images/food/".$current_image;
            $remove=unlink($path);
            if($remove==FALSE)
            {
                //redirect to manage_category page
                $_SESSION['remove-failed']=" <div class='error'>Failed To Remove Current Image</div>";
                //redirect page to Manage Category page
                header("location:".SITEURL.'admin/manage-food.php');
                die();
            }

        }

          }
          else
          {
              $image_name= $current_image;
          }

    }

    else
    {
        $image_name= $current_image;
    }

    //2. create SQL query to update database

    $sql3= "UPDATE tbl_food SET
    title= '$title',
    description= '$description',
    price= $price,
    image_name= '$image_name',
    category_id= $category,
    featured= '$featured',
    active= '$active'
    WHERE id= '$id'
    ";
    //Execute the query
    $res3= mysqli_query($conn, $sql3);

    //check whether the query is executed or not
    if($res3==TRUE)
    {
        //query updated
        $_SESSION['update']="<div class='success'> Food Updated Successfully. </div>";
        //Redirect to manage_food page
        header("location:" .SITEURL.'admin/manage-food.php');

    }

    else
    {
        //failed to update
        $_SESSION['update']="<div class='error'> Failed To Update Category. </div>";
        //Redirect to manage_admin page
        header("location:" .SITEURL.'admin/manage-food.php');
    }

}

?>

<?php include('partials/footer.php') ?>