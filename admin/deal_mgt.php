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
                <h4 class="h4 text-center p-3 bg-info">Deals Data and Informations</h4>
              </div>
              <div class="card-body">
              <div class="form-row">
                <div class="col-md-12">
                    <button class="btn btn-sm btn-info float-right" data-toggle="modal" data-target="#addStaff"><i class="fa fa-plus"></i></button>
                </div>
              </div>
                <div class="table-responsive">
                  <table class="table table-striped table-sm table-hover table-bordered table-condenced" id="table_">
                    <thead>
                      <th>S#.</th>
                      <th>Deal Title</th>
                      <th>Content</th> 
                      <th>Image</th>  
                      <th>Button Text</th>  
                      <th>button Url</th>  
                      <th>Price</th>  
                      <th>Expiry Date</th>  
                      <th>Status</th>  
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <?php
                      $count=0;
                      $res=$conn->query("SELECT * FROM `tbl_deals_details`");
                      while($rows=$res->fetch_assoc()):
                        $count++;
                      ?>
                      <tr>
                      <td><?=$count;?></td>
                      <td><?=$rows['deal_title'];?></td>
                      <td><?=$rows['deal_content'];?></td>
                      <td><img src="../common/dist/deals_images/<?=$rows['deal_image'];?>" alt="" width="180" height="180"></td>
                      <td><?=$rows['deal_button_title'];?></td>
                      <td><?=$rows['deal_button_url'];?></td>
                      <td><?=$rows['deal_price'];?></td>
                      <td><?=$rows['deal_expires_on'];?></td>
                      <td><?=($rows['deal_status']==1)?"Active":"InActive";?></td>
                      <td>
                       <button value="<?=$rows['deal_id']?>" class="btn btn-sm btn-danger"
                       onclick="delete_member_data(this.value);">
                       <i class="fa fa-trash"></i></button>
                        <a href="edit_deals.php?deal_id=<?=$rows['deal_id']?>">
                        <button class="btn btn-sm btn-info">
                       <i class="fa fa-edit"></i></button>
                        </a>
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
          <h4 class="modal-title">Add Deals Content Informations</h4>  
         

          <button type="button" class="close" data-dismiss="modal">×</button>  
        </div>  
        <div class="modal-body"> 
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name">Deals Title</label>
                <input type="text" name="deals_title"  class="form-control">
            </div>
        </div> 
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name">Deals Content</label>
                <textarea name="deals_content" id="" cols="10 " rows="3" class="form-control"></textarea>
            </div>
        </div> 
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name">Deals Price</label>
                <input type="number" class="form-control" name="deals_price">
            </div>
        </div> 
        <div class="form-row">
        <div class="form-group col-md-6">
                <label for="name">Deals Image - Dimension (1769*569)</label>
                <input type="file" name="slider_image"  class="form-control" >
        </div>
        <div class="form-group col-md-6">
                <label for="name">Deals Expire on</label>
                <input type="date" name="deals_expire"  class="form-control" >
        </div>
        </div>
        <div class="form-row">
        <div class="form-group  col-md-6">
                <label for="name">Button Text</label>
                <input type="text" name="button_text" class="form-control">
            </div>
            <div class="form-group  col-md-6">
                <label for="name">Button Url</label>
                <input type="url" name="button_url" class="form-control btn btn-info"   >
            </div>
           
        </div>
        <div class="form-row">
        <div class="form-group  col-md-12">
                <label for="name">Status</label>
               <select name="status" id="" class="form-control">
                   <option value="1">Active</option>   
                   <option value="0">InActive</option>   
               </select>
            </div>
        </div>
        </div>  
        <div class="modal-footer">  
          <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" name="add_deals_content" class="btn btn-success btn-sm ">Save</button>
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
function editmemberdetails(id){
  // alert(id);
  // $("#editmember").modal("show");

  $.ajax({
            url: 'action.php',
            method: 'POST',
            data: {edit_member: id},
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
    data:{delete_deals_data:id},
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

$(function(){
    $('#content_if_yes').hide();

$('input[type="radio"]').click(function(){
    if($('#yes_content').is(':checked')){
        $('#content_if_yes').show();
    }else{
        $('#content_if_yes').hide();

    }
})
    $("#table_").DataTable();
})
</script>

