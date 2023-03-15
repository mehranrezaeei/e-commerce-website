<!DOCTYPE html>
<html lang="en" dir="rtl">
<?php

session_start();
if (isset($_GET['pro_count_name'])) {
    btnCountChanger($_GET['pro_count_name'], $_GET['pro_id']);
}
if (isset($_GET['pro_btn_delete'])) {
    deleteProductBtn($_GET['pro_id']);
}
function btnCountChanger($action, $pro_id)
{
    $sess_arr = $_SESSION['products'];
    if ($action == 'plus') {
        for ($i = 0; $i < sizeof($sess_arr); $i++) {
            if ($sess_arr[$i]['id'] == $pro_id) {
                if ($sess_arr[$i]['count'] < 25) {
                    $sess_arr[$i]['count']++;
                    $_SESSION['products'] = $sess_arr;
                }
            }
        }
        header('Location: shopping-cart.php');
        exit();
    } else {
        for ($i = 0; $i < sizeof($sess_arr); $i++) {
            if ($sess_arr[$i]['id'] == $pro_id) {
                if ($sess_arr[$i]['count'] > 1) {
                    $sess_arr[$i]['count']--;
                    $_SESSION['products'] = $sess_arr;
                }
            }
        }
        header('Location: shopping-cart.php');
        exit();
    }
}
function deleteProductBtn($pro_id)
{
    $sess_arr = $_SESSION['products'];
    for ($i = 0; $i < sizeof($sess_arr); $i++) {
        if ($sess_arr[$i]['id'] == $pro_id) {
            array_splice($sess_arr, $i, 1);
            $_SESSION['products'] = $sess_arr;
        }
    }
    header('Location: shopping-cart.php');
    exit();
}
function totalProductCount($data)
{
    $total_count = 0;
    for ($i = 0; $i < sizeof($data); $i++) {
        $total_count += $data[$i]['count'];
    }
    return $total_count;
}
function totalProductPrice($data)
{
    $product_price = $total_price = 0;
    for ($i = 0; $i < sizeof($data); $i++) {
        $product_price = $data[$i]['price'] * $data[$i]['count'];
        $total_price += $product_price;
    }
    return $total_price;
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.rtl.min.css" integrity="sha384-WJUUqfoMmnfkBLne5uxXj+na/c7sesSJ32gI7GfCk4zO4GthUKhSEGyvQ839BC51" crossorigin="anonymous">
    <title>سبد خرید - دالکا</title>
</head>

<body>
    <div class="product-checkout-cont w-100 p-4">
        <div class="row bg-white p-2 rounded-2 m-0 h-100 w-100">
            <div class="col-8 h-100 overflow-y-auto product-check-c-scrollbar">
                <div class="row product-check-holder">
                    <?php
                    if (isset($_SESSION['products'])) {
                        $sess_arr = $_SESSION['products'];
                        for ($i = 0; $i < sizeof($sess_arr); $i++) {
                    ?>
                            <div class="col-12 product-check-card bg-light mb-2 rounded p-2 d-flex">
                                <div class="product-check-card-image">
                                    <img src="Images/products/<?php echo $sess_arr[$i]['image']; ?>" class="w-100 h-100" alt="">
                                </div>
                                <div class="product-check-card-info fs-4 d-flex flex-column px-4">
                                    <span class="product-check-card-info-name fw-bold py-1"><?php echo $sess_arr[$i]['name'] ?></span>
                                    <div class="product-check-card-info-price mt-auto fs-3 py-2"><?php echo number_format($sess_arr[$i]['price']) ?></div>
                                </div>
                                <div class="product-check-card-count d-flex align-items-end justify-content-center ">
                                    <form action="" method="GET" class="d-flex align-items-center justify-content-end w-100">
                                        <div class="btn-group w-50 py-2">
                                            <?php
                                            echo "
                                            <a href='shopping-cart.php?pro_count_name=plus&pro_id=" . $sess_arr[$i]['id'] . "' id='btn-product-submit' class='product-check-card-count-plus btn btn-outline-dark'>
                                            +
                                            </a>
                                        ";
                                            ?>
                                            <span class="btn btn-dark">
                                                <?php echo $sess_arr[$i]['count'] ?>
                                            </span>

                                            <?php
                                            echo "
                                            <a href='shopping-cart.php?pro_count_name=minus&pro_id=" . $sess_arr[$i]['id'] . "' id='btn-product-submit' class='product-check-card-count-plus btn btn-outline-dark'>
                                            -
                                            </a>
                                        ";
                                            ?>

                                        </div>
                                        <?php
                                        echo "
                                            <a href='shopping-cart.php?pro_btn_delete&pro_id=" . $sess_arr[$i]['id'] . "'  class='btn btn-outline-danger mx-1'>
                                            <i class='far fa-trash-alt'></i>
                                            </a>
                                        ";
                                        ?>
                                    </form>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="col-4  py-2">
                <div class="row h-100 d-flex">
                    <div class="col-12 d-flex justify-content-center">
                        <h2> سبد خرید محصولات<h2>
                    </div>
                    <?php
                    if (isset($_SESSION['products'])) {
                        $sess_arr = $_SESSION['products'];

                    ?>
                        <div class="col-12 mt-auto">
                            <div class="row justify-content-center">
                                <div class="col-10 d-flex fs-5 my-2">
                                    <span>تعداد محصولات :</span>
                                    <span class="products-checkout-count ms-auto"><?php echo totalProductCount($sess_arr); ?></span>
                                </div>
                                <div class="col-10 d-flex fs-5 my-2">
                                    <span>مجموع قیمت محصولات :</span>
                                    <span class="products-checkout-all-price ms-auto"><?php echo number_format(totalProductPrice($sess_arr)); ?></span>
                                </div>
                                <div class="col-10 mt-5">
                                    <a href="#" class="btn-create-session btn btn-lg btn-outline-danger w-100">
                                        پرداخت
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {

                    ?>
                        <div class="col-12 mt-auto">
                            <div class="row justify-content-center">
                                <div class="col-10 d-flex fs-5 my-2">
                                    <span>تعداد محصولات :</span>
                                    <span class="products-checkout-count ms-auto">0</span>
                                </div>
                                <div class="col-10 d-flex fs-5 my-2">
                                    <span>مجموع قیمت محصولات :</span>
                                    <span class="products-checkout-all-price ms-auto">0</span>
                                </div>
                                <div class="col-10 mt-5">
                                    <a href="#" class="btn-create-session btn btn-lg btn-outline-danger w-100">
                                        پرداخت
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <script src="js/app.js"></script>
</body>

</html>