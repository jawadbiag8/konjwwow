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
include "navbar.php";
$member_id=$_GET['member_id'];
$res=$conn->query("SELECT  * FROM `tbl_members` where member_id='$member_id'");
$data=mysqli_fetch_assoc($res);
$isdata=mysqli_num_rows($res);

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
                <h4 class="h4 text-center p-3 bg-info">Member Details</h4>
              </div>
              <div class="card-body">
              <?php
              if($isdata < 1){
            ?>
              <h4 class="h4 text-center text-danger">Member Data Not Found</h4>
            <?php
            // continue();

               }else{
              
              
              ?>
​​<div class="form-row">
    <div class="form-group col-md-6">
    <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?=$data['member_name']?>" >
            </div>
        </div> 
        <div class="form-row">
        <div class="form-group col-md-6">
        <?php
       $cnic=explode('-',$data['member_cnic']);
       $cn=$cnic[0];
       $cn1=$cnic[1];
       $cn2=$cnic[2];

        ?>
                <label for="name">Member cnic</label>
                <div class="form-row">
                <div class="form-group col-md-4">
                <input type="text"  pattern="\d+" name="cnic1" maxlength="5" class="form-control" value="<?=$cn?>" id="">
                </div>
                <div class="form-group col-md-4">
                <input type="text"  pattern="\d+" name="cnic2" maxlength="7"  class="form-control" value="<?=$cn1?>" id="">
                </div>
                <div class="form-group col-md-4">
                <input type="text"  pattern="\d+" name="cnic3" maxlength="1"  class="form-control" value="<?=$cn2?>" id="">
                </div>
                </div>
        </div>
        <div class="form-group col-md-6">
                    <label for="name">DOB</label>
                    <input type="text" name="DOB" id="name" class="form-control" value="<?=$data['dob']?>" >
            </div> 
        </div> 
        <div class="form-row">
        <div class="form-group col-md-6">
                <label for="name">Father/Husband Name</label>
                <input type="text" name="father_husband_name" id="name" class="form-control" value="<?=$data['father_husband_name']?>" >
        </div>
        <div class="form-group col-md-6">
                <label for="name">Nationality</label>
                <input type="text" name="nationality" id="name" class="form-control" value="<?=$data['nationality']?>" >
        </div>
        </div>
        <div class="form-row">
            <div class="form-group  col-md-12">
                <label for="name">Permanent Adress</label>
                <textarea name="permanent_adress" id="" cols="10" class="form-control" rows="3"><?=$data['perminnt_Address']?></textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name">Current Adress</label>
                <textarea name="current_adress" id="" cols="10" class="form-control" rows="3"><?=$data['current_address']?></textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                    <label for="name">Country</label>
                    <input type="text" name="country" id="name" class="form-control" value="<?=$data['country']?>" >
            </div>
            <div class="form-group col-md-6">
                    <label for="name">City</label>
                    <input type="text" name="city" id="name" class="form-control" value="<?=$data['city']?>" >
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                    <label for="name">Phone number</label>
                    <input type="text"  pattern="\d+" name="phone_number" id="name" class="form-control" value="<?=$data['phone_number']?>" >
            </div>
            <div class="form-group col-md-6">
                    <label for="name">Mobile</label>
                    <input type="text"  pattern="\d+" name="mobile" id="name" class="form-control" value="<?=$data['primary_mobile']?>" >
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                    <label for="name">Secondary Mobile</label>
                    <input type="text"  pattern="\d+" name="secondary_mobile" id="name" class="form-control" value="<?=$data['secondary_mobile']?>" >
            </div>
            <div class="form-group col-md-6">
                <label for="name">Email</label>
                <input type="email" name="email" id="name" class="form-control" value="<?=$data['email']?>" >
        </div>
        </div>
    </div>
    <div class="form-group col-md-4">
    
    </div>
    <div class="form-group col-md-2">
    <div class="form-group col-md-3">
                <img src="../Common/dist/img/<?=$data['profile_pictures']?>" alt="" width="150">
        </div>  
    </div>
</div>
             
​<?php 

               }
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
​
<!-- add staff -->
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
​
<script>
function editroles(id,status){
  // alert(status);
  $("#editrole").modal("show");
}
</script>
<?php
}else{
    unset($_SESSION['admin']);
    header('location:login.php');
    ob_end_flush();
}
?>
<script>
function editdata(id){
//   $.ajax({
//             url: 'action.php',
//             method: 'POST',
//             data: {edit_data: id},
//             success:function(data){
//                 // $('#EditStafinf').html(data);
//              $("#edit_data").html(data);
//              $("#editrole").modal("show");
//               // console.log(data);
//             },
//             error:function(err){
//               Swal.fire({
//                   icon: 'error',
//                   text: 'Somthing Went Wrong! Try Again',
//                   footer: '<a href>Real Estate Portal</a>'
//                 });
​
//             }
//         });
​
​
}
</script>
