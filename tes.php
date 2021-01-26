<?php
error_reporting(0);
$txt = $_SERVER['HTTP_USER_AGENT'];
$reg = '/Android (\d+).(\d+)\s+/';
$a   = array();

preg_match('/Android ((\d+|\.)+[^,;]+)/', $txt, $a);

$str_version = $a[1];

echo "android " . $str_version;