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
		$data = $b->ViewAllUser("post"); // panggil method
        $no = 1;
		foreach ($data as $row) { // pengulangan 
		?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $row['title']; ?></td>
			<td><?php echo strip_tags(substr($row['description'], 0,200), ENT_QUOTES);?>...</td>
            <td><?php echo $row['is_active']; ?></td>
			<td><?php if($row['permissions']=='1') { echo 'Admin'; } ?></td>
			<td><?php echo ($row['is_online']==1 ? 'Online' : 'Offline'); ?></td>
			<td>
				<a href="update/<?php echo $row['id']; ?>">Update</a>
				<a href="delete.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                <a href="view/<?php echo $row['id'] ?>/<?php echo $row['url'] ?>">View</a>
			</td>
		</tr>
		<?php 
	}
	?>
</table>