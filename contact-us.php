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
                    <span>Contact Us</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Map Section Begin -->
<div class="map spad">
    <div class="container">
        <div class="map-inner">
        <!--<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13273.406756660019!2d73.0877679!3d33.7257209!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xce8112a92e5f5bef!2sCybmerce%20Tech%20Private%20Limited!5e0!3m2!1sen!2s!4v1629998430676!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>-->
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3318.885776333264!2d73.0556113149657!3d33.71190444303614!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38dfbfbb539ddeaf%3A0x858d300eddf99ba5!2sIslamabad%20Stock%20Exchange%20Tower%2C%20Block%20J%20F%207%2F1%20Blue%20Area%2C%20Islamabad%2C%20Islamabad%20Capital%20Territory%2C%20Pakistan!5e0!3m2!1sen!2sus!4v1649414307505!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="icon">
                <i class="fa fa-map-marker"></i>
            </div>


        </div>
    </div>
</div>
<!-- Map Section Begin -->

<!-- Contact Section Begin -->
<section class="contact-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="contact-title">
                    <h4>Contact Us</h4>
                    <p>KON JAE is Pakistan’s first B2B virtual Textile networking and sourcing platform to link buyers and suppliers and further focus on the Global Textile and Apparel Sector.</p>
                </div>
                <div class="contact-widget">
                    <div class="cw-item">
                        <div class="ci-icon">
                            <i class="ti-location-pin"></i>
                        </div>
                        <div class="ci-text">
                            <span>Address:</span>
                            <p>Office 201, 2nd Floor, Stock Exchange Tower, Blue Area, Islamabad</p>
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
                        <h4>Get in Touch</h4>
                        <p>Our Team will get back to you to answer your questions.</p>
                        <form action="action.php" class="comment-form" method="POST">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="">Your Name <span class="text-danger">*</span> </label>
                                    <input type="text" required name="name" placeholder="Your name" class="form-control">
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Your Mobile Number <span class="text-danger">*</span></label>

                                    <input type="text" required name="email" placeholder="Your Mobile Number" class="form-control" required>
                                </div>
                                <div class="col-lg-12">
                                    <label for="">Your Message <span class="text-danger">*</span></label>
                                    <textarea placeholder="Your message "name="msgs" required class="form-control"></textarea>
                                    <button type="submit" name="contact_msgs" class="site-btn">Send message</button>
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