<h1>General Account Settings</h1>
<h3>Update Data Barang</h3>
<hr/>
 
<form method="post" action="proses_barang.php?action=users-setting" enctype="multipart/form-data">
<input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>"/>
<table>
	<tr>
		<td>Name</td>
		<td>:</td>
		<td><input type="text" name="nama" value="<?php echo $r_user['nama']; ?>" /></td>
	</tr>
	<tr>
		<td>Username</td>
		<td>:</td>
		<td><input type="text" name="username" value="<?php echo $r_user['username']; ?>" /></td>
	</tr>
	<tr>
		<td>Contact</td>
		<td>:</td>
		<td><input type="text" name="username" value="<?php echo $r_user['email']; ?>" /></td>
	</tr>
	<tr>
		<td>Ad account contact</td>
		<td>:</td>
		<td><input type="text" name="username" value="<?php echo $r_user['email']; ?>" /></td>
	</tr>
	<tr>
		<td>Manage Account</td>
		<td>:</td>
		<td><input type="text" name="username" value="<?php echo $r_user['username']; ?>" /></td>
	</tr>
	<tr>
		<td>Identity Confirmation</td>
		<td>:</td>
		<td><input type="text" name="username" value="<?php echo $r_user['username']; ?>" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><input type="submit" name="tombol" value="Update"/></td>
	</tr>
</table>
</form>

<button class="collapsible">Name</button>
<div class="contents">
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
</div>

<button class="collapsible">Username</button>
<div class="contents">
  <p>Your public username is the same as your timeline address:</p>
  <p>facebook.com/<strong>fikriyogi</strong></p>
  <input type="text" name="username" value="<?php echo $r_user['username']; ?>" />
  <br>
  <span>Note: Your username should include your authentic name. </span>
  <br>
  <input type="submit" name="tombol" value="Update"/>
</div>