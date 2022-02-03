<?php 
include "header.php"; 
if(isset($_SESSION['admin'])){
  $admin_data=$_SESSION['admin'];
  $admin_id = $_SESSION['admin']['id'];
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
                <h4 class="h4 text-center p-3 bg-info">Merchant Overview Informations</h4>
              </div>
              <div class="card-body">
              <!-- information are start here -->
          <div class="form-row">
            <div class="form-group col-md-6">
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Recent Order</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="display: block;">
              <?php
              $get_product_pending=$conn->query("SELECT tbl_vendors.vend_name,tbl_products.product_name,tbl_merchant.mer_name ,tbl_orders.status FROM `tbl_orders` INNER JOIN tbl_vendors ON tbl_vendors.vendor_id=tbl_orders.customer_id INNER JOIN tbl_merchant ON tbl_merchant.mer_id=tbl_orders.marchant_id INNER JOIN tbl_products ON tbl_orders.product_id=tbl_products.product_id  order by order_id desc limit 5");
              while($rs=$get_product_pending->fetch_assoc()):
              ?>
              <div class="callout callout-info">
                    <h5 class="h5">Vendor:<?=$rs['vend_name'];?></h5>
                    <p>Merchant Name: <?=$rs['mer_name'];?>
                    </p>
                    <p>Product Name: <?=$rs['product_name'];?> </p>
                    <p>Order Status<span class="badge badge-primary float-right"> <?=$rs['status'];?></span></p>
                    <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-striped bg-success " role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                    </div>
                    </div>
                
                </div>
                <?php endwhile;
                 ?>
                
              </div>
              <!-- /.card-body -->
            </div>
            </div>
           
            <div class="form-group col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Recently Joined Merchant </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="display: block;">
              <?php
              $get_product_pending=$conn->query("SELECT * FROM `tbl_merchant` order by mer_id desc Limit 5");
              while($rs=$get_product_pending->fetch_assoc()):
              ?>
              <div class="callout callout-info">
                    <h5 class="h5">Vendor Name:<?=$rs['mer_name'];?></h5>
                    <p>Membership Status : <span class="badge badge-primary float-right">Approved</span></p>
                    <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-striped bg-success " role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                    </div>
                    </div>
                
                </div>
                <?php endwhile;
                 ?>
                
              
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
    unset($_SESSION['admin']);
    header('location:login.php');
    ob_end_flush();
}
?>
