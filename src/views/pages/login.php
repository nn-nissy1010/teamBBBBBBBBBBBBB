<?php
$title = "ログイン画面";
$cssLink = "../sass/login.css";
$jsLink = "";
require(realpath("../../models/users.php"));
require(realpath("../../config/dbconnect.php"));

session_start();

unset($_SESSION['name']);
unset($_SESSION['email']);
unset($_SESSION['password']);
unset($_SESSION['img']);

if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $condition = "email = '$email' and password = '$password'";
    $userInfo = userSearch($db, $condition);
    $loginCheck = count($userInfo);
    if($loginCheck == 1){
      $_SESSION['name'] = $userInfo[0]['name'];
      $_SESSION['email'] = $userInfo[0]['email'];
      $_SESSION['password'] = $userInfo[0]['password'];
      $_SESSION['img'] = $userInfo[0]['img'];
      header("Location: /views/pages/top.php");
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