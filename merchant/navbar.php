<?php
include "header.php"; 
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link navbar-navy">
      <img src="../img/favicon.png" alt="KonJae Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">KonJae</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php 
          $profile=$_SESSION['merchant']['profile_pic'];
          if($profile){
?>
 <img src="../common/dist/img/<?=$profile;?>" class="img-circle elevation-2" alt="User Image">
<?php
          }else{
?>
 <img src="../common/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">

<?php
          }
          
          ?>
         
        </div>
        <div class="info">
          <a href="#" class="d-block">
          <?php
            echo $_SESSION['merchant']['mer_name']
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
        <li class="nav-header">Merchant Dashboard</li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Orders
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="order_overview.php" class="nav-link">
                  <i class="fa fa-user nav-icon"></i>
                  <p>Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="order_records.php" class="nav-link">
                  <i class="fa fa-user nav-icon"></i>
                  <p>Order Meta</p>
                </a>
              </li>
            </ul>
          </li>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu, -->
    </div>
    <!-- /.sidebar -->
  </aside>