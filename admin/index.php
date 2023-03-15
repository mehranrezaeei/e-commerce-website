<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/main.css">
    <!-- Bootstrap Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.rtl.min.css" integrity="sha384-WJUUqfoMmnfkBLne5uxXj+na/c7sesSJ32gI7GfCk4zO4GthUKhSEGyvQ839BC51" crossorigin="anonymous">
    <title>Document</title>
</head>
<?php
include('../db_c.php');
function cleanUrl()
{
    echo "
    <script>
    const url = window.location.origin + window.location.pathname;

    history.pushState('', '', url);
    </script>
        ";
}
if (isset($_POST['admin-submit'])) {
    $username = $_POST['admin-username'];
    $password = $_POST['admin-password'];
    $sql = "SELECT * FROM admin_users WHERE admin_user_username = '$username' AND admin_user_password= '$password'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
        header('Location: addin-product.php');
        cleanUrl();
        exit();
    } else {
        echo '<h3 class="text-center text-danger">Username Or Password is Wrong !!</h3>';
        cleanUrl();
        header('refresh:3');
        exit();
    }
}
?>

<body>
    <div class="admin-login-cont bg-danger d-flex justify-content-center align-items-center ">
        <form action="" method="POST" class="admin-login-form bg-white rounded-3 py-3 shadow-lg">
            <div class="row m-0 p-0">
                <div class="col-12 d-flex justify-content-center">
                    <h3>پنل ادمین</h3>
                </div>
                <div class="col-12 p-0">
                    <input type="text" name="admin-username" class="form-control rounded-0 border-bottom border-0 py-3 my-2" placeholder="نام کاربری" required>
                </div>
                <div class="col-12 p-0">
                    <input type="password" name="admin-password" class="form-control rounded-0 border-bottom border-0 py-3 my-2" placeholder="رمز عبور" required>
                </div>
                <div class="col-12 p-0 d-flex justify-content-center py-3">
                    <input type="submit" name="admin-submit" class="btn btn-outline-dark px-5" value="ورود">
                </div>
            </div>
        </form>
    </div>


    <script src="js/app.js"></script>
    <!-- Javascript Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>