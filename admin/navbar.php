<?php

include "header.php"; 

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->

    <a href="index.php" class="brand-link navbar-navy">

      <img src="../img/favicon.png" alt="KonJae" class="brand-image img-circle elevation-3" style="opacity: .8">

      <span class="brand-text font-weight-light">KonJae</span>

    </a>

    <!-- Sidebar -->

    <div class="sidebar">

      <!-- Sidebar user panel (optional) -->

      <div class="user-panel mt-3 pb-3 mb-3 d-flex">

        <div class="image">

          <img src="../common/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">

        </div>

        <div class="info">

          <a href="#" class="d-block">

          <?php

            echo $_SESSION['admin']['name']

            ?>

          </a>

        </div>

      </div>

      <!-- SidebarSearch Form -->

      <div class="form-inline">

        <div class="input-group" data-widget="sidebar-search">

          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">

          <div class="input-group-append">

            <button class="btn btn-sidebar">

              <i class="fas fa-search fa-fw"></i>

            </button>

          </div>

        </div>

      </div>

      <!-- Sidebar Menu -->

      <nav class="mt-2">

        <ul class="nav nav-pills nav-sidebar flex-column nav-compact nav-legacy" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-header">KonJae Staff</li>

          <li class="nav-item">

            <a href="admin_staff.php" class="nav-link">

              <i class="fa fa-user-plus nav-icon"></i>

              <p>Administrative staff</p>

            </a>

          </li>

          <li class="nav-item">

            <a href="account_setting.php" class="nav-link">

              <i class="fa fa-university nav-icon"></i>

              <p>Accounts Settings</p>

            </a>

          </li>

          <li class="nav-item">

            <a href="categories.php" class="nav-link">

              <i class="fa fa-university nav-icon"></i>

              <p>Categories</p>

            </a>

          </li>

          <li class="nav-item">

            <a href="sub_categories.php" class="nav-link">

              <i class="fa fa-university nav-icon"></i>

              <p>Sub Categories</p>

            </a>

          </li>

          <li class="nav-item">

            <a href="commession_setting.php" class="nav-link">

              <i class="fa fa-percent  nav-icon"></i>

              <p>Commissioning</p>

            </a>

          </li>

          <li class="nav-item">

            <a href="blog.php" class="nav-link">

              <i class="fa fa-map-marker  nav-icon"></i>

              <p>Blog</p>

            </a>

          </li>
          <li class="nav-item">

            <a href="hestory.php" class="nav-link">
            <!-- <i class="fa-solid fa-clock-rotate-left"></i> -->
              <i class="fa fa-map-marker  nav-icon"></i>

              <p>Hestory</p>

            </a>

          </li>
          <li class="nav-item">

            <a href="add_cities.php" class="nav-link">

              <i class="fa fa-map-marker  nav-icon"></i>

              <p>Add Cities</p>

            </a>

          </li>

          <li class="nav-item">

            <a href="qoute_request.php" class="nav-link">

              <i class="fa fa-map-marker  nav-icon"></i>

              <p>Qoute Requests</p>

            </a>

          </li>

          <li class="nav-item">

            <a href="contact-us-msgs.php" class="nav-link">

              <i class="fa fa-envelope nav-icon"></i>

              <p>Contact Us Msgs</p>

            </a>

          </li>

          <li class="nav-item">

            <a href="address-vendor.php" class="nav-link">

              <i class="fa fa-envelope nav-icon"></i>

              <p>Order Default Address</p>

            </a>

          </li>

        <li class="nav-header">KonJae</li>

        <li class="nav-item has-treeview">

            <a href="#" class="nav-link">

              <i class="nav-icon fa fa-users"></i>

              <p>

                Vendors

                <i class="fas fa-angle-left right"></i>

              </p>

            </a>

            <ul class="nav nav-treeview">

            <li class="nav-item">

                <a href="vendor_overview.php" class="nav-link">

                  <i class="fa fa-user nav-icon"></i>

                  <p>Vendors Overview</p>

                </a>

              </li>

              <li class="nav-item">

                <a href="vendor_records.php" class="nav-link">

                  <i class="fa fa-user nav-icon"></i>

                  <p>Vendors Records</p>

                </a>

              </li>

              <li class="nav-item" id="sha">

                <a href="products_request.php" class="nav-link">

                  <i class="nav-icon fa fa-cog"></i>

                  <p>

                  Products Request

                  </p>

                </a>            

              </li>

              <li class="nav-item" id="sha">

                <a href="products_records.php" class="nav-link">

                  <i class="nav-icon fa fa-cog"></i>

                  <p>

                  Products Records

                  </p>

                </a>            

              </li>

              

            </ul>

          </li>

          <li class="nav-item has-treeview">

            <a href="#" class="nav-link">

              <i class="nav-icon fa fa-users"></i>

              <p>

                Merchants

                <i class="fas fa-angle-left right"></i>

              </p>

            </a>

            <ul class="nav nav-treeview">

            <li class="nav-item">

                <a href="merchant_overview.php" class="nav-link">

                  <i class="fa fa-user nav-icon"></i>

                  <p>Merchants Overview</p>

                </a>

              </li>

              <li class="nav-item">

                <a href="merchant_records.php" class="nav-link">

                  <i class="fa fa-user nav-icon"></i>

                  <p>Merchants Records</p>

                </a>

              </li>

              <li class="nav-item" id="sha">

                <a href="new_details.php" class="nav-link">

                  <i class="nav-icon fa fa-cog"></i>

                  <p>

                  New Orders

                  </p>

                </a>            

              </li>

              <li class="nav-item" id="sha">

                <a href="orders_details.php" class="nav-link">

                  <i class="nav-icon fa fa-cog"></i>

                  <p>

                  Orders

                  </p>

                </a>            

              </li>

            </ul>

          </li>

          <li class="nav-header">Payment Stats</li>

          <li class="nav-item">

              <a href="order_payment.php" class="nav-link">

                <i class="fa fa-user nav-icon"></i>

                <p>Orders Payment</p>

              </a>

            </li>

          <li class="nav-header">Classified</li>

          <li class="nav-item has-treeview">

            <a href="#" class="nav-link">

              <i class="nav-icon fa fa-users"></i>

              <p>

                Advertisement

                <i class="fas fa-angle-left right"></i>

              </p>

            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">

                <a href="classified_overview.php" class="nav-link">

                  <i class="fa fa-user nav-icon"></i>

                  <p>Overview</p>

                </a>

              </li>

              <li class="nav-item">

                <a href="classified_setting.php" class="nav-link">

                  <i class="fa fa-user nav-icon"></i>

                  <p>Ads Settings</p>

                </a>

              </li>

              <li class="nav-item" id="sha">

                <a href="ads_requests.php" class="nav-link">

                  <i class="nav-icon fa fa-cog"></i>

                  <p>

                    Ads Request

                  </p>

                </a>            

              </li>

              <li class="nav-item" id="sha">

                <a href="publish_ads_setting.php" class="nav-link">

                  <i class="nav-icon fa fa-cog"></i>

                  <p>

                    Published Ads

                  </p>

                </a>            

              </li>

            </ul>

          </li>

          <li class="nav-header">CMS</li>

          <li class="nav-item has-treeview">

            <a href="#" class="nav-link">

              <i class="nav-icon fa fa-users"></i>

              <p>

                Website Mgt

                <i class="fas fa-angle-left right"></i>

              </p>

            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">

                <a href="home_slider.php" class="nav-link">

                  <i class="fa fa-user nav-icon"></i>

                  <p>Home Page Slider </p>

                </a>

              </li>

              <li class="nav-item" id="sha">

                <a href="deal_mgt.php" class="nav-link">

                  <i class="nav-icon fa fa-cog"></i>

                  <p>

                    Deals Mgt

                  </p>

                </a>            

              </li>

              <!-- <li class="nav-item" id="sha">

                <a href="send_email.php" class="nav-link">

                  <i class="nav-icon fa fa-cog"></i>

                  <p>

                    Send Email

                  </p>

                </a>            

              </li> -->

            </ul>

          </li>

        </ul>

      </nav>

      <!-- /.sidebar-menu, -->

    </div>

    <!-- /.sidebar -->

  </aside>