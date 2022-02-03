<?php 
include "header.php"; 
if(isset($_SESSION['vendor'])){
  $vendor_data=$_SESSION['vendor'];
  $vendor_id = $_SESSION['vendor']['vendor_id'];
?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <?php
  include('top-bar.php');
  ?>
  <!-- Main Sidebar Container -->
  <?php
include "navbar.php"
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-12">
            <div class="card">
              <div class="card-heading">
                <h4 class="h4 text-center p-3 bg-info">Classified Managements</h4>
              </div>
              <div class="card-body">
              <!-- information are start here -->
          <div class="form-row">
            <div class="form-group col-md-4">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">New Ads Request</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="display: block;">
              <?php 
                   $userdata=$conn->query("SELECT * FROM `tbl_ads_requests` INNER JOIN tbl_products ON tbl_products.product_id=tbl_ads_requests.product_id INNER JOIN tbl_advertisment_packages ON tbl_advertisment_packages.pkg_id=tbl_ads_requests.pkg_id where tbl_ads_requests.vendor_id='$vendor_id' and ads_status='pending'");
                   $count=0;
                   while($row=$userdata->fetch_assoc()):
                   ?>
                   
                   <div class="callout callout-info p-1 ">
                    <h5 class="h5"><?=$row['product_name'];?></h5>
                    <p>Package Name: <?=$row['pkg_name'];?><span class="badge badge-primary float-right"><?=$row['ads_status'];?></span></p>
                    <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-striped bg-success " role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                    </div>
                    </div>
                
                </div>
                   <?php endwhile;?>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
           
            <div class="form-group col-md-4">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Published Ads</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="display: block;">
              <?php 
                   $userdata=$conn->query("SELECT * FROM `tbl_ads_requests` INNER JOIN tbl_products ON tbl_products.product_id=tbl_ads_requests.product_id INNER JOIN tbl_advertisment_packages ON tbl_advertisment_packages.pkg_id=tbl_ads_requests.pkg_id where tbl_ads_requests.vendor_id='$vendor_id' and ads_status='accept'");
                   $count=0;
                   while($row=$userdata->fetch_assoc()):
                   ?>
                   
                   <div class="callout callout-info p-1 ">
                    <h5 class="h5"><?=$row['product_name'];?></h5>
                    <p>Package Name: <?=$row['pkg_name'];?><span class="badge badge-primary float-right"><?=$row['ads_status'];?></span></p>
                    <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-striped bg-success " role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                    </div>
                    </div>
                
                </div>
                   <?php endwhile;?>
               
              </div>
              <!-- /.card-body -->
            </div>
            </div>

            <div class="form-group col-md-4">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Cancelled Request</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="display: block;">
              <?php 
                   $userdata=$conn->query("SELECT * FROM `tbl_ads_requests` INNER JOIN tbl_products ON tbl_products.product_id=tbl_ads_requests.product_id INNER JOIN tbl_advertisment_packages ON tbl_advertisment_packages.pkg_id=tbl_ads_requests.pkg_id where tbl_ads_requests.vendor_id='$vendor_id' and ads_status='reject'");
                   $count=0;
                   while($row=$userdata->fetch_assoc()):
                   ?>
                   
                   <div class="callout callout-info p-1 ">
                    <h5 class="h5"><?=$row['product_name'];?></h5>
                    <p>Package Name: <?=$row['pkg_name'];?><span class="badge badge-primary float-right"><?=$row['ads_status'];?></span></p>
                    <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-striped bg-success " role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                    </div>
                    </div>
                
                </div>
                   <?php endwhile;?>
              
               
              </div>
              <!-- /.card-body -->
            </div>
            </div>

          </div>
<!-- information are end here -->
                
              </div>
            </div>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </div>
  
  <!-- /.content-wrapper -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
</body>
<?php include "footer.php";
?>
<?php
}else{
    unset($_SESSION['vendor']);
    header('location:login.php');
    ob_end_flush();
}
?>
