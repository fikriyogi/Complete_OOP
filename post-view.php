<?php
//include('class/db.class.php');
include "header.php";
include 'config/function.php';
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
    <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">
            <p><?= breadcrumbs() ?></p>

            <!-- Title -->
            <h1 class="mt-4"><?php echo $data_barang['title'];?></h1>

            <!-- Author -->
            <p class="lead">
                by
<!--                <a href="../../category/--><?php //echo $data_barang['id'] ?><!--/--><?php //echo $data_barang['category_name'] ?><!--">--><?php //echo $data_barang['category_name'];?><!--</a>-->
            </p>

            <hr>

            <!-- Date/Time -->
            <p>Posted on <?php echo $data_barang['date_post']; ?></p>

            <hr>

            <!-- Preview Image -->
            <img class="img-fluid rounded" src="<?php echo SITE_URL ?>/img/<?php echo $data_barang['feat_image'];?>" alt="">


            <!-- Post Content -->
            <p class="lead"><?php echo $data_barang['description'];?></p>


            <p>
                <pre>
                <code>asdasdasd</code>
                </pre>
            </p>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!</p>

            <hr>

            <!-- Comments Form -->
            <div class="card my-4">
                <h5 class="card-header">Leave a Comment:</h5>
                <div class="card-body">
                    <div id="disqus_thread"></div>
                </div>
            </div>

        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">
            <!-- Search Widget -->
            <div class="card my-4">
                <h5 class="card-header">Search</h5>
                <div class="card-body">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-append">
                            <button class="btn btn-secondary" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Categories Widget -->
            <div class="card my-4">
                <h5 class="card-header">Categories</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <a href="#">Web Design</a>
                                </li>
                                <li>
                                    <a href="#">HTML</a>
                                </li>
                                <li>
                                    <a href="#">Freebies</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <a href="#">JavaScript</a>
                                </li>
                                <li>
                                    <a href="#">CSS</a>
                                </li>
                                <li>
                                    <a href="#">Tutorials</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Side Widget -->
            <div class="card my-4">
                <h5 class="card-header">Side Widget</h5>
                <div class="card-body">
                    You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
                </div>
            </div>

        </div>

    </div>
</div>

<script>
    (function() { // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        s.src = 'https://perangkatpembelajaran.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<script>
    Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
    });
</script>

</body>
</html>