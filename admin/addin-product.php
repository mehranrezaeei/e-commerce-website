<!DOCTYPE html>
<html lang="en" dir="rtl">
<?php
include('../db_c.php');
mysqli_query($conn, "SET CHARACTER SET utf8");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit-btn'])) {
        $pro_name = $_POST['product-name'];
        $pro_cat_g = $_POST['product-cat-gender'];
        $pro_cat_t = $_POST['product-cat-title'];
        $pro_cat = catFind($pro_cat_g, $pro_cat_t);
        $pro_brand = $_POST['product-brand'];
        $pro_price = $_POST['product-price'];
        $pro_desc = $_POST['product-desc'];
        $pro_img =  uploadImage();
        $pro_keywords = $_POST['product-keywords'];
        $sql = "INSERT INTO products (product_cat, product_brand, product_name, product_price, product_desc, product_image, product_keywords) VALUES ('$pro_cat','$pro_brand','$pro_name','$pro_price','$pro_desc','$pro_img','$pro_keywords')";
        if (productUniquCheck($pro_name, $pro_cat, $pro_brand)) {
            if (mysqli_query($conn, $sql)) {
                echo "<h2 class='text-center text-danger'>Row Add To Db</h2>";
                cleanUrl();
                header('refresh:1');
                exit();
            } else {
                echo 'Failed :' . mysqli_error($conn);
                cleanUrl();
            }
        } else {
            header('refresh:0');
            exit();
        }
    }
}

function catFind($c_g, $c_t)
{
    global $conn;
    $sql = "SELECT cat_id FROM categories WHERE cat_gender = '$c_g' AND cat_title = '$c_t'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $cat_id = mysqli_fetch_assoc($result);
        return $cat_id['cat_id'];
    }
}

function uploadImage()
{
    $img_filename = $_FILES['product-image']['name'];
    $img_tempname = $_FILES['product-image']['tmp_name'];

    $fileExt = explode('.', $img_filename);
    $fileActualExt = strtolower(end($fileExt));
    $allowedExt = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowedExt)) {
        $fileNewName = uniqid('', true) . "." . $fileActualExt;
        $folder = '../Images/products/' . $fileNewName;
        move_uploaded_file($img_tempname, $folder);
        return $fileNewName;
    } else {
        echo 'You Can Not Upload This Extension Of File';
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
function productUniquCheck($pro_name, $pro_cat, $pro_brand)
{
    global $conn;
    $sql = "SELECT * FROM products WHERE product_name = '$pro_name' AND product_cat = '$pro_cat' AND product_brand = '$pro_brand'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        return false;
    } else {
        return true;
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Logo link -->
    <link rel="icon" href="Images/dalka-logo-black.png">
    <!-- Css Link -->
    <link rel="stylesheet" href="../Css/main.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.rtl.min.css" integrity="sha384-WJUUqfoMmnfkBLne5uxXj+na/c7sesSJ32gI7GfCk4zO4GthUKhSEGyvQ839BC51" crossorigin="anonymous">
    <title>اضافه کردن محصول - دالکا</title>
</head>

<body>
    <div class="adding-product-db-container w-100 p-5">
        <form action="addin-product.php" method="POST" enctype="multipart/form-data" class="adding-product-form rounded shadow w-100 h-100 bg-light">
            <div class="row w-100 m-0 py-2 justify-content-center">
                <div class="col-md-8 col-11  my-4  d-flex justify-content-center">
                    <h3>اضافه کردن محصول به پایگاه داده</h3>
                </div>
                <div class="col-md-8 col-11  mb-3">
                    <label for="inp-product-name" class="form-label fs-5 mb-2">نام محصول :</label>
                    <input type="text" name="product-name" id="inp-product-name" class="form-control rounded-0">
                </div>
                <div class="col-md-8 col-11  mb-3">
                    <label for="inp-product-cat" class="form-label fs-5 mb-2"> دسته بندی محصول :</label>
                    <div class="d-flex ">
                        <select name="product-cat-gender" id="inp-product-cat" class="form-select mx-2">
                            <?php
                            $cat_sql = 'SELECT DISTINCT cat_gender FROM categories';
                            $cat_result = mysqli_query($conn, $cat_sql);
                            if (mysqli_num_rows($cat_result)) {

                                while ($row = mysqli_fetch_array($cat_result)) {

                            ?>
                                    <option value="<?php echo $row['cat_gender'] ?>"><?php echo $row['cat_gender'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>

                        <select name="product-cat-title" id="inp-product-cat" class="form-select mx-2">
                            <?php
                            $cat_sql = 'SELECT DISTINCT cat_title FROM categories';
                            $cat_result = mysqli_query($conn, $cat_sql);
                            if (mysqli_num_rows($cat_result)) {

                                while ($row = mysqli_fetch_array($cat_result)) {

                            ?>
                                    <option value="<?php echo $row['cat_title'] ?>"><?php echo $row['cat_title'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>

                    </div>
                </div>
                <div class="col-md-8 col-11  mb-3">
                    <label for="inp-product-brand" class="form-label fs-5 mb-2">برند محصول :</label>
                    <input type="text" name="product-brand" id="inp-product-brand" class="form-control rounded-0">
                </div>
                <div class="col-md-8 col-11  mb-3">
                    <label for="inp-product-price" class="form-label fs-5 mb-2">قیمت محصول :</label>
                    <input type="number" name="product-price" id="inp-product-price" class="form-control rounded-0">
                </div>
                <div class="col-md-8 col-11  mb-3">
                    <label for="inp-product-desc" class="form-label fs-5 mb-2">توضیحات محصول :</label>
                    <textarea name="product-desc" class="form-control" id="" rows="3"></textarea>
                </div>
                <div class="col-md-8 col-11  mb-3">
                    <label for="inp-product-image" class="form-label fs-5 mb-2">تصویر محصول :</label>
                    <input type="file" name="product-image" id="inp-product-image" class="form-control rounded-0">
                </div>
                <div class="col-md-8 col-11  mb-3">
                    <label for="inp-product-keywords" class="form-label fs-5 mb-2">کلمات کلیدی محصول :</label>
                    <input type="text" name="product-keywords" id="inp-product-keywords" class="form-control rounded-0">
                </div>
                <div class="col-md-8 col-11  mb-3 d-flex justify-content-center">
                    <input type="submit" value="اضافه کردن" name="submit-btn" class="btn px-5 py-2 btn-outline-danger  rounded-0">
                </div>
            </div>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>

</html>