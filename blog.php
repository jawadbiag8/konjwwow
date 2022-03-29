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
                    <span>Blog</span>
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-heading" style="background: #f0a302">
                        <h4 class="h4 text-center">KON JAE Blog</h4>
                        <h6 class="h6 text-center">Welcome to the world of Kon Jae Fashion</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <?php
                                if (isset($_GET['post'])) {
                                    $sql = "SELECT * FROM `tbl_blog` where id=" . $_GET["post"];
                                    $blog = $conn->query($sql);
                                    $count = 0;
                                    $row = $blog->fetch_assoc()
                                    ?>
                                    <h1>
                                        <?php echo $row['title']; ?>
                                    </h1>
                                    <hr>
                                    <?php echo $row['contant']; ?>
                                    <hr>
                                    <?php
                                } else {
                                    $sql = "SELECT * FROM `tbl_blog` ORDER BY `tbl_blog`.`created_at` DESC";
                                    $blog = $conn->query($sql);
                                    $count = 0;
                                    $row = $blog->fetch_assoc()
                                    ?>
                                    <h1>
                                        <?php echo $row['title']; ?>
                                    </h1>
                                    <hr>
                                    <?php echo $row['contant']; ?>
                                    <hr>
                                    <?php
                                }
                                $site_url = "https://konjae.com/blog.php?post=" . $row['id'];
                                ?> 
                                <div id="button_share">
                                    <a href="http://www.facebook.com/sharer.php?u=<?= $site_url ?>" target="_blank">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                    <a href="https://twitter.com/share?url=<?= $site_url ?>&amp;text=Simple%20Share%20Buttons&amp;hashtags=simplesharebuttons" target="_blank">
                                        <i class="fa fa-twitter"></i>
                                    </a> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h1>Recent post</h1>
                                <?php
                                $sql = "SELECT b.*,a.name FROM tbl_blog b JOIN tbl_admin a on b.user=a.id;";
                                $blog = $conn->query($sql);
                                $count = 0;
                                while ($row = $blog->fetch_assoc()) {
                                    ?>
                                    <a href="blog.php?post=<?php echo $row['id']; ?>"><h3>
                                            <?php echo $row['name']; ?>
                                        </h3>
                                        <h4>
                                            <?php echo $row['title']; ?>
                                        </h4></a>
                                    <hr>
                                    <?php
                                }
                                ?>  
                            </div>
                        </div>
                    </div>
                </div>
                <br>

            </div>
        </div>
        <style>
            .company_profile a:hover{
                color: blue;
            }
        </style>
        <!-- <div class="row">
            <div class="col-lg-5">
                <div class="card">
                <div class="card-body">
                <h3>KON JAE -- AN EMERGING B2B TALENT OF THE PAKISTAN TEXTILE INDUSTRY </h3>
                <p>
                KON JAE is a project of ‘Cybmerce Tech Pvt. Ltd’ is a registered company based in Islamabad. ‘KON JAE – Trust, Empower, Future’ an emerging talent of Pakistan in the textile industry and a pioneer in introducing the Business-to-Business (B2B) model – an Online Marketplace of the textile sector in Pakistan. 
                </p>
                </div>
                
                </div>
                <img src="img/about_us_two.svg" height="200" alt="">

                <div class="contact-widget">
                </div>
            </div>
            <div class="col-lg-6 offset-lg-1">
                <div class="contact-form">
                    <div class="leave-comment">
                        <img src="img/about_us.svg" height="200" alt="">
                       <div class="card">
                        <div class="card-body">
                        <h4>Objectives:</h4>
                       <ul class="list-group">
                       <li class="list-group-item list-group-item-action">To introduce and build capacity for e-business models to the textile industry of Pakistan</li>	 
                       <li class="list-group-item list-group-item-action">To grow Pakistan Textile Industry with the online B2B model</li>	
                       <li class="list-group-item list-group-item-action">To elevate contribution of Pakistan Textile Industry in global textile economy</li>	
                       <li class="list-group-item list-group-item-action">To ensure quality pool for textile merchants, manufacturers, wholesalers, and customers while operating with B2B standards </li>	
                       </ul>

                        </div>
                       </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</section>
<!-- Contact Section End -->

<?php
include('footer.php');
?>