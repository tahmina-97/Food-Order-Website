<?php include('partials/menu.php'); ?>

    <!-- main-content section starts -->
    <div class="main-content">
       <div class="wrapper">
           <h1>Manage Food</h1>
           <br> 
           <br>
           <?php
           if(isset($_SESSION['add']))
           {
               echo $_SESSION['add'];
               unset($_SESSION['add']);
           }

           if(isset($_SESSION['remove']))
           {
               echo $_SESSION['remove'];
               unset($_SESSION['remove']);
           }

           if(isset($_SESSION['delete']))
           {
               echo $_SESSION['delete'];
               unset($_SESSION['delete']);
           }

           if(isset($_SESSION['no-food-found']))
           {
               echo $_SESSION['no-food-found'];
               unset($_SESSION['no-food-found']);
           }
           if(isset($_SESSION['upload']))
           {
               echo $_SESSION['upload'];
               unset($_SESSION['upload']);
           }
           if(isset($_SESSION['remove-failed']))
           {
               echo $_SESSION['remove-failed'];
               unset($_SESSION['remove-failed']);
           }
           if(isset($_SESSION['update']))
           {
               echo $_SESSION['update'];
               unset($_SESSION['update']);
           }


           ?>
           <br> <br>
            <a class="btn-primary" href="<?php echo SITEURL; ?>admin/add-food.php">Add Food</a>
           <br><br>
           <table class="tbl-full">
           <tr>
                   <th>S.N</th>
                   <th>Title</th>
                   <th>Image</th>
                   <th>Price</th>
                   <th>Featured</th>
                   <th>Active</th>
                   <th>Actions</th>
               </tr>

<?php 
    // query to get data of all food
    $sql= "SELECT * FROM  tbl_food";
  
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
                $title=$rows['title'];
                $image_name=$rows['image_name'];
                $price=$rows['price'];
                $featured=$rows['featured'];
                $active=$rows['active'];
                              
            //display the values in our table

?>

        <tr>
            <td> <?php echo $sn++; ?> </td>
            <td> <?php echo $title; ?></td>
            <td> 
                <?php
                  if($image_name!="")
                  {
                      ?>
                      <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px" height="120px">
                      <?php

                  } 
                  else
                  {
                      echo "<div class='error'>No Image Inserted.</div>";
                  }
                ?>
            </td>

            <td> <?php echo $price; ?> </td>
            <td> <?php echo $featured; ?> </td>
            <td> <?php echo $active; ?> </td>

            <td>

            <a class="btn-secondary" href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id;?>">Update Food</a>

            <a class="btn-danger" href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>">Delete Food</a> 

            </td>
        
<?php

               }
        }

        else
        {
            //we do not have data
            //we will display the msg inside tbl
            ?>
            <tr>
                <td colspan="7"><div class='error'>No Food Added Yet</div></td>
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