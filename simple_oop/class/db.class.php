<?php
class database{
    var $host = "localhost";
    var $username = "root";
    var $password = "";
    var $database = "my_oop";
    var $conn = "";
    function __construct(){
        $this->conn = mysqli_connect($this->host, $this->username, $this->password,$this->database);
        if (mysqli_connect_errno()){
            echo "Error database connection : " . mysqli_connect_error();
        }
    }
    function general_settings()
    {
        $settings = mysqli_query($this->conn, "SELECT * FROM email_config, settings");
        $row = $settings->fetch_array(MYSQLI_ASSOC);
            $this->aplication_name=$row['title'];
            $this->email=$row['smtp_username'];
            $this->email_pass=$row['smtp_password'];
            $this->attempt_wrong_password = $row['attempt_wrong_password'];
            $this->link = SITE_URL;
        return $settings;
    }

    // function ViewUser($table) {
    // 	$sql = mysqli_query($this->conn, "SELECT * FROM $table");
    // 	while ($row = mysqli_fetch_array($sql)) {
    // 		$hasil[] = $row;
    // 		# code...
    // 	}
    // 	return $hasil;
    // }
}


