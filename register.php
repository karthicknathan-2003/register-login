<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--carousel-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!--bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--font-->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
</head>


<?php
$name1 = $_POST['name1'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$cpass = $_POST['cpass'];


if (!empty($name1) && !empty($email) && !empty($pass) && !empty($cpass)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if ($pass === $cpass) {

            $host = "localhost";
            $dbusername = "root";
            $dbpassword = "";
            $dbname = "project";

            $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
            if (mysqli_connect_error()) {
                die('Connect Error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
            } else {
                $SELECT = "SELECT email FROM register WHERE email=? LIMIT 1";
                $INSERT = "INSERT INTO register(name1,email,pass,cpass)values(?,?,?,?)";

                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt, $SELECT);
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $email);
                mysqli_stmt_store_result($stmt);
                $rnum = mysqli_stmt_num_rows($stmt);

                if ($rnum == 0) {
                    mysqli_stmt_prepare($stmt, $INSERT);
                    mysqli_stmt_bind_param($stmt, "ssss", $name1, $email, $pass, $cpass);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success text-center'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <b>Hello " . $name1 . "</b>
            </div>";
                } else {
                    echo "<div class='alert alert-danger text-center'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <b>Someone register using this Email..</b>
                    </div>";
                    header('location:login.html');
                }
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
            }
        } else {
             echo "<div class='alert alert-danger text-center'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <b>Please enter a correct password..</b>
                    </div>";
        }
    } else {
        echo "<div class='alert alert-danger text-center'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <b>Enter a Valid Email...</b>
                    </div>";
    }
} else {
    echo "<div class='alert alert-danger text-center'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <b>All fields are required...</b>
                    </div>";
    die();
}
?>
