<?php include('partials/menu.php'); ?>

    <!-- main-content section starts -->
    <div class="main-content">
       <div class="wrapper">
           <h1>Manage Order</h1>

           <br> <br>
           <?php

           if(isset($_SESSION['update']))
           {
               echo $_SESSION['update'];
               unset($_SESSION['update']);
           }
           ?>

           <br> <br>
       
           <table class="tbl-full">
               <tr>
                   <th>S.N</th>
                   <th>Food</th>
                   <th>Price</th>
                   <th>Qty</th>
                   <th>Total</th>
                   <th>Order Date</th>
                   <th>Status</th>
                   <th>Customer Name</th>
                   <th>Contact</th>
                   <th>Email</th>
                   <th>Address</th>
                   <th>Actions</th>
               </tr>

        <?php 
    // query to get data of all food
    $sql= "SELECT * FROM  tbl_order ORDER BY id DESC"; //display the latest order at first
  
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
                $food=$rows['food'];
                $price=$rows['price'];
                $qty=$rows['qty'];
                $total=$rows['total'];
                $order_date=$rows['order_date'];
                $status=$rows['status'];
                $customer_name=$rows['customer_name'];
                $customer_contact=$rows['customer_contact'];
                $customer_email=$rows['customer_email'];
                $customer_address=$rows['customer_address'];
                              
            //display the values in our table

?>

        <tr>
            <td> <?php echo $sn++; ?> </td>
            <td> <?php echo $food; ?></td>
            <td> <?php echo $price; ?> </td>
            <td> <?php echo $qty; ?> </td>
            <td> <?php echo $total; ?> </td>
            <td> <?php echo $order_date; ?> </td>
            <td> <?php echo $status; ?> </td>
            <td> <?php echo $customer_name; ?> </td>
            <td> <?php echo $customer_contact; ?> </td>
            <td> <?php echo $customer_email; ?> </td>
            <td> <?php echo $customer_address; ?> </td>

            <td>

            <a class="btn-secondary" href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id;?>">Update Order</a>

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
                <td colspan="12"><div class='error'>Orders Not available</div></td>
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