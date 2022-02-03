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
                <h4 class="h4 text-center p-3 bg-info">Orders Information</h4>
              </div>
              <?php 
                    $p_id = $_GET['p_id'];
                    $order_id = $_GET['order_id'];
                   $userdata=$conn->query("SELECT tbl_vendors.*,tbl_products.*,tbl_merchant.* ,tbl_orders.* FROM `tbl_orders` INNER JOIN tbl_vendors ON tbl_vendors.vendor_id=tbl_orders.customer_id INNER JOIN tbl_merchant ON tbl_merchant.mer_id=tbl_orders.marchant_id INNER JOIN tbl_products ON tbl_orders.product_id=tbl_products.product_id WHERE
                    tbl_orders.order_id = '$order_id' ");
                    echo $conn->error;
                   $data=mysqli_fetch_assoc($userdata);
                //    $isdata=mysqli_num_rows($res);
                   $get_payment_data=$conn->query("SELECT * FROM `tbl_payment_records` WHERE order_id='$order_id'");
                   $payment_data=mysqli_fetch_assoc($get_payment_data);
                   ?>
              <div class="card-body">
              <form action="action.php" method="post">
              <?php $order_price=$data['product_price']*$data['product_quantity']; ?>
              <input type="hidden" name="order_id" id="" value="<?=$order_id?>">
              <div class="form-row">
                         <div class="col-md-12">
                             <a href="order_payment.php">
                             <buton class="btn btn-sm btn-info px-3 mb-4"><i class="fa fa-arrow-left mx-1"></i> Back</buton>
                             </a>
                         <h4 class="h4">Orders Details</h4>
                         </div>
                        <div class="form-group col-md-6">
                            <input type="hidden" name="order_total_price" value="<?=$order_price;?>" id="">
                        <input type="hidden" class="form-control" name="p_id" value="<?=$data['product_id'];?>">
                        <label>Product Name</label>                        
                        <input type="text" class="form-control" readonly value="<?=$data['product_name']?>">
                        </div>
                        <div class="form-group col-md-3">
                        <label>Order Price</label>
                        <input type="text" class="form-control" readonly value="<?=$data['product_price']*$data['product_quantity']?>">
                        </div>
                        <div class="form-group col-md-3">
                        <label>Quantity</label>
                        <input type="text" class="form-control" readonly value="<?=$data['product_quantity']?>">
                        </div>
                        </div>
                    <div class="form-row">
                        <div class="col-md-6 form-group card card-body">
                            <h4 class="h4">Vendor information</h4>
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
                        <input type="text" class="form-control" name="vendor_email" readonly value="<?=$data['vend_email']?>">
                        </div>
                        <div class="form-group col-md-6">
                        <label>Mobile Number</label>
                        <input type="text" class="form-control" readonly value="<?=$data['vend_mobile']?>">
                        </div>
                    </div>
                    <!-- SELECT `payment_id`, `order_id`, `received`, `received_able`, `paid`, `payable`, `deductions`, `created_at` FROM `tbl_payment_records` WHERE 1 -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Paid</label>
                        <input type="number" name="paid" class="form-control" value="<?=$payment_data['paid']?>">
                        </div>
                        <div class="form-group col-md-6">
                        <label>Payable</label>
                        <?php 
                        $deducations=$payment_data['deductions'];
                        $paid=$payment_data['paid'];
                        $payables=$order_price-$deducations-$paid;
                         ?>
                        
                        <input type="number" name="" class="form-control" value="<?=$payables?>" >
                        </div>
                        <div class="form-group col-md-12">
                        <label>Service Charges (Deducations)</label>
                        <input type="number" name="deducations" class="form-control" value="<?=$deducations?>" >
                        </div>
                    </div>
                    
                  
                        </div>
                        <div class="col-md-6 form-group card card-body">
                            <h4 class="h4">Merchant information</h4>
                            <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Merchant Name</label>
                        <input type="text" class="form-control" readonly value="<?=$data['mer_name']?>">
                        </div>
                        <div class="form-group col-md-6">
                        <label>Business Name</label>
                        <input type="text" class="form-control" readonly value="<?=$data['mer_business_name']?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Email Address</label>
                        <input type="text" name="merchant_email" class="form-control" readonly value="<?=$data['mer_email']?>">
                        </div>
                        <div class="form-group col-md-6">
                        <label>Mobile Number</label>
                        <input type="text" class="form-control" readonly value="<?=$data['mer_phone']?>">
                        </div>
                    </div>
                   
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Recieved</label>
                        <input type="number" name="recieved" min="1" max="<?=$order_price?>" class="form-control"  value="<?=$payment_data['received']?>">
                        </div>
                        <div class="form-group col-md-6">
                        <label>Recieveable</label>
                        <input type="number" name="recieveable" readonly class="form-control" 
                        value="<?php echo $order_price-$payment_data['received'];?>" >
                        </div>
                    </div>
                    
                        </div>
                        
                    </div>
                  <div class="form-row">
                      <div class="form-group col-md-12">
                          <button type="submit" name="save_order_payment_details" class="btn btn-sm btn-success px-3 float-right">Save</button>
                      </div>
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
function editvender(id){
  // alert(id);
  $("#editmember").modal("show");

  $.ajax({
            url: 'action.php',
            method: 'POST',
            data: {edit_merchant: id},
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
    data:{delete_merchant:id},
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

</script>

