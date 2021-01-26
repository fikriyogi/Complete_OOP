
<h1>User Settings</h1>
<p>Update Data Barang</p>
<hr/>
 
<form method="post" action="proses_barang.php?action=users-setting&section=2fa" enctype="multipart/form-data">
<input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>"/>
<table>
	<tr>
		<td>Enabled 2FA OTP Code by Email</td>
		<td>:</td>
		<td><select name="is_2fa">
			<option value="0" <?php if($r_user['is_2fa']=='0') { echo 'selected'; } ?>>Off</option>
			<option value="1" <?php if($r_user['is_2fa']=='1') { echo 'selected'; } ?>>On</option>
		</select>
		</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><input type="submit" name="tombol" value="Update"/></td>
	</tr>
</table>
</form>

