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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">

</head>

<body>
    <div class="body-wrapper">
        <header>
            <div class="header-content">
                <p class="header-sentence">IDO<br>BATA</p>
                <?php
                if ($_SESSION['name'] != "" && $_SESSION['email'] != "" && $_SESSION['password'] != "" && $_SESSION['img_path'] != "") {
                ?>
                    <form method="get" action="">
                        <input class="logout" type="submit" name="btn_logout" value="ログアウト">
                    </form>
                    <div class="my-profile" onclick="userInfo()">
                        <img class="my-profile_image" src="../image/<?= $_SESSION['img_path'] ?>" alt="">
                    </div>
                    <div id="profile" class="profile">
                        <p class="profile-title">ユーザープロフィール</p>
                        <div class="profile-wrapper">
                            <p class="profile-detail-title">名前</p>
                            <p class="profile-detail">
                                <?php echo $_SESSION['name']; ?>
                            </p>
                            <p class="profile-detail-title">メールアドレス</p>
                            <p class="profile-detail">
                                <?php echo $_SESSION['email']; ?>
                            </p>
                            <div class="modal-img-box">
                                <p class="profile-detail-title">画像</p>
                                <img class="profile_img" src="../image/<?= $_SESSION['img_path'] ?>" alt="">
                            </div>
                        </div>
                        <div class="p-button">
                            <button class="profile-edit-button">
                                <a style="color:#fff; font-weight:bold;" href="../pages/editAccount.php?id=<?= $_SESSION['id'] ?>">編集する</a>
                            </button>
                        </div>
                        <div class="p-button">
                            <button onclick="closeModal()"><span class="round_btn"></span></button>
                        </div>
                    </div>
                    <script>
                        function userInfo() {
                            document.getElementById('profile').style.display = "block";
                        }

                        function closeModal() {
                            document.getElementById('profile').style.display = "none";
                        }
                    </script>
                <?php
                }
                ?>
            </div>
            <h1 class="label-title"><?= $title ?></h1>

        </header>