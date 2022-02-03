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

<style>

.login-form {
    all: none;
}
.login-form input{
    background-color: darkgray !important;
}
</style>
    <!-- Contact Section Begin -->
    <section class="contact-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="contact-title">
                        <h4>Request A Quote</h4>
                        <p>Connect through B2B Textile Marketplace & Get your REQUIRED PRODUCT in an easy, quick, and accessible way.</p>
                    </div>
                    <div class="contact-widget">
                        <div class="cw-item">
                            <div class="ci-icon">
                                <i class="ti-location-pin"></i>
                            </div>
                            <div class="ci-text">
                                <span>Request a Quote:</span>
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
                                <p>support@konjae.com</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <div class="contact-form">
                        <div class="leave-comment">
                            <h4>Request a Quote Form</h4>
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
                            
                            <form action="action.php" class="login-form"  method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                    <label for="">Your Name <span class="text-danger">*</span> </label>
                                        <input type="text" name="name" required placeholder="Your name" class="form-control">
                                    </div>
                                    <div class="col-lg-6  mb-3">
                                    <label for="">Your Email <span class="text-danger">*</span></label>
                                        <input type="text" name="email" required placeholder="Your email" class="form-control">
                                    </div>
                                    <div class="col-lg-6  mb-3">
                                    <label for="">Your Mobile <span class="text-danger">*</span></label>
                                        <input type="text" required placeholder="Your Mobile No" class="form-control" name="mobile_number">
                                    </div>
                                    <div class="col-lg-6  mb-3">
                                    <label for="">Your Business Name(if any) </label>
                                        <input type="text" name="business_name" placeholder="Your Business" class="form-control">
                                    </div>
                                    <div class="col-lg-12 mb-4  ">
                                        <label for="">Select Category</label>
                                        <select name="cat_id" id="" class="form-control col-md-12" required>
                                            <option value="">Choose Category</option>
                                                <ul class="depart-hover">
                                                <?php 
                                        $userdata=$conn->query("SELECT `cat_id`, `cat_name`, `cat_feature_image`, `cat_unique_id`, `created_at` FROM `tbl_categories` ");
                                        while($row=$userdata->fetch_assoc()):
                                        ?>
                                        <option value="<?=$row['cat_id'];?>"><?=$row['cat_name'];?></option>
                                        <?php
                                        endwhile;
                                        ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-12  mb-3">
                                    <label for="">Your Address <span class="text-danger">*</span></label>
                                        <textarea placeholder="Your Address " name="address" required class="form-control"></textarea>
                                    </div>
                                    <div class="col-lg-12  mb-3">
                                    <label for="">Your Qoutations Details <span class="text-danger">*</span></label>
                                        <textarea placeholder="Your Quote " name="request_qoute" required class="form-control"></textarea>
                                    </div>
                                   <div class="col-lg-12  mb-3">
                                   <div class="group-input gi-check">
                                        <div class="gi-more">
                                            <label for="save-pass">
                                               
                                                <input type="checkbox" id="save-pass" required>
                                                <span class="checkmark"></span>
                                                I accept to let KonJae.com marketplace and hold my data as a consequence of my business request, such will be used by it only for possible occasional announcements regarding the marketplace and companies joining it.
                                            </label>
                                        </div>
                                    </div>
                                   </div>
                                    
                                    <div class="col-lg-12 col-md-12">
                                    <button type="submit" class="btn btn-dark btn-block mt-3" name="send_request">Send Request</button>
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