<?php
$title = "ログイン画面";
$cssLink = "../sass/login.css";
$jsLink = "";
require(realpath("../../models/users.php"));
require(realpath("../../config/dbconnect.php"));

session_name("user");
session_start();

createToken();

unset($_SESSION['id']);
unset($_SESSION['name']);
unset($_SESSION['email']);
unset($_SESSION['password']);
unset($_SESSION['img_path']);

if (!empty($_POST)) {
  validateToken();
  $email = $_POST['email'];
  $password = $_POST['password'];
  if(isset($email) && isset($password)){
  // eメールアドレスバリデーションチェック
  // 空白チェック
  if ($email === '') {
    $err_msg['email'] = '入力必須です';
  }
  // 文字数チェック
  elseif (strlen($email) > 255) {
    $err_msg['email'] = '255文字で入力してください';
  }
  // パスワードバリデーションチェック
  // 空白チェック
  elseif ($password === '') {
    $err_msg['password'] = '入力してください';
  }
  // 文字数チェック
  elseif (strlen($password) > 255 || strlen($password) < 5) {
    $err_msg['password'] = '６文字以上２５５文字以内で入力してください';
  }
  // 形式チェック
  elseif (!preg_match("/^[a-zA-Z0-9]+$/", $password)) {
    $err_msg['password'] = '半角英数字で入力してください';
  }
  
  if (empty($err_msg)){
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
  }else{
    foreach($err_msg as $err_msgs){
      echo $err_msgs;
    }
  }
}
}

?>
<?php include("../components/header.php"); ?>
<div class="login-wrapper">
  <form  action="login.php" method="POST">
    <input class="email" type="email" placeholder="email" name="email">
    <input class="password" type="password" placeholder="password" name="password">
    <input class="login" type="submit" value="ログイン">
    <input type="hidden" name="token" value="<?= h($_SESSION['token'])?>">
  </form>
  
  <a href="./createAccount.php" class="create-link">新規作成はこちら</a>
</div>
<?php include("../components/footer.php"); ?>