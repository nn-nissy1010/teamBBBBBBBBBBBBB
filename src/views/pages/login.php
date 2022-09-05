<?php
$title = "ログイン画面";
$cssLink = "../sass/login.css";
$jsLink = "";
require(realpath("../../models/users.php"));
require(realpath("../../config/dbconnect.php"));

session_name("user");
session_start();

unset($_SESSION['id']);
unset($_SESSION['name']);
unset($_SESSION['email']);
unset($_SESSION['password']);
unset($_SESSION['img_path']);

if (!empty($_POST)) {
  $login = $db->prepare('SELECT * FROM users WHERE email=? AND password=?');
  $login->execute(array(
    $_POST['email'],
    sha1($_POST['password'])
  ));
  $user = $login->fetch();

  if ($user) {
    $_SESSION = array();
    $_SESSION['id'] = $user['id'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['password'] = $user['password'];
    $_SESSION['img_path'] = $user['img_path'];
    $_SESSION['time'] = time();
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/views/pages/top.php");
    exit();
  } else {
    $error = 'fail';
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "Location: /views/pages/login.php");
  }
}

?>
<?php include("../components/header.php"); ?>
<div class="login-wrapper">
  <form  action="login.php" method="POST">
    <input class="email" type="text" placeholder="email" name="email">
    <input class="password" type="text" placeholder="password" name="password">
    <input class="login" type="submit" value="ログイン">
  </form>
  <a href="./createAccount.php" class="create-link">新規作成はこちら</a>
</div>
<?php include("../components/footer.php"); ?>