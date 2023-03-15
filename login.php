<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Logo link -->
    <link rel="icon" href="Images/dalka-logo-black.png">
    <!-- Bootstrap Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.rtl.min.css" integrity="sha384-WJUUqfoMmnfkBLne5uxXj+na/c7sesSJ32gI7GfCk4zO4GthUKhSEGyvQ839BC51" crossorigin="anonymous">
    <!-- Css Link -->
    <link rel="stylesheet" href="css/main.css">
    <!-- Fontawesome Link -->
    <link rel="stylesheet" href="css/all.css">
    <title>صفحه ورود و ثبت نام - دالکا</title>
</head>

<body>
    <div class="login-cont d-flex justify-content-center align-items-center">

        <div class="login-form-container bg-white rounded-2 shadow p-2">
            <div class="row p-0 m-0 w-100 h-100">
                <div class="col-lg-6 col-md-7 p-0 m-0 h-100 d-flex align-items-center">
                    <div class="logsign-form w-100 h-100">
                        <div class="logsign-toggle-head d-flex justify-content-center align-items-center">
                            <div class="logsign-toggle-holder d-flex justify-content-center align-items-center p-1">
                                <button class="login-toggle-btn toggle-btns toggle-btn-active border-0 p-3">ورود</button>
                                <button class="register-toggle-btn toggle-btns border-0 p-3">ثبت نام</button>
                            </div>
                        </div>
                        <div class="logsign-forms-holder w-100">
                            <form action="login-proccess.php?formname=login" method="POST" class="login-form h-100 d-none form-active align-items-center">
                                <div class="row row-cols-1 w-100 d-flex justify-content-center">
                                    <div class="col-8 px-0 login-inps d-flex align-items-center">
                                        <i class="fas fa-user-alt fs-5"></i>
                                        <input type="text" name="username" id="inp-username" class="border-0 bg-transparent w-100 h-100 px-2" placeholder="نام کاربری">
                                    </div>
                                    <div class="col-8 px-0 login-inps mt-4 d-flex align-items-center">
                                        <i class="fas fa-lock fs-5"></i>
                                        <input type="text" name="password" id="inp-password" class="border-0 bg-transparent w-100 h-100 px-2" placeholder="کلمه عبور">
                                    </div>
                                    <div class="col-8 px-0 mt-4 d-flex align-items-center">
                                        <input type="submit" id="inp-login-submit" class="btn btn-outline-dark w-100 rounded-0" value="ورود">
                                    </div>
                                </div>
                            </form>
                            <form action="login-proccess.php?formname=register" method="POST" class="register-form h-100 d-none align-items-center">
                                <div class="row row-cols-1 w-100 d-flex justify-content-center">
                                    <div class="col-8 px-0">
                                        <div class="row w-100 h-100 m-0 p-0">
                                            <div class="col-6 login-inps">
                                                <input type="text" name="firstname" class="border-0 bg-transparent" id="inp-firstname" placeholder="نام">

                                            </div>
                                            <div class="col-6 login-inps">
                                                <input type="text" name="lastname" class="border-0 bg-transparent" id="inp-lastname" placeholder="نام خانوادگی">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-8 px-0 login-inps mt-4 d-flex align-items-center">
                                        <input type="text" name="username" id="inp-username" class="border-0 bg-transparent w-100 h-100 px-2" placeholder="نام کاربری">
                                    </div>
                                    <div class="col-8 px-0 login-inps mt-4 d-flex align-items-center">
                                        <input type="text" name="password" id="inp-password" class="border-0 bg-transparent w-100 h-100 px-2" placeholder="کلمه عبور">
                                    </div>
                                    <div class="col-8 px-0 login-inps mt-4 d-flex align-items-center">
                                        <input type="text" name="re-password" id="inp-re-password" class="border-0 bg-transparent w-100 h-100 px-2" placeholder="تکرار - کلمه عبور">
                                    </div>
                                    <div class="col-8 px-0 mt-4 d-flex align-items-center">
                                        <input type="submit" id="inp-register-submit" class="btn btn-outline-dark w-100 rounded-0" value="ثبت نام">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5 d-md-block d-none p-0 m-0 h-100">
                    <img src="images/bg-9.jpg" class="login-bg-image w-100 h-100 rounded-end-2" alt="">
                </div>
            </div>
        </div>
    </div>

    <script src="js/app.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>

</html>