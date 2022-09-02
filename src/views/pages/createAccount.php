<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アカウント作成画面</title>
    <link rel="stylesheet" href="../sass/style.css">
    <link rel="stylesheet" href="../sass/createAccount.css">
</head>

<body>
    <div class="body-wrapper">

        <h1 class="label-title">会員登録</h1>


        <form class="form-wrapper">
            <div class="form-sample">
                <p class="form-label">氏名</p>
                <input type="text" class="form-input" placeholder="例）鈴木一郎">
            </div>
            <div class="form-sample">
                <p class="form-label">電話番号</p>
                <input type="text" class="form-input" placeholder="例）123-4567-8910">
            </div>
            <div class="form-sample">
                <p class="form-label">画像</p>
                <label class="form-input-file" tabindex="0">
                    <input type="file" id="file" name="sample" accept="image/jpeg, image/png, image/gif" multiple>画像を選ぶ→
                </label>
                <p id="fileName">選択されていません</p>
            </div>
            <div class="form-sample">
                <p class="form-label">メールアドレス</p>
                <input type="email" class="form-input" placeholder="例）sample@gmail.com">
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
        <script src="../js/script.js"></script>
    </div>
</body>

</html>