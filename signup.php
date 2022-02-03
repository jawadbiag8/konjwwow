<?php
include('header.php');
include('navbar.php');
?>

	<div class="main-w3layouts wrapper">
		<h1>SignUp Form</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="action.php" method="post" class="login-form">
                    <input class="text" type="text" name="name" placeholder="Name" required>
					<input class="text email" type="email" name="email" placeholder="Email" required>
					<input class="text" type="password" name="password" placeholder="Password" required>
					<input class="text w3lpass" type="password" name="password" placeholder="Confirm Password" required>
					<input  type="text" name="business" placeholder="Business Name if any ">
                    <input class="text" type="text" name="address" placeholder="Address" required>
                    <input class="text" type="text" name="number" placeholder="Mobile Number" required>
					<!-- <div class="wthree-text">
						<label class="anim">
							<input type="checkbox" class="checkbox" required>
							<span>I Agree To The Terms & Conditions</span>
						</label>
						<div class="clear"> </div>
					</div> -->
					<input type="submit" name="add_merchant" value="SIGNUP">
				</form>
				<p>Already have an Account? <a href="login.php"> Login Now!</a></p>
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