<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 11/01/16
 * Time: 9:47
 */


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "padelexperience";

// Create connection
$mysqli = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}



?>