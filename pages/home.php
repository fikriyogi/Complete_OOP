<?php 	
	include('header.php');
?>


<form method="post" action="proses_barang.php?action=update">
<input type="hidden" name="page_id" value="<?php echo $data_barang['page_id']; ?>"/>
<table>
	<tr>
		<td>Email</td>
		<td>:</td>
		<td><input type="text" name="userMail" value="<?php echo $data_barang['email']; ?>"/></td>
	</tr>
	<tr>
		<td>userName</td>
		<td>:</td>
		<td><input type="text" name="userName" value="<?php echo $data_barang['username']; ?>"/></td>
	</tr>
    <tr>
        <td>Status</td>
        <td>:</td>
        <td><input type="text" name="is_online" value="<?php echo $data_barang['is_online']; ?>"/></td>
    </tr>
	<tr>
		<td></td>
		<td></td>
		<td><input type="submit" name="tombol" value="Update"/></td>
	</tr>
</table>


