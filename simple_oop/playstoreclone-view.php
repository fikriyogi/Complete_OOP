<?php
//include('class/db.class.php');
// include "header.php";
// include 'config/function.php';
// session_start();
// if (!isset($_SESSION['is_login'])) {
//     header('location:login.php');
// }

require_once __DIR__.'/class/user.class.php';
// include 'autoload.php';

$b = new users; // panggil class

$id = $_GET['id'];
if (!is_null($id)) {
    $row = $b->GetById('app_post','id',$id);
} else {
    header('location:playstoreclone.php');
}

?>
<img src="<?php echo $row['icon']; ?>" width="50px"> <h1 class="mt-4"><?php echo $row['title'];?></h1>
<p class="mt-4"><?php echo $row['description'];?></p>
<a href="../../../download/<?php echo $row['id'] ?>/<?php echo $row['app_id'] ?>">
Download
</a>

<hr>
<p class="mt-4"><?php echo $row['permissions'];?></p>
