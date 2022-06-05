<?php

session_start();

if ((!isset($_POST['uname'])) || (!isset($_POST['pword']))){
    header("Location: /");
    exit();
}

$login = $_POST["uname"];
$password = $_POST["pword"];

if (($login == "hubert" and $password == "123") or ($login == "hubert1" and $password == "1234")){

    $_SESSION['username'] = $login;
    $_SESSION['password'] = $password;

    header("Location: /profile");
} else {
    $_SESSION['error'] = "<span style='color: red'>Incorrect password</span>";
    header("Location: /login");
}

