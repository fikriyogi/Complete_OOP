<?php 	
	include('header.php');
?>
<main role="main" class="container">
<a href="post-new.php">Tambah Data</a>
<a href="settings.php">pengaturan</a>
<br>
<div class="row">
    <div class="col-md-12">
        <table border="1" class="table table-hover ">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Title</th>
                <th scope="col">Desc</th>
                <th scope="col">Handle</th>
                <th scope="col">Title</th>
                <th scope="col">Desc</th>
                <th scope="col">Handle</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM post";
            $data_barang = $db->tampil_data($sql);
            $no = 1;
            foreach($data_barang as $row){
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><a href="edit/<?php echo $row['id'] ?>/<?php echo $row['url'] ?>"><?php echo $row['title']; ?></a></td>
                    <td><?php echo strip_tags(substr($row['description'], 0,200), ENT_QUOTES);?>...</td>
                    <td><?php echo $row['is_active']; ?></td>
                    <td><?php if($row['permissions']=='1') { echo 'Admin'; } ?></td>
                    <td><?php echo ($row['is_online']==1 ? 'Online' : 'Offline'); ?></td>
                    <td>
                        <a href="edit/<?php echo $row['id'] ?>/<?php echo $row['url'] ?>">Update</a>
                        <a href="proses_barang.php?action=delete&id=<?php echo $row['uid']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        <a href="proses_barang.php?action=revoke">Revoke</a>
                        <a href="post/<?php echo $row['id'] ?>/<?php echo $row['url'] ?>">View Post</a>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

</main>

<?php include 'footer.php' ?>