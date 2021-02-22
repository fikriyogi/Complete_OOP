<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<?php
session_start();

?>
<div class="container">
    <div class="row text-center">
        <div class="col-sm-6 col-sm-offset-3">
            <br><br>
            <h2 style="color:#0fad00">Success</h2>
            <img src="http://osmhotels.com//assets/check-true.jpg">
            <h3>Dear</h3>
            <p style="font-size:20px;color:#5C5C5C;">Thank you for verifying your Mobile No.We have sent you an email
                "<?php echo $_SESSION['userMail'] ?>" with your details
                Please go to your above email now and login.</p>
            <a href="" class="btn btn-success">     Log in     </a>
            <br><br>
        </div>

    </div>
</div>

