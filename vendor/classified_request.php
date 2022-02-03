<?php 
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
                <h4 class="h4 text-center p-3 bg-info">Classffied Ads Request</h4>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12">
                <button class="btn btn-sm btn-danger float-right" data-toggle="modal" data-target="#ad_price">Send Request <i class="fa fa-plus"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="form-row">
                  <div class="form-group col-md-12">
                  <div class="table-responsive">
                  <table class="table table-striped table-sm table-hover table-bordered table-condenced" id="table_">
                    <thead>
                      <th>S#.</th>
                      <th>Product Name</th> 
                      <th>Package Name</th> 
                      <th>Status</th> 
                    </thead>
                    <tbody>
                   <?php 
                   $userdata=$conn->query("SELECT * FROM `tbl_ads_requests` INNER JOIN tbl_products ON tbl_products.product_id=tbl_ads_requests.product_id INNER JOIN tbl_advertisment_packages ON tbl_advertisment_packages.pkg_id=tbl_ads_requests.pkg_id where tbl_ads_requests.vendor_id='$vendor_id'");
                   $count=0;
                   while($row=$userdata->fetch_assoc()):
                   $count++;

                   ?>
                   <tr>
                    <td><?=$count;?></td>
                    <td><?=$row['product_name'];?></td>
                    <td><?=$row['pkg_name'];?></td>
                    <td><?=$row['ads_status'];?></td>
                   </tr>
                   <?php endwhile;?>
                    </tbody>
                  </table>
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
  
   <!-- ad_price -->
   <div class="modal fade" id="ad_price" role="dialog">  
    <div class="modal-dialog modal-lg">  
      <div class="modal-content">
      <form action="action.php" method="POST" enctype="multipart/form-data">
        <div class="modal-header">  
          <h4 class="modal-title">Advertise Your Business</h4>  
         

          <button type="button" class="close" data-dismiss="modal">×</button>  
        </div>  
        <div class="modal-body"> 
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name">Select Ads Plan</label>
                <select name="ads_id" id="" class="form-control" required>
                <option value="">Choose Plane</option>
                <?php
                $get_plan=$conn->query("SELECT * FROM `tbl_advertisment_packages`");
                while($rw=$get_plan->fetch_assoc()):
                  ?>
                  <option value="<?=$rw['pkg_id'];?>"><?=$rw['pkg_name'].'('.$rw['pkg_prices'].' Rs/) ';?></option>
                  <?php
                endwhile;
                ?>
                
                </select>
            </div>
            <div class="form-group col-md-12">
              <label for="">Choose Product to Advertise</label>
             <select name="product_id" id="" class="form-control" required>
               <option value="">Choose Product</option>
               <?php
                $userdata=$conn->query("SELECT * FROM `tbl_products` where product_status = 'approved' AND vendor_id='$vendor_id'");
                $count=0;
                while($row=$userdata->fetch_assoc()):
               
               ?>
               <option value="<?=$row['product_id'];?>"><?=$row['product_name'];?></option>
               <?php 
               endwhile;
               ?>
             </select>
            </div>
            <div class="form-group col-md-12">
              <label for="">Description (if any)</label>
              <textarea name="description" id="" class="form-control" cols="30" rows="10"></textarea>
            </div>
            
        </div> 
        </div>  
        <div class="modal-footer">  
          <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" name="send_request" class="btn btn-success btn-sm "> Send Request</button>
            
        </div>  
        </form>

      </div>  

    </div>  
  </div>
  <!-- end -->
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
  $(function(){
    $("#table_").DataTable({
			"dom": '<"dt-buttons"Bf><"clear">lirtp',
			"paging": true,
			"autoWidth": true,
			"buttons": [
      
        {
					text: 'Generate Excel',
					extend: 'excel',
					filename: 'adminstrative_staff',
			
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