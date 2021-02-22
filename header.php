<?php
    error_reporting(0);
    include('class/db.class.php');
    session_start();

    $db = new database();
    $id = $_SESSION['id'];

    $sql = "SELECT * FROM users, appearance, profiles, email_config, settings 
            WHERE users.uid=appearance.user_id AND users.uid=profiles.user_id 
            AND users.uid='$id'";
    $data_barang = $db->tampil_data($sql);
    foreach ($data_barang as $r_user) ;

    // set timeout user when login
    if (isset($_SESSION["token"]) && $_SESSION['login_with_otp'] == $r_user['is_2fa'] && $_SESSION['session_code'] == $r_user['session_id']) {
        if ((time() - $_SESSION['login_time']) > SESSION_TIMEOUT) // 900 = 15 * 60
        {
            header("location:logout.php");
        } else {
            $_SESSION['login_time'] = time();
        }
    } else {
        header('location:logout.php');
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo strip_tags(substr($r_user['description'], 0,200), ENT_QUOTES);?>">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Fikri Yogi v3.8.5">
    <title><?php echo $r_user['title']; ?></title>
    <link rel="icon" type="image/png" href="./upload/<?php echo $r_user['favicon']; ?>"/>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/starter-template/">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS ?>style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS ?>bootstrap.min.css">
    <script src="<?php echo JS ?>jquery.min.js"></script>
    <script type="text/javascript"
            src="https://phppot.com/demo/creating-dynamic-data-graph-using-php-and-chart-js/js/jquery.min.js"></script>
    <script type="text/javascript"
            src="https://phppot.com/demo/creating-dynamic-data-graph-using-php-and-chart-js/js/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.0.5/tinymce.min.js"></script>

</head>
<body>

<nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top ">
    <a class="navbar-brand" href="#">Expand at sm</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03"
            aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample03">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo SITE_URL;?>">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo SITE_URL;?>profile">Profile</a>
            </li>
            <li><a class="nav-link" href="<?php echo SITE_URL;?>settings">General Settings</a></li>
            <li><a class="nav-link" href="<?php echo SITE_URL;?>all-post">All Post</a></li>
            <li><a class="nav-link" href="pages.php">Pages</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown03" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">Dropdown</a>
                <div class="dropdown-menu" aria-labelledby="dropdown03">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown03" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">Dropdown</a>
                <div class="dropdown-menu" aria-labelledby="dropdown03">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul>
        <form class="form-inline " action="" method="POST">
            <input placeholder="Search" type="text" class="form-control search_query" id="search_query">
            
                                

        </form>
        <a href="logout.php" class="form-inline my-2 my-lg-0 btn btn-secondary">Logout</a>
    </div>
</nav>

<!--   <?php
echo $_SESSION['session_code'];
echo '<br>';
echo $r_user['session_id'];
?> -->