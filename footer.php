<!-- Footer Section Begin --><footer class="footer-section">    <div class="container">        <div class="row">            <div class="col-lg-3 col-md-4">                <div class="footer-left">                    <div class="footer-logo">                        <a href="#"><img src="img/footer_logo_n.png" alt="Konjae"></a>                    </div>                    <ul>                        <li>Address: 37-A Sethi Plaza, Shop#4,                            Fazal e haq Road, Blue Area, Islamabad</li>                        <!-- <li>Phone: +92 51 12345</li> -->                        <li>                            <a href="mailto:info@konjae.com" style="color:#b2b2b2;">                                Email: info@konjae.com                            </a>                        </li>                    </ul>                    <div class="footer-social">                        <a target="_blank" href="https://www.facebook.com/KonjaePlatform"><i class="fa fa-facebook"></i></a>                        <a href="https://www.linkedin.com/in/kon-jae-846b50220/" target="_blank"><i class="ti-linkedin"></i></a>                        <a target="_blank" href="https://twitter.com/Konjaeplatform"><i class="fa fa-twitter"></i></a>                        <a target="_blank" href="https://www.instagram.com/konjaeplatform/"><i class="fa fa-instagram"></i></a>                            <!-- <a target="_blank" href="https://co.pinterest.com/konjaes"><i class="fa fa-pinterest"></i></a> -->                    </div>                </div>            </div>            <div class="col-lg-2 offset-lg-1 col-md-4">                <div class="footer-widget">                    <h5>Categories</h5>                    <ul class="filter-catagories">                        <?php                        $userdata = $conn->query("SELECT `cat_id`, `cat_name`, `cat_feature_image`, `cat_unique_id`, `created_at` FROM `tbl_categories` ");                        $count = 0;                        while ($row = $userdata->fetch_assoc()):                            $count++;                            ?>                            <li><a href="shop.php?cat_id=<?= $row['cat_id']; ?>"><?= $row['cat_name']; ?></a>                            </li>                            <?php                        endwhile;                        ?>                    </ul>                </div>            </div>            <div class="col-lg-2 col-md-4">                <div class="footer-widget">                    <h5>Pages</h5>                    <ul>                        <li><a href="index.php">Home</a></li>                        <li><a href="shop.php">Shop</a></li>                        <li><a href="about-us.php">About Us</a></li>                        <li><a href="how-it-works.php">How it Works</a></li>                        <li><a href="contact-us.php">Contact Us</a></li>                        <li><a href="privacy-policy.php">Privacy Policy</a></li>                    </ul>                </div>            </div>            <div class="col-lg-4 col-md-12">                <div class="newslatter-item">                    <h5>Join Our Newsletter Now</h5>                    <p>Get E-mail updates about our latest shop and special offers.</p>                    <form action="action.php" class="subscribe-form" method="POST">                        <input type="email" name="email" placeholder="Enter Your Mail">                        <button type="submit" name="news_letter">Subscribe</button>                    </form>                </div>            </div>        </div>    </div>    <div class="copyright-reserved">        <div class="container">            <div class="row">                <div class="col-lg-12">                    <div class="copyright-text">                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | KonJae                    </div>                    <!-- <div class="payment-pic">                        <img src="img/payment-method.png" alt="">                    </div> -->                </div>            </div>        </div>    </div></footer><!-- Footer Section End --><!-- Js Plugins --><script src="js/jquery-3.3.1.min.js"></script><script src="js/jquery-ui.min.js"></script><script src="js/owl.carousel.min.js"></script><script src="js/jquery.zoom.min.js"></script><script src="js/popper.min.js"></script><script src="common/plugins/sweetalert2/sweetalert2.min.js"></script><script src="js/bootstrap.min.js"></script><script src="js/jquery.countdown.min.js"></script><script src="js/jquery.nice-select.min.js"></script><script src="js/jquery.dd.min.js"></script><script src="js/jquery.slicknav.js"></script><script src="js/main.js"></script><!-- Toastr --><script src="common/plugins/toastr/toastr.min.js"></script></body><script>                            $(function () {                                var currURL = document.location.href;                                $('.nav-menu ul li a').each(function () {                                    var myHref = $(this).attr('href');                                    if (currURL.match(myHref)) {                                        $(this).parent('li').addClass('active');                                    }                                });                            })</script><?php if (isset($_SESSION['msg'])) {    ?>    <script>        $(function () {            var Toast = Swal.mixin({                toast: true,                position: 'top-end',                showConfirmButton: false,                timer: 5000            });            Toast.fire({                icon: '<?php echo $_SESSION['msg']['icon']; ?>',                title: '<?php echo $_SESSION['msg']['description']; ?>',            })            Swal.fire({                icon: '<?php echo $_SESSION['msg']['icon']; ?>',                title: '<?php echo $_SESSION['msg']['title']; ?>',                text: '<?php echo $_SESSION['msg']['description']; ?>',                footer: '<a>Konjae B2B Solutions </a>',            });        });    </script>    <?php    unset($_SESSION['msg']);}?><script>/// start cart    $.noConflict();    jQuery(document).ready(function () {        load_cart_data();        function load_cart_data()        {            $.ajax({                url: "fetch_cart.php",                method: "POST",                dataType: "json",                success: function (data)                {                    $('#cart_details').html(data.cart_details);                    $('.total_price').text(data.total_price);                    $('.badge').text(data.total_item);                }            });        }        $('#cart-popover').popover({            html: true,            container: 'body',            content: function () {                return $('#popover_content_wrapper').html();            }        });        $(document).on('click', '.add_to_cart', function () {            //alert('aa');            var product_id = $(this).attr("id");            var product_name = $('#name' + product_id + '').val();            var product_price = $('#price' + product_id + '').val();            var product_img = $('#img' + product_id + '').val();            var product_quantity = $('#quantity' + product_id).val();            var vendor_id = $('#vend_id' + product_id).val();            var action = "add";            if (product_quantity > 0)            {                $.ajax({                    url: "cart_action.php",                    method: "POST",                    data: {product_id: product_id, product_name: product_name, product_img: product_img, product_price: product_price, product_quantity: product_quantity, vendor_id: vendor_id, action: action},                    success: function (data)                    {                        load_cart_data();                        alert("Item has been Added into Cart");                    }                });            } else            {                alert("lease Enter Number of Quantity");            }        });        $(document).on('click', '.delete', function () {            var product_id = $(this).attr("id");            var action = 'remove';            if (confirm("Are you sure you want to remove this product?"))            {                $.ajax({                    url: "cart_action.php",                    method: "POST",                    data: {product_id: product_id, action: action},                    success: function ()                    {                        load_cart_data();                        $('#cart-popover').popover('hide');                        alert("Item has been removed from Cart");                    }                })            } else            {                return false;            }        });        $(document).on('click', '#clear_cart', function () {            var action = 'empty';            $.ajax({                url: "cart_action.php",                method: "POST",                data: {action: action},                success: function ()                {                    load_cart_data();                    $('#cart-popover').popover('hide');                    alert("Your Cart has been clear");                }            });        });    });</script><style>    .select-items {        max-height: 300px;        scroll-behavior: smooth;        overflow: auto;    }</style></html>