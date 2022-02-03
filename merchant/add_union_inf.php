<?php 
include "header.php"; 
if(isset($_SESSION['merchant'])){
  $vendor_data=$_SESSION['merchant'];
  $vendor_id = $_SESSION['merchant']['mer_id'];
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
                <h4 class="h4 text-center p-3 bg-info">All Union Information</h4>
              </div>
              <div class="card-body">
              
                <div>
                <form>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="unionname">Union Name</label>
                      <select id="unionname" class="form-control">
                        <option selected>Choose...</option>
                        <option>Non-Union</option>
                        <option>Insulators</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                    <label for="unionlevel">Union Level</label>
                      <select id="unionlevel" class="form-control">
                        <option selected>Choose...</option>
                        <option>1</option>
                        <option>2</option>
                      </select>
                    </div>
                    <div class="form-group  col-md-4">
                    <label for="inputAddress">Wage Rate</label>
                    <input type="number" class="form-control" id="inputAddress" placeholder="1">
                  </div>
                  </div>
                  
                  <div class="table-responsive">
                  <table class="table table-striped table-sm table-hover table-bordered table-condenced">
                    <thead>
                      <th>s#.</th>
                      <th>Benefit Name</th> 
                      <th>Type</th>  
                      <th>Type 2</th>  
                      <th>Amount</th>
                    </thead>
                    <tbody>
                    <tr>
                    <td>1</td>
                    <td>
                    <input type="text" class="form-control" placeholder="Pension Fund">
                    </td>
                    <td>
                    <select class="form-control">
                        <option selected>Choose...</option>
                        <option>Employer</option>
                        <option>Employer</option>
                      </select>
                    </td>
                    <td>
                    <input type="text" class="form-control" placeholder="Hours Worked">
                    </td>
                    <td>
                    <input type="number" class="form-control" placeholder="4.4">
                    </td>
                    </tr>                    
                    </tbody>
                    </table>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                    <button type="submit" class="btn btn-primary float-right">Add</button>
                    </div>
                    </div>
                    <h3>Cost Summary</h3>
                    <div class="row">
                    <div class="form-group col-md-6">
                    <label for="inputAddress2">Employer Hours Worked</label>
                    <input type="number" class="form-control" id="inputAddress2" placeholder="7.4">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputAddress3">Employer Hours Earned</label>
                    <input type="number" class="form-control" id="inputAddress3" placeholder="2000">
                  </div>
                  </div>
                  <div class="table-responsive">
                  <table class="table table-striped table-sm table-hover table-bordered table-condenced">
                    <thead>
                      <th>s#.</th>
                      <th>Deductions Name</th> 
                      <th>Type</th>  
                      <th>Type 2</th>  
                    </thead>
                    <tbody>
                    <tr>
                    <td>1</td>
                    <td>
                    <input type="text" class="form-control" placeholder="Pension Fund">
                    </td>
                    <td>
                    <select class="form-control">
                        <option selected>Choose...</option>
                        <option>Employer</option>
                        <option>Employer</option>
                      </select>
                    </td>
                    <td>
                    <input type="text" class="form-control" placeholder="Hours Worked">
                    </td>
                    </tr>                    
                    </tbody>
                    </table>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                    <button type="submit" class="btn btn-primary float-right">Add</button>
                    </div>
                    </div>
                    <h3>Cost Summary</h3>
                    <div class="row">
                    <div class="form-group col-md-6">
                    <label for="inputAddress2">Employer Hours Worked</label>
                    <input type="number" class="form-control" id="inputAddress2" placeholder="7.4">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputAddress3">Employer Hours Earned</label>
                    <input type="number" class="form-control" id="inputAddress3" placeholder="2000">
                  </div>
                  </div>                 
                  
                </form>
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
    header('location:../login.php');
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
            data: {edit_product: id},
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
    data:{delete_product:id},
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

