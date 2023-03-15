<!DOCTYPE html>
<html lang="en" dir="rtl">
<?php
include('db_c.php');
mysqli_query($conn, "SET CHARACTER SET utf8");
$sql = 'SELECT DISTINCT cat_gender FROM categories';
$result = mysqli_query($conn, $sql);
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

function checkUniquEmailNews($data)
{
    global $conn;
    $sql = "SELECT * FROM usersemail_news WHERE email='$data'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
        return false;
    } else {
        return true;
    }
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
    <!-- Css Link -->
    <link rel="stylesheet" href="Css/main.css">
    <!-- Fontawesome Link -->
    <link rel="stylesheet" href="Css/all.css">
    <!-- Bootstrap Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.rtl.min.css" integrity="sha384-WJUUqfoMmnfkBLne5uxXj+na/c7sesSJ32gI7GfCk4zO4GthUKhSEGyvQ839BC51" crossorigin="anonymous">
    <title>فروشگاه لباس زنانه و مردانه - دالکا</title>
</head>

<body class="position-relative ">
    <!-- Scroll To Top -->
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
                    <form action="" method="GET">
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
        <div class="header-qoute d-flex justify-content-center align-items-center en-font">
            <p class="w-50">Style is the only thing you can’t buy. It’s not in a shopping bag, a label, or a price tag.
                It’s
                something reflected from our soul to the outside world—an emotion.</p>
        </div>
    </header>
    <!-- Header Ends -->

    <!-- This is Section of Page That We Put Content In it -->
    <section>
        <!-- This is Whre i put Discount Carousel In it  -->
        <div class="caro-sec-part">
            <div class="container-lg">
                <h1 class="text-center py-3">پیشنهاد شگفت انگیز</h1>
                <div id="carouselExampleIndicators" class="carousel carousel-dark slide" data-bs-touch="true">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active bg-black caro-ind-btns" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" class="bg-black caro-ind-btns" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" class="bg-black caro-ind-btns" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" class="bg-black caro-ind-btns" aria-label="Slide 4"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="caro-items-h w-100 d-flex justify-content-between">
                                <div class="pro-disc-card position-relative">
                                    <div class="image-content h-100">
                                        <img src="Images/Exported/pic-1.jpg" class="image-disc w-100 h-100" alt="">
                                    </div>
                                    <div class="desc-content position-absolute bottom-0 bg-white w-100 h-25">
                                        <div class="row flex-column h-100 w-100 m-0 p-0">
                                            <div class="col">
                                                <div class="row p-0 m-0 d-flex">
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="real-price fs-1-7">27,000</span>
                                                    </div>
                                                    <div class="col d-flex justify-content-center p-0">
                                                        <span class="disc-num bg-black text-white px-1 py-3">25%</span>
                                                    </div>
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="disc-price text-decoration-line-through fs-1-7">30,000</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col disc-add-card d-none justify-content-center align-items-center">
                                                <button class="btn btn-outline-danger fs-3">Add To Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-disc-card position-relative d-sm-block d-none">
                                    <div class="image-content h-100">
                                        <img src="Images/Exported/pic-1.jpg" class="image-disc w-100 h-100" alt="">
                                    </div>
                                    <div class="desc-content position-absolute bottom-0 bg-white w-100 h-25">
                                        <div class="row flex-column h-100 w-100 m-0 p-0">
                                            <div class="col">
                                                <div class="row p-0 m-0 d-flex">
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="real-price fs-1-7">27,000</span>
                                                    </div>
                                                    <div class="col d-flex justify-content-center p-0">
                                                        <span class="disc-num bg-black text-white px-1 py-3">25%</span>
                                                    </div>
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="disc-price text-decoration-line-through fs-1-7">30,000</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col disc-add-card d-none justify-content-center align-items-center">
                                                <button class="btn btn-outline-danger fs-3">Add To Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-disc-card position-relative d-md-block d-none">
                                    <div class="image-content h-100">
                                        <img src="Images/Exported/pic-1.jpg" class="image-disc w-100 h-100" alt="">
                                    </div>
                                    <div class="desc-content position-absolute bottom-0 bg-white w-100 h-25">
                                        <div class="row flex-column h-100 w-100 m-0 p-0">
                                            <div class="col">
                                                <div class="row p-0 m-0 d-flex">
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="real-price fs-1-7">27,000</span>
                                                    </div>
                                                    <div class="col d-flex justify-content-center p-0">
                                                        <span class="disc-num bg-black text-white px-1 py-3">25%</span>
                                                    </div>
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="disc-price text-decoration-line-through fs-1-7">30,000</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col disc-add-card d-none justify-content-center align-items-center">
                                                <button class="btn btn-outline-danger fs-3">Add To Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-disc-card position-relative d-lg-block d-none">
                                    <div class="image-content h-100">
                                        <img src="Images/Exported/pic-1.jpg" class="image-disc w-100 h-100" alt="">
                                    </div>
                                    <div class="desc-content position-absolute bottom-0 bg-white w-100 h-25">
                                        <div class="row flex-column h-100 w-100 m-0 p-0">
                                            <div class="col">
                                                <div class="row p-0 m-0 d-flex">
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="real-price fs-1-7">27,000</span>
                                                    </div>
                                                    <div class="col d-flex justify-content-center p-0">
                                                        <span class="disc-num bg-black text-white px-1 py-3">25%</span>
                                                    </div>
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="disc-price text-decoration-line-through fs-1-7">30,000</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col disc-add-card d-none justify-content-center align-items-center">
                                                <button class="btn btn-outline-danger fs-3">Add To Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item ">
                            <div class="caro-items-h w-100 d-flex justify-content-between">
                                <div class="pro-disc-card position-relative">
                                    <div class="image-content h-100">
                                        <img src="Images/Exported/pic-2.jpg" class="image-disc w-100 h-100" alt="">
                                    </div>
                                    <div class="desc-content position-absolute bottom-0 bg-white w-100 h-25">
                                        <div class="row flex-column h-100 w-100 m-0 p-0">
                                            <div class="col">
                                                <div class="row p-0 m-0 d-flex">
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="real-price fs-1-7">27,000</span>
                                                    </div>
                                                    <div class="col d-flex justify-content-center p-0">
                                                        <span class="disc-num bg-black text-white px-1 py-3">25%</span>
                                                    </div>
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="disc-price text-decoration-line-through fs-1-7">30,000</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col disc-add-card d-none justify-content-center align-items-center">
                                                <button class="btn btn-outline-danger fs-3">Add To Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-disc-card position-relative d-sm-block d-none">
                                    <div class="image-content h-100">
                                        <img src="Images/Exported/pic-2.jpg" class="image-disc w-100 h-100" alt="">
                                    </div>
                                    <div class="desc-content position-absolute bottom-0 bg-white w-100 h-25">
                                        <div class="row flex-column h-100 w-100 m-0 p-0">
                                            <div class="col">
                                                <div class="row p-0 m-0 d-flex">
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="real-price fs-1-7">27,000</span>
                                                    </div>
                                                    <div class="col d-flex justify-content-center p-0">
                                                        <span class="disc-num bg-black text-white px-1 py-3">25%</span>
                                                    </div>
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="disc-price text-decoration-line-through fs-1-7">30,000</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col disc-add-card d-none justify-content-center align-items-center">
                                                <button class="btn btn-outline-danger fs-3">Add To Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-disc-card position-relative d-md-block d-none">
                                    <div class="image-content h-100">
                                        <img src="Images/Exported/pic-2.jpg" class="image-disc w-100 h-100" alt="">
                                    </div>
                                    <div class="desc-content position-absolute bottom-0 bg-white w-100 h-25">
                                        <div class="row flex-column h-100 w-100 m-0 p-0">
                                            <div class="col">
                                                <div class="row p-0 m-0 d-flex">
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="real-price fs-1-7">27,000</span>
                                                    </div>
                                                    <div class="col d-flex justify-content-center p-0">
                                                        <span class="disc-num bg-black text-white px-1 py-3">25%</span>
                                                    </div>
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="disc-price text-decoration-line-through fs-1-7">30,000</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col disc-add-card d-none justify-content-center align-items-center">
                                                <button class="btn btn-outline-danger fs-3">Add To Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-disc-card position-relative d-lg-block d-none">
                                    <div class="image-content h-100">
                                        <img src="Images/Exported/pic-2.jpg" class="image-disc w-100 h-100" alt="">
                                    </div>
                                    <div class="desc-content position-absolute bottom-0 bg-white w-100 h-25">
                                        <div class="row flex-column h-100 w-100 m-0 p-0">
                                            <div class="col">
                                                <div class="row p-0 m-0 d-flex">
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="real-price fs-1-7">27,000</span>
                                                    </div>
                                                    <div class="col d-flex justify-content-center p-0">
                                                        <span class="disc-num bg-black text-white px-1 py-3">25%</span>
                                                    </div>
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="disc-price text-decoration-line-through fs-1-7">30,000</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col disc-add-card d-none justify-content-center align-items-center">
                                                <button class="btn btn-outline-danger fs-3">Add To Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="carousel-item ">
                            <div class="caro-items-h w-100 d-flex justify-content-between">
                                <div class="pro-disc-card position-relative">
                                    <div class="image-content h-100">
                                        <img src="Images/Exported/pic-4.jpg" class="image-disc w-100 h-100" alt="">
                                    </div>
                                    <div class="desc-content position-absolute bottom-0 bg-white w-100 h-25">
                                        <div class="row flex-column h-100 w-100 m-0 p-0">
                                            <div class="col">
                                                <div class="row p-0 m-0 d-flex">
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="real-price fs-1-7">27,000</span>
                                                    </div>
                                                    <div class="col d-flex justify-content-center p-0">
                                                        <span class="disc-num bg-black text-white px-1 py-3">25%</span>
                                                    </div>
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="disc-price text-decoration-line-through fs-1-7">30,000</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col disc-add-card d-none justify-content-center align-items-center">
                                                <button class="btn btn-outline-danger fs-3">Add To Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-disc-card position-relative d-sm-block d-none">
                                    <div class="image-content h-100">
                                        <img src="Images/Exported/pic-4.jpg" class="image-disc w-100 h-100" alt="">
                                    </div>
                                    <div class="desc-content position-absolute bottom-0 bg-white w-100 h-25">
                                        <div class="row flex-column h-100 w-100 m-0 p-0">
                                            <div class="col">
                                                <div class="row p-0 m-0 d-flex">
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="real-price fs-1-7">27,000</span>
                                                    </div>
                                                    <div class="col d-flex justify-content-center p-0">
                                                        <span class="disc-num bg-black text-white px-1 py-3">25%</span>
                                                    </div>
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="disc-price text-decoration-line-through fs-1-7">30,000</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col disc-add-card d-none justify-content-center align-items-center">
                                                <button class="btn btn-outline-danger fs-3">Add To Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-disc-card position-relative d-md-block d-none">
                                    <div class="image-content h-100">
                                        <img src="Images/Exported/pic-4.jpg" class="image-disc w-100 h-100" alt="">
                                    </div>
                                    <div class="desc-content position-absolute bottom-0 bg-white w-100 h-25">
                                        <div class="row flex-column h-100 w-100 m-0 p-0">
                                            <div class="col">
                                                <div class="row p-0 m-0 d-flex">
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="real-price fs-1-7">27,000</span>
                                                    </div>
                                                    <div class="col d-flex justify-content-center p-0">
                                                        <span class="disc-num bg-black text-white px-1 py-3">25%</span>
                                                    </div>
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="disc-price text-decoration-line-through fs-1-7">30,000</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col disc-add-card d-none justify-content-center align-items-center">
                                                <button class="btn btn-outline-danger fs-3">Add To Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-disc-card position-relative d-lg-block d-none">
                                    <div class="image-content h-100">
                                        <img src="Images/Exported/pic-4.jpg" class="image-disc w-100 h-100" alt="">
                                    </div>
                                    <div class="desc-content position-absolute bottom-0 bg-white w-100 h-25">
                                        <div class="row flex-column h-100 w-100 m-0 p-0">
                                            <div class="col">
                                                <div class="row p-0 m-0 d-flex">
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="real-price fs-1-7">27,000</span>
                                                    </div>
                                                    <div class="col d-flex justify-content-center p-0">
                                                        <span class="disc-num bg-black text-white px-1 py-3">25%</span>
                                                    </div>
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="disc-price text-decoration-line-through fs-1-7">30,000</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col disc-add-card d-none justify-content-center align-items-center">
                                                <button class="btn btn-outline-danger fs-3">Add To Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="carousel-item ">
                            <div class="caro-items-h w-100 d-flex justify-content-between">
                                <div class="pro-disc-card position-relative">
                                    <div class="image-content h-100">
                                        <img src="Images/Exported/pic-3.jpg" class="image-disc w-100 h-100" alt="">
                                    </div>
                                    <div class="desc-content position-absolute bottom-0 bg-white w-100 h-25">
                                        <div class="row flex-column h-100 w-100 m-0 p-0">
                                            <div class="col">
                                                <div class="row p-0 m-0 d-flex">
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="real-price fs-1-7">27,000</span>
                                                    </div>
                                                    <div class="col d-flex justify-content-center p-0">
                                                        <span class="disc-num bg-black text-white px-1 py-3">25%</span>
                                                    </div>
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="disc-price text-decoration-line-through fs-1-7">30,000</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col disc-add-card d-none justify-content-center align-items-center">
                                                <button class="btn btn-outline-danger fs-3">Add To Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-disc-card position-relative d-sm-block d-none">
                                    <div class="image-content h-100">
                                        <img src="Images/Exported/pic-3.jpg" class="image-disc w-100 h-100" alt="">
                                    </div>
                                    <div class="desc-content position-absolute bottom-0 bg-white w-100 h-25">
                                        <div class="row flex-column h-100 w-100 m-0 p-0">
                                            <div class="col">
                                                <div class="row p-0 m-0 d-flex">
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="real-price fs-1-7">27,000</span>
                                                    </div>
                                                    <div class="col d-flex justify-content-center p-0">
                                                        <span class="disc-num bg-black text-white px-1 py-3">25%</span>
                                                    </div>
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="disc-price text-decoration-line-through fs-1-7">30,000</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col disc-add-card d-none justify-content-center align-items-center">
                                                <button class="btn btn-outline-danger fs-3">Add To Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-disc-card position-relative d-md-block d-none">
                                    <div class="image-content h-100">
                                        <img src="Images/Exported/pic-3.jpg" class="image-disc w-100 h-100" alt="">
                                    </div>
                                    <div class="desc-content position-absolute bottom-0 bg-white w-100 h-25">
                                        <div class="row flex-column h-100 w-100 m-0 p-0">
                                            <div class="col">
                                                <div class="row p-0 m-0 d-flex">
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="real-price fs-1-7">27,000</span>
                                                    </div>
                                                    <div class="col d-flex justify-content-center p-0">
                                                        <span class="disc-num bg-black text-white px-1 py-3">25%</span>
                                                    </div>
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="disc-price text-decoration-line-through fs-1-7">30,000</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col disc-add-card d-none justify-content-center align-items-center">
                                                <button class="btn btn-outline-danger fs-3">Add To Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-disc-card position-relative d-lg-block d-none">
                                    <div class="image-content h-100">
                                        <img src="Images/Exported/pic-3.jpg" class="image-disc w-100 h-100" alt="">
                                    </div>
                                    <div class="desc-content position-absolute bottom-0 bg-white w-100 h-25">
                                        <div class="row flex-column h-100 w-100 m-0 p-0">
                                            <div class="col">
                                                <div class="row p-0 m-0 d-flex">
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="real-price fs-1-7">27,000</span>
                                                    </div>
                                                    <div class="col d-flex justify-content-center p-0">
                                                        <span class="disc-num bg-black text-white px-1 py-3">25%</span>
                                                    </div>
                                                    <div class="col d-flex align-items-center text-center">
                                                        <span class="disc-price text-decoration-line-through fs-1-7">30,000</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col disc-add-card d-none justify-content-center align-items-center">
                                                <button class="btn btn-outline-danger fs-3">Add To Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </button>
                    <button class="carousel-control-next " type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </button>
                </div>
            </div>

        </div>
        <!-- --------------------------------------- -->
        <!-- I Put the Video int this Part -->
        <div class="sec-video w-100">
            <video class="w-100 h-100" autoplay loop muted>
                <source src="video/videoplayback (1).webm" type="video/webm">
                <source src="video/SAINT LAURENT - MEN'S SPRING SUMMER 2021.mp4" type="video/mp4">
            </video>
        </div>
        <!-- --------------------- -->

        <!-- This is Men And Women Addvertising  -->
        <div class="sec-part3">
            <div class="sec-mw-add">
                <div class="row p-0 m-0 d-flex">
                    <div class="col-md-6 order-md-1 order-2 p-5 m-0">
                        <h2 class="sec-men-header pb-2">لباس مردانه</h2>
                        <span class="sec-men-qoute fs-5">
                            مد امروزه در دنیا بسیار مهم است. مد تقویت‌کننده زندگی است و مانند همه چیز که احساس رضایت
                            می‌دهد ارزش این را دارد که خوب انجامش دهیم.
                        </span>
                    </div>
                    <div class="col-md-6 order-1 sec-img-holder p-0 m-0 position-relative">
                        <img src="Images/featured-image-Sean-OPry.jpg" class="w-100 h-100" alt="">
                        <div class="img-description position-absolute bottom-0 end-0 p-3 text-white d-flex flex-column">
                            <span class="sec-img-desc fs-5 py-2">کم بخر ولی با کیفیت بخر</span>
                            <a href="products.php" class="btn btn-outline-light rounded-0">نمایش</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="sec-part3 mb-250">
            <div class="sec-mw-add">
                <div class="row p-0 m-0">
                    <div class="col-md-6 sec-img-holder p-0 m-0 position-relative">
                        <img src="Images/102054-kendall-jenner-beauty-photo-5k.jpg" class="w-100 h-100" alt="">
                        <div class="img-description position-absolute bottom-0 start-0 p-3 text-white d-flex flex-column">
                            <span class="sec-img-desc fs-5 py-2">کم بخر ولی با کیفیت بخر</span>
                            <a href="products.php" class="btn btn-outline-light rounded-0">نمایش</a>
                        </div>
                    </div>

                    <div class="col-md-6 p-5 m-0">
                        <h2 class="sec-men-header pb-2">لباس زنانه</h2>
                        <span class="sec-men-qoute fs-5">
                            مد امروزه در دنیا بسیار مهم است. مد تقویت‌کننده زندگی است و مانند همه چیز که احساس رضایت
                            می‌دهد ارزش این را دارد که خوب انجامش دهیم.
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- End OF Men And Women Addvertising  -->


        <!--  in this part i add Some Products -->
        <div class="sec-firstp-products h-100 overflow-hidden">
            <div class="sec-moving-letter overflow-hidden position-relative">
                <span class="sml-text py-2 d-flex justify-content-center ">
                    <span class="px-2">تخفیفات ویژه 70%</span>
                    <span class="px-2">تیشرت</span>
                    <span class="px-2">پیراهن</span>
                    <span class="px-2">شلوار</span>
                    <span class="px-2">کفش</span>
                    <span class="px-2">کیف</span>
                    <span class="px-2">تخفیفات ویژه 10%</span>
                </span>
                <div class="mov-anim position-absolute top-0 w-25 h-100"></div>
            </div>
            <div class="row p-0 my-4 mx-0 h-100 w-100 gy-5">
                <?php
                $sql = "SELECT * FROM products,products_discount WHERE product_id = disc_product_id;";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <?php
                            echo "
                            <a href='product.php?pro_name=" . $row["product_name"] . "&pro_id=" . $row['product_id'] . "' class='text-reset text-decoration-none'>
                            ";
                            ?>
                            <div class="c-card">
                                <div class="c-card-image position-relative overflow-hidden">
                                    <img src="Images/products/<?php echo $row['product_image'] ?>" class="w-100 h-100" alt="">
                                </div>
                                <div class="c-card-content">
                                    <div class="card-c-name d-flex justify-content-center py-1">
                                        <span class="card-product-name fs-5 fw-light"><?php echo $row['product_name'] ?></span>
                                    </div>
                                    <div class="card-c-info d-flex align-items-center">
                                        <div class="card-size-color-holder d-flex align-items-center">
                                            <div class="card-color bg-green px-2 py-2 mx-1"></div>
                                            <div class="card-color bg-navy px-2 py-2 mx-1"></div>
                                            <div class="card-color bg-black px-2 py-2 mx-1"></div>
                                            <div class="span card-size py-1 px-2 mx-1 border">L</div>
                                            <div class="span card-size py-1 px-2 mx-1 border">XL</div>
                                        </div>
                                        <span class="card-c-price ms-auto px-2 fs-1-8 fw-light"><?php echo $row['disc_disc_price'] ?></span>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>

                <?php
                    }
                }
                ?>



            </div>

    </section>
    <!-- Section Ends -->

    <!-- Fotter Codes Start From Here -->

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
                        <form action="" method="POST">
                            <div class="input-group">
                                <input type="text" name="email-contact" id="inp-email-contact" class="form-control email-contact rounded-0">
                                <input type="submit" name="add-email-contact" class="btn btn-outline-light rounded-0 cu-email-btn" value="اضافه کردن">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST['add-email-contact'])) {
            $emailnews = $_POST['email-contact'];
            if (checkUniquEmailNews($emailnews)) {
                $sql = "INSERT INTO usersemail_news(email) VALUES('$emailnews')";
                if (mysqli_query($conn, $sql)) {
                    echo 'hello';
                    echo "
                    <script>alert('Your Email Add To Our DataBase')</script>
                    ";
                }
                cleanUrl();
            } else {
                echo '
                    <script>alert("Your Email Already Added !!")</script>
                    ';
                cleanUrl();
            }
        }
        ?>
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
    <!-- Fotter Codes Ends Here -->


    <script src="js/app.js"></script>
    <!-- Javascript Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>