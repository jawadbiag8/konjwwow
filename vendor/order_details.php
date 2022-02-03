s<?php 
include "header.php"; 
if(isset($_SESSION['vendor'])){
  $vendor_data=$_SESSION['vendor'];
  $vendor_id = $_SESSION['vendor']['vendor_id'];
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
                <h4 class="h4 text-center p-3 bg-info">Products Information</h4>
              </div>
              <?php 
                    $p_id = $_GET['p_id'];
                    $order_id = $_GET['order_id'];
                   $userdata=$conn->query("SELECT tbl_products.*, tbl_vendors.* FROM (`tbl_products` INNER JOIN tbl_vendors ON tbl_vendors.vendor_id = tbl_products.vendor_id) WHERE tbl_products.product_id = '$p_id' ");
                   $data=mysqli_fetch_assoc($userdata);
                //    $isdata=mysqli_num_rows($res);
                   
                   ?>
              <div class="card-body">
              <form action="action.php" method="post">
              
              <input type="hidden" name="order_id" id="" value="<?=$order_id?>">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Vender Name</label>
                        <input type="text" class="form-control" readonly value="<?=$data['vend_name']?>">
                        </div>
                        <div class="form-group col-md-6">
                        <label>Business Name</label>
                        <input type="text" class="form-control" readonly value="<?=$data['vend_business_name']?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Email Address</label>
                        <input type="text" class="form-control" readonly value="<?=$data['vend_email']?>">
                        </div>
                        <div class="form-group col-md-6">
                        <label>Mobile Number</label>
                        <input type="text" class="form-control" readonly value="<?=$data['vend_mobile']?>">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <input type="hidden" class="form-control" name="p_id" value="<?=$data['product_id']?>">
                        <label>Product Name</label>                        
                        <input type="text" class="form-control" readonly value="<?=$data['product_name']?>">
                        </div>
                        <div class="form-group col-md-3">
                        <label>Price</label>
                        <input type="text" class="form-control" readonly value="<?=$data['product_price']?>">
                        </div>
                        <div class="form-group col-md-3">
                        <label>Quantity</label>
                        <input type="text" class="form-control" readonly value="<?=$data['product_quantity']?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                        <label>Remarks</label>
                        <input type="text" class="form-control" readonly value="<?=$data['product_remarks']?>">
                        <br>
                        <label>Describtion</label>
                        <textarea class="form-control" readonly><?=$data['product_desc']?></textarea>
                        </div>                                             
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                        <label>Feature Image</label><br>
                        <img src="../common/dist/img/<?=$data['product_feature_image']?>" alt="" width="100">
                        </div>
                        <div class="form-group col-md-9">
                        <label>Gallery</label>
                        <div class="form-row">
                        <?php
                        $gellary=json_decode( $data['prod_gellary']);
                          foreach($gellary as $key=>$val){
                            ?>
                             <div class="">
                              <a href="../common/dist/product_gellary/<?=$val;?>" data-toggle="lightbox" data-title="<?=$data['product_name']?>" data-gallery="gallery">
                                <img src="../common/dist/product_gellary/<?=$val;?>" class="img-fluid mb-2" alt="<?=$data['product_name']?>">
                              </a>
                            </div>
                            <!-- <img src="../common/dist/product_gellary/<?=$val;?>" alt="" width="200"> -->
                            <?php
                          }
                        ?>
                        </div>
                        
                        </div>                       
                    </div>
                    <div class="form-row">
                        <?php $order_status=$conn->query("SELECT status FROM tbl_orders where order_id='$order_id'")->fetch_assoc(); ?>
                    <div class="form-group col-md-12">
                        <label for="">Status</label>
                        <select name="status" id="" class="form-control" required>
                            <option value="">Choose Order Status</option>
                            <option value="Order Placed" <?php if($order_status['status']=="Order Placed"){ echo 'selected';} ?>>Order Placed</option>
                            <option value="Order Confirmed" <?php if($order_status['status']=="Order Confirmed"){ echo 'selected';} ?>>Order Confirmed</option>
                            <option value="Delivered" <?php if($order_status['status']=="Delivered"){ echo 'selected';} ?>>Delivered</option>
                            <option value="Dispatched" <?php if($order_status['status']=="Dispatched"){ echo 'selected';} ?>>Dispatched</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success float-right" name="update_order_status">Update Status</button>
                    </div>
                    </form>

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
          <h4 class="modal-title">Add Vendors information</h4>  
         

          <button type="button" class="close" data-dismiss="modal">×</button>  
        </div>  
        <div class="modal-body"> 
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name">Full Name</label>
                <input type="text" name="name" class="form-control" >
            </div>
        </div> 
        <div class="form-row">
        <div class="form-group col-md-6">
                <label for="name">Mobile Number</label>
                <input type="text" name="mobile_number"  class="form-control" >
        </div>
        <div class="form-group col-md-6">
                <label for="name">Email</label>
                <input type="email" name="email"  class="form-control" >
        </div>
        </div>
        <div class="form-row">
        <div class="form-group  col-md-12">
                <label for="name">Password</label>
                <input type="password" name="password" class="form-control">
        </div> 
        </div>
        <div class="form-row">
        <div class="form-group  col-md-6">
            <label for="name">Business Name</label>
            <input type="text" name="business_name" class="form-control"   >
        </div>
        <div class="form-group  col-md-6">
            <label for="name">Business Logo</label>
            <input type="file" name="profile_pic" class="form-control btn btn-info"   >
        </div>
        </div>
        <div class="form-row">
        <div class="form-group  col-md-12">
            <label for="name">Remarks</label>
            <textarea name="business_remarks" id="" cols="10" rows="3" class="form-control"></textarea>
        </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name">Status</label>
              <select name="status" id="" class="form-control">
                      <option value="1">Membership Approved</option>
                      <option value="0">Membership Not Approved</option>
              </select>
            </div>
        </div>
        </div>  
        <div class="modal-footer">  
          <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" name="add_member" class="btn btn-success btn-sm ">Add Vendors</button>
            
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
    data:{delete_member_data:id},
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
    $("#table_").DataTable({
			"dom": '<"dt-buttons"Bf><"clear">lirtp',
			"paging": true,
			"autoWidth": true,
			"buttons": [

                     {
					text: 'Generate Excel',
					extend: 'excel',
					filename: 'vendors_record',
			
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

