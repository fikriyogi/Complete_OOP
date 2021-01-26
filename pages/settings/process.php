<?php 
	include('../../class/setting.class.php');
	// include('img.class.php');
	$koneksi = new pengaturan();
	$ua      = getBrowser();
	// $gambar = new gambar();

	$action = $_GET['action'];
	$section = $_GET['section'];
	if($action=="update-setting")
	{
		$namafile=$_FILES['favicon']['name'];
	    $pindah = $_FILES['favicon']['tmp_name'];
	    $folder="upload/";
	    $lokbaru=$folder.$namafile;
	    $gagal=$_FILES['favicon']['error'];
		$koneksi->save_file($folder,$pindah,$namafile,$lokbaru);
		$koneksi->update_settings($_POST['title'],$_POST['address'],$_POST['enable_recaptcha'],$_POST['enable_otp'],$_POST['mailserver_login'],$_POST['mailserver_pass'],$_POST['idSetting']);
	}
	elseif($action=="security-setting")
	{
		$koneksi->update_user_settings('appearance','is_2fa',$_POST['is_2fa'],$_POST['user_id']);
		echo "<script type=text/javascript>
		              alert('Update successfully');
		              window.location = 'settings.php?tab=security'</script>";	
	}
	elseif($action=="users-setting")
	{
		if ($section=="nama") {
			$qry = "UPDATE users SET nama='".$_POST['nama']."' WHERE id='".$_POST['user_id']."'";
			$koneksi->update_user_settings($qry);	
			echo "<script type=text/javascript>
		              alert('Update username');
		              window.location = 'settings.php?tab=account'</script>";
		} elseif ($section=="username") {
			$qry = "UPDATE users SET username='".$_POST['username']."' WHERE id='".$_POST['user_id']."'";
			$koneksi->update_user_settings($qry);	
			echo "<script type=text/javascript>
		              alert('Update username');
		              window.location = 'settings.php?tab=account'</script>";
		}
	}
	elseif($action=="mobile-setting")
	{
		$koneksi->update_user_settings('phone',$_POST['phone'],$_POST['user_id']);	
		echo "<script type=text/javascript>
		              alert('Update successfully');
		              window.location = 'settings.php?tab=mobile'</script>";	
	}
	elseif($action=="change-password")
	{
		$koneksi->change_password($_POST['password_old'],$_POST['password_new'],$_POST['password_confirm'],$_POST['email']);
    	$database->log($email,'Login',$updateName,$userManufactur,$userTimezone,$ua['userAgent'],$ua['name'],$ua['version'],getOS(),$userIp,$userResolution,$userMac,$userDeviceName,$userPage,$userSystemModel,$userSystemInfo);
	}
	
?>