<?php
ob_start();
include "header.php";
$msg='';
if(isset($_POST['dataUploaderLogin'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $pass=md5($password);
    if(!empty($username && $password)){
        $sql="SELECT * from `tbl_admin` Where username='$username' AND password='$pass'";
        $result=$conn->query($sql);
        $rows=mysqli_num_rows($result);
        if($rows >0){
        $res=mysqli_fetch_assoc($result);
            session_start();
            $_SESSION['msg']['icon']="success";
            $_SESSION['msg']['title']="Congratulations";
            $_SESSION['msg']['description']="You Logged in SuccessFully";
            $_SESSION['admin']=$res;
            header('location: index.php');
            exit();
        }else{
        $msg='<h5 class="text-center message-box alert text-danger p-0">Authentication Failed</h5>';
            
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
            <div class="user-icon gr-bg">
            <i class="fa fa-user"></i>
            </div>
     <h2>Login</h2>
          <?php
          echo $msg;
          ?>
            </div>
    <label for="email"><i class="fa fa-envelope"></i> Username:</label>
        <input type="text" id="email" name="username" class="cm-input" placeholder="Email/Username">
        
        <label for="pass"><i class="fa fa-lock"></i> Password:</label>
        <input id="pass" type="password" class="cm-input" name="password" placeholder="Password">
        <button type="submit" name="dataUploaderLogin" class="btn-login  gr-bg">Login</button>
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

