<?php 
	require_once __DIR__.'/class/user.class.php';
	// include('img.class.php');
	$conn = new users();
	// $ua   = getBrowser();
	// $gambar = new gambar();

	$action = $_GET['action'];
	$section = $_GET['section'];
	
	if($action=="delete")
	{
		$id = $_GET['id'];
		$conn->delete($id);
		header('location:read.php');
	}