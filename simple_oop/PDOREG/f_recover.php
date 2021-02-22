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
	if($no_of_row > 0)
	{
		$user_password = rand(100000,999999);
		$user_encrypted_password = password_hash($user_password, PASSWORD_DEFAULT);
		$user_activation_code = md5(rand());
		$insert_query = "
		UPDATE register_user SET user_password=:user_password WHERE user_email=:user_email
		";
		$statement = $connect->prepare($insert_query);
		$statement->execute(
			array(
				':user_email'			=>	$_POST['user_email'],
				':user_password'		=>	$user_encrypted_password,
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			$base_url = BASE_URL;  //change this baseurl value as per your file path
			// $mail_body = "
			// <p>Hi ".$_POST['user_name'].",</p>
			// <p>You are reset password and Your password is ".$user_password.", This password will work only after your email verification.</p>
			// <p>Please Open this link to verified your email address - ".$base_url."
			// <p>Best Regards,<br />Webslesson</p>
			// ";
			$mail_body = '<table border="0" cellspacing="0" cellpadding="0" align="center" id="m_-8613839138522340347email_table" style="border-collapse:collapse"><tbody><tr><td id="m_-8613839138522340347email_content" style="font-family:Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;background:#ffffff"><table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse"><tbody><tr><td height="20" style="line-height:20px" colspan="3">&nbsp;</td></tr><tr><td height="1" colspan="3" style="line-height:1px"><span style="color:#ffffff;font-size:1px">We received a request to reset your Facebook password.</span></td></tr><tr><td width="15" style="display:block;width:15px">&nbsp;&nbsp;&nbsp;</td><td><table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse"><tbody><tr><td height="15" style="line-height:15px">&nbsp;</td></tr><tr><td width="32" align="left" valign="middle" style="height:32px;line-height:0px"><img src="https://ci5.googleusercontent.com/proxy/8JL2ule9KrMjX9BHPfLqB144hhEQJl3Rvv_azXGi9foEKkmnur2qeVLoL1IUhEm01tewd5Zx-FTm7JcJmb6ypFQYd_CtGN200i-qpKpuzw=s0-d-e1-ft#https://static.xx.fbcdn.net/rsrc.php/v3/yW/r/7s5lklTGUda.png" width="118" height="24" alt="Facebook" style="border:0;font-size:19px;font-family:Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;color:#1877f2" class="CToWUd"></td></tr><tr style="border-bottom:solid 1px #e5e5e5"><td height="15" style="line-height:15px">&nbsp;</td></tr></tbody></table></td><td width="15" style="display:block;width:15px">&nbsp;&nbsp;&nbsp;</td></tr><tr><td width="15" style="display:block;width:15px">&nbsp;&nbsp;&nbsp;</td><td><table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse"><tbody><tr><td height="4" style="line-height:4px">&nbsp;</td></tr><tr><td><span class="m_-8613839138522340347mb_text" style="font-family:Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;font-size:16px;line-height:21px;color:#141823"><span style="font-size:15px"><p></p><div style="margin-top:16px;margin-bottom:20px">Hi '.$_POST[user_name].',</div><div>We received a request to reset your Facebook password.</div>Enter the following password reset code:<p></p><table border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse;width:max-content;margin-top:20px;margin-bottom:20px"><tbody><tr><td style="font-size:11px;font-family:LucidaGrande,tahoma,verdana,arial,sans-serif;padding:14px 32px 14px 32px;background-color:#f2f2f2;border-left:1px solid #ccc;border-right:1px solid #ccc;border-top:1px solid #ccc;border-bottom:1px solid #ccc;text-align:center;border-radius:7px;display:block;border:1px solid #1877f2;background:#e7f3ff"><span class="m_-8613839138522340347mb_text" style="font-family:Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;font-size:16px;line-height:21px;color:#141823"><span style="font-size:17px;font-family:Roboto;font-weight:700;margin-left:0px;margin-right:0px"> '.$user_password.' </span></span></td></tr></tbody></table>Alternatively, you can directly change your password.<table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse"><tbody><tr><td height="20" style="line-height:20px">&nbsp;</td></tr><tr><td align="middle"><a href="https://web.facebook.com/recover/code/?u=100039561228202&amp;n=557324&amp;s=23&amp;exp_locale=id_ID&amp;redirect_from=button" style="color:#3b5998;text-decoration:none" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://web.facebook.com/recover/code/?u%3D100039561228202%26n%3D557324%26s%3D23%26exp_locale%3Did_ID%26redirect_from%3Dbutton&amp;source=gmail&amp;ust=1613539713131000&amp;usg=AFQjCNEHtjap4673vGyhXlJlBHyY7OWihw"><table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse"><tbody><tr><td style="border-collapse:collapse;border-radius:6px;text-align:center;display:block;border:none;background:#1877f2;padding:6px 20px 10px 20px"><a href="https://web.facebook.com/recover/code/?u=100039561228202&amp;n=557324&amp;s=23&amp;exp_locale=id_ID&amp;redirect_from=button" style="color:#3b5998;text-decoration:none;display:block" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://web.facebook.com/recover/code/?u%3D100039561228202%26n%3D557324%26s%3D23%26exp_locale%3Did_ID%26redirect_from%3Dbutton&amp;source=gmail&amp;ust=1613539713131000&amp;usg=AFQjCNEHtjap4673vGyhXlJlBHyY7OWihw"><center><font size="3"><span style="font-family:Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;white-space:nowrap;font-weight:bold;vertical-align:middle;color:#ffffff;font-weight:500;font-family:Roboto-Medium,Roboto,-apple-system,BlinkMacSystemFont,Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;font-size:17px">Change&nbsp;Password</span></font></center></a></td></tr></tbody></table></a></td></tr><tr><td height="8" style="line-height:8px">&nbsp;</td></tr><tr><td height="20" style="line-height:20px">&nbsp;</td></tr></tbody></table><br><div><span style="color:#333333;font-weight:bold">Didnt request this change?</span></div>If you didnt request a new password, <a href="https://web.facebook.com/login/recover/cancel/?n=557324&amp;id=100039561228202&amp;i=www" style="color:#0a7cff;text-decoration:none" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://web.facebook.com/login/recover/cancel/?n%3D557324%26id%3D100039561228202%26i%3Dwww&amp;source=gmail&amp;ust=1613539713131000&amp;usg=AFQjCNGAjsQ5cH374QOnu8Bs-O8A3w7IZw">let us know</a>.</span></span></td></tr><tr><td height="50" style="line-height:50px">&nbsp;</td></tr></tbody></table></td><td width="15" style="display:block;width:15px">&nbsp;&nbsp;&nbsp;</td></tr><tr><td width="15" style="display:block;width:15px">&nbsp;&nbsp;&nbsp;</td><td><table border="0" width="100%" cellspacing="0" cellpadding="0" align="left" style="border-collapse:collapse"><tbody><tr style="border-top:solid 1px #e5e5e5"><td height="19" style="line-height:19px">&nbsp;</td></tr><tr><td style="font-family:Roboto-Regular,Roboto,-apple-system,BlinkMacSystemFont,Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;font-size:12px;color:#8a8d91;line-height:16px;font-weight:400">This message was sent to <a href="mailto:fikriyogi85@gmail.com" style="color:#216fdb;text-decoration:none" target="_blank">fikriyogi85@gmail.com</a> at your request.<br>Facebook, Inc., Attention: Community Support, 1 Facebook Way, Menlo Park, CA 94025</td></tr></tbody></table></td><td width="15" style="display:block;width:15px">&nbsp;&nbsp;&nbsp;</td></tr><tr><td height="20" style="line-height:20px" colspan="3">&nbsp;</td></tr></tbody></table><span><img src="https://ci5.googleusercontent.com/proxy/xPYw676kbiyEOkLCwZUwVTZCk6zq7H1XpEos3xjBz7W98yt_jR2ZXZj3x-WlFaXHxts-whFrhPxWmzZKY4hyQ_ZVegkcAIzuOdMPEY-WAY32HM81_mNc7ZYiXzrgx3EilGY0xOMoaAkv1GEYCm8lqsOliA=s0-d-e1-ft#https://www.facebook.com/email_open_log_pic.php?mid=5bb6aabbe99b2G5afc4682afaaG5bb6af5549c84G178" style="border:0;width:1px;height:1px" class="CToWUd"></span></td></tr></tbody></table>';
			require 'class/PHPMailerAutoload.php';
			$mail = new PHPMailer;
			$mail->IsSMTP();								//Sets Mailer to send message using SMTP
			$mail->Host = MAIL_HOST;		//Sets the SMTP hosts of your Email hosting, this for Godaddy
			$mail->Port = 587;								//Sets the default SMTP server port
			$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
			$mail->Username = MAIL_USERNAME;					//Sets SMTP username
			$mail->Password = MAIL_PASS;					//Sets SMTP password
			$mail->SMTPSecure = 'tls';							//Sets connection prefix. Options are "", "ssl" or "tls"
			$mail->From = 'info@webslesson.info';			//Sets the From email address for the message
			$mail->FromName = 'Webslesson';					//Sets the From name of the message
			$mail->AddAddress($_POST['user_email'], $_POST['user_name']);		//Adds a "To" address			
			$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
			$mail->IsHTML(true);							//Sets message type to HTML				
			$mail->Subject = 'Email Verification';			//Sets the Subject of the message

			// $mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
			//Replace the plain text body with one created manually
			// $mail->AltBody = 'This is a plain-text message body';
			//Attach an image file
			// $mail->addAttachment('images/phpmailer_mini.png');
			//send the message, check for errors

			$mail->Body = $mail_body;							//An HTML or plain text message body
			if($mail->Send())								//Send an Email. Return true on success or false on error
			{
				// $message = '<label class="text-success">Register Done, Please check your mail.</label>';
				$_SESSION['userMail'] = $user_email;
				header("location:login.php");
			}
		}
	}
	else
	{
		$message = '<label class="text-danger">Email Not Exits</label>';
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
			<h2 align="center">PHP Register Login Script with Email Verification</h2>
			<br />
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Temukan Akun Anda</h4></div>

				

				<div class="panel-body">
					<form method="post" id="register_form" action="forgot">
						<?php echo $message; ?>
						<div class="form-group">
							<label>Ketik email atau nomor telepon Anda untuk mencari akun Anda.</label>
							<input type="email" name="user_email" class="form-control" required />
						</div>
						<div class="form-group">
							<input type="submit" name="forgot" id="forgot" value="Register" class="btn btn-info" />
						</div>
					</form>
					<p align="right"><a href="login.php">Login</a></p>
				</div>
			</div>
		</div>
	</body>
</html>