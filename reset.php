<?php
	error_reporting(0);
	include('class/db.class.php');
	$database = new database();

	if (isset($_GET["key"]) && isset($_GET["email"])){
		$key = $_GET["key"];
		$email = $_GET["email"];
		$curDate = date("Y-m-d H:i:s");
		$query = mysqli_query($this->koneksi, "SELECT * FROM `reset_password` WHERE `code`='".$key."' and `email`='".$email."';");
		$row = mysqli_num_rows($query);

		
	}

	if(isset($_POST['reset']))
	{
		$email = $_POST['email'];

		$password = password_hash($_POST['pass1'],PASSWORD_DEFAULT);
		// $password = "kjhjkhjk";
		if (empty($email)) {
			$message =  "Email harus diisi lengkap";
		} elseif ($_POST['pass1'] !== $_POST['pass2']) {
			$message =  "Password tidak sama";
		} else {
			$database->reset_password($email,$password);
			// if($database->register($email,$username,$password,$nama,$token,$hashing))
			// {
			//   header('location:login.php');
			// }
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Reset Password</title>
</head>
<body>
	<?=  $message ?>
	<form method="post" action="" >
	<label><strong>Enter New Password:</strong></label><br />
	<input type="password" name="pass1" maxlength="15" required />
	<br /><br />
	<label><strong>Re-Enter New Password:</strong></label><br />
	<input type="password" name="pass2" maxlength="15" required/>
	<br /><br />
	<input type="hidden" name="email" value="<?php echo $_GET['email'];?>"/>
	<input type="submit" name="reset" value="Reset Password" />
	</form>

</body>
</html>