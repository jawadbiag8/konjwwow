<?php 
include "header.php"; 
if(isset($_SESSION['merchant'])){
  $vendor_data=$_SESSION['merchant'];
  $vendor_id = $_SESSION['merchant']['merchant_id'];
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
              <div class="callout callout-info p-1 ">
                    <h5 class="h5">Shope Name</h5>
                    <p>Vendor want to Advertise Product Name<span class="badge badge-primary float-right">25000</span></p>
                    7 days
                    <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-striped bg-success " role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                    </div>
                    </div>
                
                </div>
                <div class="callout callout-success p-1 ">
                    <h5 class="h5">Shope Name</h5>
                    <p>Vendor want to Advertise Product Name<span class="badge badge-primary float-right">45000</span></p>
                    10 days
                    <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-striped bg-success " role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                    </div>
                    </div>
                
                </div>
                <div class="callout callout-danger p-1 ">
                    <h5 class="h5">Shope Name</h5>
                    <p>Vendor want to Advertise Product Name<span class="badge badge-primary float-right">55000</span></p>
                    15 days
                    <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-striped bg-success " role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                    </div>
                    </div>
                
                </div>
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
              <div class="callout callout-danger p-1">
                    <h5 class="h5">Shope Name</h5>
                    <p>Product Name pubished ads<span class="badge badge-primary float-right">55000</span></p>
                    2 day remaining
                    <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-striped bg-danger " role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 96%">
                    </div>
                    </div>
                
                </div>
                <div class="callout callout-danger p-1">
                    <h5 class="h5">Shope Name</h5>
                    <p> Product Name pubished ads<span class="badge badge-primary float-right">55000</span></p>
                    15 days remaining
                    <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-striped bg-success " role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                    </div>
                    </div>
                
                </div>
                <div class="callout callout-danger p-1">
                    <h5 class="h5">Shope Name</h5>
                    <p> Product Name pubished ads<span class="badge badge-primary float-right">55000</span></p>
                    1 days remaining
                    <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-striped bg-danger " role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width: 97%">
                    </div>
                    </div>
                
                </div>
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
              <div class="callout callout-info">
                    <h5 class="h5">Shaheen Khan</h5>
                    <p>Deals with Pakistan Schools<span class="badge badge-primary float-right">10 Days</span></p>
                    <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-striped bg-success " role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                    </div>
                    </div>
                
                </div>
                <div class="callout callout-info">
                    <h5 class="h5">New American Khan</h5>
                    <p>Deals with Pakistan group of Companies<span class="badge badge-primary float-right">2 Days</span></p>
                    <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-striped bg-success " role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                    </div>
                    </div>
                
                </div>
                <div class="callout callout-info">
                    <h5 class="h5">Karyan Store</h5>
                    <p>Deals with GlassDor Shop<span class="badge badge-primary float-right">4 Days</span></p>
                    <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-striped bg-success " role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                    </div>
                    </div>
                
                </div>
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
    header('location:../login.php');
    ob_end_flush();
}
?>
