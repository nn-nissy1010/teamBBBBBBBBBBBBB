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
                <div class="my-profile">
                    <a href="">
                        <img class="my-profile_image" src="../image/<?= $_SESSION['img_path'] ?>" alt="">
                    </a>
                </div>
                <?php
                }
                ?>
            </div>
            <h1 class="label-title"><?= $title ?></h1>
            
        </header>