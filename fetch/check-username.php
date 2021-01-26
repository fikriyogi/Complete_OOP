<?php  
	//check.php  
	$connect = mysqli_connect("localhost", "root", "", "fb_clone"); 
	if(!empty($_POST["email"])) {
		$result = mysqli_query($connect,"SELECT count(*) FROM users WHERE email='" . $_POST["email"] . "'");
		$row = mysqli_fetch_row($result);
		$email_count = $row[0];
		if($email_count>0) echo "<span style='color:red'> Email Already Exist .</span>";
		else echo "<span style='color:green'> Email Available.</span>";
	}
	// End code check email
	//Code check user name
	if(!empty($_POST["username"])) {
		$result1 = mysqli_query($connect,"SELECT count(*) FROM users WHERE username='" . $_POST["username"] . "'");
		$row1 = mysqli_fetch_row($result1);
		$user_count = $row1[0];
		if($user_count>0) echo "<span style='color:red'> Username Already Exist .</span>";
		else echo "<span style='color:green'> Username Available.</span>";
	}
	// End code check username
?>