<?php 
include "header.php"; 
if(isset($_SESSION['support'])){
  $admin_data=$_SESSION['support'];
  $admin_id = $_SESSION['support']['staff_id'];
  if($admin_data['role_id']==2):

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
                <h4 class="h4 text-center p-3 bg-info">All Qoute Request</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-sm table-hover table-bordered table-condenced" id="table_">
                    <thead>
                      <th>S#.</th>
                      <th>Name</th> 
                      <th>Email</th> 
                      <th>Messages</th> 
                      <th>Action</th>
                    </thead>
                    <tbody>
                   <?php 
                   $userdata=$conn->query("SELECT * FROM `contact_us_msgs`");
                   $count=0;
                   while($row=$userdata->fetch_assoc()):
                   $count++;

                   ?>
                   <tr>
                    <td><?=$count;?></td>
                    <td><?=$row['contact_name'];?></td>
                    <td><?=$row['contact_email'];?></td>
                    <td><?=$row['contact_msgs'];?></td>
                    <td>
                    <button class="btn btn-danger btn-sm" title="You cannot delete"><i class="fa fa-trash"></i></button>
                    
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
          <h4 class="modal-title">Edit Member s</h4>  
          <button type="button" class="close" data-dismiss="modal">×</button>  
        </div>  
        <form action="action.php" enctype="multipart/form-data" method="POST" >
        <div class="modal-body" id="edit_data">  
      
        </div>  
        </form>
      </div>  
    </div>  
  </div> 

<!-- add .staff -->
  <div class="modal fade" id="addStaff" role="dialog">  
    <div class="modal-dialog modal-lg">  
      <div class="modal-content">
      <form action="action.php" method="POST" enctype="multipart/form-data">
        <div class="modal-header">  
          <h4 class="modal-title">Add Ads Content</h4>  
         

          <button type="button" class="close" data-dismiss="modal">×</button>  
        </div>  
        <div class="modal-body"> 
        <input type="hidden" name="pkg_id" value="<?=$pkg_id;?>">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name">Content Descriptions</label>
                <input type="text" name="description" class="form-control" >
            </div>
        </div> 
        </div>  
        <div class="modal-footer">  
          <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" name="save_ads_content" class="btn btn-success btn-sm "> Save</button>
            
        </div>  
        </form>

      </div>  

    </div>  
  </div> 
  <!-- inforamtion -->
  <div class="modal fade" id="informations" role="dialog">  
    <div class="modal-dialog modal-lg">  
      <div class="modal-content">
      <form action="action.php" method="POST" enctype="multipart/form-data">
        <div class="modal-header">  
          <h4 class="modal-title">Add Ads Content</h4>  
         

          <button type="button" class="close" data-dismiss="modal">×</button>  
        </div>  
        <div class="modal-body"> 
        <input type="hidden" name="pkg_id" value="<?=$pkg_id;?>">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name">Content Descriptions</label>
                <input type="text" name="description" class="form-control" >
            </div>
        </div> 
        </div>  
        <div class="modal-footer">  
          <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" name="save_ads_content" class="btn btn-success btn-sm "> Save</button>
            
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
endif;
}else{
    unset($_SESSION['support']);
    header('location:login.php');
    ob_end_flush();
}
?>
<script>
function editorledetails(id){
  // alert(id);
  $("#editmember").modal("show");
  $.ajax({
            url: 'action.php',
            method: 'POST',
            data: {edit_role: id},
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
// informations
function informations(id){
  // alert(id);
  $("#informations").modal("show");
  $.ajax({
            url: 'action.php',
            method: 'POST',
            data: {get_qoute_informations: id},
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
    data:{delete_contact_content:id},
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
					filename: 'adminstrative_staff',
					orientation: 'portrait', //landscape
          pageSize: 'A4', //A3 , A5 , A6 , legal , letter
          
					exportOptions: {
						columns: [0,1,2,3,4,5],
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
            var Customer_name="Cybemerce";
            var Customer_father="Member Detail";
            
            doc.pageMargins = [40,100,5,40];
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

                    text: 'Cybemerce \n Mobile Number +923439482592\n ',
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

