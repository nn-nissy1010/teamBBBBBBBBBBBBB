<?php
$title = "ログイン画面";
$cssLink = "../sass/login.css";
$jsLink = "";
require(realpath("../../models/users.php"));
require(realpath("../../config/dbconnect.php"));

if(isset($_POST['email']) && isset($_POST['password'])){
  $email = $_POST['email'];
  $condition = "email = '$email'";
  $emailCheck = loginSearch($db, $condition);
  if($emailCheck == 1){
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $condition = "email = '$email' and password = '$password'";
    $passwordCheck = loginSearch($db, $condition);
    if($passwordCheck == 1){
      header("Location: /views/pages/top.php");
    }
  }else{
    header("Location: /views/pages/login.php");
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