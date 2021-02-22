
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
			<h2 align="center">PHP Register Login Script with Email Verification</h2>
			<br />
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Temukan Akun Anda</h4></div>

				

				<div class="panel-body">
					<form method="post" id="register_form" action="f_initiate">
						
						<div class="form-group">
							<label>Ketik email atau nomor telepon Anda untuk mencari akun Anda.</label>
							<input type="email" name="user_email" class="form-control" required />
						</div>
						<div class="form-group">
							<input type="submit" name="forgot" id="forgot" value="Cari" class="btn btn-info" />
						</div>
					</form>
					<p align="right"><a href="login.php">Login</a></p>
				</div>
			</div>
		</div>
	</body>
</html>