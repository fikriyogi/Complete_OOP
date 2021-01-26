
<h1>Security and Login</h1>


<p>It's a good idea to use a strong password that you're not using elsewhere</p>
<hr/>

<form method="post" action="action.php?action=change-password&section=change-password"
      enctype="multipart/form-data">
    <input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>"/>

    <div class="form-group row">
        <label for="password-old" class="col-sm-4 col-form-label">Current Password</label>
        <div class="col-sm-8">
            <input name="password_old" class="form-control" type="password" id="password_old">
        </div>
    </div>
    <div class="form-group row">
        <label for="password_new" class="col-sm-4 col-form-label">New Password</label>
        <div class="col-sm-8">
            <input name="password_new" class="form-control" type="password" id="password_new">
        </div>
    </div>
    <div class="form-group row">
        <label for="password_confirm" class="col-sm-4 col-form-label">Confirm New Password</label>
        <div class="col-sm-8">
            <input name="password_confirm" class="form-control" type="password" id="password_confirm">
        </div>
    </div>
    <div class="form-group row">
        <label for="password_confirm" class="col-sm-4 col-form-label"></label>
        <div class="col-sm-8">
            <input type="submit" name="save" class="btn btn-primary" value="Update"/>
        </div>
    </div>

    <!-- <table>
        <tr>
            <td colspan="3"><h3>Change Password</h3></td>
        </tr>
        <tr>
            <td width="200px">Current Password</td>
            <td>:</td>
            <td><input type="text" name="password_old"/></td>
        </tr>
        <tr>
            <td>New Password</td>
            <td>:</td>
            <td><input type="text" name="password_new"/></td>
        </tr>
        <tr>
            <td>Confirm New Password</td>
            <td>:</td>
            <td><input type="text" name="password_confirm"/></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><input type="submit" name="save" class="btn btn-primary" value="Update"/></td>
        </tr>
    </table> -->
</form>


<form method="post" action="proses_barang.php?action=users-setting&section=2fa" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>"/>
    <table>
        <tr>
            <td colspan="3"><h3>Two-Factor Authentication</h3></td>
        </tr>
        <tr>
            <td width="200px">Enabled 2FA OTP Code by Email</td>
            <td>:</td>
            <td><select name="is_2fa" class="form-control">
                    <option value="0" <?php if ($r_user['is_2fa'] == '0') {
                        echo 'selected';
                    } ?>>Off
                    </option>
                    <option value="1" <?php if ($r_user['is_2fa'] == '1') {
                        echo 'selected';
                    } ?>>On
                    </option>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><input type="submit" name="tombol" class="btn btn-primary" value="Update"/></td>
        </tr>
    </table>
</form>


