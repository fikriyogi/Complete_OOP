<?php
//forgot.php

include('dbConnect.php');

if(isset($_SESSION['user_id']))
{
	header("location:index.php");
}

$message = '';

if(isset($_POST["forgot"]))
{
	$query = "
	SELECT * FROM register_user 
	WHERE user_email = :user_email
	";
	$statement = $connect->prepare($query);
	$statement->execute(
		array(
			':user_email'	=>	$_POST['user_email']
		)
	);
	$no_of_row = $statement->rowCount();
	$r=$statement->fetch(PDO::FETCH_ASSOC);
	if($no_of_row > 0)
	{
		$message = '<div class="form-group">
							<label>Kirim kode melalui</label>
							<input type="email" name="user_email" class="form-control" value="'.$r['user_email'].'" required />
						</div>
						<div class="form-group">
							<input type="submit" name="forgot" id="forgot" value="Kirim kode" class="btn btn-info" />
						</div>';

	}
	else
	{
		$message = '<div class="form-group">
							<label>Email <b>'.$_POST['user_email'].'</b> tidak ditemukan</label>
							
						</div>';
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>PHP Register Login Script with Email Verification</title>		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<br />
		<div class="container" style="width:100%; max-width:600px">
			<h2 align="center">Cek</h2>
			<br />
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Temukan Akun Anda</h4></div>

				

				<div class="panel-body">
					<form method="post" id="register_form" action="f_recover">
						<?php echo $message; ?>
						
					</form>
					<p align="right"><a href="login.php">Login</a></p>
				</div>
			</div>
		</div>
	</body>
</html>