<?php
include('header.php');
include('navbar.php');
?>
  
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="index.php"><i class="fa fa-home"></i> Home</a>
                        <a href="shop.php">Placing Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->
    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" id="popover_content_wrapper">
                    <div class="cart-table" id="cart_details">
                    <script src="js/jquery-3.3.1.min.js"></script>
                    <script src="js/jquery-ui.min.js"></script>
                    <?php 
                    function get_vendor_email($conn,$vendor_id){
                        $data_=$conn->query("SELECT vend_email FROM `tbl_vendors` where vendor_id='$vendor_id'");
                        $merchant_email=mysqli_fetch_assoc($data_);
                        echo $merchant_email['vend_email'];
                    }
                    //print_r($_POST);
                    $address = $_POST['address'];
                    ob_start();
                    if(!isset($_SESSION)){
                    session_start();
                    }
                    if(isset($_SESSION['merchant'])){
                        $custome_id = $_SESSION['merchant']['mer_id'];
                    foreach($_POST['product_id'] as $i => $product_id) 
                            { 

                                $marchant_id = $_POST['marchant_id'][$i];
                                $product_id = $_POST['product_id'][$i];
                                $product_quantity = $_POST['product_quantity'][$i];
                                $vendor_id = $_POST['vendor_id'][$i];
                                // echo "INSERT INTO `tbl_orders`(`marchant_id`, `product_id`, `product_quantity`) VALUES('$marchant_id','$product_id','$product_quantity')";
                               $vendor_email=get_vendor_email($conn,$vendor_id);
                               $current_qty=get_product_qty($conn,$product_id);
                                $insertorders=$conn->query("INSERT INTO `tbl_orders`(`marchant_id`, `product_id`, `product_quantity`, `delivery_address`, `customer_id`) VALUES('$marchant_id','$product_id','$product_quantity','$address','$vendor_id')");
                               update_product_qty($conn,$product_id,$current_qty,$product_quantity);
                                
                                $to = ".$vendor_email.";
                               $mail_subject = "New Order Placed";
                                $mail_message = "
                                <html>
                                <head>
                                <title>Please Check Your Portal To see order details</title>
                                </head>
                                <body>
                                A new order Placed on Your Shop, Please check your Portal for details
                                Order Quantity: ".$product_quantity."
                                <br>
                                
                                </body>
                                </html>
                                ";
                                //dont forget to include content-type on header if your sending html
                                $headers = "MIME-Version: 1.0" . "\r\n";
                                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                                // $headers .= "From: webmaster@konjae.com";
                                     mail($to,$mail_subject,$mail_message,$headers);


                                     $to = "info@konjae.com";
                                     $mail_subject = "New Order Placed";
                                      $mail_message = "
                                      <html>
                                      <head>
                                      <title>Please Check Your Portal To see order details</title>
                                      </head>
                                      <body>
                                      A new order Placed on Your Shop, Please check your Portal for details
                                      Order Quantity: ".$product_quantity."
                                      <br>
                                      
                                      </body>
                                      </html>
                                      ";
                                      //dont forget to include content-type on header if your sending html
                                      $headers = "MIME-Version: 1.0" . "\r\n";
                                      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                                    //   $headers .= "From: webmaster@konjae.com";
                                           mail($to,$mail_subject,$mail_message,$headers);
                               
                  
                            }
                        }
                            if($insertorders){
                                // $mail_to=""
                                // $_SESSION['msg']['icon']='success';
                                // $_SESSION['msg']['title']='Successfully';
                                // $_SESSION['msg']['description']=' Your Order has been Placed Successfully. Our Representative will Contact You Soon. Thanks.';

                                ?>
                             <script>
                        
                                            alert("Your Order has been Placed Successfully. Our Representative will Contact You Soon. Thanks."); 
                                            $.noConflict();
                                            jQuery(document).ready(function(){
                                                //alert("test");

                                                var action = 'empty';
                                                        $.ajax({
                                                            url:"cart_action.php",
                                                            method:"POST",
                                                            data:{action:action},
                                                            success:function()
                                                            {
                                                                load_cart_data();
                                                                $('#cart-popover').popover('hide');
                                                                alert("Your Cart has been clear");
                                                            }
                                                        });
                                                    location.replace("shop.php");                    
                                            });
                            </script>
                             
                           <?php }
                    ?>
                   
                    </script>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="cart-buttons">
                                <a href="shop.php" class="primary-btn continue-shop">Continue shopping</a>
                                <!-- <a href="#" class="primary-btn up-cart">Update cart</a> -->
                            </div>
                            <!-- <div class="discount-coupon">
                                <h6>Discount Codes</h6>
                                <form action="#" class="coupon-form">
                                    <input type="text" class="mycustom_class" placeholder="Enter your codes">
                                    <button type="submit" class="site-btn coupon-btn">Apply</button>
                                </form>
                            </div> -->
                        </div>
                        <!-- <div class="col-lg-4 offset-lg-4">
                            <div class="proceed-checkout">
                                <ul>
                                    <li class="subtotal">Subtotal <span>$240.00</span></li>
                                    <li class="cart-total">Total <span>$240.00</span></li>
                                </ul>
                                <a href="#" class="proceed-btn">PROCEED TO CHECK OUT</a>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

   
<?php
include('footer.php');
?>