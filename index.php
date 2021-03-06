<?php
include('header.php');

include('navbar.php');

include("common/lib/conn.php");
?>
<style>
    .modal-dialog {
        display: flex !important;
        align-items: center !important;
        flex-direction: column;
    }

    @media (min-width: 576px) {
        .modal-dialog {
            max-width: 9300px;
            margin: 1.75rem auto;
        }

        .modal-content {
            width: max-content;
            height: max-content;
        }
    }
</style>
<!-- .Hero Section Begin -->

<section class="hero-section">

    <div class="hero-items owl-carousel">

        <?php
        $slider = $conn->query("SELECT * FROM `tbl_home_slider_control`");

        while ($rs = $slider->fetch_assoc()) {
        ?>

            <div class="single-hero-items set-bg" data-setbg="common/dist/slider_images/<?= $rs['slider_image']; ?>">

                <div class="container">

                    <div class="row">

                        <div class="col-lg-5">

                            <span>Kon Jae</span>

                            <h1><?= $rs['slider_content']; ?></h1>

                            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor

                                                                                incididunt ut labore et dolore</p> -->

                            <?php
                            if ($rs['is_button_exist'] == 1) {
                            ?>

                                <a href="<?= $rs['button_url']; ?>" class="primary-btn"><?= $rs['button_content']; ?></a>

                            <?php
                            }
                            ?>



                        </div>

                    </div>

                    <!-- <div class="off-card">

                        <h2>Sale <span>50%</span></h2>

                    </div> -->

                </div>

            </div>

        <?php
        }
        ?>



        <!-- <div class="single-hero-items set-bg" data-setbg="img/hero-2.jpg">

            <div class="container">

                <div class="row">

                    <div class="col-lg-5">

                        <span>Kon Jae</span>

                        <h1>Nationwide B2B Online Networking, Sourcing Platform</h1>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor

                            incididunt ut labore et dolore</p>

                        <a href="#" class="primary-btn">Shop Now</a>

                    </div>

                </div>

               

            </div>

        </div> -->



    </div>

</section>

<!-- Hero Section End -->

<!-- Banner Section Begin -->

<!-- <div class="banner-section spad">

     <div class="container-fluid">

         <h2 class="text-center pb-4 heading_label">Our Feature Products</h2>

         <div class="row">

         

             <div class="col-lg-4">

                 <div class="single-banner">

                     <img src="img/banner-1.jpg" alt="">

                     <div class="inner-text">

                         <h4>Business One</h4>

                     </div>

                 </div>

             </div>

             <div class="col-lg-4">

                 <div class="single-banner">

                     <img src="img/banner-2.jpg" alt="">

                     <div class="inner-text">

                         <h4>Business Two</h4>

                     </div>

                 </div>

             </div>

             <div class="col-lg-4">

                 <div class="single-banner">

                     <img src="img/banner-3.jpg" alt="">

                     <div class="inner-text">

                         <h4>Business Three</h4>

                     </div>

                 </div>

             </div>

         </div>

     </div>

 </div> -->

<!-- Banner Section End -->



<!-- Women Banner Section Begin -->

<section class="women-banner spad mt-5">

    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-3">

                <div class="gold_slider owl-carousel">

                    <?php
                    $slider_ads = $userdata = $conn->query("SELECT tbl_ads_requests.*,tbl_products.product_name,tbl_advertisment_packages.pkg_name FROM `tbl_ads_requests` INNER JOIN tbl_products ON tbl_products.product_id=tbl_ads_requests.product_id INNER JOIN tbl_advertisment_packages ON tbl_advertisment_packages.pkg_id=tbl_ads_requests.pkg_id where tbl_ads_requests.publish_status='publish'");
                    $count = 0;

                    while ($row = $userdata->fetch_assoc()) :

                        $count++;
                    ?>

                        <div class="product-large set-bg" data-setbg="common/dist/img/<?= $row['media_image']; ?>">

                            <h2><?= $row['product_name']; ?></h2>

                            <a href="<?= $row['link']; ?>">Discover More</a>

                        </div>

                    <?php
                    endwhile;
                    ?>

                    <!-- <div class="product-large set-bg" data-setbg="img/products/women-large.jpg">

                        <h2>Women two</h2>

                        <a href="#">Discover More</a>

                    </div> -->



                </div>

            </div>

            <div class="col-lg-8 offset-lg-1">

                <!-- <div class="filter-control">

                    <ul>

                        <li class="active">Clothings</li>

                        <li>HandBag</li>

                        <li>Shoes</li>

                        <li>Accessories</li>

                    </ul>

                </div> -->

                <div class="product-slider owl-carousel mt-5">



                    <?php
                    $productdata = $conn->query("SELECT * FROM `tbl_vendors` WHERE vend_memberships = '1'");

                    $count = 0;

                    while ($productrow = $productdata->fetch_assoc()) :
                    ?>

                        <div class="product-item">

                            <a href="shop.php?store_id=<?php echo $productrow['vendor_id']; ?>">

                                <div class="pi-pic">

                                    <img src="common/dist/img/<?php echo $productrow['vend_logo']; ?>" alt="" class="imag_card">

                                    <ul>

                                        <!-- <li class="quick-view"><a href="shop.php?store_id=<?php echo $productrow['vendor_id']; ?>">View Shop </a></li> -->

                                    </ul>

                                </div>

                            </a>

                            <div class="pi-text">

                                <a href="shop.php?store_id=<?php echo $productrow['vendor_id']; ?>">

                                    <h5><?php echo $productrow['vend_business_name']; ?></h5>

                                </a>



                            </div>

                        </div>

                    <?php
                    endwhile;
                    ?>



                </div>

            </div>

        </div>

    </div>

</section>

<!-- Women Banner Section End -->







<!-- Deal Of The Week Section Begin-->

<?php
$get_deals = $conn->query("SELECT * FROM `tbl_deals_details` where deal_status=1 order by deal_id desc limit 1");

$deals_data = mysqli_fetch_assoc($get_deals);

if (mysqli_num_rows($get_deals) > 0) {

    $expiry = $deals_data['deal_expires_on'];
?>

    <section class="deal-of-week set-bg spad" data-setbg="common/dist/deals_images/<?= $deals_data['deal_image'] ?>">

        <div class="container">

            <div class="col-lg-6 text-center">

                <div class="section-title">

                    <h2><?= $deals_data['deal_title']; ?></h2>

                    <p><?= $deals_data['deal_content']; ?></p>

                    <div class="product-price">

                        <?= $deals_data['deal_price']; ?>

                        <span> RS</span>



                    </div>

                </div>

                <div class="countdown-timer" id="countdown">

                    <div class="cd-item">

                        <span>56</span>

                        <p>Days</p>

                    </div>

                    <div class="cd-item">

                        <span>12</span>

                        <p>Hrs</p>

                    </div>

                    <div class="cd-item">

                        <span>40</span>

                        <p>Mins</p>

                    </div>

                    <div class="cd-item">

                        <span>52</span>

                        <p>Secs</p>

                    </div>

                </div>

                <a href="<?= $deals_data['deal_button_url']; ?>" class="primary-btn"> <?= $deals_data['deal_button_title']; ?></a>

            </div>

        </div>

    </section>

<?php
}
?>

<!-- Deal Of The Week Section End -->



<!-- Man Banner Section Begin -->

<section class="man-banner spad">

    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-12">

                <div class="row">

                    <?php
                    $productdata = $conn->query("SELECT * FROM `tbl_products` WHERE product_status = 'approved' ORDER BY RAND() LIMIT 4");

                    $count = 0;

                    while ($productrow = $productdata->fetch_assoc()) :
                        //$productname=
                        // print_r($productrow);
                    ?>

                        <div class="col-lg-3 col-sm-6">

                            <div class="product-item">
                                   

                                <div class="pi-pic">

                                    <a href="product.php?title=<?= str_replace(" ", "_", $productrow['product_name']); ?>">
                                    
                                           <?php 
                                      $d1=date('Y-m-d', strtotime($productrow['created_at']. ' + 10 days'));
                                      $d2= date('Y-m-d');
                                      
                                       if($d1>$d2){
                                           echo '<span>New</span>';
                                       }
                                      //var_dump($d1); ?>
                                        <img src="common/dist/img/<?= $productrow['product_feature_image']; ?>" class="imag_card">

                                    </a>



                                    <!-- <div class="sale pp-sale">Sale</div> -->

                                    <!-- <div class="icon">
               
                                        <i class="icon_heart_alt"></i> 
               
                                    </div>-->

                                    <ul>

                                        <li class="w-icon active">



                                            <input type="hidden" name="quantity" id="quantity<?= $productrow['product_id']; ?>" class="form-control" value="1" />

                                            <input type="hidden" name="hidden_name" id="name<?= $productrow['product_id']; ?>" value="<?= $productrow['product_name']; ?>" />

                                            <input type="hidden" name="hidden_name" id="img<?= $productrow['product_id']; ?>" value="<?= $productrow['product_feature_image']; ?>" />

                                            <input type="hidden" name="hidden_price" id="price<?= $productrow['product_id']; ?>" value="<?= $productrow['product_price']; ?>" />

                                            <input type="hidden" name="vendor_id" id="vend_id<?= $productrow['product_id']; ?>" value="<?= $productrow['vendor_id']; ?>" />

                                        </li>

                                        <li class="quick-view"><button class=" action_bag add_to_cart" name="add_to_cart" id="<?= $productrow['product_id']; ?>">+ Add to Cart</button></li>

                                        <li class="w-icon"><a href="product.php?title=<?= str_replace(" ", "_", $productrow['product_name']); ?>">Details <i class="fa fa-info"></i></a></li>

                                    </ul>

                                </div>

                                <div class="pi-text">

                                    <div class="catagory-name"><?php get_vendor_name($productrow['vendor_id'], $conn); ?></div>

                                    <div class="catagory-name"><?php getCat($productrow['prod_cat'], $conn); ?></div>

                                    <a href="product.php?title=<?= str_replace(" ", "_", $productrow['product_name']); ?>">

                                        <h5><?= $productrow['product_name']; ?></h5>

                                    </a>

                                    <div class="product-price">

                                        RS-<?= $productrow['product_price']; ?>

                                    </div>

                                </div>

                            </div>

                        </div>



                    <?php
                    endwhile;
                    ?>







                </div>

                <div class="row">

                    <div class="col-md-12 text-center">

                        <a href="shop.php"><button class="btn btn-sm primary-btn ml-auto mr-auto text-center">View All</button></a>



                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- Man Banner Section End -->



<?php
include('footer.php');
?>

<script>
    'use strict';



    (function($) {
        $("#myModal").modal();
        /*------------------
         
         CountDown
         
         --------------------*/

        // For demo preview

        var today = new Date();

        var dd = String(today.getDate()).padStart(2, '0');

        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!

        var yyyy = today.getFullYear();

        if (mm == 12) {

            mm = '01';

            yyyy = yyyy + 1;

        } else {

            mm = parseInt(mm) + 1;

            mm = String(mm).padStart(2, '0');

        }

        var timerdate = mm + '/' + dd + '/' + yyyy;

        // For demo preview end



        console.log(timerdate);





        // Use this for real timer date

        // year

        // month

        // days

        <?php
        $date_exp = explode('-', $expiry);

        $yy = $date_exp[0];

        $mm = $date_exp[1];

        $dd = $date_exp[2];
        ?>

        var timerdate = "<?= $yy; ?>/<?= $mm; ?>/<?= $dd; ?>";



        $("#countdown").countdown(timerdate, function(event) {

            $(this).html(event.strftime("<div class='cd-item'><span>%D</span> <p>Days</p> </div>" + "<div class='cd-item'><span>%H</span> <p>Hrs</p> </div>" + "<div class='cd-item'><span>%M</span> <p>Mins</p> </div>" + "<div class='cd-item'><span>%S</span> <p>Secs</p> </div>"));

        });

    })(jQuery);
</script>