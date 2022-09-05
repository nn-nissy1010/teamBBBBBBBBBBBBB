<?php $title = "ユーザー情報編集";
$cssLink = "../sass/editAccount.css";
$jsLink = "../js/editAccount/script.js";
require(realpath("../../models/users.php"));
require(realpath("../../config/dbconnect.php"));
require(realpath("../../auth/auth.php"));

auth('editAccount.php');

session_start();

$loginUserId = $_SESSION['user_id'];
$condition = "id = '$loginUserId'";
$loginUser = userSearch($db, $condition)[0];

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
    if($img_name){
        editUserImg($db, $err_msgs, $tmp_path, $img_path, $name, $email,  $tel, $img_name, $upload_dir, $loginUser['img_path'], $condition);
    }else{
        userUpdate($db, $name, $email, $tel, $loginUser['img'], $loginUser['img_path'], $condition);
    }
}

$loginUser = userSearch($db, $condition)[0];
var_dump($loginUser);
?>
<?php include("../components/header.php"); ?>
<form class="form-wrapper validation-form" action="editAccount.php" method="post" enctype="multipart/form-data">
    <div class="form-sample">
        <p class="form-label">氏名</p>
        <input type="text" class="form-input required" placeholder="例）鈴木一郎" name="name" value="<?= $loginUser['name'] ?>">
    </div>
    <div class="form-sample">
        <p class="form-label">電話番号</p>
        <input type="text" class="form-input required tel" placeholder="例）123-4567-8910" name="tel" value="<?= $loginUser['tel'] ?>">
    </div>
    <div class="form-sample">
        <p class="form-label">画像</p>
        <label class="form-input-file" tabindex="0">
            <input type="file" id="editAccountFile" name="img" accept="image/jpeg, image/png, image/gif" onchange="previewImage(this);" multiple novalidate>画像を選ぶ→
        </label>
        <p id="editAccountFileName">選択されていません</p>
    </div>
    <div id="previewImage" class="preview-image">
    <!-- <img id="preImg" src="<?= $loginUser['img_path'] . '?' . uniqid()?>" alt=""> -->
    <img id="preview" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">
    </div>
    <div class="form-sample">
        <p class="form-label">メールアドレス</p>
        <input type="email" class="form-input required email" placeholder="例）sample@gmail.com" name="email" value="<?= $loginUser['email'] ?>">
    </div>
    <input type="submit" class="form-Btn" value="編集">
</form>
<script>
function previewImage(obj)
{
	var fileReader = new FileReader();
	fileReader.onload = (function() {
		document.getElementById('preview').src = fileReader.result;
	});
	fileReader.readAsDataURL(obj.files[0]);
    document.getElementById('preImg').style.display = "none";
}
</script>
<?php include("../components/footer.php"); ?>
