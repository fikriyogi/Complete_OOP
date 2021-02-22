<?php

require_once "connection.php";

if (isset($_REQUEST['update_id'])) {
    try {
        $id = $_REQUEST['update_id']; //get "update_id" from index.php page through anchor tag operation and store in "$id" variable
        $select_stmt = $db->prepare('SELECT * FROM tbl_file WHERE id =:id'); //sql select query
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
    } catch (PDOException $e) {
        $e->getMessage();
    }

}

if (isset($_REQUEST['btn_update'])) {
    try {
        $name = $_REQUEST['txt_name']; //textbox name "txt_name"
        // $url = $_REQUEST['txt_url']; //textbox name "txt_name"
        $description = $_REQUEST['description']; //textbox name "txt_name"
        $url = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($name)));


        $image_file = $_FILES["txt_file"]["name"];
        $type = $_FILES["txt_file"]["type"]; //file name "txt_file"
        $size = $_FILES["txt_file"]["size"];
        $temp = $_FILES["txt_file"]["tmp_name"];

        $path = "upload/" . $image_file; //set upload folder path

        $directory = "upload/"; //set upload folder path for update time previous file remove and new file upload for next use

        if ($image_file) {
            if ($type == "image/jpg" || $type == 'image/jpeg' || $type == 'image/png' || $type == 'image/gif') //check file extension
            {
                if (!file_exists($path)) //check file not exist in your upload folder path
                {
                    if ($size < 5000000) //check file size 5MB
                    {
                        unlink($directory . $row['image']); //unlink function remove previous file
                        move_uploaded_file($temp, "upload/" . $image_file); //move upload file temperory directory to your upload folder
                    } else {
                        $errorMsg = "Your File To large Please Upload 5MB Size"; //error message file size not large than 5MB
                    }
                } else {
                    $errorMsg = "File Already Exists...Check Upload Folder"; //error message file not exists your upload folder path
                }
            } else {
                $errorMsg = "Upload JPG, JPEG, PNG & GIF File Formate.....CHECK FILE EXTENSION"; //error message file extension
            }
        } else {
            $image_file = $row['image']; //if you not select new image than previous image sam it is it.
        }

        if (!isset($errorMsg)) {
            $update_stmt = $db->prepare('UPDATE tbl_file SET name=:name_up, url=:url, description=:description, image=:file_up WHERE id=:id'); //sql update query
            $update_stmt->bindParam(':name_up', $name);
            $update_stmt->bindParam(':url', $url);
            $update_stmt->bindParam(':description', $description);
            $update_stmt->bindParam(':file_up', $image_file); //bind all parameter
            $update_stmt->bindParam(':id', $id);

            if ($update_stmt->execute()) {
                $updateMsg = "File Update Successfully......."; //file update success message
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
    <title></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.0.5/tinymce.min.js"></script>
</head>
<body>
    <div class="container">
        <form method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-10">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">URL</label>
                            <div class="col-sm-6">
                                <input type="text" name="txt_url" class="form-control" value="<?php echo $url; ?>" readonly/>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-6">
                                <input type="text" name="txt_name" class="form-control" value="<?php echo $name; ?>" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-6">
                                <textarea name="description" id="editor"><?php echo $description; ?></textarea>
                            </div>
                        </div>


                        
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">File</label>
                        <div class="col-sm-6">
                            <input type="file" name="txt_file" class="form-control" value="<?php echo $image; ?>"/>
                            <p><img src="upload/<?php echo $image; ?>" height="100" width="100"/></p>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9 m-t-15">
                            <input type="submit" name="btn_update" class="btn btn-primary" value="Update">
                            <a href="index.php" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    

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

