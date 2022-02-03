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
                <h4 class="h4 text-center p-3 bg-info">Order Record</h4>
              </div>
              <div class="card-body">
              <div class="form-row">
              </div>
                <div class="table-responsive">
                  <table class="table table-striped table-sm table-hover table-bordered table-condenced" id="table_">
                    <thead>
                      <th>s#.</th>
                      <th>Product Name</th> 
                      <th>Quantity</th>  
                      <th>Price</th>  
                      <th>Address</th>
                      <th>Order Date</th>
                      <th>Status</th>
                      <th>
                        Action
                      </th>
                    </thead>
                    <tbody>
                     <?php 

                   $userdata=$conn->query("SELECT tbl_orders.product_quantity AS quantity, tbl_orders.status as order_status, tbl_orders.*, tbl_products.* FROM tbl_orders INNER JOIN  tbl_products ON tbl_orders.product_id = tbl_products.product_id WHERE status != 'pending' and vendor_id = '$vendor_id'");
                   $count=0;
                   while($row=$userdata->fetch_assoc()):
                   $count++;

                   ?>
                   <tr>
                    <td><?=$count;?></td>
                    <td><?=$row['product_name'];?></td>
                    <td><?=$row['quantity'];?></td>
                    <td><?=($row['vendor_price']*$row['quantity']);?></td>
                    <td>
                      <?php
                      $get_dres=$conn->query("SELECT * FROM `tbl_order_address`")->fetch_assoc();
                      echo $get_dres['address'];
                      ?>
                   
                  </td>
                  <td><?php echo date('Y-m-d',strtotime($row["created_at"]));?></td>
                  <td><?=$row['order_status'];?></td>
                  <td>
                    <a href="order_details.php?p_id=<?=$row['product_id']?>&order_id=<?=$row['order_id']?>"><button class="btn btn-success btn-sm">Proceed</button></a>
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

