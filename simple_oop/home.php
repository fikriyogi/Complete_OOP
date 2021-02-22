<?php
    // error_reporting(0);
    include('class/user.class.php');
    session_start();

    $db = new database();
    $id = @$_SESSION['id'];

    $sql = "SELECT * FROM users, profiles 
            WHERE users.uid=profiles.user_id";
    $data_barang = $db->ViewSql($sql);
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

<main role="main" class="container">

    <div style="width: 800px;margin: 0px auto;">
        <canvas id="myChart"></canvas>
    </div>
    <div class="starter-template">
        <h1>Selamat Datang <?php echo $r_user['username']; ?></h1>
        <p class="lead">Belajar PHP Sangat Menyenangkan</p>
        <p>Total Users :
            <?php $data = $db->counts('users', 'token', ''); ?>
        </p>
        <p>Currently Online :
            <?php $data = $db->counts('users', 'is_online', '1'); ?>
        </p>
        <p>Banned Users :
            <?php $data = $db->counts('users', 'is_blocked', '1'); ?>
        </p>
        <p>Pending Users :
            <?php $data = $db->counts('users', 'is_active', '0'); ?>
        </p>
    </div>
    <div class="starter-template">
        <h2 class="lead">Statistik</h2>
        <p>Last month :
            <?php
            $sql = "SELECT * FROM users WHERE YEAR(register_at) = YEAR(NOW()) AND MONTH(register_at)=MONTH(NOW());";
            $data = $db->count_by_category($sql);
            ?>
        </p>
        <p>Last 7 days :
            <?php
            $sql = "SELECT * FROM users WHERE WEEKOFYEAR(register_at) = WEEKOFYEAR(NOW());";
            $data = $db->count_by_category($sql);
            ?>
        </p>
        <p>Today so far :
            <?php
            $sql = "SELECT * FROM users WHERE YEAR(register_at) = YEAR(NOW()) AND MONTH(register_at) = MONTH(NOW()) AND DAY(register_at) = DAY(NOW());";
            $data = $db->count_by_category($sql);
            ?>
        </p>
    </div>
    <div>
        <h2>New Registrations</h2>
        <ul>
            <?php
            $sql = "SELECT * FROM users ORDER BY uid DESC";
            $data = $db->tampil_data($sql);
            $no = 1;
            foreach ($data as $row) {
                ?>
                <li><?php echo $row['username']; ?> | <?php echo time_elapsed_string($row['register_at']); ?></li>
            <?php } ?>
        </ul>
    </div>
    <div>
        <h2>New Registrations</h2>
        <table class="table-style-one">
            <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM users ORDER BY uid DESC";
            $data = $db->tampil_data($sql);
            $no = 1;
            foreach ($data as $row) {
                ?>
                <tr>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo time_elapsed_string($row['register_at']); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</main>
<!-- /.container -->


<?php include 'footer.php'; ?>
