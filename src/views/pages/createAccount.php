<?php $title = "会員登録";
$cssLink = "../sass/createAccount.css";
$jsLink = "../js/createAccount/script.js";
require(realpath("../../models/users.php"));
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
    $name = $_POST['name'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $img = $_POST['img'];
    uploadImg($db, $err_msgs, $tmp_path, $img_path, $name, $email,  $tel, $password, $img_name, $upload_dir);
    header("Location: /views/pages/login.php");
}
?>
<?php include("../components/header.php"); ?>
<form class="form-wrapper validation-form" action="createAccount.php" method="post" enctype="multipart/form-data">
    <div class="form-sample">
        <p class="form-label">氏名</p>
        <input type="text" class="form-input required" placeholder="例）鈴木一郎" name="name">
    </div>
    <div class="form-sample">
        <p class="form-label">電話番号</p>
        <input type="text" class="form-input required tel" placeholder="例）123-4567-8910" name="tel">
    </div>
    <div class="form-sample">
        <p class="form-label">画像</p>
        <label class="form-input-file" tabindex="0">
            <input type="file" id="accountFile" name="img" accept="image/jpeg, image/png, image/gif" onchange="previewImage(this);" multiple novalidate>画像を選ぶ→
        </label>
        <p id="accountFileName">選択されていません</p>
    </div>
    <div id="previewImage" class="preview-image">
    <img id="preview" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">
    </div>
    <div class="form-sample">
        <p class="form-label">メールアドレス</p>
        <input type="email" class="form-input required email" placeholder="例）sample@gmail.com" name="email">
    </div>
    <div class="form-sample">
        <p class="form-label">パスワード</p>
        <input type="password" class="form-input required" placeholder="例）password123" name="password" id="password" required>
    </div>
    <div class="form-sample">
        <p class="form-label">パスワード再確認</p>
        <input type="password" class="form-input required equal-to" placeholder="例）password123" name="confirm" oninput="CheckPassword(this)" required>
    </div>
    <input type="submit" class="form-Btn" value="会員登録">
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
