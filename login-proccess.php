<?php
include('db_c.php');
$username = $password = '';

if ($_GET['formname'] === 'login') {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $username = inpVlidate($_POST["username"]);
        $password = inpVlidate($_POST["password"]);

        $sql = "SELECT * FROM users WHERE user_username = '$username' AND user_password = '$password'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo '
                <h1 style="text-align: center;background-color: tomato;marging-top: 80px">Wellcome Your Logged In</h1>
                ';
            header('refresh:5;url=home.php');
            exit();
        } else {
            header("Location: login.php");
            exit();
        }
    } else {
        header("Location: login.php");
        exit();
    }
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fname = inpVlidate($_POST['firstname']);
        $lname = inpVlidate($_POST['lastname']);
        $username = inpVlidate($_POST['username']);
        $password = inpVlidate($_POST['password']);

        if (uniqueCheck($username, $conn)) {
            $sql = "INSERT INTO users (user_firstname,user_lastname,user_username,user_password) 
            VALUES ('$fname', '$lname', '$username', '$password')";

            if (mysqli_query($conn, $sql)) {
                echo '
                <h1 style="text-align: center;background-color: tomato;marging-top: 80px">New Record ADD</h1>
                ';
                header('refresh:5;url=home.php');
                exit();
            } else {
                echo 'Error:' . $sql . '</br>' . mysqli_error($conn);
            }
        }
    }
}

function uniqueCheck($user, $conn)
{
    $sql = "SELECT user_username FROM users WHERE user_username='$user'";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        header('Location: login.php?error=Username Exist Try Somthing Else');
        exit();
    } else {
        return true;
    }
}
function inpVlidate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

mysqli_close($conn);
