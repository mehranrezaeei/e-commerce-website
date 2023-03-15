<?php
session_start();
include("db_c.php");

if (isset($_GET['pro_name'])) {
    $ses_pro_arr = array();
    $ses_pro_arr['name'] = $_GET['pro_name'];
    $ses_pro_arr['id'] = $_GET['pro_id'];
    $ses_pro_arr['price'] = $_GET['pro_price'];
    $ses_pro_arr['image'] = $_GET['pro_image'];
    $ses_pro_arr['count'] = 1;
    if (isset($_SESSION['products'])) {
        productUniquCheck($ses_pro_arr);
        $a = $_SESSION['products'];
        array_push($a, $ses_pro_arr);
        $_SESSION['products'] = $a;
        header('Location: products.php');
        exit();
    } else {
        $_SESSION['products'] = array();
        array_push($_SESSION['products'], $ses_pro_arr);
        header('Location: products.php');
        exit();
    }
}


function productUniquCheck($arr)
{
    $sarr = $_SESSION['products'];
    $sarrLength = sizeof($sarr);
    for ($i = 0; $i <= $sarrLength; ++$i) {
        if ($arr['name'] === $sarr[$i]['name'] && $arr['id'] === $sarr[$i]['id']) {
            header('refresh:5;url=products.php');
            exit();
        }
    }
}
