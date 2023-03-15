<?php

$dblocalhost = 'localhost';
$dbusername = 'root';
$dbpassword = '';

$db_name = 'dalka_ecommerce';

$conn = mysqli_connect($dblocalhost, $dbusername, $dbpassword, $db_name);

if (!$conn) {
    die('Connection Failed :' . mysqli_connect_error());
}
