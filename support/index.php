<?php 
include "header.php"; 
if(isset($_SESSION['support'])){
  $admin_data=$_SESSION['support'];
  $admin_id = $_SESSION['support']['staff_id'];
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

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       
        <!-- Main row -->
        <div class="row">
          <div class="container">
            <div class="col-md-10 ml-auto mr-auto">
              <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="card-heading">
                <!-- CybMerce B2B Online Admin Panel -->
                  <h4 class="h4 text-center text-info">Welcome to KonJae B2B Support Panel</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                  <table class="table table-sm table-striped table-hover">
                    <tbody>
                      
                      <tr>
                        <td>Name:</td>
                        <td>
                          <?php echo $admin_data['staff_name']; ?>
                        </td>
                      </tr>
                      <tr>
                      <td>Email:</td>
                        <td>
                        <?php echo $admin_data['email']; ?>

                        </td>
                      </tr>
                     
                      <tr>
                      <td>Mobile:</td>
                        <td>
                        <?php echo $admin_data['mobile']; ?>

                        </td>
                        
                      </tr>
                      <tr>
                        <td>Designations</td>
                        <td>Support</td>
                      </tr>

                    </tbody>
                    </table>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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

}else{
    unset($_SESSION['support']);
    header('location:login.php');
    ob_end_flush();
}
?>

