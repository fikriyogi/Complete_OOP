<?php
//index.php
include('dbConnect.php');
include('function.php');
error_reporting(0);
if (!isset($_SESSION["user_id"])) {
    header("location:login.php");
} else {
    $id = $_SESSION['user_id'];
    $statement = $connect->prepare("SELECT * FROM register_user WHERE register_user_id=:uid");
    $statement->execute(array(":uid" => $id));
    $r = $statement->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['update'])) {
    $o_pass = $_POST['o_pass'];
    $n_pass = $_POST['n_pass'];
    $r_pass = $_POST['r_pass'];

    $query = " SELECT * FROM register_user WHERE register_user_id=:uid";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            'uid' => $id
        )
    );
    $count = $statement->rowCount();
    if ($count > 0) {
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            if ($row['user_email_status'] == 'verified') {
                if (password_verify($_POST["o_pass"], $row["user_password"])) //if($row["user_password"] == $_POST["user_password"])
                {
                    if (strlen($n_pass) < PASS_LENGTH) {
                        $returnVal = True;
                        echo "Password Harus lebih dari ".PASS_LENGTH." <br>";
                    }

                    if (!preg_match("#[0-9]+#", $n_pass)) {
                        $returnVal = True;
                        echo "Password Harus angka <br>";
                    }

                    if (!preg_match("#[a-z]+#", $n_pass)) {
                        $returnVal = True;
                        echo "Password Harus huruf <br>";
                    }

                    if (!preg_match("#[A-Z]+#", $n_pass)) {
                        $returnVal = True;
                        echo "Password Harus kapital <br>";
                    }

                    if (!preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $n_pass)) {
                        $returnVal = True;
                        echo "Password Harus simbol <br>";
                    } else {
                        $user_encrypted_password = password_hash($n_pass, PASSWORD_DEFAULT);
                        $query = " UPDATE register_user SET user_password=:n_pass WHERE register_user_id=:uid";
                        $statement = $connect->prepare($query);
                        $statement->execute(
                            array(
                                'uid' => $id,
                                'n_pass' => $user_encrypted_password
                            )
                        );

                        $message = "<label>Berhasil</label>";
                    }


                } else {
                    $message = "<label>Wrong Password</label>";
                }
            } else {
                $message = "<label class='text-danger'>Please First Verify, your email address</label>";
            }
        }
    } else {
        $message = "<label class='text-danger'>Wrong Email Address</label>";
    }

}


?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP Register Login Script with Email Verification</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<?php echo $message; ?>

<br/>
<form action="" method="post" enctype="multipart/form-data">

    <table id="customers">
        <!-- <tr>
          <th>Company</th>
          <th>Contact</th>
          <th>Country</th>
        </tr> -->
        <tr>
            <td>Old</td>
            <td>:</td>
            <td><input type="text" name="o_pass" class="form-control"></td>
        </tr>
        <tr>
            <td>New</td>
            <td>:</td>
            <td><input type="text" name="n_pass" class="form-control"></td>
        </tr>
        <tr>
            <td>Repeat</td>
            <td>:</td>
            <td><input type="text" name="r_pass" class="form-control"/></td>
        </tr>
    </table>


    <button type="submit" name="update">Save</button>
</form>

</body>
<?php

?>
</html>

