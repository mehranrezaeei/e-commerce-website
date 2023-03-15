<!DOCTYPE html>
<html lang="en" dir="rtl">
<?php
include("db_c.php");
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Logo link -->
    <link rel="icon" href="Images/dalka-logo-black.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.rtl.min.css" integrity="sha384-WJUUqfoMmnfkBLne5uxXj+na/c7sesSJ32gI7GfCk4zO4GthUKhSEGyvQ839BC51" crossorigin="anonymous">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/main.css">
    <title>صفحه محصول - دالکا</title>
</head>
<?php
mysqli_query($conn, "SET CHARACTER SET utf8");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $pro_name = $_GET['pro_name'];
    $pro_id = $_GET['pro_id'];

    $sql = "SELECT * FROM products WHERE product_id = '$pro_id'";
    $result = mysqli_query($conn, $sql);
}

function productCountPlus()
{
}
?>

<body>
    <div class="product-page w-100 d-flex flex-column">
        <div class="product-page-head w-100 d-flex justify-content-end">
            <a class="text-reset text-decoration-none m-2" onclick="window.history.go(-1);">
                <i class="fas fa-arrow-circle-left text-black fs-2">
                </i>
            </a>
        </div>
        <div class="product-page-body w-100 h-100 d-flex align-items-center">
            <div class="produc-page-body-container w-100">
                <div class="row d-flex flex-md-row flex-column m-0 p-0 h-100 ">
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);

                    ?>
                        <div class="col-md-5 col">
                            <div class="row m-0 p-0">
                                <div class="col-9">

                                    <div class="product-page-i-c-orginal-image">
                                        <img src="Images/products/<?php echo $row['product_image']; ?>" class="product-lg-img w-100 h-100" alt="">
                                    </div>

                                </div>
                                <div class="col-3">
                                    <div class="product-page-i-c-images h-100 d-flex flex-column align-items-center justify-content-center">
                                        <div class="product-image-card-sm my-2">
                                            <img src="Images/products/<?php echo $row['product_image']; ?>" class="product-sm-img w-100 h-100" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7 col">
                            <div class="row m-0 p-0 w-100 h-100 row-cols-1">
                                <div class="col-12 py-5">
                                    <h1 class="product-page-pro-name"><?php echo $row['product_name']; ?></h1>
                                    <p class="product-page-pro-caption fs-5 mt-2"><?php echo $row['product_desc']; ?></p>
                                </div>
                                <div class="col-12 p-0 d-flex flex-column">
                                    <div class="col my-3 d-flex align-items-end justify-content-md-end justify-content-start">
                                        <span class="fs-3 fw-bold">
                                            <?php echo $row['product_price']; ?>
                                        </span>
                                    </div>
                                    <div class="col mt-auto  d-flex align-items-end justify-content-md-end justify-content-start">
                                        <?php
                                        echo "
                                        <a href='product-proccess.php?pro_name=" . $row["product_name"] . "&pro_id=" . $row["product_id"] . "&pro_image=" .  $row["product_image"] . "&pro_price=" . $row["product_price"] . "' id='btn-product-submit' class='btn btn-outline-dark rounded-0'>
                                            اضافه کردن به سبد
                                        </a>
                                        ";
                                        ?>

                                    </div>
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
    <script src="Js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>