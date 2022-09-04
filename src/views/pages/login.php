<?php
$title = "ログイン画面";
$cssLink = "../sass/login.css";
$jsLink = "";
require(realpath("../../models/users.php"));
require(realpath("../../config/dbconnect.php"));

// if(isset($_POST['email']) && isset($_POST['password'])){
//   $email = $_POST['email'];
//   $condition = "email = '$email'";
//   $emailCheck = loginSearch($db, $condition);
//   if($emailCheck == 1){
//     $email = $_POST['email'];
//     $password = sha1($_POST['password']);
//     $condition = "email = '$email' and password = '$password'";
//     $passwordCheck = loginSearch($db, $condition);
//     if($passwordCheck == 1){
//       header("Location: /views/pages/top.php");
//     }
//   }else{
//     header("Location: /views/pages/login.php");
//   }
// }

// session_name("user");
// session_start();

// if (!empty($_POST)) {
//   $login = $db->prepare('SELECT * FROM users WHERE email=? AND password=?');
//   $login->execute(array(
//     $_POST['email'],
//     sha1($_POST['password'])
//   ));
//   $user = $login->fetch();

//   if ($user) {
//     $_SESSION = array();
//     $_SESSION['user_id'] = $user['id'];
//     $_SESSION['password'] = $user['password'];
//     $_SESSION['time'] = time();
//     header("Location: http://" . $_SERVER['HTTP_HOST'] . "/views/pages/top.php");
//     exit();
//   } else {
//     $error = 'fail';
//     header("Location: http://" . $_SERVER['HTTP_HOST'] . "Location: /views/pages/login.php");
//   }
// }
?>
<?php include("../components/header.php"); ?>
<form action="login.php" method="POST">
  <input type="text" placeholder="mail" name="email">
  <input type="text" placeholder="password" name="password">
  <input type="submit" value="ログイン">
</form>
<?php include("../components/footer.php"); ?>