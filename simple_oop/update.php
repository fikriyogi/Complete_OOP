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
    $row = $b->GetById('post','id',$id);
} else {
    header('location:playstoreclone.php');
}

?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.0.5/tinymce.min.js"></script>
<form>

	<input type="text" name="title" value="<?php echo $row['title']; ?>"> 
	<textarea name="editor" id="editor"><?php echo $row['description'];?></textarea>
		
</form>
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
        height: 600
    });
</script>