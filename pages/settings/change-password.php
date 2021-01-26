<h1>Security and Login</h1>

<h3>Change Password</h3>
<p>It's a good idea to use a strong password that you're not using elsewhere</p>
<hr/>
 
<form method="post" action="proses_barang.php?action=change-password" enctype="multipart/form-data">
<input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>"/>
<table>
	<tr>
		<td>Current Password</td>
		<td>:</td>
		<td><input type="text" name="password_old" /></td>
	</tr>
	<tr>
		<td>New</td>
		<td></td>
		<td><input type="text" name="password_new" /></td>
	</tr>
	<tr>
		<td>New</td>
		<td></td>
		<td><input type="text" name="password_confirm" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><input type="submit" name="save" value="Update"/></td>
	</tr>
</table>
</form>

<form method="post" action="proses_barang.php?action=change-password" enctype="multipart/form-data">
    <input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>"/>
    <table>
        <tr>
            <td>Current Password</td>
            <td>:</td>
            <td><input type="text" name="password_old" /></td>
        </tr>
        <tr>
            <td>New</td>
            <td></td>
            <td><input type="text" name="password_new" /></td>
        </tr>
        <tr>
            <td>New</td>
            <td></td>
            <td><input type="text" name="password_confirm" /></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><input type="submit" name="save" value="Update"/></td>
        </tr>
    </table>
</form>

<!-- Auto Hide -->
<script type="text/javascript">
    window.setTimeout("document.getElementById('box-pesan').style.display='none';", 3000); 
</script>
</body>
</html>