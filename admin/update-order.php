<?php include('partials/menu.php') ?>
<div class="main-content">
       <div class="wrapper">
           <h1>Update Order</h1>
<br> <br>
        <?php 
           //chech if the id is set or not
           if( isset($_GET['id']))
           {
                //get the order details
                $id=$_GET['id'];
                $sql= "SELECT * FROM tbl_order WHERE id=$id";

                //Execute the query
                $res= mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                //check whether the query is executed or not
                    if($count==1)
                    {
                        //get the details
                        
                        $rows = mysqli_fetch_assoc($res);

                        $id=$rows['id'];
                        $food=$rows['food'];
                        $price=$rows['price'];
                        $qty=$rows['qty'];
                        $status=$rows['status'];
                        $customer_name=$rows['customer_name'];
                        $customer_contact=$rows['customer_contact'];
                        $customer_email=$rows['customer_email'];
                        $customer_address=$rows['customer_address'];
                                      

                    }
                    else
                    {
                          //redirect page to Manage Order page
                          header("location:".SITEURL.'admin/manage-order.php');
                    }

                

           }

           else
           {
               //redirect page to Manage Order page
              header("location:".SITEURL.'admin/manage-order.php');
           }

        ?>

           <form action="" method="POST">
               <table class="tbl-30">
               <tr>
                   <td>Food Name</td>
                   <td><b> <?php echo $food; ?> </b></td>
               </tr>

               <tr>
                    <td>Price</td>
                    <td><b>$<?php echo $price; ?> </b></td>
                </tr>

               <tr>
                   <td>Qty</td>
                   <td>
                       <input type="number" name="qty" value="<?php echo $qty; ?>">
                   </td>
               </tr>

            <tr>
                <td>Status</td>
                <td>
                    <select name="status">
                        <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                        <option <?php if($status=="On Delivary"){echo "selected";} ?>
                        value="On Delivary">On Delivary</option>
                        <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                        <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>

                    </select>
                </td>
            </tr>

               <tr>
                   <td>Customer Name: </td>
                   <td>
                       <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                   </td>
               </tr>

               <tr>
                   <td>Customer Contact: </td>
                   <td>
                       <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                   </td>
               </tr>
               <tr>
                   <td>Customer Email: </td>
                   <td>
                       <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                   </td>
               </tr>
               <tr>
                   <td>Customer Address: </td>
                   <td>
                      <textarea name="customer_address" cols="22" rows="5"><?php echo $customer_address; ?></textarea>
                   </td>
               </tr>
               <tr>
                       <td colspan="2">
                           <input type="hidden" name="id" value="<?php echo $id; ?>">
                           <input type="hidden" name="price" value="<?php echo $price; ?>">
                           <input type="submit"  name="submit" class="btn-secondary" value="Update Order">
                       </td>
                </tr>
                   
               </table>

           </form>
<?php

    if(isset($_POST['submit']))
        {
            //echo "Button Clicked";
            // get all the values from form to update

            $id=$_POST['id'];
            $price=$_POST['price'];
            $qty=$_POST['qty'];
            $total=$price * $qty;
            $status=$_POST['status'];
            $customer_name=$_POST['customer_name'];
            $customer_contact=$_POST['customer_contact'];
            $customer_email=$_POST['customer_email'];
            $customer_address=$_POST['customer_address'];

            //create SQL query to update admin

            $sql2= "UPDATE tbl_order SET
                qty='$qty',
                total='$total',
                status='$status',
                customer_name='$customer_name',
                customer_contact='$customer_contact',
                customer_email='$customer_email',
                customer_address='$customer_address'
                WHERE id=$id
                ";
            //Execute the query
            $res2= mysqli_query($conn, $sql2);

            //check whether the query is executed or not
            if($res2==TRUE)
            {
                //query updated
                $_SESSION['update']="<div class='success'> Order Updated Successfully. </div>";
                //Redirect to manage_admin page
                header("location:" .SITEURL.'admin/manage-order.php');

            }

            else
            {
                //failed to update
                $_SESSION['update']="<div class='error'> Failed To Update Order. </div>";
                //Redirect to manage_admin page
                header("location:" .SITEURL.'admin/manage-order.php');
            }

        }

?>
        </div>
</div>


<?php include('partials/footer.php') ?>