<?php
$title = "ログイン画面";
$cssLink = "../sass/login.css";
$jsLink = "";
require(realpath("../../models/users.php"));
require(realpath("../../config/dbconnect.php"));

session_name("user");
session_start();

if (!empty($_POST)) {
  $login = $db->prepare('SELECT * FROM users WHERE email=? AND password=?');
  $login->execute(array(
    $_POST['email'],
    sha1($_POST['password'])
  ));
  $user = $login->fetch();

  if ($user) {
    $_SESSION = array();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['password'] = $user['password'];
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
<form action="login.php" method="POST">
  <input type="text" placeholder="mail" name="email">
  <input type="text" placeholder="password" name="password">
  <input type="submit" value="ログイン">
</form>
<?php include("../components/footer.php"); ?>