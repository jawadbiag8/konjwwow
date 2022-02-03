<?php
ob_start();
include "header.php";
$msg='';
if(isset($_POST['dataUploaderLogin'])){
    $username=$_POST['username'];
   
    if(!empty($username)){
        $sql="SELECT * from `tbl_vendors` Where vend_email='$username' and vend_memberships=1";
        $result=$conn->query($sql);
        $rows=mysqli_num_rows($result);
        if($rows >0){
            
            $token=md5($username."".time());
            $recovery_token=$token."&em_=".$username."&_encryption_=".$token;
                $update_q=$conn->query("UPDATE `tbl_vendors` SET recovery_token='$recovery_token' where vend_email='$username' and vend_memberships=1");
                if($update_q){
                $to = $username;
                $mail_subject = "Reset Your Password | Konjae";
                $mail_message = "
                  <html>
                  <head>
                  <title>Reset Password</title>
                  </head>
                  <body>
                  <h1>Please Click on the bellow link and Reset Your Password</h1>
                  <a href='http://demo.konjae.com/vendor/reset-password.php?encrypt=$recovery_token'>Click Here</a>
                  
                  <p>Optional : if button not work please use this link</p>
                  <p>http://demo.konjae.com/vendor/reset-password.php?encrypt=$recovery_token</p>
                  </body>
                  </html>
                  ";
                //dont forget to include content-type on header if your sending html
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From: info@konjae.com";
                print_r(mail($to,$mail_subject,$mail_message,$headers));

              if(mail($to,$mail_subject,$mail_message,$headers)){
                $_SESSION['msg']['icon']="success";
                $_SESSION['msg']['title']="Successfully";
                $_SESSION['msg']['description']="Please Check Your Email account, recovery Email Sent";
                header('location: login.php');
                exit();
              }else{
                $msg='<h5 class="text-center message-box alert text-danger p-0">Try Again Something Went Wrong</h5>';
              }
            }
            // recovery_token
            
  

           
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
     <h2>Vendor|Reset Password</h2>
          <?php
          echo $msg;
          ?>
            </div>
    <label for="email"><i class="fa fa-envelope"></i> Registered Email:</label>
        <input type="text" id="email" name="username" class="cm-input" placeholder="Enter Email">
        <button type="submit" name="dataUploaderLogin" class="btn-login  gr-bg">Send Email</button>
        <a href="login.php" class="p-3 m-3">Go Back To Login</a>
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

