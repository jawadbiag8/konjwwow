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
                <h4 class="h4 text-center p-3 bg-info">Orders Records</h4>
              </div>
              <div class="card-body">
              <!-- <div class="form-row">
                <div class="col-md-12">
                    <button class="btn btn-sm btn-info float-right" data-toggle="modal" data-target="#addStaff"><i class="fa fa-plus"></i></button>
                </div>
              </div> -->
                <div class="table-responsive">
                  <table class="table table-striped table-sm table-hover table-bordered table-condenced" id="table_">
                    <thead>
                      <th>s#.</th>
                      <th>Product Name</th> 
                      <th>Quantity</th>  
                      <th>Order Price</th>
                      <th>Delivery Address</th>  
                      <th>Merchant</th>  
                      <th>Vendor</th>  
                      <th>Order Status</th>
                      <th>
                        Action
                      </th>
                    </thead>
                    <tbody>
                   <?php 
                   $count=0;
                    $get_product_pending=$conn->query("SELECT tbl_vendors.*,tbl_products.*,tbl_merchant.* ,tbl_orders.* FROM `tbl_orders` INNER JOIN tbl_vendors ON tbl_vendors.vendor_id=tbl_orders.customer_id INNER JOIN tbl_merchant ON tbl_merchant.mer_id=tbl_orders.marchant_id INNER JOIN tbl_products ON tbl_orders.product_id=tbl_products.product_id  order by order_id desc");
                    while($row=$get_product_pending->fetch_assoc()):
                   $count++;

                   ?>
                   <tr>
                    <td><?=$count;?></td>
                    <td><?=$row['product_name'];?></td>
                    <td><?=$row['product_quantity'];?></td>
                    <td><?=($row['product_price']*$row['product_quantity']);?></td>
                    <td><?=$row['delivery_address'];?></td>
                    <td><?=$row['mer_name'];?></td>
                    <td><?=$row['vend_business_name'];?></td>
                    <td><?=$row['status'];?></td>
                    <td>
                      <a href="orders_information.php?p_id=<?=$row['product_id']?>&order_id=<?=$row['order_id']?>">
                      <button class="btn btn-info btn-sm"><i class="fa fa-info"></i></button>
                    </a>
                     
                    </td>
                   </tr>
                   <?php endwhile;?>
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
          <button type="submit" name="add_vender" class="btn btn-success btn-sm ">Add Vendors</button>
            
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

$(function(){
  $("#table_").DataTable({
			"dom": '<"dt-buttons"Bf><"clear">lirtp',
			"paging": true,
			"autoWidth": true,
			"buttons": [
        
				{
					text: 'Generate PDF',
					extend: 'pdfHtml5',
					filename: 'order_details',
					orientation: 'portrait', //landscape
          pageSize: 'A4', //A3 , A5 , A6 , legal , letter
          
					exportOptions: {
						columns: [0,1,2,3,4,5],
						search: 'applied',
						order: 'applied'
					},
					customize: function (doc) {
        //     doc.content[1].table.widths = 
        // Array(doc.content[1].table.body[0].length + 1).join('*').split('');
						//Remove the title created by datatTables
						doc.content.splice(0,1);
						//Create a date string that we use in the footer. Format is dd-mm-yyyy
						var now = new Date();
            var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();
            var checkedBy="______________";
            var Customer_name="Konjae";
            var logo_url="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAcIAAACaCAYAAAA6skhrAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAABAFpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1wTU06T3JpZ2luYWxEb2N1bWVudElEPSJ1dWlkOjY1RTYzOTA2ODZDRjExREJBNkUyRDg4N0NFQUNCNDA3IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjhDQzgzRjc5QzNCOTExRUI4MTZEQ0EwOTg2NUEzRUEzIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjhDQzgzRjc4QzNCOTExRUI4MTZEQ0EwOTg2NUEzRUEzIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIElsbHVzdHJhdG9yIENDIDIwMTcgKFdpbmRvd3MpIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6ZGE4MzkxNTQtMzM2OS04YjQ0LWE1MmQtOWRlODljZTZhZmY2IiBzdFJlZjpkb2N1bWVudElEPSJhZG9iZTpk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";

            doc.pageMargins = [40,100,40,40];
						// Set the font size fot the entire document
						doc.defaultStyle.fontSize = 11;
						// Set the fontsize for the table header
            doc.styles.tableHeader.fontSize = 12;
						doc['header']=(function() {
							return {
								columns: [
                  {
                    image:logo_url,
                    width:200,
                    marginLeft:15,
                  },
									// {
									// 	alignment: 'left',

                  //   text:  Customer_name+' ',
                  //   fontWeight:700,
                  //   marginLeft:25,
                  //   fontSize: 18,
                    
									// }
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
					filename: 'order_details',
			
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

