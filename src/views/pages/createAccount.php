<?php $title = "会員登録";
    $cssLink = "../sass/createAccount.css";
    $jsLink = "../js/createAccount/script.js";
    require(realpath("../../models/users.php"));
    require(realpath("../../config/dbconnect.php"));

    if ($_POST) {
        $name = $_POST['name'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $img = $_POST['img'];
        userCreate($db, $name, $email, $tel, $password, $img);
    }
?>
<?php include("../components/header.php"); ?>
        <form class="form-wrapper" action="createAccount.php" method="post" enctype="multipart/form-data">
            <div class="form-sample">
                <p class="form-label">氏名</p>
                <input type="text" class="form-input" placeholder="例）鈴木一郎" name="name">
            </div>
            <div class="form-sample">
                <p class="form-label">電話番号</p>
                <input type="text" class="form-input" placeholder="例）123-4567-8910" name="tel">
            </div>
            <div class="form-sample">
                <p class="form-label">画像</p>
                <label class="form-input-file" tabindex="0">
                    <input type="file" id="accountFile" name="img" accept="image/jpeg, image/png, image/gif" multiple>画像を選ぶ→
                </label>
                <p id="accountFileName">選択されていません</p>
            </div>
            <div class="form-sample">
                <p class="form-label">メールアドレス</p>
                <input type="email" class="form-input" placeholder="例）sample@gmail.com" name="email">
            </div>
            <div class="form-sample">
                <p class="form-label">パスワード</p>
                <input type="password" class="form-input" placeholder="例）password123" name="password" id="password" required>
            </div>
            <div class="form-sample">
                <p class="form-label">パスワード再確認</p>
                <input type="password" class="form-input" placeholder="例）password123" name="confirm" oninput="CheckPassword(this)" required>
            </div>
            <input type="submit" class="form-Btn" value="会員登録">
        </form>
        <?php include("../components/footer.php"); ?>