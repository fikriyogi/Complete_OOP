<?php include 'header.php'; ?>
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
    <div>
        <h2>Where You're Logged In</h2>
        <table class="table-style-one">
            <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
            </tr>
            </thead>
            <tbody>
                <?php
                $id = $_SESSION['email'];
                $sql = "SELECT * FROM logs ";
                $p = $db->tampil_data($sql);
                $no = 1;
                foreach ($p as $q) {
                    ?>
                    <tr>
                        <td><?php echo $q['user_id']; ?></td>
                        <td><?php echo $q['log_type']; ?></td>
                        <td><?php echo $q['log_time']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</main>
<!-- /.container -->


<?php include 'footer.php'; ?>
