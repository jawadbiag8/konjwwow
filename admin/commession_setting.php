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
                <h4 class="h4 text-center p-3 bg-info">Commission Settings</h4>
              </div>
              <div class="card-body">
              <div class="form-row">
                <div class="col-md-12">
                    <button class="btn btn-sm btn-info float-right" data-toggle="modal" data-target="#addStaff">Add commission <i class="fa fa-plus"></i></button>
                </div>
              </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">General commission Percentage</label>
                        <input type="text" required name="percentage_100k" placeholder="10%" class="form-control" value="10">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">If Price Is under 25k</label>
                        <input type="checkbox" checked required name="price_greater_then_100" placeholder="100,000" class="form-control" >
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">General commission Percentage</label>
                        <input type="text" required name="percentage_5_k" placeholder="20%" class="form-control" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">If Price Is 25k-100k</label>
                        <input type="checkbox" checked required name="price_greater_then_100" placeholder="100,000" class="form-control" >
                    </div>
                </div> 
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">General commission Percentage</label>
                        <input type="text" required name="percentage_10_k" placeholder="20%" class="form-control" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">If Price Is 100k-500k</label>
                        <input type="checkbox" checked required name="price_greater_then_100" placeholder="100,000" class="form-control" >
                    </div>
                </div> 
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">General commission Percentage</label>
                        <input type="text" required name="percentage_100k_g" placeholder="20%" class="form-control" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">If Price Is Greater then  500k.</label>
                        <input type="checkbox"  required name="price_greater_then_100" placeholder="100,000" class="form-control" >
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
          <h4 class="modal-title">Define commission Information</h4>  
         

          <button type="button" class="close" data-dismiss="modal">×</button>  
        </div>  
        <div class="modal-body"> 
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">General commission Percentage</label>
                <input type="text" required name="percentage_100k" placeholder="10%" class="form-control" >
            </div>
            <div class="form-group col-md-6">
                <label for="name">If Price Is Less Than or Equal 100k</label>
                <input type="checkbox" required name="price_greater_then_100" placeholder="100,000" class="form-control" >
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">General commission Percentage</label>
                <input type="text" required name="percentage_5_k" placeholder="20%" class="form-control" >
            </div>
            <div class="form-group col-md-6">
                <label for="name">If Price Is Less Than or Equal 500k</label>
                <input type="checkbox" required name="price_greater_then_5_k" placeholder="100,000" class="form-control" >
            </div>
        </div> 
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">General commission Percentage</label>
                <input type="text" required name="percentage_10_k" placeholder="20%" class="form-control" >
            </div>
            <div class="form-group col-md-6">
                <label for="name">If Price Is Less Than or Equal 10,00k</label>
                <input type="checkbox" required name="price_greater_then_10_k" placeholder="100,000" class="form-control" >
            </div>
        </div> 
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">General commission Percentage</label>
                <input type="text" required name="percentage_100k_g" placeholder="20%" class="form-control" >
            </div>
            <div class="form-group col-md-6">
                <label for="name">If Price Is Greater then 10,00k</label>
                <input type="checkbox" required name="price_greater_then_100_k" placeholder="100,000" class="form-control" >
            </div>
        </div> 
        </div>  
        <div class="modal-footer">  
          <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" name="add_commission" class="btn btn-success btn-sm ">Add Commision</button>
            
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


