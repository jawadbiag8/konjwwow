<?php
ob_start();
include "header.php";
$msg='';
if($_GET['encrypt'] && $_GET['em_']){
 $username=$_GET['em_'];

//  print_r($username);
 $token=$_GET['encrypt'];
 $encrypt=$_GET['_encryption_'];
 $total=$token."&em_=".$username."&_encryption_=".$encrypt;
}else{
    header('location: login.php');
}
if(isset($_POST['dataUploaderLogin'])){
    if(!empty($username)){
        print_r($token);
        // exit;
        // 754216838b18a967f890302084142b61&em_=dilawar@gmail.com&_encryption_754216838b18a967f890302084142b61 _encryption_
        
        $sql="SELECT * from `tbl_vendors` Where vend_email='$username' and recovery_token='$total'";
        $result=$conn->query($sql);
        $rows=mysqli_num_rows($result);
        if($rows >0){
            $password=$_POST['password'];
            $token=md5($password);
           
                $update_q=$conn->query("UPDATE `tbl_vendors` SET vend_pass='$token' where vend_email='$username' and vend_memberships=1");
            if($update_q){
                $_SESSION['msg']['icon']="success";
                $_SESSION['msg']['title']="Successfully";
                $_SESSION['msg']['description']="Password Updated Successfully";
                header('location: login.php');
                exit();
            
            }
            // recovery_toke           
        }else{
        $msg='<h5 class="text-center message-box alert text-danger p-0">Email Not Found</h5>';
            
        }
    }
}
?>
  <link rel="stylesheet" href="../common/login-form/css/login-page.css">
    
    <!--Only for demo purpose - no need to add.-->
    <link rel="stylesheet" href="../common/login-form/css/demo.css" />
<section>
    <div class="rt-container">
          <div class="col-rt-12">
              <div class="Scriptcontent">
              
              <!-- Stylish Login Page Start -->
                <form class="codehim-form" action="#" method="POST">
                  
        <div class="form-title">
<!-- <div class="form-row">
<div class="form-group col-md-12">
<a href=""></a>

</div>

</div> -->
<a href="../index.php">
        <div class="user-icon gr-bg">
          <!-- <a href=""><img src="../img/favicon.png" alt="" class="bg-info"></a> -->
            <i class="fa fa-arrow-left" title="Go Back"></i> 
            </div>
            </a>
     <h2>Reset Password</h2>
          <?php
          echo $msg;
          ?>
            </div>
        <label for="pass"><i class="fa fa-lock"></i>Update Password:</label>
        <input id="pass" type="password" class="cm-input" name="password" placeholder="Update Password">
        <button type="submit" name="dataUploaderLogin" class="btn-login  gr-bg">Update Password</button>
        <a href="login.php" class="p-3 m-3">Back To Login</a>
    </form>
              <!-- Stylish Login Page End -->
    		
    		</div>
		</div>
    </div>
</section>
     
 
<style>
   .main-footer{
     display: none;
   }
</style>
<?php include "footer.php"; ?>

