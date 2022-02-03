<?php 
include "header.php"; 
if(isset($_SESSION['merchant'])){
  $vendor_data=$_SESSION['merchant'];
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
          <div class="col-md-12">
            <div class="card">
              <div class="card-heading">
                <h4 class="h4 text-center p-3 bg-info">Contact Us</h4>
              </div>
              <div class="card-body">
              <!-- information are start here -->
              <div class="form-row">
            
            <div class="col-md-6">
                <div class="leave-comment">
                    <h4>Leave A Comment</h4>
                    <p>If You Have any Query Fill The Form Our Customer Support Will Contact You With in 24 Hrs.</p>
                    <form action="action.php" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                            <label for="">Your Name <span class="text-danger">*</span> </label>
                                <input type="text" required name="name" placeholder="Your name" class="form-control">
                            </div>
                            <div class="col-md-6">
                            <label for="">Your Email <span class="text-danger">*</span></label>
                                <input type="text" required name="email" placeholder="Your email" class="form-control">
                            </div>
                            <div class="col-md-12">
                            <label for="">Your Message <span class="text-danger">*</span></label>
                                <textarea placeholder="Your message" cols="10" rows="5" name="msgs" required class="form-control"></textarea>
                                <button type="submit" name="contact_msgs" class="btn btn-info btn-submit btn-sm mt-4 float-right">Send message</button>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
                <div class="col-md-6 ">
                  <h4 class="h4">You can send Us Email or Can Call Us on Whatsapp AnyTime.</h4>
                  <h4 class="h4"> <b class="mr-4" >Email:</b>info@konjae.com</h4>
                  <h4 class="h4"><b class="mr-4">Whatsapp:</b> 0333 1124159</h4>
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
    header('location:../login.php');
    ob_end_flush();
}
?>
