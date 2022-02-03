<?php 
include "header.php"; 
if(isset($_SESSION['merchant'])){
  $data=$_SESSION['merchant'];
  $vendor_id = $_SESSION['merchant']['mer_id'];
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
                <!-- Konjae B2B Online Admin Panel -->
                  <h4 class="h4 text-center text-info">Welcome to Konjae B2B Merchant Dashboard</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                  <table class="table table-sm table-striped table-hover">
                    <tbody>
                      
                      <tr>
                        <td>Name:</td>
                        <td>
                          <?php echo $data['mer_name']; ?>
                        </td>
                      </tr>
                      <tr>
                      <td>Email:</td>
                        <td>
                        <?php echo $data['mer_email']; ?>

                        </td>
                      </tr>
                      <tr>
                      <td>Business Name:</td>
                        <td>
                        <?php echo $data['mer_business_name']; ?>

                        </td>
                      </tr>
                      <tr>
                      <td>Mobile:</td>
                        <td>
                        <?php echo $data['mer_phone']; ?>

                        </td>
                        
                      </tr>
                      <tr>
                        <td>Designations</td>
                        <td>Merchant</td>
                      </tr>
                      <tr>
                        <td>Update Profile</td>
                        <td><button class="btn btn-sm btn-dark" data-toggle="modal" data-target="#ad_price"><i class="fa fa-edit"></i></button> </td>
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
<div class="modal fade" id="ad_price" role="dialog">  
    <div class="modal-dialog modal-lg">  
      <div class="modal-content">
      <form action="action.php" method="POST" enctype="multipart/form-data">
        <div class="modal-header">  
          <h4 class="modal-title">Update Your Profile</h4>  
          <button type="button" class="close" data-dismiss="modal">×</button>  
        </div>  
        <div class="modal-body"> 
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name">Full Name</label>
                <input type="text" name="name" value="<?=$data['mer_name']?>" class="form-control" >
            </div>
        </div> 
        <div class="form-row">
        <div class="form-group col-md-6">
                <label for="name">Mobile Number</label>
                <input type="text" name="mobile_number" value="<?=$data['mer_phone']?>"  class="form-control" >
        </div>
        <div class="form-group col-md-6">
                <label for="name">Email</label>
                <input type="email" name="email" value="<?=$data['mer_email']?>"  class="form-control" >
        </div>
        </div>
        <div class="form-row">
        <div class="form-group  col-md-12">
                <label for="name">Password</label>
                <input type="password" name="password" class="form-control">
        </div> 
        </div>
        <div class="form-row">
        <div class="form-group  col-md-12">
            <label for="name">Business Name</label>
            <input type="text" name="business_name" value="<?=$data['mer_business_name']?>" class="form-control"   >
        </div>
        <div class="form-group  col-md-12">
            <label for="name">Update Profile Picture (Picture Size 40 Kb)</label>
            <input type="file" name="update_profile_pic" class="form-control" >
        </div>
        
        </div>

        </div>  
        <div class="modal-footer">  
          <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" name="update_profile_data" class="btn btn-success btn-sm "> Update Profile</button>
        </div>  
        </form>

      </div>  

    </div>  
  </div>
  <!-- end modal -->
</body>
<?php include "footer.php";

}else{
    unset($_SESSION['vendor']);
    header('location:../login.php');
    ob_end_flush();
}
?>

