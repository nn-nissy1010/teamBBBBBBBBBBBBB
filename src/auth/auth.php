<?php
function auth($now_path)
{
    session_name("user");
    session_start();
    if (isset($_GET['btn_logout'])) {
        unset($_SESSION['user_id']);
        unset($_SESSION['time']);
        unset($_SESSION['password']);
    }
    if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
        $_SESSION['time'] = time();
    } else {
        header("Location: http://" . $_SERVER['HTTP_HOST'] . "/views/pages/login.php");
        exit();
    }
}
