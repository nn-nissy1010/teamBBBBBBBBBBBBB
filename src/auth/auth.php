<?php
function auth($now_path)
{
    session_name("user");
    session_start();
    if (isset($_GET['btn_logout'])) {
        unset($_SESSION['name']);
        unset($_SESSION['email']);
        unset($_SESSION['password']);
        unset($_SESSION['img_path']);
    }
    if (isset($_SESSION['name']) && isset($_SESSION['email']) && isset($_SESSION['password']) && isset($_SESSION['img_path']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
        $_SESSION['time'] = time();
    } else {
        header("Location: http://" . $_SERVER['HTTP_HOST'] . "/views/pages/login.php");
        exit();
    }
}
