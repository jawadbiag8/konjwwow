<?php 
include "header.php"; 
if(isset($_SESSION['admin'])){
  $admin_data=$_SESSION['admin'];
  $admin_id = $_SESSION['admin']['id'];
?>

  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../common/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="../common/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../common/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">

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
                <h4 class="h4 text-center p-3 bg-info">Member In Course</h4>
              </div>
              <div class="card-body">
              <div class="form-row">
                <div class="col-md-12">
                    <button class="btn btn-sm btn-info float-right my-4" data-toggle="modal" data-target="#addStaff">Assign Course <i class="fa fa-plus"></i></button>
                </div>
              </div>
                <div class="table-responsive">
                  <table class="table table-striped table-sm table-hover table-bordered table-condenced" id="datatable">
                    <thead>
                      <th>s#.</th>
                      <th>Name</th> 
                      <th>Mobile</th>  
                      <th>Email</th>  
                      <th>Enrolled In Course</th>  
                      <th>Status</th>  
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <?php
                      $count=0;
                      $res=$conn->query("SELECT tbl_applicants.*,tbl_courses.*, tbl_assign_course.assign_status,tbl_assign_course.assign_id FROM ((`tbl_assign_course` INNER JOIN tbl_applicants ON tbl_assign_course.app_id=tbl_applicants.app_id) INNER JOIN tbl_courses ON tbl_courses.course_id=tbl_assign_course.course_id)");
                      while($rows=$res->fetch_assoc()):
                        $count++;
                      ?>
                      <tr>
                      <td><?=$count;?></td>
                      <td><?=$rows['app_name'];?></td>
                      <td><?=$rows['app_mobile'];?></td>
                      <td><?=$rows['app_email'];?></td>
                      <td><?=$rows['course_title'];?></td>
                      <td><?=($rows['assign_status']==1)?'Active':'Inactive';?></td>
                      <td><button value="<?=$rows['assign_id'];?>" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editmember"
                       onclick="editmemberdetails(this.value);"><i class="fa fa-edit"></i></button>
                       <button value="<?=$rows['assign_id']?>" class="btn btn-sm btn-info"
                       onclick="delete_member_data(this.value);">
                       <i class="fa fa-trash"></i></button>
                       </td>
                      </tr>
                      <?php
                      endwhile;
                      
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </div>
  <div class="modal fade" id="editmember" role="dialog">  
    <div class="modal-dialog modal-lg">  
      <div class="modal-content">  
        <div class="modal-header">  
          <h4 class="modal-title">Edit Member information</h4>  
          <button type="button" class="close" data-dismiss="modal">×</button>  
        </div>  
        <form action="action.php" enctype="multipart/form-data" method="POST" >
        <div class="modal-body" id="edit_data">  
      
        </div>  
        </form>
      </div>  
    </div>  
  </div> 

<!-- add staff -->
  <div class="modal fade" id="addStaff" role="dialog">  
    <div class="modal-dialog modal-lg">  
      <div class="modal-content">
      <form action="action.php" method="POST" enctype="multipart/form-data">
        <div class="modal-header">  
          <h4 class="modal-title">Assign Course To Member</h4>  
         

          <button type="button" class="close" data-dismiss="modal">×</button>  
        </div>  
        <div class="modal-body"> 
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name">Select Member</label>
               <select name="app_id" class="form-control input-group input-group-sm select2" style="width: 100%;">
                      <option value="">Choose Member</option>
                      <?php 
                      $res=$conn->query("SELECT * FROM `tbl_applicants` where app_status=1");
                      while($rows=$res->fetch_assoc()){
                            ?>
                        <option value="<?=$rows['app_id'];?>"><?=$rows['app_name'].'/'.$rows['app_mobile'];?></option>
                            <?php
                      }
                      
                      ?>
               </select>
            </div>
        </div> 
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name">Select Course</label>
               <select name="course_id" class="form-control input-group input-group-sm select2" style="width: 100%;" >
                      <option value="">Choose Course</option>
                      <?php 
                      $res=$conn->query("SELECT * FROM `tbl_courses`");
                      while($rows=$res->fetch_assoc()){
                            ?>
                        <option value="<?=$rows['course_id'];?>"><?=$rows['course_title'];?></option>
                            <?php
                      }
                      
                      ?>
               </select>
            </div>
        </div> 
        
       
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name">Status</label>
              <select name="status" id="" class="form-control">
                      <option value="1">Active</option>
                      <option value="0">In active</option>
              </select>
            </div>
        </div>
        </div>  
        <div class="modal-footer">  
          <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" name="assign_member" class="btn btn-success btn-sm ">Assign Course</button>
            
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

<script src="../common/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="../common/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="../common/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="../common/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../common/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="../common/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<?php

}else{
    unset($_SESSION['admin']);
    header('location:login.php');
    ob_end_flush();
}
?>
<script>
function editmemberdetails(id){
  // alert(id);
  // $("#editmember").modal("show");

  $.ajax({
            url: 'action.php',
            method: 'POST',
            data: {edit_assign_course: id},
            success:function(data){
                // $('#EditStafinf').html(data);
             $("#edit_data").html(data);
           
              // console.log(data);
            },
            error:function(err){
              Swal.fire({
                  icon: 'error',
                  text: 'Somthing Went Wrong! Try Again',
                  footer: '<a href>Real Estate Portal</a>'
                });

            }
        });


}
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
    data:{delete_assign_course:id},
    success:function(data){
        Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    );
        location.reload(true);
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

$('.select2').select2()

//Initialize Select2 Elements
$('.select2bs4').select2({
  theme: 'bootstrap4'
});
$("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

</script>

