<?php
require(realpath("../../models/users.php"));
require(realpath("../../models/rooms.php"));
require(realpath("../../config/dbconnect.php"));
require(realpath("../../auth/auth.php"));

auth('room.php');

session_start();

$loginUserId = $_SESSION['id'];
$condition = "id = '$loginUserId'";
$loginUser = userSearch($db, $condition)[0];

$J_file = "../js/room/chatlog.json";
date_default_timezone_set('Asia/Tokyo');
// 以下追加

$filesize = filesize($J_file); // 旧⇦ファイルサイズを取得
if (empty($_SESSION['filesize'])) {
    // 新が空なら(1番最初のアクセスなら)新にファイルサイズを格納
    $_SESSION['filesize'] = $filesize;
}

$J_file = "../js/room/chatlog.json";
$filesize = filesize($J_file); // 最新のファイルサイズ

if (isset($_GET['ajax']) && $_GET['ajax'] === "ON") {
    // ファイルサイズが違った時
    if ($file = file_get_contents($J_file)) {
        // 新しいチャットログのHTMLを構築
        $file = json_decode($file);
        $array = $file->chatlog;
        foreach ($array as $object) {
            if ($object->roomId === $_SESSION["roomId"]) {
                // 第二回目以降
                if ($object->person === $loginUser['name']) {
                    $result =  $result . '<div class="say right" id="b"><div><p class="face_icon"><span>' . $object->person . '</span></p><div class="chatting"><div class="sc"><p>' . str_replace("\r\n", "<br>", $object->text) . '</p></div></div></div></div>';
                } else {
                    $result = $result . '<div class="say left" id="b"><div><p class="face_icon"><img src="' . $object->imgPath . '" alt="m" width="110"><span>' . $object->person . '</span></p><div class="chatting"><div class="sc"><p>' . str_replace("\r\n", "<br>", $object->text) . '</p></div></div></div></div>';
                }
            }else {
                // 第一回目
                // $result = '<div class="say' . $object->person === $loginUser['name'] ? 'right' : 'left' . '" id="b"><p class="face_icon">' .  $object->person === $loginUser['name'] ? '' : '<img src="' . $object->imgPath . '" alt="m" width="110">'  . '<span>' . $object->person . '</span></p><div class="chatting"><div class="sc"><p>' . str_replace("\r\n", "<br>", $object->text) . '</p></div></div></div>';
                if ($object->roomId === $_SESSION["roomId"]) {
                    // 第二回目以降
                    if ($object->person === $loginUser['name']) {
                        $result =  $result . '<div class="say right" id="b"><div><p class="face_icon"><span>' . $object->person . '</span></p><div class="chatting"><div class="sc"><p>' . str_replace("\r\n", "<br>", $object->text) . '</p></div></div></div></div>';
                    } else {
                        $result = $result . '<div class="say left" id="b"><div><p class="face_icon"><img src="' . $object->imgPath . '" alt="m" width="110"><span>' . $object->person . '</span></p><div class="chatting"><div class="sc"><p>' . str_replace("\r\n", "<br>", $object->text) . '</p></div></div></div></div>';
                    }
                }
            }
        }
    }
    // チャットリセットされた時もファイルサイズが一瞬違うため9行目にfalseが返ってもinputを表示させる
    $result = $result . '<input  id="preFilesize" type="hidden" value="' . $filesize . '"><input  id="aftFilesize" type="hidden" value="' . $filesize . '">';
    echo $result;
    exit;
} elseif (isset($_GET['ajax']) && $_GET['ajax'] === "OFF") {
    // ファイルサイズが同じ時
    echo $filesize;
    exit;
}

