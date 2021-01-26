<h1>Website Settings</h1>
<hr/>
 
<form method="post" action="action.php?action=update-setting" enctype="multipart/form-data">
<!--<input type="hidden" name="id_setting" value="--><?php //echo $r_user['id_setting']; ?><!--"/>-->
<table>
	<tr>
		<td>Site Name</td>
		<td>:</td>
		<td><input type="text" class="form-control" name="title" value="<?php echo $r_user['title']; ?>"/></td>
	</tr>
	<tr>
		<td>Address</td>
		<td>:</td>
		<td><input type="text" class="form-control" name="address" value="<?php echo $r_user['address']; ?>"/></td>
	</tr>
	<tr>
		<td>Enabled Recaptcha</td>
		<td>:</td>
		<td><select name="is_recaptcha" class="form-control">
			<option value="0" <?php if($r_user['is_recaptcha']=='0') { echo 'selected'; } ?>>Off</option>
			<option value="1" <?php if($r_user['is_recaptcha']=='1') { echo 'selected'; } ?>>On</option>
		</select>
		</td>
	</tr>
	<tr>
		<td>Enabled 2FA OTP Code by Email</td>
		<td>:</td>
		<td><select name="theme" class="form-control">
			<option value="0" <?php if($r_user['theme']=='0') { echo 'selected'; } ?>>Dark</option>
			<option value="1" <?php if($r_user['theme']=='1') { echo 'selected'; } ?>>Blue</option>
		</select>
		</td>
	</tr>
	<tr>
		<td>Email</td>
		<td>:</td>
		<td><input type="text" class="form-control" name="smtp_username" value="<?php echo $r_user['smtp_username']; ?>"/></td>
	</tr>
	<tr>
		<td>Password</td>
		<td>:</td>
		<td><input type="password" class="form-control" name="smtp_password" value="<?php echo $r_user['smtp_password']; ?>"/></td>
	</tr>
	<tr>
		<td>Logo</td>
		<td>:</td>
		<td><input type="file"  class="form-control" name="favicon" id="favicon"  /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><input type="submit" class="btn btn-primary" name="tombol" value="Update"/></td>
	</tr>
</table>
</form>
