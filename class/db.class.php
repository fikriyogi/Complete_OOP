<?php
include 'config/constants.php';

date_default_timezone_set(TIMEZONE_ID);
require 'mail.class.php';
require 'general.class.php';
// require 'setting.class.php';
class database{
    var $host = HOST;
    var $username = USERNAME;
    var $password = PASSWORD;
    var $database = DATABASE;
    var $koneksi = "";
    function __construct(){
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password,$this->database);
        if (mysqli_connect_errno()){
            echo "Error database connection : " . mysqli_connect_error();
        }
    }

	function general_settings()
    {
        $settings = mysqli_query($this->koneksi, "SELECT * FROM email_config, settings");
        $row = $settings->fetch_array(MYSQLI_ASSOC);
            $this->aplication_name=$row['title'];
            $this->email=$row['smtp_username'];
            $this->email_pass=$row['smtp_password'];
            $this->attempt_wrong_password = $row['attempt_wrong_password'];
            $this->link = SITE_URL;
        return $settings;
    }
	function user_settings($email)
    {
        $settings = mysqli_query($this->koneksi, "SELECT * FROM users, appearance WHERE users.email='$email' AND appearance.user_id=users.uid");
        $row = $settings->fetch_array(MYSQLI_ASSOC);
            $this->two_fa = $row['is_2fa'];
    }

	function counts($tabel,$row,$hasil)
	{
		$data = mysqli_query($this->koneksi,"SELECT * FROM $tabel WHERE $row='$hasil'");
		$count=mysqli_num_rows($data);
		echo $count;
		return $data;
	}
	function count_by_category($sql) 
	{
		$q = mysqli_query($this->koneksi, $sql);
		$qw=mysqli_num_rows($q);
		echo $qw;
		return $q;
	}

	function tampil_data($sql)
	{
		$data = mysqli_query($this->koneksi, $sql);
		while($row = mysqli_fetch_array($data)){
			$hasil[] = $row;
		}
		return @$hasil;
	}


	public function search($query)
	 {
	  $output = '';
	  $result = $this->execute_query($query);
	  $output .= '
	  <table class="table table-bordered table-striped">
	   <tr>
	    <th width="10%">Image</th>
	    <th width="35%">First Name</th>
	    <th width="35%">Last Name</th>
	    <th width="10%">Update</th>
	    <th width="10%">Delete</th>
	   </tr>
	  ';
	  if(mysqli_num_rows($result) > 0)
	  {
	   while($row = mysqli_fetch_object($result))
	   {
	    $output .= '
	    <tr>
	     <td><img src="upload/'.$row->f_name.'" class="img-thumbnail" width="50" height="35" /></td>
	     <td>'.$row->l_name.'</td>
	     <td>'.$row->nik.'</td>
	     <td><button type="button" name="update" id="'.$row->id.'" class="btn btn-success btn-xs update">Update</button></td>
	     <td><button type="button" name="delete" id="'.$row->id.'" class="btn btn-danger btn-xs delete">Delete</button></td>
	    </tr>
	    ';
	   }
	  }
	  else
	  {
	   $output .= '
	    <tr>
	     <td colspan="5" align="center">No Data Found</td>
	    </tr>
	   ';
	  }
	  $output .= '</table>';
	  return $output;
	 }

	function tambah_data($email,$username,$is_online,$permissions)
	{
		$cek = mysqli_query($this->koneksi, "SELECT * FROM users WHERE email='$email'");
		$row_count = $cek->num_rows;
		if ($row_count == 1) {
			echo "<script type=text/javascript>
              alert('Data sudah ada');
              window.location = 'all-post.php'</script>";
		} else {
			mysqli_query($this->koneksi,"INSERT INTO users (uid,email,username,is_online,permissions) VALUES ('".gen_uid()."','$email','$username','$is_online','$permissions')");
			header('location:all-post.php');
		}
	}

	function get_by_id($table,$id,$category)
	{
		$query = mysqli_query($this->koneksi,"SELECT * FROM $table WHERE $id='$category'");
		return $query->fetch_array();
	}
	function get_detail($sql)
	{
		$query = mysqli_query($this->koneksi, $sql);
		return $query->fetch_array();
	}

	function profile($email)
	{
		$query = mysqli_query($this->koneksi,"SELECT * FROM users WHERE email='$email'");
		return $query->fetch_array();
	}


	function verification($token,$hashing)
	{
		$query = mysqli_query($this->koneksi,"SELECT * FROM users WHERE token='$token' AND hash='$hashing'");
		// If successfully queried
	    if($query) {
	        // Count how many row has this passkey
	        $count=mysqli_num_rows($query);

	        // if found this passkey in our database, retrieve data from table "users"
	        if($count==1) {
	        	$sql3=mysqli_query($this->koneksi, "UPDATE users SET is_active='1', token='' WHERE token = '$token' ");

				echo "<script type=text/javascript>
			  	alert('Your account has been activated');
			  	window.location = 'login.php'</script>";
				return $query->fetch_array();

	        } else {

				echo "<script type=text/javascript>
		              alert('Wrong Confirmation code or code not exist');
		              window.location = 'register.php'</script>";
	        	// $message = "Wrong Confirmation code or code not exist";
	        }

	    }
	}

	

	function update_data($userMail,$userName,$userOnline,$level,$Sid)
	{
		$query = mysqli_query($this->koneksi,"UPDATE post SET title='$userMail',description='$userName',is_active='$userOnline',category='$level' WHERE id='$Sid'");
		echo "<script type=text/javascript>
		              alert('Update Successfully');
		              window.location = 'settings.php?tab=general'</script>";
	}

	function delete_data($Sid)
	{
		$query = mysqli_query($this->koneksi,"DELETE FROM users WHERE uid='$Sid'");
	}
	// End Tabel Sekolah

	// Tabel Pengaturan
	function update_settings($title,$address,$recaptcha,$theme,$email,$pass)
	{
		$query = mysqli_query($this->koneksi,"UPDATE settings SET title='$title',address='$address',is_recaptcha='$recaptcha',theme='$theme'");
        $query = mysqli_query($this->koneksi,"UPDATE email_config SET smtp_username='$email',smtp_password='$pass'");


		echo "<script type=text/javascript>
		              alert('Update Successfully');
		              window.location = 'settings.php?tab=general'</script>";
	}

	// File Upload
	function save_file($folder,$file,$namaFile,$tempat) {
            $upload = "UPDATE settings SET favicon='$namaFile' WHERE idSetting=0";
	    	// unlink("$tempat");
            move_uploaded_file($file,$tempat);
            $simpan = mysqli_query($this->koneksi,$upload);
    }
	// End File Upload

	function update_user_settings($sql)
	{
		$query = mysqli_query($this->koneksi,$sql);
	}
	function change_password($old,$new,$confirm,$email)
	{
		$ua=getBrowser();	
		$qry = mysqli_query($this->koneksi, "SELECT * FROM users WHERE email='$email'");
		$r = $qry->fetch_array();
        $pass = $r['password'];
        if (empty($new) && empty($confirm)) {
				echo "<script type=text/javascript>
		              alert('Please fill form');
		              window.location = 'settings.php?tab=security'</script>";
        } elseif (password_verify($old,$pass)) {
			if (strlen($new) < 5) {
				echo "<script type=text/javascript>
		              alert('password short must 5');
		              window.location = 'settings.php?tab=security'</script>";
			} elseif ($new == $confirm) {
				$password = password_hash($new,PASSWORD_DEFAULT);
				$qry = mysqli_query($this->koneksi, "UPDATE users SET password='$password' WHERE email='$email'");

				echo "<script type=text/javascript>
		              alert('Update Password Success');
		              window.location = 'settings.php?tab=security'</script>";
			} else {
				echo "<script type=text/javascript>
		              alert('Passwords do not match');
		              window.location = 'settings.php?tab=security'</script>";
			}
              // return $cek;
        } else {
			echo "<script type=text/javascript>
	              alert('Your password was incorrect.');
	              window.location = 'settings.php?tab=security'</script>";

        }
	}
	function log($user_id,$log_type,$desc,$devices){
        
		$nowDate = date("Y-m-d H:i:s");
		$ip = $_SERVER['REMOTE_ADDR'];
        $insert = mysqli_query($this->koneksi, "INSERT INTO logs VALUES ('$user_id','$log_type','$desc','$devices','$ip','$nowDate')");
    }

	function register($f_name,$l_name,$email,$username,$gender,$password,$dob,$token,$hashing)
	{
        $this->general_settings();

		$nowDate = date("Y-m-d H:i:s");

		$qry = mysqli_query($this->koneksi, "SELECT * FROM users WHERE email='$email'");
		$cek = $qry->num_rows;
		if ($cek > 0) {
			$_SESSION['message'] = 'Email '.$email.' sudah terdaftar';
              // return $cek;
        } else {
			$senderName = $this->aplication_name;
		    $senderEmail = $this->email;
		    $senderEmailPassword = $this->email_pass;
		    $recieverEmail = $email;
		    $subject = "Register Verification";
		    $body = "
		    Hi ".$f_name.", 
		    <br>
		    Thanks for creating account ".$this->aplication_name."
		    Klik here <a href='".$this->link."verification.php?token=".$token."&hash=".$hashing."'>Active</a>
		    <br>or copy and paste to your browser ".$this->link."verification.php?token=".$token."&hash=".$hashing."";
		    
		    $mailer = new Mail($senderName,$senderEmail,$senderEmailPassword);
		    $mailer->sendMail($recieverEmail,$subject,$body);
			$_SESSION['message'] = 'Code verification was send to '.$email.', check your email and click is_active';
			$_SESSION['email'] = $email;


			$insert = mysqli_query($this->koneksi, "INSERT INTO users VALUES('".gen_uid()."','$email','$username','$password','0','0','0','0','0','0','$token','$hashing','','$nowDate','$nowDate')");
            $qry = mysqli_query($this->koneksi, "INSERT INTO profiles (user_id,f_name,l_name,bod,gender) VALUES('".gen_uid()."','$f_name','$l_name','$dob','$gender')");
            $qry = mysqli_query($this->koneksi, "INSERT INTO appearance (user_id) VALUES('".gen_uid()."')");

			header('location:success-register.php');
			// return $insert;
		}
	}
	function forgot_password($email,$hashing)
	{	
        $this->general_settings();
		$qry = mysqli_query($this->koneksi, "SELECT * FROM users WHERE email='$email'");
		$cek = $qry->num_rows;
		if ($cek > 0) {
			$nowDate = date("Y-m-d H:i:s");
			$insert = mysqli_query($this->koneksi,"INSERT INTO reset_password VALUES ('','$email','$hashing','$nowDate')");
            $senderName = $this->aplication_name;
            $senderEmail = $this->email;
            $senderEmailPassword = $this->email_pass;
		    $recieverEmail = $email;
		    $subject = "Password Reset";
		    $body = "
		    We received a request to reset the password for your account. If you made this request, click the link below to change your password:  ".$email."! 
		    If you didn't make this request, ignore this email or report it to us.
		    Klik here <a href='http://" . $_SERVER["HTTP_HOST"] .dirname($_SERVER["PHP_SELF"]). "/reset.php?email=".$email."&token=".$hashing."'>Reset</a>";
		    
		    $mailer = new Mail($senderName,$senderEmail,$senderEmailPassword);
		    $mailer->sendMail($recieverEmail,$subject,$body);
			echo "<script type=text/javascript>alert('Email terkirim cek email Anda');</script>";

			// return $insert;
            // return $cek;
        } else {

			$_SESSION['message'] = 'Email '.$email.' tidak terdaftar';
			
		}
	}

	function reset_password($email,$password)
	{	
		// $qry = mysqli_query($this->koneksi, "SELECT * FROM users WHERE email='$email'");
		// $cek = $qry->num_rows;
		// if ($cek > 0) {
			$nowDate = date("Y-m-d H:i:s");
			$insert = mysqli_query($this->koneksi,"UPDATE users SET password='$password', logintime='0' WHERE email='$email' ");
            if ($insert) {
            	echo "Berhasil <a href='login.php'>Login</a>";

            	// return $cek;
            // }
	        } else {
				$_SESSION['message'] = 'Email '.$email.' tidak terdaftar';
			}
	}
 
	function login($email,$password,$remember)
	{

        $this->general_settings();
        $this->user_settings($email);

		$query = mysqli_query($this->koneksi,"SELECT * FROM users, appearance WHERE users.email='$email' AND users.uid=appearance.user_id");
		$data_user = $query->fetch_array();
        $cuk = $data_user['logintime'];

		if ($data_user['token']!=='' ) { 
			echo "<script type=text/javascript>
              alert('Akun belum terverifikasi');
              window.location = 'login.php'</script>";
		}
		elseif ($cuk > 2) { // Banyak kesalahan login
			$query = mysqli_query($this->koneksi,"UPDATE users SET is_active = '0' where email='$email'");
			echo "<script type=text/javascript>alert('Alamat email $email Telah Di Blokir, Silahkan Hubungi Administrator');
			window.location = 'account-disable.php'</script>";
		}
		elseif(password_verify($password,$data_user['password']))
		{
			if ($this->two_fa == 1) {
				$nowDate = date("Y-m-d H:i:s");
				$otp = rand(100000, 999999);
				$insert = mysqli_query($this->koneksi,"INSERT INTO authentication VALUES ('$otp','".$data_user['uid']."','0','$nowDate')");
                $query = mysqli_query($this->koneksi,"UPDATE users SET session_id = '".gen_uid()."' where email='$email'");
                $this->log('$data_user[uid]','Login With OTP','User Login',getOS());
				$senderName = $this->aplication_name;
			    $senderEmail = $this->email;
			    $senderEmailPassword = $this->email_pass;
			    $recieverEmail = $email;
			    $subject = "[".$this->aplication_name."] Please verify your device";
			    $body = "Hey ".$data_user['nama']."!
<br>
<br>
A sign in attempt requires further verification because we did not recognize your device. To complete the sign in, enter the verification code on the unrecognized device.
<br>
<br>
Device: ".getOS()."
<br>
Verification code: ".$otp."
<br>
<br>

If you did not attempt to sign in to your account, your password may be compromised. Visit https://github.com/settings/security to create a new, strong password for your GitHub account.
<br>
<br>
If you'd like to automatically verify devices in the future, consider enabling two-factor authentication on your account. Visit https://docs.github.com/articles/configuring-two-factor-authentication to learn about two-factor authentication.
<br>
<br>
If you decide to enable two-factor authentication, ensure you retain access to one or more account recovery methods. See https://docs.github.com/articles/configuring-two-factor-authentication-recovery-methods in the GitHub Help.
<br>
<br>
Thanks,
The GitHub";
			    
			    $mailer = new Mail($senderName,$senderEmail,$senderEmailPassword);
			    $mailer->sendMail($recieverEmail,$subject,$body);
				$_SESSION['message'] = 'Code verification was send to '.$email.', check your email and click is_active';


				$_SESSION['token'] = $data_user['hash'];
				$_SESSION['email'] = $email;
				$_SESSION['id'] = $data_user['uid'];
				$_SESSION['session'] = $data_user['session_id'];
				$_SESSION['is_login'] = TRUE;
				header('location:otp-verify.php');
				return $insert;
			} elseif($this->two_fa == 0) {
				$sesi = md5(unixtojd(rand()));
				$query = mysqli_query($this->koneksi,"UPDATE users SET is_online='1' WHERE email='$email'");
                $query = mysqli_query($this->koneksi,"UPDATE users SET session_id = '$sesi' where email='$email'");
				$this->log('$data_user[uid]','Login Without OTP','User Login',getOS());
				if($remember)
				{
					setcookie('email', $email, time() + (60 * 60 * 24 * 5), '/');
					setcookie('nama', $data_user['nama'], time() + (60 * 60 * 24 * 5), '/');
				}

				$_SESSION['token'] = $data_user['hash'];
				$_SESSION['email'] = $email;
				$_SESSION['id'] = $data_user['uid'];
				$_SESSION["login_time"] = time();  
				$_SESSION['login_with_otp'] = 0;
                $_SESSION['session_code'] = $sesi;
				$_SESSION['is_login'] = TRUE;
				header('location:home.php');
				return TRUE;
			}
		} else {
			echo 'Password salah';
            $query = mysqli_query($this->koneksi,"UPDATE users SET logintime = logintime + 1 WHERE email='$email'");
		}
	}

	function otp_verification($email,$otp)
	{
        $this->general_settings();
		$query1 = mysqli_query($this->koneksi,"SELECT * FROM users, appearance WHERE users.email='$email' AND users.uid=appearance.user_id");
		$data_user = $query1->fetch_array();
		$query = mysqli_query($this->koneksi, "SELECT * FROM authentication WHERE otp='$otp' AND user_id='$data_user[uid]' AND expired!=1 AND NOW() <= DATE_ADD(create_at, INTERVAL 1 HOUR)");
		$count = mysqli_num_rows($query);
		if($count) {
			$qry = mysqli_query($this->koneksi,"UPDATE authentication SET expired = 1 WHERE otp = '$otp'");
			// Jika otp diterima maka masuk ke sistem
			$token = md5(unixtojd(rand()));
			$query = mysqli_query($this->koneksi,"UPDATE users SET is_online='1', token='$token' WHERE email='$email'");

			$_SESSION['token'] = $data_user['hash'];
			$_SESSION['email'] = $email;
			$_SESSION['nama'] = $data_user['username'];
			$_SESSION['login_with_otp'] = 1; // OTP must same with users setting
			$_SESSION["login_time"] = time();  
			$_SESSION['is_login'] = TRUE;
			header("Location:home.php");
			return TRUE;
		} else {
			echo "Invalid OTP or OTP expired!";
		}
	}
 
	function relogin($email)
	{
		$query = mysqli_query($this->koneksi,"SELECT * FROM users where email='$email'");
		$data_user = $query->fetch_array();
		$_SESSION['email'] = $email;
		$_SESSION['username'] = $data_user['username'];
		$_SESSION['is_login'] = TRUE;
	}
	function logout($email)
	{
		$query = mysqli_query($this->koneksi,"UPDATE users SET is_online='0', token='' WHERE email='$email'");
		return $query;
	}
	// End Login Script
}




?>