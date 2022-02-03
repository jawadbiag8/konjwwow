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
include "navbar.php";

if(isset($_REQUEST['status'])){
    $order_id = $_REQUEST['order_id'];
    $update_order=$conn->query("UPDATE `tbl_orders` SET `status`='approved' WHERE `order_id`='$order_id'");
    if($update_order){
        echo '<script>alert("Order Approved");</script>';
        header('Location: vendor_overview.php');
    }
}

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
                <h4 class="h4 text-center p-3 bg-info">Vendors Overview Informations</h4>
              </div>
              <div class="card-body">
              <!-- information are start here -->
          <div class="form-row">
            <div class="form-group col-md-6">
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Pending Orders</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="display: block;">

              <?php 

                   $userdata=$conn->query("SELECT tbl_orders.product_quantity AS quantity, tbl_orders.*, tbl_products.* FROM tbl_orders INNER JOIN  tbl_products ON tbl_orders.product_id = tbl_products.product_id WHERE  status = 'pending' and vendor_id = '$vendor_id'");
                   $count=0;
                   while($row=$userdata->fetch_assoc()):
                   $count++;

                   ?>
              <div class="callout callout-info">
                    <h5 class="h5"><?php echo $row['product_name'];?></h5>
                    <b>Quantity:</b>&nbsp<?php echo $row['quantity'];?><br>
                    <b>Delivery Address:</b>&nbsp<?php echo $row['delivery_address'];?><br>
                    <b>Description:</b>&nbsp<?php echo $row['product_desc'];?><span class="badge badge-primary float-right"><?php echo $row['status'];?></span><br><br>
                    <a href="?order_id=<?php echo $row['order_id']; ?>&status=approved">
                    <button class="btn btn-sm btn-info" >Approve Order</button>
                    </a>
                </div>
                <?php endwhile;?>

              </div>
              <!-- /.card-body -->
            </div>
            </div>
           
            <div class="form-group col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Approved Orders</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="display: block;">
              <?php 

                   $userdata=$conn->query("SELECT tbl_orders.product_quantity AS quantity, tbl_orders.*, tbl_products.* FROM tbl_orders INNER JOIN  tbl_products ON tbl_orders.product_id = tbl_products.product_id WHERE status = 'approved' and vendor_id = '$vendor_id'");
                   $count=0;
                   while($row=$userdata->fetch_assoc()):
                   $count++;

                   ?>
              <div class="callout callout-info">
                    <h5 class="h5"><?php echo $row['product_name'];?></h5>
                    <b>Quantity:</b>&nbsp<?php echo $row['quantity'];?><br>
                    <b>Delivery Address:</b>&nbsp<?php echo $row['delivery_address'];?><br>
                    <b>Description:</b>&nbsp<?php echo $row['product_desc'];?><span class="badge badge-primary float-right"><?php echo $row['status'];?></span>
                   
                
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
    unset($_SESSION['admin']);
    header('location:login.php');
    ob_end_flush();
}
?>
