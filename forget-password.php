<?php
include('header.php');
include('navbar.php');
?>

	<div class="main-w3layouts wrapper">
		<h1>Forget Password</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="#" method="post" class="login-form">
                    <input class="email" type="email" name="email" placeholder="Email" required="">
					<input type="submit" name="dataUploaderLogin" value="LOGIN">
				</form>
				<p>Login? <a href="login.php">Click Here!</a></p>
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