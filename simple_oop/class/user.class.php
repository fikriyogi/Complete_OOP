<?php 
require_once __DIR__.'/db.class.php';
class users extends database {
	function ViewAllUser($table) // view all data
	{
    	$sql = mysqli_query($this->conn, "SELECT * FROM $table");
    	while ($row = mysqli_fetch_array($sql)) {
    		$hasil[] = $row;
    		# code...
    	}
    	return $hasil;
    }
    function GetById($table,$id,$category) // view one data
	{
		$query = mysqli_query($this->conn,"SELECT * FROM $table WHERE $id='$category'");
		return $query->fetch_array();
	}
    function AddUser($title,$url,$description,$app_id,$permissions) // add data
	{
		$cek = mysqli_query($this->conn, "SELECT * FROM users WHERE email='$title'");
		$row_count = $cek->num_rows;
		if ($row_count == 1) {
			echo "<script type=text/javascript>
              alert('Data sudah ada');
              window.location = 'all-post.php'</script>";
		} else {
			mysqli_query($this->conn,"INSERT INTO app_post (title,url,description,app_id,permissions) VALUES ('$title','$url','$description','$app_id','$permissions')");
			header('location:playstoreclone-view.php');
		}
	}
	function update_data($userMail,$userName,$userOnline,$level,$Sid) // update data
	{
		$query = mysqli_query($this->conn,"UPDATE post SET title='$userMail',description='$userName',is_active='$userOnline',category='$level' WHERE id='$Sid'");
		echo "<script type=text/javascript>
		              alert('Update Successfully');
		              window.location = 'settings.php?tab=general'</script>";
	}

	function delete($id) // delete data
	{
		$query = mysqli_query($this->conn,"DELETE FROM post WHERE id='$id'");
		echo "<script type=text/javascript>alert('Delete Successfully');  </script>";
	}

	function ViewSql($sql)
	{
		$data = mysqli_query($this->conn, $sql);
		while($row = mysqli_fetch_array($data)){
			$hasil[] = $row;
		}
		return @$hasil;
	}

}