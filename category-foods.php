<?php include('partials-front/menu.php'); 

if(isset($_GET['category_id']))
{
    //category_id is set and get the id
    $category_id=$_GET['category_id'];
    //get the category title accorging to category_id
    $sql= "SELECT title from tbl_category WHERE id = $category_id";
    //execute the query
    $res= mysqli_query($conn, $sql);
    //get value from database
    $row=mysqli_fetch_assoc($res);
    //get the title
    $category_title=$row['title'];

}
else
{
    header('location:'.SITEURL);
}

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->


    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
          <?php 

            //sql query to get foods based on search keyword
            $sql2 = "SELECT * FROM tbl_food WHERE category_id= $category_id";

            //execute the query
            $res2= mysqli_query($conn, $sql2);

            //count rows
            $count = mysqli_num_rows($res2);

            //check whether food available or not
            if($count>0)
            {
                //food available
                while($row2=mysqli_fetch_assoc($res2))
                {
                    //get the details from database
                    $id=$row2['id'];
                    $title=$row2['title'];
                    $price=$row2['price'];
                    $description=$row2['description'];
                    $image_name=$row2['image_name'];
          ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">
          <?php
                    if($image_name=="")
                    {
                        echo "<div class='error'>Image Not Available.</div>"; 
                    }
                    else
                    {
        ?>
                    <img src="<?php echo SITEURL; ?>/images/food/<?php echo $image_name; ?>" alt="Chicken Hawain Pizza" class="img-responsive img-curve">
        <?php
                    }
                    ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">$<?php echo $price; ?></p>
                        <p class="food-detail"><?php echo $description; ?></p>
                        <br>

                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>

                    <?php
                }

            }

            else
            {
                //no food available
                echo "<div class='error'> Food is not available.</div>";
            }


            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>