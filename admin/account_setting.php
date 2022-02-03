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
                <h4 class="h4 text-center p-3 bg-info">Accounts Settings</h4>
              </div>
              <div class="card-body">
              <div class="form-row">
                <div class="col-md-12">
                <?php
                $Query=$conn->query("SELECT * FROM `tbl_accounts`");
                $num=mysqli_num_rows($Query);
                if($num <2){
                ?>
                    <button class="btn btn-sm btn-info float-right" data-toggle="modal" data-target="#addStaff">Add Account <i class="fa fa-plus"></i></button>
                    <?php
                 }                 
                 ?>
                 <div class="card-body mt-4" style="display: block;">
                 <div class="form-row">
                 <?php 
                 while($row=$Query->fetch_assoc()):
                 ?>
                    <div class="form-group col-md-6">
                    <div class="callout callout-info">
                        <h5 class="h5"><?=$row['acc_holder_name'] ?></h5>
                        <p><?=$row['acc_Ibn_number'] ?><span class="badge badge-primary float-right"><?=$row['acc_banks_name'] ?></span></p>
                        <p><?=$row['acc_email'] ?></p>
                        <button class="btn float-right btn-sm btn-danger"
                         value="<?=$row['acc_id'];?>"  onclick="delete_member_data(this.value);" >
                         <i class="fa fa-trash"></i></button>
                      
                    </div>
                    </div>
                <?php
                endwhile;
                ?>
            
                 </div>
                 </div>
                </div>
              </div>
                
              </div>
            </div>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </div>
<!-- add staff -->
  <div class="modal fade" id="addStaff" role="dialog">  
    <div class="modal-dialog modal-lg">  
      <div class="modal-content">
      <form action="action.php" method="POST" enctype="multipart/form-data">
        <div class="modal-header">  
          <h4 class="modal-title">Account Information</h4>  
         

          <button type="button" class="close" data-dismiss="modal">×</button>  
        </div>  
        <div class="modal-body"> 
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name">Bank Name</label>
                <input type="text" name="bank_name" class="form-control" >
            </div>
        </div> 
        <div class="form-row">
        <div class="form-group col-md-6">
                <label for="name">Account Number IBAN</label>
                <input type="text" name="Account_number"  class="form-control" >
        </div>
        <div class="form-group col-md-6">
                <label for="name">Account Number Local</label>
                <input type="text" name="Account_number_local"  class="form-control" >
        </div>
        </div>
        <div class="form-row">
        <div class="form-group  col-md-6">
                <label for="name">Account Holder Name</label>
                <input type="text" name="account_holder_name" class="form-control">
        </div>  
        <div class="form-group  col-md-6">
                <label for="name">Account Holder Email</label>
                <input type="text" name="account_email" class="form-control">
        </div>  
        </div>
        </div>  
        <div class="modal-footer">  
          <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" name="add_account" class="btn btn-success btn-sm ">Add Account</button>
            
        </div>  
        </form>

      </div>  

    </div>  
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
<script>
function delete_member_data(id){
  Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
    
  if (result.isConfirmed) {
    $.ajax({
    url:"action.php",
    method:"POST",
    data:{delete_account_:id},
    success:function(data){
        Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    );
       setInterval(function(){
            location.reload();
       },3000);
    },
    error: function() {
        Swal.fire(
      'Deleted!',
      'Data Not Deleted.',
      'error'
    );
	}
   });
 
  }
})
}
</script>


