<?php 
include "header.php"; 
if(isset($_SESSION['admin'])){
  $admin_data=$_SESSION['admin'];
  $admin_id = $_SESSION['admin']['id'];
  $course_id=$_GET['course_id'];
?>
<script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
<link rel="stylesheet" href="css/dropzone.css" />
  <script src="js/dropzone.js"></script>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <?php
  include('top-bar.php');
  ?>
  <!-- Main Sidebar Container -->
  <?php
include "navbar.php";
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-12">
          <?php 
          $count=0;
          $res=$conn->query("SELECT * FROM `tbl_courses` where course_id='$course_id'");
          $num=mysqli_num_rows($res);
          if($num < 1){
              echo "<h1 class='text-danger text-center'>Please Come through Proper Way, Your Selection is Wrong</h1>";
              exit;
          }
          ?>
            <div class="card">
              <div class="card-heading">
                <h4 class="h4 text-center p-3 bg-info">Add Lectures</h4>
              </div>
              <div class="card-body">
              <div class="form-row">
                <div class="col-md-12">
                    <button class="btn btn-sm my-2 btn-info float-right" data-toggle="modal" data-target="#addStaff">Add Lecture <i class="fa fa-plus"></i></button>
                </div>
                <div class="form-group col-md-12">
                <div class="alert alert-sm icon-alert with-arrow alert-success form-alter my-2" role="alert">
                  <i class="fa fa-fw fa-check-circle"></i>
                  <strong> Success ! </strong> <span class="success-message"> Lectures Order has been updated successfully </span>
                </div>
                <div class="alert icon-alert with-arrow alert-danger form-alter" role="alert">
                  <i class="fa fa-fw fa-times-circle"></i>
                  <strong> Note !</strong> <span class="warning-message"> Empty list cant be ordered Try Again </span>
                </div>
                </div>
              </div>
              <div class="table-responsive">
                  <table class="table table-striped table-sm table-hover table-bordered sortable table-condenced" id="datatable">
                    <thead>
                      <th>s#.</th>
                      <th>Lecture Title</th> 
                      <th>Lecture Type</th> 
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <?php
                      $count=0;
                      $res=$conn->query("SELECT * FROM `tbl_lectures` where course_id='$course_id' ORDER BY position_order ASC");
                      while($rows=$res->fetch_assoc()):
                        $count++;
                      ?>
                      <tr data-post-id="<?php echo $rows["lec_id"]; ?>">
                      <td><?=$count;?></td>
                      <td><?=$rows['lec_title'];?></td>
                      <td><?=$rows['lect_type'];?></td>
                      <td>
                      <!-- <button value="<?=$rows['lec_id'];?>" class="btn btn-sm btn-info" data-toggle="modal"        data-target="#editlecture"
                        onclick="editlecturedetails(this.value);"><i class="fa fa-edit"></i></button> -->

                        <button value="<?=$rows['lec_id']?>" class="btn btn-sm btn-info"
                        onclick="delete_lect_data(this.value);">
                        <i class="fa fa-trash"></i></button>
                       <?php if($rows['lect_type']=="quiz"){
                           ?>
                           <a class="btn btn-sm btn-warning" href="create_quiz.php?lectur_id=<?=$rows['lec_id']?>&&course_id=<?=$course_id?>">
                           <i class="fa fa-info"></i> </a>
                       
                        <?php
                        }elseif($rows['lect_type']=="lecture"){
                          ?>
                          <a class="btn btn-sm  btn-success" href="lecure_detail.php?lectur_id=<?=$rows['lec_id']?>">
                          <i class="fa fa-info"></i> </a>
                      
                       <?php
                        }
                        ?>
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
  <div class="modal fade" id="editlecture" role="dialog">  
    <div class="modal-dialog modal-lg">  
      <div class="modal-content">  
        <div class="modal-header">  
          <h4 class="modal-title">Edit Lecture Detail</h4>  
          <button type="button" class="close" data-dismiss="modal">×</button>  
        </div>  
        <form action="action.php" enctype="multipart/form-data" method="POST" >
        <div class="modal-body" id="edit_data">  
        <textarea id='edit_long_desc' name="lecture_description"  cols="10" class="form-control" rows="3"></textarea>
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
          <h4 class="modal-title">Add Lecture</h4>  
         

          <button type="button" class="close" data-dismiss="modal">×</button>  
        </div>  
        <div class="modal-body"> 
        <div class="form-row">
        <input type="hidden" name="course_id" id="" value="<?=$course_id;?>">
        <?php
        $res=$conn->query("SELECT * FROM `tbl_lectures` ORDER BY position_order DESC");
        $position=mysqli_fetch_assoc($res);
        ?>
        <input type="hidden" name="position" value="<?=$position['position_order'];?>">
            <div class="form-group col-md-12">
                <label for="name">Lecture/Quiz/Topic Heading</label>
                <input type="text" required name="lecture_title" class="form-control" >
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name">Lecture Type</label>
                <div class="form-row">
                    <div class="form-group col-md-12">
                    <label for=""><input type="radio" id="lecture" name="lecture_type" required class="p-2 m-2" value="lecture" >Lecture</label>
                    <label for=""><input type="radio" id="quiz" name="lecture_type" required  class="p-2 m-2" value="quiz" >Quiz</label>
                    <label for=""><input type="radio" id="heading" name="lecture_type" required  class="p-2 m-2" value="heading" >Topic Heading</label>
                    </div>
                </div>
            </div>
        </div> 
        <div class="form-row" id="ifYes">
            <div class="form-group col-md-12">
                <label for="name">Lecture Description</label>
                <textarea id='long_desc' name="lecture_description"  cols="10" class="form-control" rows="3"></textarea>
            </div>
           <div class="form-row">
           <div class="form-group col-md-6">
                <label for="name">Lecture Description Media</label>
                <input type="file" class="form-control" name="desc_attachment[]">
                <div class="add_more_field">
                </div>
            </div>
            <div class="form-group col-md-6 mt-4">
              <button id="remove" type="button" onclick="remove_attachement()" class="btn btn-sm btn-danger">Remove</button>
              <button class="btn btn-info btn-sm"  type="button" onclick="add_more()">Add More</button>
            </div>
           </div>
            <div class="form-group col-md-6">
                <label for="name">Video Link</label>
                <input type="text"  name="lecture_link" class="form-control" >
            </div>
            <div class="form-group col-md-6">
                <label for="name">Attachment</label>
                <input type="file"  name="lecture_attach" class="form-control" >
            </div>

        </div>
    
        </div>  
        <div class="modal-footer">  
          <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" name="add_lecture" class="btn btn-success btn-sm ">Add Lecture</button>
            
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

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<?php

}else{
    unset($_SESSION['admin']);
    header('location:login.php');
    ob_end_flush();
}
?>
<script>
function add_more(){
  $(".add_more_field").append(`
  <input type="file" id='newattach' class="form-control mt-2" name="desc_attachment[]">`);
  $('#remove').show();
}
function remove_attachement(){
  $("#newattach").remove();
}
$(document).ready(function(){
  $('#remove').hide();

    $("#ifYes").hide();
$('#lecture').click(function() {
   if($('#lecture').is(':checked')) { 
    $("#ifYes").show();
    }
    
});
$('#quiz').click(function() {
   if($('#quiz').is(':checked')) { 
    $("#ifYes").hide();
    } 
});
})
// Initialize CKEdito
// 
CKEDITOR.replace( 'long_desc', {
  height: 300,
  filebrowserUploadUrl: "upload.php"
  
 });
CKEDITOR.replace('edit_long_desc'); 
function editlecturedetails(id){
  $.ajax({
      url: 'action.php',
      method: 'POST',
      data: {edit_lecture: id},
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
function delete_lect_data(id){
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
    data:{delete_lect_data:id},
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
$(function() {
  $(".alert-danger").hide();
	$(".alert-success ").hide();
    $( ".sortable tbody" ).sortable({
	placeholder : "ui-state-highlight",
	update  : function(event, ui)
	{
		var post_order_ids = new Array();
		$('.sortable tbody tr').each(function(){
			post_order_ids.push($(this).data("post-id"));
		});
		$.ajax({
			url:"ajax_upload.php",
			method:"POST",
			data:{post_order_ids:post_order_ids},
			success:function(data)
			{
			 if(data){
			 	$(".alert-danger").hide();
			 	$(".alert-success ").show();
			 }else{
			 	$(".alert-success").hide();
			 	$(".alert-danger").show();
			 }
			}
		});
	}
});
$( ".sortable tbody" ).sortable({
	placeholder : "ui-state-highlight",
	update  : function(event, ui)
	{
		var post_order_ids = new Array();
		$('.sortable tbody tr').each(function(){
			post_order_ids.push($(this).data("post-id"));
		});
		$.ajax({
			url:"action.php",
			method:"POST",
			data:{sort_lecture:post_order_ids},
			success:function(data)
			{
			 if(data){
			 	$(".alert-danger").hide();
			 	$(".alert-success ").show();
			 }else{
			 	$(".alert-success").hide();
			 	$(".alert-danger").show();
			 }
			}
		});
	}
});
$(function(){
    $("#ifYes").hide();
$('#lecture').click(function() {
   if($('#lecture').is(':checked')) { 
    $("#ifYes").show();
    }
    
});
$('#quiz').click(function() {
   if($('#quiz').is(':checked')) { 
    $("#ifYes").hide();
    }
});

$('#heading').click(function() {
   if($('#heading').is(':checked')) { 
    $("#ifYes").hide();
    }
});
})
  });
</script>

