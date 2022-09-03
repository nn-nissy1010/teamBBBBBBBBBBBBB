<?php $title = "トップ画面";
$cssLink = "../sass/top.css";

require(realpath("../../models/rooms.php"));
require(realpath("../../config/dbconnect.php"));

session_start();

if (isset($_POST['name']) && strlen($_POST['name']) != 0) {
    $name = $_POST["name"];
    $condition = "name = '$name'";
    roomSearch($db, $condition);
    $rooms = roomSearch($db, $condition);
} else {
    $rooms = roomRead($db);
}
?>
<?php include("../components/header.php"); ?>
<section>
    <form action="top.php" method="post">
        <input type="text" placeholder="room名" name="name">
        <input type="submit" value="検索">
    </form>
</section>

<section>
    <div class="room-box">
        <?php foreach ($rooms as $room) : ?>
            <div class="room">
                <div><?= $room["name"]; ?></div>
                <img src="<?= $room["img_path"] ?>" alt="">
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section>
    <button class="create-room-bottun">部屋を作る→</button>
</section>

</body>

</html>