<?php include('partials/menu.php'); ?>

<!-- main-content section starts -->
    <div class="main-content">
       <div class="wrapper">
           <h1>Manage Category</h1>
           <br> <br>

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

           if(isset($_SESSION['remove']))
           {
               echo $_SESSION['remove'];
               unset($_SESSION['remove']);
           }

           if(isset($_SESSION['no-category-found']))
           {
               echo $_SESSION['no-category-found'];
               unset($_SESSION['no-category-found']);
           }
           if(isset($_SESSION['update']))
           {
               echo $_SESSION['update'];
               unset($_SESSION['update']);
           }
           if(isset($_SESSION['upload']))
           {
               echo $_SESSION['upload'];
               unset($_SESSION['upload']);
           }

           if(isset($_SESSION['failed-remove']))
           {
               echo $_SESSION['failed-remove'];
               unset($_SESSION['failed-remove']);
           }
           
        ?>
           <br> <br>

            <a class="btn-primary" href="<?php echo SITEURL; ?>admin/add-category.php">Add Category</a>
           <br><br>
           <table class="tbl-full">
               <tr>
                   <th>S.N</th>
                   <th>Title</th>
                   <th>Image</th>
                   <th>Featured</th>
                   <th>Active</th>
                   <th>Actions</th>
               </tr>

<?php 
    // query to get all admin
    $sql= "SELECT * FROM  tbl_category";
  
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
                      <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px" height="120px">
                      <?php

                  } 
                  else
                  {
                      echo "<div class='error'>No Image Inserted.</div>";
                  }
                ?>
            </td>
            <td> <?php echo $featured; ?> </td>
            <td> <?php echo $active; ?> </td>

            <td>

            <a class="btn-secondary" href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id;?>">Update Category</a>

            <a class="btn-danger" href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>">Delete Category</a> 

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
                <td colspan="6"><div class='error'>No Category Added Yet</div></td>
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