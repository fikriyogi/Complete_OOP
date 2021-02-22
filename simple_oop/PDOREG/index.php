<?php
//index.php
include('dbConnect.php');

if(!isset($_SESSION["user_id"]))
{
	header("location:login.php");
} else {
	$id = $_SESSION['user_id'];
    
	$statement = $connect->prepare("SELECT * FROM register_user WHERE register_user_id=:uid");
	$statement->execute(array(":uid"=>$id));
	$r=$statement->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>PHP Register Login Script with Email Verification</title>		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		
		<br />
		<br />
		<h1 align="center">PHP Register Login Script with Email Verification</h1>
		
		<h3 align="center">Welcome Verified Email User <?= $r['user_name']?> <?= $r['user_email']?></h3>
		
		<h4 align="center"><a href="logout.php">Logout</a></h4> 
		<a href="u_profile.php">Update Profile</a>
		<a href="u_pass.php">Update Pass</a>
		<a href="profile.php">Profile</a>
	
	</body>
	
</html>

