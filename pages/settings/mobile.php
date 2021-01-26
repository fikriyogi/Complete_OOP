<h1>Mobile Settings</h1>
<hr/>
<?php if ($r_user['show_phone'] == 1) {
    echo $r_user['phone'];
} else {
    echo "Tidak tampil";
}
?>
<form method="post" action="proses_barang.php?action=users-setting&section=mobile" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>"/>
    <table>
        <tr>
            <td>Your phones:</td>
            <td>:</td>
            <td><input type="text" name="phone" class="form-control" value="<?php echo $r_user['phone']; ?>"/></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><input type="submit" name="tombol" class="btn btn-primary" value="Update"/></td>
        </tr>
    </table>
</form>
<form method="post" action="">
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>"/>
    <tr>
        <td>Tampil phone <span id="display"></span></td>
        <td>:</td>
        <td>
            <select id="selectstatus" class="selectstatus form-control" status-id="<?php echo $_SESSION['id']; ?>">
                <option value="">Pilih</option>
                <option value="0" <?php if ($r_user['show_phone'] == 0) {
                    echo "selected";
                } ?> >Tidak
                </option>
                <option value="1" <?php if ($r_user['show_phone'] == 1) {
                    echo "selected";
                } ?>>Ya
                </option>
            </select>
        </td>
    </tr>
</form>

<script type="text/javascript">
    $(".selectstatus").change(function () {
        var statusname = $(this).val();
        var getid = $(this).attr("status-id");
        $.ajax({
            type: 'POST',
            url: 'fetch/ajaxtes.php',
            data: {statusname: statusname, getid
    :
        getid
    },
        success:function (result) {
            $("#display").html(result);
        }
    })

    });
</script>
