<?php
$title = "部屋作成";
$cssLink = "../sass/createRoom.css";
$jsLink = "../js/createRoom/script.js";
require(realpath("../../models/rooms.php"));
require(realpath("../../config/dbconnect.php"));

if ($_POST) {
    //ファイル関連の取得
    $file = $_FILES['img'];
    $img_name = basename($file['name']);
    $tmp_path = $file['tmp_name'];
    $file_err = $file['error'];
    $filesize = $file['size'];
    $upload_dir = '../image/';
    $save_filename = date('YmdHis') . $img_name;
    $err_msgs = array();
    $img_path = $upload_dir . $save_filename;
    //その他の取得
    $name = $_POST["name"];
    $limit = $_POST["limit"];
    uploadImg($db, $err_msgs, $tmp_path, $img_path, $name, $limit, $img_name, $upload_dir);
}

?>
<?php include("../components/header.php"); ?>
<form class="form-wrapper validation-form" action="createRoom.php" method="post" enctype="multipart/form-data" novalidate>
    <div class="form-sample">
        <p class="form-label">部屋の名前</p>
        <input type="text" class="form-input required" placeholder="例）〇〇町お茶会部屋" name="name">
    </div>
    <div class="form-sample">
        <p class="form-label">人数制限</p>
        <div class="radio-label">
            <label>
                <input type="radio" name="limit" value="2" >
                2人
            </label>
            <label>
                <input type="radio" name="limit" value="5">
                5人
            </label>
            <label>
                <input type="radio" name="limit" value="8"class="required">
                8人
            </label>

        </div>
    </div>
    <div class="form-sample">
        <p class="form-label">画像</p>
        <label class="form-input-file" tabindex="0">
            <input type="file" id="roomFile" name="img" accept="image/jpeg, image/png, image/gif" onchange="previewImage(this);" multiple>画像を選ぶ→
        </label>
        <p id="roomFileName">選択されていません</p>
    </div>
    <div id="previewImage" class="preview-image">
    <img id="preview" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">
    </div>
    <input type="submit" class="form-Btn" value="部屋作成">
</form>
<script>
function previewImage(obj)
{
	var fileReader = new FileReader();
	fileReader.onload = (function() {
		document.getElementById('preview').src = fileReader.result;
	});
	fileReader.readAsDataURL(obj.files[0]);
    document.getElementById('previewImage').style.display = "block";
}
</script>
<?php include("../components/footer.php"); ?>