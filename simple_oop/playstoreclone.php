<?php
require_once __DIR__.'/class/user.class.php';
// include 'autoload.php';

$b = new users; // panggil class
?>

<table border="1" class="table table-hover ">
	<tr>
		<th>No</th>
		<th>Email</th>
		<th>username</th>
		<th>Status</th>
        <th>Session</th>
		<th>Permission</th>
		<th>Action</th>
	</tr>
	<?php
        // $sql = "SELECT * FROM users";
		$data = $b->ViewAllUser("app_post"); // panggil method
        $no = 1;
		foreach ($data as $row) { // pengulangan 
		?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $row['title']; ?></td>
			<td><?php echo strip_tags(substr($row['description'], 0,200), ENT_QUOTES);?>...</td>
            <td><img src="<?php echo $row['icon']; ?>" width="50px"> </td>
			<td><?php if($row['license']=='1') { echo 'Free'; } else { echo "In App Purchase";} ?></td>
			<td><?php echo ($row['is_online']==1 ? 'Online' : 'Offline'); ?></td>
			<td>
				<a href="edit.php?uid=<?php echo $row['uid']; ?>">Update</a>
				<a href="delete.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                <a href="apps/details/<?php echo $row['id'] ?>/<?php echo $row['app_id'] ?>">View</a>
			</td>
		</tr>
		<?php 
	}
	?>
</table>