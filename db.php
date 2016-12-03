<?php
date_default_timezone_set("Asia/Jakarta");

// perintah untuk mengkoneksikan php ke database mysql
$db = new mysqli('localhost','demoo','asdakgnadjfbdfnkb34r3cff3','rsb_asih_metro');


// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


?>