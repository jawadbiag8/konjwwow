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
            echo $_SESSION['support']['staff_name'];
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
        <?php
        if($_SESSION['support']['role_id']==2){
          ?>
          <li class="nav-header">KonJae Support</li>
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
          
          <?php
        }
        ?>
         <?php
        if($_SESSION['support']['role_id']==1){
          ?>
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
              <li class="nav-item" id="sha">
                <a href="products_rejected.php" class="nav-link">
                  <i class="nav-icon fa fa-cog"></i>
                  <p>
                  Rejected Products
                  </p>
                </a>            
              </li>
            </ul>
          </li>
          <?php
        }
        ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu, -->
    </div>
    <!-- /.sidebar -->
  </aside>