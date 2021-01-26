
<form id="authenticateform" class="form-horizontal" role="form" method="POST" action="">  					
	<div style="margin-bottom: 25px" class="input-group">
		<label class="text-success">Check your email for OTP</label>
		<input type="text" class="form-control" id="otp" name="otp" placeholder="One Time Password">                       
	</div>                          
	<div style="margin-top:10px" class="form-group">                               
		<div class="col-sm-12 controls">
		  <input type="submit" name="authenticate" value="Submit" class="btn btn-success">						  
		</div>
	</div>                                
</form>

<?php

session_start();
if(! isset($_SESSION['is_login']))
{
  	header('location:login.php');
}

include('class/db.class.php');
$db = new database();
if (isset($_POST['authenticate'])) {
	$otp = $_POST["otp"];
	$email = $_SESSION['email'];
	if($otp!='') {
		$db->otp_verification($email,$otp);
			
	} else if(empty($otp)){
		echo "Enter OTP!";	
	}	
}
?>