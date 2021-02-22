<html>
<head>
    <title>Search with PHP PDO & Mysql Script</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form">
    <h2>Search with PHP-PDO & MySQL</h2>
    <form action="" method="get">
        Search: <input name="q" placeholder=" Search"/>
        <input type="submit" value="GO"/>
    </form>
    <table border="1">
        </thead>
        <tr>
            <th>No</th>
            <th>Judul Buku</th>
            <th>Author</th>
            <th>Harga</th>
        </tr>
        </thead>
        <tbody>

        <!--Blok PHP-->
        <?php
        //include file koneksi
        include "dbConnect.php";

        if (isset($_GET['q'])) {

            $param = $_GET['q'];
            $query = $connect->prepare("SELECT * FROM students WHERE name LIKE :param OR email LIKE :param ");
            $query->bindValue(':param', '%' . $param . '%', PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                $no = 1;
                while ($r = $query->fetch()) {
                    echo '<tr>   
                        <td>' . $no . '</td>
                        <td>' . $r['name'] . '</td>
                        <td>' . $r['email'] . '</td>
                        <td>Rp' . $r['mobile'] . '</td>
                    </tr>';

                    ++$no;

                }//end while

            } else {
                echo "<tr><td colspan=\"4\">Not Found</td></tr>";
            }

        }//end if
        else {
            $param = @$_GET['q'];
            $query = $connect->prepare("SELECT * FROM students ");
            $query->bindValue(':param', '%' . $param . '%', PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                $no = 1;
                while ($r = $query->fetch()) {
                    echo '<tr>
                        <td>' . $no . '</td>
                        <td>' . $r['name'] . '</td>
                        <td>' . $r['email'] . '</td>
                        <td>Rp' . $r['mobile'] . '</td>
                     </tr>';

                    ++$no;

                }//end while
            }
        }

        ?>

        </tbody>
    </table>
</div>
<p class="footer"><a href="http://teknosains.com/i/">PHP MySQL Database Search</a></p>
</body>
</html>