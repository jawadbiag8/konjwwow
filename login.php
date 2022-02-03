<?php
include('header.php');
include('navbar.php');
?>

	<div class="main-w3layouts wrapper">
		<h1>Login Form</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="login_act.php" method="post" class="login-form">
                    <input class="text" type="email" name="email" placeholder="Email" required="">
					<input class="text" type="password" name="password" placeholder="Password" required="">
					<input type="submit" name="dataUploaderLogin" value="LOGIN">
				</form>
				<p>Don't have an Account? <a href="signup.php"> Registered Now!</a></p>
				<p class="mt-2">Forget Password? <a href="forget-password.php"> Click Here</a></p>
			</div>
		</div>
		
<?php
include('footer.php');
?>
<?php if( isset ($_SESSION['msg'])) { 
    ?>
    <script>
     $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000
    });
    Toast.fire({
        icon: '<?php echo $_SESSION['msg']['icon']; ?>',
        title: '<?php echo $_SESSION['msg']['description']; ?>', 
      })
      Swal.fire({
        icon: '<?php echo $_SESSION['msg']['icon']; ?>',
        title: '<?php echo $_SESSION['msg']['title']; ?>',
        text: '<?php echo $_SESSION['msg']['description']; ?>',
        footer: '<a>CybMerce B2B Solutions </a>',
  
      });
     });

    </script>
                               
    <?php
    unset ($_SESSION['msg'] ); 
        }   
    ?>