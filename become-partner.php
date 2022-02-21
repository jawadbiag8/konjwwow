<?php
include('header.php');
include('navbar.php');
?>
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="index.php"><i class="fa fa-home"></i> Home</a>
                        <span>Become a Partner</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->


    <!-- Contact Section Begin -->
    <section class="contact-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="contact-title">
                        <h4>Become a Partner/Vendor</h4>
                        <p>KON JAE is Pakistan’s first B2B virtual Textile networking and sourcing platform to link buyers and suppliers and further focus on the Global Textile and Apparel Sector.</p>
                    </div>
                    <div class="contact-widget">
                        <div class="cw-item">
                            <div class="ci-icon">
                                <i class="ti-location-pin"></i>
                            </div>
                            <div class="ci-text">
                                <span>Vendors:</span>
                                <p>KON JAE is a huge platform to provide easy access to multiple trustworthy textile gems to showcase their products and sell online.</p>
                            </div>
                        </div>
                        <!-- <div class="cw-item">
                            <div class="ci-icon">
                                <i class="ti-mobile"></i>
                            </div>
                            <div class="ci-text">
                                <span>Phone:</span>
                                <p>+92 51 142535</p>
                            </div>
                        </div> -->
                        <div class="cw-item">
                            <div class="ci-icon">
                                <i class="ti-email"></i>
                            </div>
                            <div class="ci-text">
                                <span>Email:</span>
                                <p>info@konjae.com</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <div class="contact-form">
                        <div class="leave-comment">
                            <h4>Partner/Vendor Registration Form</h4>
                            <p>Fill Your Informations Our Support Will Contact You with in 24 Hrs</p>
                            <?php 
                            if(isset($_SESSION['msg'])){
                             ?>
                             <div class="alert alert-success">
                                Your Request Submitted Successfully, Please Wait. Our Support will Contact You with in 24 Hrs After Some basics Verifications. Thanks.
                            </div>
                             <?php
                            }

                            ?>
                            
                            <form action="action.php" class="comment-form" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-6">
                                    <label for="">Your Name <span class="text-danger">*</span> </label>
                                        <input type="text" name="name" required placeholder="Your name" class="form-control">
                                    </div>
                                    <div class="col-lg-6">
                                    <label for="">Your Email <span class="text-danger">*</span></label>
                                        <input type="text" name="email" required placeholder="Your email" class="form-control">
                                    </div>
                                    <div class="col-lg-6">
                                    <label for="">Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" required placeholder="Your Password" class="form-control">
                                    </div>
                                    <div class="col-lg-6">
                                    <label for="">Your Mobile <span class="text-danger">*</span></label>
                                        <input type="text" required placeholder="Your Mobile No" class="form-control" name="mobile_number">
                                    </div>
                                    <div class="col-lg-6">
                                    <label for="">Your Business Name(if any) </label>
                                        <input type="text" name="business_name" placeholder="Your Business" class="form-control">
                                    </div>

                                    <div class="col-lg-6">
                                    <label for="">Your Business Logo(if any) </label>
                                        <input type="file" class="form-control" name="business_logo">
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                    <button type="submit" class="btn btn-success btn-block mt-3" name="save_partner">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <?php
include('footer.php');
?>