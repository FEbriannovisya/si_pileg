<?php
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','pileg');

class Database {

    private $con;

    function __construct() {

    }

    function connect() {
        $this->con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 
        if (mysqli_connect_errno()) {
            echo "Gagal menghubungkan ke server database: " . mysqli_connect_error();
            return null;
        }
		
        return $this->con;
        // echo "Sukses";
    }
	
}

?>