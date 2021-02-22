<?php
//database_connection.php

$connect = new PDO('mysql:host=localhost;dbname=my_oop', 'root', '');
session_start();


define('BASE_URL', 'http://http://localhost/my_oop/simple_oop/PDOREG/', true);
define('MAIL_USERNAME', 'fikriyogi@gmail.com');
define('MAIL_PASS', '@fy085264972892');
define('MAIL_HOST', 'smtp.gmail.com');
define('PASS_LENGTH', 8);
define('DATE_FORMAT', 'Y/m/d H:i:s');
define('IMG_MAX_SIZE', 5000000);


?>