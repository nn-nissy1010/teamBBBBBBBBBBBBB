<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="../sass/global.css">
    <link rel="stylesheet" href="<?= $cssLink ?>">
</head>

<body>
    <div class="body-wrapper">
        <header>
            <div class="header-content">
                <p class="header-sentence">IDO<br>BTA</p>
                <?php
                if($_SESSION['name'] != "" && $_SESSION['email'] != "" && $_SESSION['password'] != "" && $_SESSION['img_path'] != ""){
                ?>
                <form method="get" action="">
                    <input class="logout" type="submit" name="btn_logout" value="ログアウト">
                </form>
                <div class="my-profile" onclick="userInfo()">
                    <img class="my-profile_image" src="../image/<?= $_SESSION['img_path'] ?>" alt="">
                </div>
                <div id="profile" class="profile">
                    <h1>ユーザープロフィール</h1>
                    <?php 
                    echo $_SESSION['name'];
                    echo $_SESSION['email'];
                    ?>
                    <div class="modal-img-box">
                    <img class="profile_img" src="../image/<?= $_SESSION['img_path'] ?>" alt="">
                    </div>
                    <a href="../pages/editAccount.php?id=<?= $_SESSION['id'] ?>">編集する</a>
                    <button onclick="closeModal()">閉じる</button>
                </div>
                <script>
                    function userInfo(){
                        document.getElementById('profile').style.display = "block";
                    }
                    function closeModal(){
                        document.getElementById('profile').style.display = "none";
                    }
                </script>
                <?php
                }
                ?>
            </div>
            <h1 class="label-title"><?= $title ?></h1>

        </header>