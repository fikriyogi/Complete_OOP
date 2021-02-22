<?php
//index.php
include('dbConnect.php');
error_reporting(0);
if(!isset($_SESSION["user_id"]))
{
	header("location:login.php");
} else {
	$id = $_SESSION['user_id'];
    
	$statement = $connect->prepare("SELECT * FROM register_user WHERE register_user_id=:uid");
	$statement->execute(array(":uid"=>$id));
	$r=$statement->fetch(PDO::FETCH_ASSOC);
}
if (isset($_POST['save'])) {
	try
 {
  $name =$_REQUEST['user_name']; //textbox name "user_name"
  $email =$_REQUEST['user_email']; //textbox name "user_name"
  
  $image_file = $_FILES["txt_file"]["name"];
  $type  = $_FILES["txt_file"]["type"]; //file name "txt_file"
  $size  = $_FILES["txt_file"]["size"];
  $temp  = $_FILES["txt_file"]["tmp_name"];
   
  $path="upload/".$image_file; //set upload folder path
  
  $directory="upload/"; //set upload folder path for update time previous file remove and new file upload for next use
  
  if($image_file)
  {
   if($type=="image/jpg" || $type=='image/jpeg' || $type=='image/png' || $type=='image/gif') //check file extension
   { 
    if(!file_exists($path)) //check file not exist in your upload folder path
    {
     if($size < 5000000) //check file size 5MB
     {
      unlink($directory.$r['avatar']); //unlink function remove previous file
      move_uploaded_file($temp, "upload/" .$image_file); //move upload file temperory directory to your upload folder 
     }
     else
     {
      $errorMsg="Your File To large Please Upload 5MB Size"; //error message file size not large than 5MB
     }
    }
    else
    { 
     $errorMsg="File Already Exists...Check Upload Folder"; //error message file not exists your upload folder path
    }
   }
   else
   {
    $errorMsg="Upload JPG, JPEG, PNG & GIF File Formate.....CHECK FILE EXTENSION"; //error message file extension
   }
  }
  else
  {
   $image_file=$r['avatar']; //if you not select new avatar than previous avatar sam it is it.
  }
 
  if(!isset($errorMsg))
  {
   $update_stmt=$connect->prepare('UPDATE register_user SET user_name=:name_up, user_email=:email_up, avatar=:file_up WHERE register_user_id=:id'); //sql update query
   $update_stmt->bindParam(':name_up',$name);
   $update_stmt->bindParam(':email_up',$email);
   $update_stmt->bindParam(':file_up',$image_file); //bind all parameter
   $update_stmt->bindParam(':id',$id);
    
   if($update_stmt->execute())
   {
    $updateMsg="File Update Successfully......."; //file update success message
    header("refresh:0;u_profile.php"); //refresh 3 second and redirect to index.php page
   }
  }
 }
 catch(PDOException $e)
 {
  echo $e->getMessage();
 }
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>PHP Register Login Script with Email Verification</title>		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="../style.css"></script>
	</head>
	<body>

		<?php echo $errorMsg; ?>
		
		<br />
		<form action="" method="post"  enctype="multipart/form-data">

      <table id="customers">
        <!-- tr>
          <th>Company</th>
          <th>Contact</th>
          <th>Country</th>
        </tr> -->
        <tr>
          <td>Nama</td>
          <td>:</td>
          <td><input type="text" name="user_name" value="<?= $r['user_name']?>"> </td>
        </tr>
        <tr>
          <td>Email</td>
          <td>:</td>
          <td><input type="text" name="user_email" value="<?= $r['user_email']?>"></td>
        </tr>
        <tr>
          <td>Avatar</td>
          <td>:</td>
          <td><input type="file" name="txt_file" class="form-control" value="<?php echo $r['avatar']; ?>"/></td>
        </tr>
        <tr>
          <td>Avatar</td>
          <td>:</td>
          <td><img src="upload/<?php echo $r['avatar']; ?>" height="100" width="100" /></td>
        </tr>
      </table>

			
			<button type="submit" name="save">Save</button>
		</form>
	
	</body>
	
</html>

