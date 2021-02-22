<?php

 require_once "connection.php";
 
 if(isset($_REQUEST['del']))
 {
  // select image from db to delete
  $id=$_REQUEST['del']; //get del and store in $id variable
  
  $select_stmt= $db->prepare('SELECT * FROM tbl_file WHERE id =:id'); //sql select query
  $select_stmt->bindParam(':id',$id);
  $select_stmt->execute();
  $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
  unlink("upload/".$row['image']); //unlink function permanently remove your file
  
  //delete an orignal record from db
  $delete_stmt = $db->prepare('DELETE FROM tbl_file WHERE id =:id');
  $delete_stmt->bindParam(':id',$id);
  $delete_stmt->execute();
  
  header("Location:index.php");
 }
 
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>

</body>
</html>
<a href="add.php">Add</a>
    <table class="table table-striped table-bordered table-hover" id="customers">
        <thead>
            <tr>
                <th>Name</th>
                <th>File</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
 $select_stmt=$db->prepare("SELECT * FROM tbl_file"); //sql select query
 $select_stmt->execute();
 while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
 {
    ?>
                <tr>
                    <td>
                        <?php echo $row['name']; ?>
                    </td>
                    <td><img src="upload/<?php echo $row['image']; ?>" width="100px" height="60px"></td>
                    <td><a href="edit.php?update_id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a></td>
                    <td><a href="view/<?php echo $row['id']; ?>/<?php echo $row['url']; ?>" class="btn btn-warning">View</a></td>
                    <td><a href="?del=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>
                </tr>
                <?php
 }
    ?>
        </tbody>
    </table>