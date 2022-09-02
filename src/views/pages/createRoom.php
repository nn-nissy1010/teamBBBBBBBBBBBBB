<?php
$title = "部屋作成";
$cssLink = "../sass/createRoom.css";
require(realpath("../../models/rooms.php"));
require(realpath("../../config/dbconnect.php"));

if($_POST){
    $name = $_POST["name"];
    $img = $_POST["img"];
    $limit = $_POST["limit"];
    roomCreate($db, $name, $img, $limit);
}

?>
<?php include("../components/header.php"); ?>
<form class="form-wrapper" action="createRoom.php" method="post">
    <div class="form-sample">
        <p class="form-label">部屋の名前</p>
        <input type="text" class="form-input" placeholder="例）〇〇町お茶会部屋" name="name">
    </div>
    <div class="form-sample">
        <p class="form-label">人数制限</p>
        <div class="radio-label">
            <label>
                <input type="radio" name="limit" value="2">
                2人
            </label>
            <label>
                <input type="radio" name="limit" value="5">
                5人
            </label>
            <label>
                <input type="radio" name="limit" value="8">
                8人
            </label>

        </div>
    </div>
    <div class="form-sample">
        <p class="form-label">画像</p>
        <label class="form-input-file" tabindex="0">
            <input type="file" id="roomFile" name="img" accept="image/jpeg, image/png, image/gif" multiple>画像を選ぶ→
        </label>
        <p id="fileName">選択されていません</p>
    </div>
    <input type="submit" class="form-Btn" value="部屋作成">
</form>
<?php include("../components/footer.php"); ?>