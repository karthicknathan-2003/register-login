<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--carousel-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
    <!--bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--font-->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
</head>


<?php

$email = $_POST['email'];
$pass1 = $_POST['pass1'];

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "project";

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
    die("Failed to connect:" . $conn->connect_error);
} else {
    $stmt = mysqli_stmt_init($conn);
    $SELECT = "SELECT * FROM register WHERE email=?";
    mysqli_stmt_prepare($stmt, $SELECT);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $stmt_result = mysqli_stmt_get_result($stmt);
    if (!empty($email) || !empty($pass1)) {

        if ($stmt_result->num_rows > 0) {
            $data = mysqli_fetch_assoc($stmt_result);
            if ($data['pass'] === $pass1) {
                echo "<div class='alert alert-success text-center'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <b>Welcome Back...</b>
                </div>";
            } else {
                echo "<div class='alert alert-danger text-center'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <b>Wrong Password...</b>
                </div>";
            }
        } else {
            echo "<div class='alert alert-danger text-center'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <b>Invalid Email or Password...</b>
                </div>";
        }
    } else {
        echo "<div class='alert alert-danger text-center'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <b>All fields are Required...</b>
                </div>";
    }
}
