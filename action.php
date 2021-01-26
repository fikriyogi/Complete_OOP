<?php 
	include('class/db.class.php');
	// include('img.class.php');
	$koneksi = new database();
	$ua       = getBrowser();
	// $gambar = new gambar();

	$action = $_GET['action'];
	$section = $_GET['section'];
	
	if($action == "add")
	{
		$koneksi->tambah_data($_POST['email'],$_POST['username'],$_POST['is_online'],$_POST['permissions']);
		// header('location:tampil_data.php');
		
	}
	elseif($action=="update") // User update profile
	{
		$koneksi->update_data($_POST['title'],$_POST['description'],$_POST['is_active'],$_POST['category'],$_POST['id']);
		header('location:all-post.php');
	}
	elseif($action=="delete")
	{
		$Sid = $_GET['id'];
		$koneksi->delete_data($Sid);
		header('location:all-post.php');
	}
	elseif($action=="update-setting")
	{
//		$namafile=$_FILES['favicon']['name'];
//	    $pindah = $_FILES['favicon']['tmp_name'];
//	    $folder="upload/";
//	    $lokbaru=$folder.$namafile;
//	    $gagal=$_FILES['favicon']['error'];

//		$koneksi->save_file($folder,$pindah,$namafile,$lokbaru);
		$koneksi->update_settings($_POST['title'],$_POST['address'],$_POST['is_recaptcha'],$_POST['theme'],$_POST['smtp_username'],$_POST['smtp_password']);

	}
	elseif($action=="users-setting")
	{
	    if ($section=="2fa")
        {
            $sql = "UPDATE appearance SET is_2fa='".$_POST['is_2fa']."' WHERE user_id='".$_POST['user_id']."'";
            $koneksi->update_user_settings($sql);
            echo "<script type=text/javascript>
		              alert('Update successfully');
		              window.location = 'settings.php?tab=account'</script>";
        }
	    elseif ($section=="mobile")
        {
            $sql = "UPDATE contacts SET phone='".$_POST['phone']."' WHERE user_id='".$_POST['user_id']."'";
            $koneksi->update_user_settings($sql);
            echo "<script type=text/javascript>
		              alert('Update mobile successfully');
		              window.location = 'settings.php?tab=mobile'</script>";
        }
//	    elseif ($section=="change-password")
//        {
//            $sql = "UPDATE appearance SET phone='".$_POST['phone']."' WHERE user_id='".$_POST['user_id']."'";
//            $koneksi->update_user_settings($sql);
//            echo "<script type=text/javascript>
//		              alert('Update mobile successfully');
//		              window.location = 'settings.php?tab=mobile'</script>";
//        }

	}
	elseif($action=="change-password")
	{
		$koneksi->change_password($_POST['password_old'],$_POST['password_new'],$_POST['password_confirm'],$_POST['email']);
	}
	
?>