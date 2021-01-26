<?php 
	include('class/db.class.php');
	$database = new database();
	if(isset($_POST['forgot']))
	{
		$email = $_POST['email'];
		$key = md5(2418*2);
        $addKey = substr(md5(uniqid(rand(),1)),3,10);
        
        $hashing = $key . $addKey;
		// $password = password_hash($_POST['hash'],PASSWORD_DEFAULT);
		if (empty($email)) {
			echo 'Email harus diisi lengkap';
		} else {
			$database->forgot_password($email,$hashing);
		}
	}
// echo $hashing      	= rand(0,999999);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Login Form</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sign-in/">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/starter-template/">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS ?>style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS ?>bootstrap.min.css">

    <!-- Bootstrap core CSS -->

    <!-- Custom styles for this template -->
  </head>
  <body class="text-center">

	<?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])) { ?>
		<div class="success-message" id="box-pesan"><?php echo $_SESSION['message']; ?></div>
		<?php
		unset($_SESSION['message']);
		}
	?> 
		<!-- Begin page content -->
<main role="main" class="flex-shrink-0">
	<div class="container">
		<h1 class="mt-5">Forgot Password Form</h1>
		<p class="lead">Silahkan Daftarkan Identitas Anda</p>
		<hr/>
		<form method="post" action="">
			<div class="form-group row">
				<label for="email" class="col-sm-2 col-form-label">Email</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="email" name="email" placeholder="Email">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-10">
					Don't have account yet? <a href="register">Sign up</a>
					<button type="submit" class="btn btn-primary" name="forgot">Reset Password</button>
				</div>
			</div>
		</form>
	</div>
</main>

<footer class="footer mt-auto py-3">
	<div class="container">
		<span class="text-muted">Warung Belajar@2019</span>
	</div>
</footer>

<!-- Auto Hide -->
<script type="text/javascript">
    window.setTimeout("document.getElementById('box-pesan').style.display='none';", 3000); 
</script>
</body>
</html>