<?php
//register.php

include('dbConnect.php');

if (isset($_SESSION['user_id'])) {
    header("location:index.php");
}

$message = '';

if (isset($_POST["register"])) {
    $query = "
	SELECT * FROM register_user 
	WHERE user_email = :user_email
	";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':user_email' => $_POST['user_email']
        )
    );
    $no_of_row = $statement->rowCount();
    if ($no_of_row > 0) {
        $message = '<label class="text-danger">Email Already Exits</label>';
    } else {
        $user_password = rand(100000, 999999);
        $user_encrypted_password = password_hash($user_password, PASSWORD_DEFAULT);
        $user_activation_code = md5(rand());
        $insert_query = "
		INSERT INTO register_user 
		(user_name, user_email, user_password, user_activation_code, user_email_status) 
		VALUES (:user_name, :user_email, :user_password, :user_activation_code, :user_email_status)
		";
        $statement = $connect->prepare($insert_query);
        $statement->execute(
            array(
                ':user_name' => $_POST['user_name'],
                ':user_email' => $_POST['user_email'],
                ':user_password' => $user_encrypted_password,
                ':user_activation_code' => $user_activation_code,
                ':user_email_status' => 'not verified'
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            $base_url = BASE_URL;  //change this baseurl value as per your file path
            $mail_body = "
			<p>Hi " . $_POST['user_name'] . ",</p>
			<p>Thanks for Registration. Your password is " . $user_password . ", This password will work only after your email verification.</p>
			<p>Please Open this link to verified your email address - " . $base_url . "email_verification.php?activation_code=" . $user_activation_code . "
			<p>Best Regards,<br />Webslesson</p>
			";
            require 'class/PHPMailerAutoload.php';
            $mail = new PHPMailer;
            $mail->IsSMTP();                                //Sets Mailer to send message using SMTP
            $mail->Host = MAIL_HOST;        //Sets the SMTP hosts of your Email hosting, this for Godaddy
            $mail->Port = 587;                                //Sets the default SMTP server port
            $mail->SMTPAuth = true;                            //Sets SMTP authentication. Utilizes the Username and Password variables
            $mail->Username = MAIL_USERNAME;                    //Sets SMTP username
            $mail->Password = MAIL_PASS;                    //Sets SMTP password
            $mail->SMTPSecure = 'tls';                            //Sets connection prefix. Options are "", "ssl" or "tls"
            $mail->From = 'info@webslesson.info';            //Sets the From email address for the message
            $mail->FromName = 'Webslesson';                    //Sets the From name of the message
            $mail->AddAddress($_POST['user_email'], $_POST['user_name']);        //Adds a "To" address
            $mail->WordWrap = 50;                            //Sets word wrapping on the body of the message to a given number of characters
            $mail->IsHTML(true);                            //Sets message type to HTML
            $mail->Subject = 'Email Verification';            //Sets the Subject of the message

            // $mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
            //Replace the plain text body with one created manually
            // $mail->AltBody = 'This is a plain-text message body';
            //Attach an image file
            // $mail->addAttachment('images/phpmailer_mini.png');
            //send the message, check for errors

            $mail->Body = $mail_body;                            //An HTML or plain text message body
            if ($mail->Send())                                //Send an Email. Return true on success or false on error
            {
                // $message = '<label class="text-success">Register Done, Please check your mail.</label>';
                $_SESSION['userMail'] = $user_email;
                header("location:otp.php");
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP Register Login Script with Email Verification</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<br/>
<div class="container" style="width:100%; max-width:600px">
    <h2 align="center">PHP Register Login Script with Email Verification</h2>
    <br/>
    <div class="panel panel-default">
        <div class="panel-heading"><h4>Register</h4></div>


        <div class="panel-body">
            <form method="post" id="register_form">
                <?php echo $message; ?>
                <div class="form-group">
                    <label>User Name</label>
                    <input type="text" name="user_name" class="form-control" pattern="[a-zA-Z ]+" required/>
                </div>
                <div class="form-group">
                    <label>User Email</label>
                    <input type="email" name="user_email" class="form-control" required/>
                </div>
                <div class="form-group">
                    <input type="submit" name="register" id="register" value="Register" class="btn btn-info"/>
                </div>
            </form>
            <p align="right"><a href="login.php">Login</a></p>
        </div>
    </div>
</div>
</body>
</html>