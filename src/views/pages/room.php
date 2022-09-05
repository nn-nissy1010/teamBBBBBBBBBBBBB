<?php
require(realpath("../../models/users.php"));
require(realpath("../../models/rooms.php"));
require(realpath("../../config/dbconnect.php"));
require(realpath("../../auth/auth.php"));

auth('room.php');

session_start();

$loginUserId = $_SESSION['user_id'];
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

// ユーザーアイコンが押された時
// if (isset($_GET['person'])) {
//     $_SESSION['person'] = $_GET['person'];
// } else {

//     // ユーザーアイコンも押されず、切り替えアイコンも押されていない時(=初めてページに訪れた時)
//     if (empty($_GET['change']) && empty($_SESSION['person'])) {
//         $_SESSION['person'] = 'person1';
//         // 以下切り替えアイコンが押された時にアクティブのユーザーではない方に切り替える処理
//     } elseif ($_GET['change'] === 'change' && $_SESSION['person'] === "person2") {
//         $_SESSION['person']  = 'person1'; //現在2なら1をアクティブに
//     } elseif ($_GET['change'] === 'change' && $_SESSION['person'] === "person1") {
//         $_SESSION['person']  = 'person2'; //現在1なら2をアクティブに
//     }
// }
$_SESSION["roomId"] = $_GET['id'];

if (isset($_POST['submit']) && $_POST['submit'] === "送信") { // #1

    $chat = [];
    $chat["person"] = $loginUser["name"];
    $chat["imgPath"] = $loginUser["img_path"];
    $chat["roomId"] = $_GET['id'];
    $chat["time"] = date("H:i");
    $chat["text"] = htmlspecialchars($_POST['text'], ENT_QUOTES);

    // 入力値格納処理
    if ($file = file_get_contents($J_file)) { // #2
        // ファイルがある場合 追記処理
        $file = str_replace(array(" ", "\n", "\r"), "", $file);
        $file = mb_substr($file, 0, mb_strlen($file) - 2);
        $json = json_encode($chat);
        $json = $file . ',' . $json . ']}';
        file_put_contents($J_file, $json, LOCK_EX);
    } else { // #2
        // ファイルがない場合 新規作成処理
        $json = json_encode($chat);
        $json = '{"chatlog":[' . $json . ']}';
        file_put_contents($J_file, $json, FILE_APPEND | LOCK_EX);
    } // #2

    // header('Location:https://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/chat.php');
    header('Location:./room.php?id=' . $_GET['id']);
    exit;
} // #1

// チャットログがあればチャットログとファイルサイズ(新旧)を表示
if ($file = file_get_contents($J_file)) {
    $file = json_decode($file);
    $array = $file->chatlog;

    // チャットログを全て取り出しHTMLツリーを構築
    foreach ($array as $object) {
        if (isset($result)) {
            if ($object->roomId === $_SESSION["roomId"]) {
                // 第二回目以降
                if ($object->person === $loginUser['name']) {
                    $result =  $result . '<div class="say right" id="b"><div><p class="face_icon"><span>' . $object->person . '</span></p><div class="chatting"><div class="sc"><p>' . str_replace("\r\n", "<br>", $object->text) . '</p></div></div></div></div>';
                } else {
                    $result = $result . '<div class="say left" id="b"><div><p class="face_icon"><img src="' . $object->imgPath . '" alt="m" width="110"><span>' . $object->person . '</span></p><div class="chatting"><div class="sc"><p>' . str_replace("\r\n", "<br>", $object->text) . '</p></div></div></div></div>';
                }
            }
        } else {
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

    // 現在のファイルサイズと旧ファイルサイズを表示
    $result = $result . '<input id="preFilesize" type="hidden" value="' . $_SESSION['filesize'] . '"><input  id="aftFilesize" type="hidden" value="' . $filesize . '">';
} else {
    // チャット履歴がない場合はチャットが増えたときに備える
    $result = '<input id="preFilesize" type="hidden" value="' . $_SESSION['filesize'] . '"><input  id="aftFilesize" type="hidden" value="' . $filesize . '">';
}

if ($_GET['reset'] === "チャット履歴をリセット" && isset($_GET['reset'])) {
    file_put_contents($J_file, '');
    // header('Location:https://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/chat.php');
    header('Location:./room.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../sass/global.css">
    <link rel="stylesheet" href="../sass/room.css">
</head>

<body>
    <header>
        <div class="room-header">
            <div class="room-back">←</div>
            <div class="room-name">部屋<?= $_SESSION["roomId"]?></div>
        </div>
    </header>

    <section class="content">
        <!-- <div class="say right">
            <div class="chatting">
                <div class="sc">
                    <p>サンプルサンプルサンプルサンプルサンプル</p>
                </div>
            </div>
        </div>
        <div class="say left" id="b">
            <p class="face_icon">
                <img src="<?= $_SESSION["img_path"] ?>" alt="m" width="110">
                <span>かずき</span>
            </p>
            <div class="chatting">
                <div class="sc">
                    <p>サンプルサンプルサンプルサンプルサンプル</p>
                </div>
            </div>
        </div> -->
        <div class="chat-area" id="chat-area">
            <?php echo $result; ?>
        </div>
    </section>

    <section>
        <form action="room.php?id=<?= $_GET['id'] ?>#chat-area" method="post">
            <input id="textarea" type="text" name="text" placeholder="Aa">
            <input type="submit" name="submit" value="送信" id="search">
        </form>
    </section>
</body>
<script src=“https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js”></script>
<script src="../js/room/script.js"></script>

</html>