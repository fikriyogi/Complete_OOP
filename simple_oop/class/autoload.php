<?php
spl_autoload_register(function($className) {
	$file = $className . '.php';
	if (file_exists($file)) {
		include $file;
	}
});