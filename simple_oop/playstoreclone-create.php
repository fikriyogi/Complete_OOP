<?php 
	require_once __DIR__.'/class/user.class.php';
	// include('img.class.php');
	$conn = new users;
    $conn = mysqli_connect('localhost','root','','blog');
    if(isset($_POST['upload'])) {
		$title = $_POST['title'];
		$desc = $_REQUEST['editor'];
        $perm = $_REQUEST['permissions'];
		$appid = $_POST['app_id'];
		$url = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($title)));

		$conn->AddUser($_POST['title'],$_POST['description'],$_POST['app_id'],$_POST['permissions']);
        // mysqli_query($conn,"INSERT INTO app_post (title,url,description,app_id,permissions) VALUES ('$title','$url','$desc','$appid','$perm')");
		# code...
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>add</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.0.5/tinymce.min.js"></script>
</head>
<body>
	<form method="post" action="playstoreclone-create.php">
		<table style="border-collapse: collapse; width: 100%;" border="0">
			<tbody>
				<tr>
					<td>Title</td>
					<td>:</td>
					<td><input type="text" name="title"></td>
				</tr>
				<tr>
					<td>Description</td>
					<td>:</td>
					<td><textarea name="editor" id="editor"></textarea></td>
				</tr>
				<tr>
					<td>Apps Id</td>
					<td>:</td>
					<td><input type="text" name="app_id"></td>
				</tr>
				<tr>
					<td>Category</td>
					<td>:</td>
					<td><input type="text" name="category"></td>
				</tr>
				<tr>
					<td>Icon</td>
					<td>:</td>
					<td><input type="text" name="icon"></td>
				</tr>
				<tr>
					<td>License</td>
					<td>:</td>
					<td><input type="text" name="license"></td>
				</tr>
				<tr>
					<td>OS</td>
					<td>:</td>
					<td><input type="text" name="os"></td>
				</tr>
				<tr>
					<td>Developer</td>
					<td>:</td>
					<td><input type="text" name="developer"></td>
				</tr>
				<tr>
					<td>version</td>
					<td>:</td>
					<td><input type="text" name="version"></td>
				</tr>
				<tr>
					<td>ss</td>
					<td>:</td>
					<td><input type="text" name="ss"></td>
				</tr>
				<tr>
					<td>size</td>
					<td>:</td>
					<td><input type="text" name="size"></td>
				</tr>
				<tr>
					<td>new</td>
					<td>:</td>
					<td><input type="text" name="new"></td>
				</tr>
				<tr>
					<td>updated</td>
					<td>:</td>
					<td><input type="text" name="updated"></td>
				</tr>
				<tr>
					<td>permissions</td>
					<td>:</td>
					<td><input type="text" name="permissions"></td>
				</tr>
				<tr>
					<td colspan="3"><button type="submit" name="upload">Upload</button></td>
				</tr>
			</tbody>
		</table>
<!--		<script>-->
<!--		        tinymce.init({-->
<!--		  selector: "textarea",-->
<!--		  plugins: "lists advlist autolink autoresize charmap code emoticons hr image insertdatetime link media paste preview searchreplace table textpattern toc visualblocks visualchars wordcount quickbars",-->
<!--		  toolbar: "code preview | undo redo | formatselect | fontselect | fontsizeselect | bold italic underline strikethrough backcolor | subscript superscript | numlist bullist | alignleft aligncenter alignright alignjustify | outdent indent | paste searchreplace | toc link image media charmap insertdatetime emoticons hr | table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol | removeformat",-->
<!--		  insertdatetime_element: true,-->
<!--			   media_scripts: [-->
<!--			   {filter: 'platform.twitter.com'},-->
<!--			   {filter: 's.imgur.com'},-->
<!--			   {filter: 'instagram.com'},-->
<!--			   {filter: 'https://platform.twitter.com/widgets.js'},-->
<!--			 ],-->
<!--			   browser_spellcheck: true,-->
<!--			   contextmenu: false,-->
<!--			});-->
<!---->
<!--		  </script>-->
        <script>
            tinymce.init({
                selector: "textarea",
                plugins: [
                    "code ",
                    "paste"
                ],
                toolbar: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link code ",
                menubar:false,
                statusbar: false,
                content_style: ".mce-content-body {font-size:15px;font-family:Arial,sans-serif;}",
                height: 200
            });
        </script>
</body>
</html>