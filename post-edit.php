<?php
//include('class/db.class.php');
include "header.php";
session_start();
if (!isset($_SESSION['is_login'])) {
    header('location:login.php');
}
$db = new database();
$id = $_GET['id'];
if (!is_null($id)) {
    $data_barang = $db->get_by_id('post','id',$id);
} else {
    header('location:all-post.php');
}

?>
<h3>Update Data Barang</h3>
<hr/>
<div class="container">
    <form method="post" action="<?php echo SITE_URL ?>action.php?action=update">

        <div class="row">
            <div class="col-md-8">
                <h2>Edit Post</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mt-4">
                <div class="form-group">
                    <input type="hidden" name="id" value="<?php echo $data_barang['id']; ?>"/>
                    <input type="text"  class="form-control" name="title" value="<?php echo $data_barang['title']; ?>">
                </div>
                <div class="form-group">
                    <textarea name="description" id="editor" ><?php echo $data_barang['description']; ?></textarea>
                </div>
            </div>
            <div class="col-md-4">

                <div class="form-group">
                    <label for="is_active">Status</label>
                    <select id="is_active" class="form-control">
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="category">Kategori</label>
                    <select name="category" class="form-control">
                        <option>Choose kategori</option>
                        <?php

                        $sql = "SELECT * FROM roles";
                        $data_barang = $db->tampil_data($sql);
                        foreach ($data_barang as $row) {
                            ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                        <?php } ?>
                        <!--                <option value="1" -->
                        <?php //if($data_barang['permissions']=='1') { echo 'selected'; } ; ?><!-->Admin</option>-->
                        <!--                <option value="2" -->
                        <?php //if($data_barang['permissions']=='2') { echo 'selected'; } ; ?><!-->Operator</option>-->
                        <!--                <option value="3" -->
                        <?php //if($data_barang['permissions']=='3') { echo 'selected'; } ; ?><!-->PTK</option>-->
                        <!--                <option value="4" -->
                        <?php //if($data_barang['permissions']=='4') { echo 'selected'; } ; ?><!-->Siswa</option>-->
                    </select>
                </div>
                <div class="form-group">
                    <label>Featured Image</label>
                    <input type="file" name="feat_image"  class="form-control">
                </div>
                <div class="form-group">

                </div>
                <div class="form-group">

                </div>

                <input type="submit" name="tombol" value="Update"/>
            </div>
        </div>
    </form>
</div>


<script>
    tinymce.init({
        selector: "textarea",
        plugins: "lists advlist autolink autoresize charmap code emoticons hr image insertdatetime link media paste preview searchreplace table textpattern toc visualblocks visualchars wordcount quickbars",
        toolbar: "code preview | undo redo | formatselect | fontselect | fontsizeselect | bold italic underline strikethrough backcolor | subscript superscript | numlist bullist | alignleft aligncenter alignright alignjustify | outdent indent | paste searchreplace | toc link image media charmap insertdatetime emoticons hr | table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol | removeformat",
        insertdatetime_element: true,
        media_scripts: [
            {filter: 'platform.twitter.com'},
            {filter: 's.imgur.com'},
            {filter: 'instagram.com'},
            {filter: 'https://platform.twitter.com/widgets.js'},
        ],
        browser_spellcheck: true,
        contextmenu: false,
        height: 300
    });
</script>
</body>
</html>