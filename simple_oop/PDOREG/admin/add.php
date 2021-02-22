<?php
//index.php
include('../dbConnect.php');

if(!isset($_SESSION["user_id"]))
{
    header("location:../login.php");
} else {
    $id = $_SESSION['user_id'];
    
    $statement = $connect->prepare("SELECT * FROM register_user WHERE register_user_id=:uid");
    $statement->execute(array(":uid"=>$id));
    $r=$statement->fetch(PDO::FETCH_ASSOC);
}

?>
<?php

require_once "../dbConnect.php";

if (isset($_REQUEST['btn_insert'])) {
    try {
        $name = $_REQUEST['txt_name']; //textbox name "txt_name"
        $description = $_REQUEST['description']; //textbox name "txt_name"
        $update_at = date(DATE_FORMAT); //textbox name "txt_name"
        $url = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($name)));

        $image_file = $_FILES["txt_file"]["name"];
        $type = $_FILES["txt_file"]["type"]; //file name "txt_file"
        $size = $_FILES["txt_file"]["size"];
        $temp = $_FILES["txt_file"]["tmp_name"];

        $path = "upload/" . $image_file; //set upload folder path

        if (empty($name)) {
            $errorMsg = "Please Enter Name";
        } else if (empty($image_file)) {
            $errorMsg = "Please Select Image";
        } else if ($type == "image/jpg" || $type == 'image/jpeg' || $type == 'image/png' || $type == 'image/gif') //check file extension
        {
            if (!file_exists($path)) //check file not exist in your upload folder path
            {
                if ($size < IMG_MAX_SIZE) //check file size 5MB
                {
                    move_uploaded_file($temp, "upload/" . $image_file); //move upload file temperory directory to your upload folder
                } else {
                    $errorMsg = "Your File To large Please Upload 5MB Size"; //error message file size not large than 5MB
                }
            } else {
                $errorMsg = "File Already Exists...Check Upload Folder"; //error message file not exists your upload folder path
            }
        } else {
            $errorMsg = "Upload JPG , JPEG , PNG & GIF File Formate.....CHECK FILE EXTENSION"; //error message file extension
        }

        if (!isset($errorMsg)) {
            $insert_stmt = $connect->prepare('INSERT INTO tbl_file(name,url,description,update_at,user_id,image) VALUES(:fname,:url,:description,:update_at,:user_id,:fimage)'); //sql insert query
            $insert_stmt->bindParam(':fname', $name);
            $insert_stmt->bindParam(':url', $url);
            $insert_stmt->bindParam(':description', $description);
            $insert_stmt->bindParam(':update_at', $update_at);
            $insert_stmt->bindParam(':user_id', $_SESSION['user_id']);
            $insert_stmt->bindParam(':fimage', $image_file);   //bind all parameter

            if ($insert_stmt->execute()) {
                $insertMsg = "File Upload Successfully........"; //execute query success message
                header("refresh:3;index.php"); //refresh 3 second and redirect to index.php page
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Add</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.0.5/tinymce.min.js"></script>
</head>
<body>
    <?php echo @$errorMsg; ?>
    <form method="post" class="form-horizontal" enctype="multipart/form-data">

        <div class="form-group">
            <label class="col-sm-3 control-label">Name</label>
            <div class="col-sm-6">
                <input type="text" name="txt_name" class="form-control" placeholder="enter name"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Editor</label>
            <div class="col-sm-6">
                <textarea name="description" id="editor"></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">File</label>
            <div class="col-sm-6">
                <input type="file" name="txt_file" class="form-control"/>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9 m-t-15">
                <input type="submit" name="btn_insert" class="btn btn-success " value="Insert">
                <a href="index.php" class="btn btn-danger">Cancel</a>
            </div>
        </div>

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
</body>
</html>
