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
  $deal_id=$_GET['deal_id'];
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
                <h4 class="h4 text-center p-3 bg-info">Edit Deals Data and Information's</h4>
              </div>
              <div class="card-body">
              <div class="">
              <?php
                      $res=$conn->query("SELECT * FROM `tbl_deals_details`");
                      while($rows=$res->fetch_assoc()):
                      ?>
                      <form action="action.php" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                      
                        <div class="form-group col-md-12">
                        <img src="../common/dist/deals_images/<?=$rows['deal_image'];?>" class="float-right" alt="" width="180" height="180">
                            <label for="name">Deals Title</label>
                            <input type="hidden" name="id" value="<?=$rows['deal_id']?>">
                            <input type="text" name="deals_title"  class="form-control" value="<?=$rows['deal_title'];?>">
                        </div>
                    </div> 
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="name">Deals Content</label>
                            <textarea name="deals_content" id="" cols="10 " rows="3" class="form-control"><?=$rows['deal_content'];?></textarea>
                        </div>
                    </div> 
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="name">Deals Price</label>
                            <input type="text" class="form-control" name="deals_price" value="<?=$rows['deal_price'];?>">
                        </div>
                    </div> 
                    <div class="form-row">
                    <div class="form-group col-md-6">
                            <label for="name">Deals Image - Dimension (1769*569)</label>
                            <input type="file" name="slider_image"  class="form-control" >
                    </div>
                    <div class="form-group col-md-6">
                            <label for="name">Deals Expire on</label>
                            <input type="date" name="deals_expire" value="<?=$rows['deal_expires_on'];?>"  class="form-control" >
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group  col-md-6">
                            <label for="name">Button Text</label>
                            <input type="text" name="button_text" value="<?=$rows['deal_button_title'];?>" class="form-control">
                        </div>
                        <div class="form-group  col-md-6">
                            <label for="name">Button Url</label>
                            <input type="text" name="button_url" value="<?=$rows['deal_button_url'];?>" class="form-control btn btn-info"   >
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
                        <div class="form-group  col-md-12">
                           <button type="submit" class="btn btn-success btn-sm"  name="update_deals">Update Deals</button>
                        </div>
                    </div>
                    </form> 
                    <?php
                      endwhile;
                      
                      ?>
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
    $("#table_").DataTable({
			"dom": '<"dt-buttons"Bf><"clear">lirtp',
			"paging": true,
			"autoWidth": true,
			"buttons": [
        
				{
					text: 'Generate PDF',
					extend: 'pdfHtml5',
					filename: 'customer_payment_details',
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
            var Customer_name="Edmy";
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

                    text: 'Edmy \n Mobile Number +9231245698\n ',
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

