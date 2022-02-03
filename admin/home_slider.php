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
                <h4 class="h4 text-center p-3 bg-info">Sliders Content And Data information</h4>
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
                      <th>Slider Content</th> 
                      <th>Image</th>  
                      <th>Button</th>  
                      <th>Button Text</th>  
                      <th>button Url</th>  
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <?php
                      $count=0;
                      $res=$conn->query("SELECT * FROM `tbl_home_slider_control`");
                      while($rows=$res->fetch_assoc()):
                        $count++;
                      ?>
                      <tr>
                      <td><?=$count;?></td>
                      <td><?=$rows['slider_content'];?></td>
                      <td><img src="../common/dist/slider_images/<?=$rows['slider_image'];?>" alt="" width="180" height="180"></td>
                      <td><?=($rows['is_button_exist']==1)?'Yes':'No';?></td>
                      <td><?=$rows['button_content'];?></td>
                      <td><?=$rows['button_url'];?></td>
                      <td>
                       <button value="<?=$rows['slider_id']?>" class="btn btn-sm btn-info"
                       onclick="delete_member_data(this.value);">
                       <i class="fa fa-trash"></i></button>
                       <button value="<?=$rows['slider_id']?>" class="btn btn-sm btn-primary"
                       onclick="edit_information(this.value);">
                       <i class="fa fa-edit"></i></button>
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
          <h4 class="modal-title">Update information's</h4>  
          <button type="button" class="close" data-dismiss="modal">×</button>  
        </div>  
        <form action="action.php" enctype="multipart/form-data" method="POST" >
        <div class="modal-body" id="edit_data">  
      
        </div>
        <div class="modal-footer">  
          <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" name="update_slider_content" class="btn btn-success btn-sm ">Update</button>
            
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
          <h4 class="modal-title">Add Slider Content Informations</h4>  
         

          <button type="button" class="close" data-dismiss="modal">×</button>  
        </div>  
        <div class="modal-body"> 
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name">Slider Content</label>
                <textarea name="slider_content" id="editor" cols="10 " rows="3" class="form-control"></textarea>
            </div>
        </div> 
        <div class="form-row">
        <div class="form-group col-md-6">
                <label for="name">Slider Image - Dimension (570*320)</label>
                <input type="file" name="slider_image"  class="form-control" >
        </div>
        <div class="form-group col-md-6">
                <label for="name">Do you Want to Add Button on Slider <br>
                <input type="radio" name="slider_button" id="yes_content" value="1"> Yes
                <input type="radio" name="slider_button" id="" value="0"> No
            </label>
                
        </div>
        </div>
        <div class="form-row" id="content_if_yes">
        <div class="form-group  col-md-6">
                <label for="name">Button Text</label>
                <input type="text" name="button_text" class="form-control">
            </div>
            <div class="form-group  col-md-6">
                <label for="name">Button Url</label>
                <input type="url" name="button_url" class="form-control btn btn-info"   >
            </div>
           
        </div>
       
        </div>  
        <div class="modal-footer">  
          <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" name="add_slider_content" class="btn btn-success btn-sm ">Save</button>
            
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
function edit_information(id){
  // alert(id);
  // $("#editmember").modal("show");

  $.ajax({
            url: 'action.php',
            method: 'POST',
            data: {edit_slider_info: id},
            success:function(data){
                // $('#EditStafinf').html(data);
             $("#edit_data").html(data);
             $("#editmember").modal("show");
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
    data:{delete_slider_data:id},
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
    $("#table_").DataTable({
			"dom": '<"dt-buttons"Bf><"clear">lirtp',
			"paging": true,
			"autoWidth": true,
			"buttons": [
      
        {
					text: 'Generate Excel',
					extend: 'excel',
					filename: 'customer_payment_detail',
			
				},
                // {
                //     text:'take print',
                //     extend:'print',
                //     file_name:'Print_customer_date'
                // }
        
        ]
		});
})
</script>

