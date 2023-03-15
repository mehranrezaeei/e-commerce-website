<!DOCTYPE html>
<html lang="en" dir="rtl">
<?php
include('db_c.php');
mysqli_query($conn, "SET CHARACTER SET utf8");
$sql = 'SELECT DISTINCT cat_gender FROM categories';
$result = mysqli_query($conn, $sql);

$sqlAll = 'SELECT * FROM products';
$resultAll = mysqli_query($conn, $sqlAll);

$cat_gender = $cat_parent = $cat_title = '';
function generateCollapseName($c_g = '', $c_p = '', $c_t = '')
{
    $cat_g = $cat_p = $cat_t = '';
    if ($c_g == 'مردانه') {
        $cat_g = 'men';
    } else if ($c_g == 'زنانه') {
        $cat_g = 'women';
    }
    if ($c_p != '') {
        switch ($c_p) {
            case 'بالاپوش':
                $cat_p = 'topwear';
                break;
            case 'شلوار':
                $cat_p = 'pants';
                break;
            case 'کفش':
                $cat_p = 'shoes';
                break;
            case 'اکسسوری':
                $cat_p = 'accessory';
                break;
            case 'کیف':
                $cat_p = 'bag';
                break;
            default:
                $cat_p = rand(8, 1000);
        }
    }
    if ($c_t != '') {
        switch ($c_t) {
            case 'پیراهن':
                $cat_t = 'shirt';
                break;
            case 'تیشرت':
                $cat_t = 't-shirt';
                break;
            case 'جین':
                $cat_t = 'jean';
                break;
            case 'پارچه ای':
                $cat_t = 'fabric';
                break;
            case 'جا کارتی':
                $cat_t = 'cartbox';
                break;
            case 'دستی':
                $cat_t = 'handbag';
                break;
            case 'مجلسی':
                $cat_t = 'party';
                break;
            default:
                $cat_t = rand(8, 1000);
        }
    }

    return $cat_g . $cat_p . $cat_t . 'collapse';
}

function cleanUrl()
{
    echo "
    <script>
    const url = window.location.origin + window.location.pathname;

    history.pushState('', '', url);
    </script>
        ";
}
?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Logo link -->
    <link rel="icon" href="Images/dalka-logo-black.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.rtl.min.css" integrity="sha384-WJUUqfoMmnfkBLne5uxXj+na/c7sesSJ32gI7GfCk4zO4GthUKhSEGyvQ839BC51" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/all.css">
    <title>صفحه محصولات - دالکا</title>
</head>

<body>
    <!-- This is Navigation Bar & Mega Menu -->
    <div class="top-scroll position-fixed bg-black bottom-0 d-none d-flex justify-content-center align-items-center">
        <i class="fa fas fa-arrow-up text-white"></i>
    </div>
    <!-- This is Navigation Bar & Mega Menu -->
    <nav class="bg-white shadow d-flex align-items-center">
        <div class="container-lg">
            <div class="row row-cols-1 g-4 d-flex align-items-center">
                <!-- Burger Menu -->
                <div class="col-4 borgermenu justify-content-start py-3 d-none align-items-center" data-bs-toggle="offcanvas" data-bs-target="#borgermenucanvas">
                    <i class="fas fa-align-right fa-fw fs-3 borgermenu-icon"></i>
                </div>
                <div class="offcanvas offcanvas-start overflow-y-auto mt-0 text-bg-dark" id="borgermenucanvas">
                    <div class="offcanvas-header justify-content-end">
                        <button class="btn-close btn-close-white" type="button" data-bs-dismiss="offcanvas"></button>
                    </div>
                    <div class="offfcanvas-body">
                        <div class="row row-cols-1">
                            <div class="col mt-3">
                                <div class="btn-group w-100">
                                    <a href="login.php" class="test-session btn text-reset text-decoration-none rounded-0 border-end">ورود</a>
                                    <a href="login.php" class="btn text-reset text-decoration-none rounded-0">ثبت نام</a>
                                </div>
                            </div>
                            <div class="col w-100 d-flex mt-3 flex-column">
                                <ul class="borger-ul-list d-flex flex-column w-100 p-0">
                                    <!-- Men List -->
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($g_row = mysqli_fetch_assoc($result)) {
                                            $cat_gender = $g_row['cat_gender'];

                                    ?>
                                            <li class="d-flex flex-column">
                                                <a class="borger-items py-2 px-2 text-reset text-decoration-none br-li-bor-cu w-100 d-flex align-items-center top-item-borger-list" data-bs-toggle="collapse" data-bs-target="<?php echo '#' . generateCollapseName($cat_gender, '', ''); ?>">
                                                    <?php echo $cat_gender ?>
                                                    <span class="fw-bold fs-4 key-arrow ms-auto">&rsaquo;</span>
                                                </a>
                                                <ul class="borger-sub-items collapse" id="<?php echo generateCollapseName($cat_gender, '', ''); ?>">
                                                    <?php
                                                    $p_sql = "SELECT DISTINCT cat_parent FROM categories WHERE cat_gender = '$cat_gender';";
                                                    $p_result = mysqli_query($conn, $p_sql);

                                                    if (mysqli_num_rows($p_result) > 0) {

                                                        while ($p_row = mysqli_fetch_assoc($p_result)) {
                                                            $cat_parent = $p_row['cat_parent'];


                                                    ?>
                                                            <li class="d-flex flex-column">
                                                                <a class="borger-items py-2 px-2 text-reset text-decoration-none br-li-bor-cu w-100 d-flex align-items-center top-item-borger-list" data-bs-toggle="collapse" data-bs-target="<?php echo '#' . generateCollapseName($cat_gender, $cat_parent, ''); ?> ">
                                                                    <?php echo $cat_parent ?>
                                                                    <span class="fw-bold fs-4 key-arrow ms-auto">&rsaquo;</span>
                                                                </a>
                                                                <ul class="br-2sub-items list-unstyled ps-3 collapse" id="<?php echo generateCollapseName($cat_gender, $cat_parent, ''); ?>">
                                                                    <?php
                                                                    $t_sql = "SELECT DISTINCT cat_title FROM categories WHERE cat_parent = '$cat_parent' AND cat_gender='$cat_gender'";

                                                                    $t_result = mysqli_query($conn, $t_sql);

                                                                    if (mysqli_num_rows($t_result) > 0) {

                                                                        while ($t_row = mysqli_fetch_assoc($t_result)) {
                                                                            $cat_title = $t_row['cat_title'];
                                                                    ?>
                                                                            <li class="d-flex">
                                                                                <?php
                                                                                echo "
                                                                                <a href='products.php?h_burger=&ct_g=" . $cat_gender . "&ct_p=" . $cat_parent . "&ct_t=" . $cat_title . "' class='w-100 py-2 text-reset text-decoration-none'> $cat_title </a>
                                                                                ";
                                                                                ?>

                                                                            </li>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>

                                                                </ul>
                                                            </li>
                                                    <?php
                                                        }
                                                    }
                                                    ?>

                                                </ul>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>

                                </ul>
                                <a href="" class="text-danger text-decoration-none py-3 px-2 br-cu-fs">فروش ویژه</a>
                                <a href="" class="text-reset text-decoration-none py-3 px-2 br-cu-fs">درباره ما</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ---------- -->
                <!-- Burger Menu End -->

                <!-- Mega Menu -->
                <div class="col-4 megamenu d-flex align-items-center justify-content-start overflow-hidden">
                    <?php
                    $sql = 'SELECT DISTINCT cat_gender FROM categories';
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {

                        while ($g_row = mysqli_fetch_assoc($result)) {
                            $cat_gender = $g_row['cat_gender'];

                    ?>
                            <div class="megamenu-container">
                                <div class="megamenu-link py-4 px-3">
                                    <?php
                                    echo "
                                    <a href='products.php?h_mega=&ct_g=" . $cat_gender . "' class='position-relative mg-link text-reset text-decoration-none'> $cat_gender </a>
                                    ";
                                    ?>
                                    <div class="megamenu-ul-menu d-none bg-white position-absolute w-100">
                                        <div class="container bg-white">
                                            <div class="row">
                                                <?php
                                                $p_sql = "SELECT DISTINCT cat_parent FROM categories WHERE cat_gender = '$cat_gender';";
                                                $p_result = mysqli_query($conn, $p_sql);

                                                if (mysqli_num_rows($p_result) > 0) {

                                                    while ($p_row = mysqli_fetch_assoc($p_result)) {
                                                        $cat_parent = $p_row['cat_parent'];

                                                ?>
                                                        <div class="col">
                                                            <ul class="list-unstyled d-flex justify-content-around flex-wrap">
                                                                <li class="megamenu-item">
                                                                    <ul class="list-unstyled my-3 border-start px-4">
                                                                        <li class="mb-3 fw-bold">
                                                                            <?php
                                                                            echo "
                                                                            <a href='products.php?h_mega=&ct_g=" . $cat_gender . "&ct_p=" . $cat_parent . "' class='position-relative text-reset text-decoration-none'> $cat_parent </a>
                                                                            ";
                                                                            ?>
                                                                        </li>
                                                                        <?php
                                                                        $t_sql = "SELECT DISTINCT cat_title FROM categories WHERE cat_parent = '$cat_parent' AND cat_gender='$cat_gender'";

                                                                        $t_result = mysqli_query($conn, $t_sql);

                                                                        if (mysqli_num_rows($t_result) > 0) {

                                                                            while ($t_row = mysqli_fetch_assoc($t_result)) {
                                                                                $cat_title = $t_row['cat_title'];
                                                                        ?>
                                                                                <li class="mb-3">
                                                                                    <?php
                                                                                    echo "
                                                                                    <a href='products.php?h_mega=&ct_g=" . $cat_gender . "&ct_p=" . $cat_parent . "&ct_t=" . $cat_title . "' class='text-reset text-decoration-none'> $cat_title </a>
                                                                                    ";
                                                                                    ?>
                                                                                </li>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>



                                                    <?php
                                                    }

                                                    ?>
                                                    <div class="col-auto d-flex justify-content-end align-items-center">
                                                        <?php
                                                        $mega_pic = '';
                                                        if ($cat_gender == 'مردانه') {
                                                            $mega_pic = 'Images/megamenu-pic-men.jpg';
                                                        } else if ($cat_gender == 'زنانه') {
                                                            $mega_pic = 'Images/megamenu-pic-women.jpg';
                                                        }
                                                        ?>
                                                        <img src="<?php echo $mega_pic ?>" style=" height: 22rem;" class="w-100" alt="">
                                                        <?php

                                                        ?>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    <?php
                        }
                    }
                    ?>

                </div>
                <!-- Mega Menu End-->
                <!-- Logo -->
                <div class="col-4 d-flex justify-content-center nav-padding">
                    <a href="home.php"><img src="images/dalka-logo-black.png" style="width: 32px;" alt=""></a>
                </div>
                <!-- Logo End -->
                <!-- Search Icon & Shopping Icon & User Icon -->
                <div class="col-4 d-flex align-items-center justify-content-end">
                    <i class="far fa-search fa-lg fa-fw curs-point" data-bs-toggle="offcanvas" data-bs-target="#offcanvassearch"></i>
                    <a href="shopping-cart.php" class="text-reset">
                        <i class="far fa-shopping-bag mx-2 fa-lg fa-fw curs-point"></i>
                    </a>
                    <a href="login.php" class="text-reset text-decoration-none pe-lg-0 pe-2">
                        <i class="far fa-user-alt fa-lg fa-fw"></i>
                    </a>
                </div>
                <!-- Search Icon & Shopping Icon & User Icon End -->
            </div>
        </div>
    </nav>

    <!-- Search Full Screen -->
    <div class="search-container offcanvas bg-white w-100 h-100 offcanvas-top" id="offcanvassearch">
        <div class="offcanvas-header">
            <button class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <div class="row d-flex align-items-center justify-content-center w-100 h-100">
                <div class="col-lg-5 col-sm-10 col-12">
                    <form action="" method="POST">
                        <div class="input-group">
                            <input type="text" name="search" id="search-inp" class="form-control" placeholder="کلمه مورد نظر را وارد کنید...">
                            <button type="submit" class="btn btn-outline-dark btn-search btn-lg">
                                <i class="far fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ------------------------- -->
    <!-- This is Header -->
    <header>
        <div class="header-background position-relative">
            <img src="images/header-bg.jpg" class="h-100 w-100" alt="">
        </div>
    </header>

    <section class="p-4">
        <div class="products-header my-4 d-flex align-items-center border-bottom py-3">
            <h5>
                مرتب سازی
                <i class="fas fa-sort-amount-down fs-5"></i>
            </h5>
            <ul class="list-unstyled d-flex text-black m-0 mx-3">
                <li class="mx-2"><a href="#" class="text-reset text-decoration-none">پربازدیدترین</a></li>
                <li class="mx-2"><a href="#" class="text-reset text-decoration-none">جدیدترین</a></li>
                <li class="mx-2"><a href="#" class="text-reset text-decoration-none">پرفروش ترین</a></li>
                <li class="mx-2"><a href="#" class="text-reset text-decoration-none">ارزان ترین</a></li>
                <li class="mx-2"><a href="#" class="text-reset text-decoration-none">گران ترین</a></li>
            </ul>
        </div>
        <div class="products-body">
            <div class="row row-cols-sm-2 row-cols-1 w-100">
                <div class="col-sm-2 my-4 col p-0 position-relative">
                    <div class="pro-filter-container position-sticky top-0 border rounded p-2">
                        <ul class="list-unstyled">
                            <li class="border-bottom my-3">
                                <button class="btn btn-outline-dark d-flex w-100 fs-5 border-0" data-bs-toggle="collapse" data-bs-target="#coll-prod-color">
                                    <span>رنگ</span>
                                    <span class="ms-auto">+</span>
                                </button>
                                <div class="collapse " id="coll-prod-color">
                                    <div class="collapse-products d-flex flex-wrap">
                                        <input type="checkbox" name="color-check" id="check-color-black" class="btn-check" value="black">
                                        <label for="check-color-black" class="bg-black p-3 m-2 rounded"></label>
                                        <input type="checkbox" name="color-check" id="check-color-red" class="btn-check" value="red">
                                        <label for="check-color-red" class="bg-danger p-3 m-2 rounded"></label>
                                        <input type="checkbox" name="color-check" id="check-color-blue" class="btn-check" value="blue">
                                        <label for="check-color-blue" class="bg-info p-3 m-2 rounded"></label>
                                        <input type="checkbox" name="color-check" id="check-color-green" class="btn-check" value="green">
                                        <label for="check-color-green" class="bg-success p-3 m-2 rounded"></label>
                                        <input type="checkbox" name="color-check" id="check-color-grsy" class="btn-check" value="grsy">
                                        <label for="check-color-grsy" class="bg-secondary p-3 m-2 rounded"></label>

                                    </div>
                                </div>
                            </li>
                            <li class="border-bottom my-3">
                                <button class="btn btn-outline-dark d-flex w-100 fs-5 border-0" data-bs-toggle="collapse" data-bs-target="#coll-prod-size">
                                    <span>سایز</span>
                                    <span class="ms-auto">+</span>
                                </button>
                                <div class="collapse " id="coll-prod-size">
                                    <div class="collapse-products d-flex flex-wrap">
                                        <input type="checkbox" name="size-check" id="check-size-small" class="btn-check" value="small">
                                        <label for="check-size-small" class="border p-2 m-2 rounded">S</label>

                                        <input type="checkbox" name="size-check" id="check-size-medium" class="btn-check" value="medium">
                                        <label for="check-size-medium" class="border p-2 m-2 rounded">M</label>

                                        <input type="checkbox" name="size-check" id="check-size-large" class="btn-check" value="large">
                                        <label for="check-size-large" class="border p-2 m-2 rounded">L</label>

                                        <input type="checkbox" name="size-check" id="check-size-xlarge" class="btn-check" value="xlarge">
                                        <label for="check-size-xlarge" class="border p-2 m-2 rounded">XL</label>


                                    </div>
                                </div>
                            </li>
                            <li class="border-bottom my-3">
                                <button class="btn btn-outline-dark d-flex w-100 fs-5 border-0" data-bs-toggle="collapse" data-bs-target="#coll-prod-price">
                                    <span>قیمت</span>
                                    <span class="ms-auto">+</span>
                                </button>
                                <div class="collapse" id="coll-prod-price">
                                    <div class="collapse-products">
                                        <label for="price-min">از</label>
                                        <input type="number" class="form-control my-2 fs-4" min="0" name="product-price-min" id="price-min" placeholder="2000">
                                        <label for="price-min">تا</label>
                                        <input type="number" class="form-control my-2 fs-4" min="0" name="product-price-min" id="price-min" placeholder="2000">
                                    </div>
                                </div>

                            </li>
                            <li class="border-bottom my-3">
                                <button class="btn btn-outline-dark d-flex w-100 fs-5 border-0" data-bs-toggle="collapse" data-bs-target="#coll-prod-brand">
                                    <span>برند</span>
                                    <span class="ms-auto">+</span>
                                </button>
                                <div class="collapse" id="coll-prod-brand">
                                    <div class="collapse-products px-2">
                                        <div class="col d-flex my-2 align-items-center">
                                            <div class="col">
                                                <input type="checkbox" class="form-check-input btn-check-brand" name="" id="check-brand-zara">
                                            </div>
                                            <div class="col d-flex justify-content-end">
                                                <label for="check-brand-zara" class="form-check-label fs-5">Zara</label>

                                            </div>
                                        </div>
                                        <div class="col d-flex my-2 align-items-center">
                                            <div class="col">
                                                <input type="checkbox" class="form-check-input btn-check-brand" name="" id="check-brand-nike">
                                            </div>
                                            <div class="col d-flex justify-content-end">
                                                <label for="check-brand-nike" class="form-check-label fs-5">Nike</label>
                                            </div>
                                        </div>
                                        <div class="col d-flex my-2 align-items-center">
                                            <div class="col">
                                                <input type="checkbox" class="form-check-input btn-check-brand" name="" id="check-brand-gucci">
                                            </div>
                                            <div class="col d-flex justify-content-end">
                                                <label for="check-brand-gucci" class="form-check-label fs-5">Gucci</label>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-10 col">
                    <div class="row">
                        <?php
                        if (isset($_POST['search'])) {
                            $search_value = $_POST['search'];
                            $sql = "SELECT * FROM products WHERE product_name LIKE '%$search_value%'";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                    <div class="col-lg-3 col-md-4 col-sm-6 col">
                                        <div class="c-pro-card">
                                            <?php
                                            echo "
                                            <a href='product.php?pro_name=" . $row["product_name"] . "&pro_id=" . $row['product_id'] . "' class='text-reset text-decoration-none'>
                                            ";
                                            ?>
                                            <div class="c-pro-card-image-content">
                                                <img src="Images/products/<?php echo $row['product_image'] ?>" class="w-100 h-100" alt="">
                                            </div>
                                            <div class="c-pro-card-description d-flex flex-column align-items-center py-1">
                                                <h5><?php echo $row['product_name'] ?></h5>
                                                <div class="d-flex">
                                                    <span>t</span>
                                                    <span class="pro-card-price mx-1">
                                                        <?php echo number_format($row['product_price']); ?>
                                                    </span>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                }
                                cleanUrl();
                            }
                        } else {
                            if (isset($_GET['ct_g']) || isset($_GET['ct_p']) || isset($_GET['ct_t'])) {
                                if (isset($_GET['h_burger'])) {
                                    $ct_g = $_GET['ct_g'];
                                    $ct_p = $_GET['ct_p'];
                                    $ct_t = $_GET['ct_t'];
                                    $sql = "SELECT * FROM products WHERE products.product_cat in(SELECT DISTINCT cat_id FROM categories WHERE cat_gender='$ct_g' AND cat_parent='$ct_p' AND cat_title='$ct_t')";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {

                                    ?>
                                            <div class="col-lg-3 col-md-4 col-sm-6 col">
                                                <div class="c-pro-card">
                                                    <?php
                                                    echo "
                                                        <a href='product.php?pro_name=" . $row["product_name"] . "&pro_id=" . $row['product_id'] . "' class='text-reset text-decoration-none'>
                                                        ";
                                                    ?>

                                                    <div class="c-pro-card-image-content">
                                                        <img src="Images/products/<?php echo $row['product_image'] ?>" class="w-100 h-100" alt="">
                                                    </div>
                                                    <div class="c-pro-card-description d-flex flex-column align-items-center py-1">
                                                        <h5><?php echo $row['product_name'] ?></h5>
                                                        <div class="d-flex">
                                                            <span>t</span>
                                                            <span class="pro-card-price mx-1">
                                                                <?php echo number_format($row['product_price']); ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                    }
                                } else {
                                    if (isset($_GET['ct_g'])) {
                                        $ct_g = $_GET['ct_g'];
                                        if (isset($_GET['ct_g']) && isset($_GET['ct_p'])) {
                                            $ct_p = $_GET['ct_p'];
                                            if (isset($_GET['ct_g']) && isset($_GET['ct_p']) && isset($_GET['ct_t'])) {
                                                $ct_t = $_GET['ct_t'];
                                                $sql = "SELECT * FROM products WHERE products.product_cat in(SELECT DISTINCT cat_id FROM categories WHERE cat_gender='$ct_g' AND cat_parent='$ct_p' AND cat_title='$ct_t')";
                                            } else {
                                                $sql = "SELECT * FROM products WHERE products.product_cat in(SELECT DISTINCT cat_id FROM categories WHERE cat_gender='$ct_g' AND cat_parent='$ct_p')";
                                            }
                                        } else {
                                            $sql = "SELECT * FROM products WHERE products.product_cat in(SELECT DISTINCT cat_id FROM categories WHERE cat_gender='$ct_g')";
                                        }
                                    }
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {

                                        ?>
                                            <div class="col-lg-3 col-md-4 col-sm-6 col">
                                                <div class="c-pro-card">
                                                    <?php
                                                    echo "
                                                        <a href='product.php?pro_name=" . $row["product_name"] . "&pro_id=" . $row['product_id'] . "' class='text-reset text-decoration-none'>
                                                        ";
                                                    ?>

                                                    <div class="c-pro-card-image-content">
                                                        <img src="Images/products/<?php echo $row['product_image'] ?>" class="w-100 h-100" alt="">
                                                    </div>
                                                    <div class="c-pro-card-description d-flex flex-column align-items-center py-1">
                                                        <h5><?php echo $row['product_name'] ?></h5>
                                                        <div class="d-flex">
                                                            <span>t</span>
                                                            <span class="pro-card-price mx-1">
                                                                <?php echo number_format($row['product_price']); ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                    }
                                }
                            } else {
                                if (mysqli_num_rows($resultAll) > 0) {

                                    while ($row = mysqli_fetch_assoc($resultAll)) {

                                        ?>
                                        <div class="col-lg-3 col-md-4 col-sm-6 col">
                                            <div class="c-pro-card">
                                                <?php
                                                echo "
                                                <a href='product.php?pro_name=" . $row["product_name"] . "&pro_id=" . $row['product_id'] . "' class='text-reset text-decoration-none'>
                                                ";
                                                ?>

                                                <div class="c-pro-card-image-content">
                                                    <img src="Images/products/<?php echo $row['product_image'] ?>" class="w-100 h-100" alt="">
                                                </div>
                                                <div class="c-pro-card-description d-flex flex-column align-items-center py-1">
                                                    <h5><?php echo $row['product_name'] ?></h5>
                                                    <div class="d-flex">
                                                        <span>t</span>
                                                        <span class="pro-card-price mx-1">
                                                            <?php echo number_format($row['product_price']); ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                </a>
                                            </div>
                                        </div>

                        <?php
                                    }
                                }
                            }
                        }
                        mysqli_close($conn);
                        ?>


                    </div>
                </div>
            </div>
        </div>
    </section>


    <footer>
        <div class="fotr-contact bg-black">
            <div class="container">
                <div class="row row-cols-1 py-2 justify-content-center align-items-center">
                    <div class="col d-flex align-items-center justify-content-center w-100 py-2">
                        <img src="Images/dalka-logo-white.png" class="" alt="" style="width: 40px;">
                    </div>
                    <div class="col py-2 d-flex align-items-center justify-content-center w-100">
                        <span class="text-white">برای با خبر شدن از جدیدترین خبرها ایمیل خود را وارد کنید</span>
                    </div>
                    <div class="col-lg-6 col-sm-10 col py-2">
                        <div class="input-group">
                            <input type="text" name="email-contact" id="email-contact" class="form-control email-contact rounded-0">
                            <button class="btn btn-outline-light rounded-0 cu-email-btn">اضافه کردن</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="fotr-about-info bg-white">
            <div class="container">
                <div class="row row-cols-1 justify-content-center">
                    <div class="col border-bottom py-3">
                        <div class="row w-100">
                            <div class="col-lg-3 col-6 d-flex justify-content-center ">
                                <ul class="list-unstyled m-3">
                                    <li class="fw-bold fs-5">مردانه</li>
                                    <li class="py-1">
                                        <a href="#" class="text-reset">پیراهن</a>
                                    </li>
                                    <li class="py-1">
                                        <a href="#" class="text-reset">تیشرت</a>
                                    </li>
                                    <li class="py-1">
                                        <a href="#" class="text-reset">شلوار جین</a>
                                    </li>
                                    <li class="py-1">
                                        <a href="#" class="text-reset">کفش مجلسی</a>
                                    </li>
                                    <li class="py-1">
                                        <a href="#" class="text-reset">انگشتر</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-3 col-6 d-flex justify-content-center ">
                                <ul class="list-unstyled m-3">
                                    <li class="fw-bold fs-5">زنانه</li>
                                    <li class="py-1"><a href="#" class="text-reset">تیشرت</a></li>
                                    <li class="py-1"><a href="#" class="text-reset">شلوار پارچه ای</a></li>
                                    <li class="py-1"><a href="#" class="text-reset">کیف دستی</a></li>
                                    <li class="py-1"><a href="#" class="text-reset">کفش کتانی</a></li>
                                    <li class="py-1"><a href="#" class="text-reset">انگشتر</a></li>
                                    <li class="py-1"><a href="#" class="text-reset">شلوار جین</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-3 col-sm-6 d-flex justify-content-center ">
                                <ul class="list-unstyled m-3">
                                    <li class="fw-bold fs-5">ارتباط</li>
                                    <li class="py-1">
                                        <i class="far fa-map"></i>
                                        میدان امام حسین (ع) - ابتدای خیابان دماوند - روبروی خیابان شهید منتظری پلاک 1343
                                        - دانشکده فنی شهید شمسی پور
                                    </li>
                                    <li class="py-1">
                                        <i class="fas fa-phone"></i>
                                        021-77158745
                                    </li>
                                    <li class="py-1">
                                        <a href="about.html" class="text-reset">درباره ما</a>
                                    </li>
                                    <li class="py-1">
                                        <a href="#" class="text-reset">پشتیبانی</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-reset">سوالات متداول</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-3 col-sm-6 d-flex justify-content-center ">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3239.9004130613253!2d51.45241418670436!3d35.70406820092795!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f8e0248182b1fdf%3A0x41b23deefbb9c666!2sShamsipour%20Technical%20and%20Vocational%20College!5e0!3m2!1sen!2sus!4v1676710129792!5m2!1sen!2sus" width="400" height="300" class="location-holder" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row justify-content-center">
                            <div class="col-6 py-3">
                                <ul class="d-flex justify-content-center list-unstyled w-100">
                                    <li class="soci-icon">
                                        <a href="#" class="text-reset p-1 mx-1">
                                            <i class="fab fa-instagram fs-4"></i>
                                        </a>
                                    </li>
                                    <li class="soci-icon">
                                        <a href="#" class="text-reset p-1 mx-1">
                                            <i class="fab fa-twitter fs-4"></i>
                                        </a>
                                    </li>
                                    <li class="soci-icon">
                                        <a href="#" class="text-reset p-1 mx-1">
                                            <i class="fab fa-linkedin fs-4"></i>
                                        </a>
                                    </li>
                                    <li class="soci-icon">
                                        <a href="#" class="text-reset p-1 mx-1">
                                            <i class="fab fa-telegram fs-4"></i>
                                        </a>
                                    </li>
                                    <li class="soci-icon">
                                        <a href="#" class="text-reset p-1 mx-1">
                                            <i class="fab fa-twitch fs-4"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>