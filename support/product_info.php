<?php 
include "header.php"; 
if(isset($_SESSION['support'])){
  $admin_data=$_SESSION['support'];
  $admin_id = $_SESSION['support']['staff_id'];
 
?>
<link rel="stylesheet" href="../common/plugins/ekko-lightbox.css">
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
                   $userdata=$conn->query("SELECT tbl_products.*, tbl_vendors.* FROM (`tbl_products` INNER JOIN tbl_vendors ON tbl_vendors.vendor_id = tbl_products.vendor_id) WHERE tbl_products.product_id = '$p_id' ");
                   $data=mysqli_fetch_assoc($userdata);
                //    $isdata=mysqli_num_rows($res);
                   
                   ?>
              <div class="card-body">
              <form action="action.php" method="post">
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
                    <div class="form-row float-right">
                    
                    <button type="submit" class="btn btn-danger <?php 
                    if($data['product_status'] == 'rejected'){ echo 'disabled'; } ?>" name="rejected" value="rejected">Reject</button>
                    <button type="submit" class="btn btn-info ml-1 mr-1 <?php 
                    if($data['product_status'] == 'disabled'){ echo 'disabled'; } ?>" name="disabled" value="disabled">Disable</button>
                    <button type="submit" class="btn btn-success <?php 
                    if($data['product_status'] == 'approved'){ echo 'disabled'; } ?>" name="approved" value="approved">Approve</button>
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
<script src="../common/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<?php

}else{
    unset($_SESSION['support']);
    header('location:login.php');
    ob_end_flush();
}
?>
<script>
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  })
</script>
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
					text: 'Generate PDF',
					extend: 'pdfHtml5',
					filename: 'products_records',
					orientation: 'portrait', //landscape
          pageSize: 'A4', //A3 , A5 , A6 , legal , letter
          
					exportOptions: {
						columns: [0,1,2,3,4],
						search: 'applied',
						order: 'applied'
					},
					customize: function (doc) {
						//Remove the title created by datatTables
						doc.content.splice(0,1);
						//Create a date string that we use in the footer. Format is dd-mm-yyyy
						var now = new Date();
            var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();
            var checkedBy="______________";
            var Customer_name="cybemerce";
            var Customer_father="Member Detail";
            
            doc.pageMargins = [20,100,5,40];
						// Set the font size fot the entire document
						doc.defaultStyle.fontSize = 11;
						// Set the fontsize for the table header
            doc.styles.tableHeader.fontSize = 12;
						// Create a header object with 3 columns
						// Left side: Logo
						// Middle: brandname
						// Right side: A document title
						doc['header']=(function() {
							return {
								columns: [
									{
										alignment: 'center',

                    text: 'cybemerce \n Mobile Number +9231245698\n ',
                    fontWeight:500,
                    fontSize: 15,
                    paddingTop:50,
                    paddingBottom:20,
									}
                ],
               paddingTop:20,
               marginTop:20,
            
							}
						});
						// Create a footer object with 2 columns
						// Left side: report creation date
						// Right side: current page and total pages
            doc['footer']=(function(page, pages) {
							return {
								columns: [
									{
										alignment: 'left',
										text: ['Created on: ', { text: jsDate.toString() }]
									},
									{
										alignment: 'center',
										text: ['page ', { text: page.toString() },	' of ',	{ text: pages.toString() }]
                  },
                  {
										alignment: 'right',
										text: 'Checked By:________________',
									}
								],
								margin: 20
							}
						});
                        var objLayout = {};
						objLayout['hLineWidth'] = function(i) { return .5; };
						objLayout['vLineWidth'] = function(i) { return .5; };
						objLayout['hLineColor'] = function(i) { return '#aaa'; };
						objLayout['vLineColor'] = function(i) { return '#aaa'; };
						objLayout['paddingLeft'] = function(i) { return 4; };
						objLayout['paddingRight'] = function(i) { return 4; };
						doc.content[0].layout = objLayout;
				}
				},
        {
					text: 'Generate Excel',
					extend: 'excel',
					filename: 'products_record',
			
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

