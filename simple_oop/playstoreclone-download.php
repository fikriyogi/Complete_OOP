<?php
//include('class/db.class.php');
// include "header.php";
// include 'config/function.php';
// session_start();
// if (!isset($_SESSION['is_login'])) {
//     header('location:login.php');
// }

require_once __DIR__.'/class/user.class.php';
// include 'autoload.php';

$b = new users; // panggil class

$id = $_GET['id'];
if (!is_null($id)) {
    $row = $b->GetById('app_post','id',$id);
} else {
    header('location:playstoreclone.php');
}

?>
<html>
<head>
<title><?php echo $row['title']; ?></title>
<script type="text/javascript">
	var counter = 10;
	function countDown()
	{
		if(counter>=0)
		{
			document.getElementById("timer").innerHTML = counter;
		}
		else
		{
			download();
			return;
		}
		counter -= 1;

		var counter2 = setTimeout("countDown()",1000);
		return;
	}
	function download()
	{
		document.getElementById("link").innerHTML = "<a href='<?php echo $row['file']; ?>' target=\"_blank\">-LINK DOWNLOAD-'>Download</a>";
	}
</script>
</head>

<body onload="countDown();">
<div style="text-align: center;">
<h1>Download PHP Script Z-War Online</h1><br />
Size : 9 Mb <br />
By : Henlatoz
<h3>Dapat download dalam <span id="timer"></span> detik.</h3>
</div>

<div style="text-align: center;"><h1><span id="link"></span></h1></div>

</body>
</html>