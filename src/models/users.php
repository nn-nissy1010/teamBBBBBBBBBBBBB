<?php
// 追加
function userCreate($db, $name, $email, $tel, $password, $img, $img_path)
{
    $stmt = $db->prepare(
        'INSERT INTO 
`users` (
    `name`,
    `email`,
    `tel`,
    `password`,
    `img`,
    `img_path`
) 
VALUES
(?,?,?,?,?,?)
'
    );

    $stmt->bindValue(1, $name, PDO::PARAM_STR);
    $stmt->bindValue(2, $email, PDO::PARAM_STR);
    $stmt->bindValue(3, $tel, PDO::PARAM_STR);
    $stmt->bindValue(4, sha1($password), PDO::PARAM_STR);
    $stmt->bindValue(5, $img, PDO::PARAM_STR);
    $stmt->bindValue(6, $img_path, PDO::PARAM_STR);
    $stmt->execute();
}

function uploadImg($db, $err_msgs, $tmp_path, $img_path, $name, $email,  $tel, $password, $img_name){
    if (count($err_msgs) === 0) {
        //ファイルはあるかどうか
        if (is_uploaded_file($tmp_path)) {
            if (move_uploaded_file($tmp_path, $img_path)) {
                //DBに保存する(ルーム名、画像ファイル名、画像ファイルパス、ルーム上限人数)
                $result = userCreate($db, $name, $email, $tel, $password, $img_name, $img_path);
            }else{
                echo 'ファイルが保存できませんでした。';
            }
        } else {
            echo 'ファイルが選択されていません.';
            echo '<br>';
        }
    }
}


// 編集
function userUpdate($db, $name, $email, $tel, $password, $img, $condition)
{
    $stmt = $db->prepare("UPDATE `users` SET name=?, `email`=?, `tel`=?, password=? ,`img`=? WHERE '$condition'");
    $stmt->bindValue(1, $name, PDO::PARAM_STR);
    $stmt->bindValue(2, $email, PDO::PARAM_STR);
    $stmt->bindValue(3, $tel, PDO::PARAM_STR);
    $stmt->bindValue(4, sha1($password), PDO::PARAM_STR);
    $stmt->bindValue(5, $img, PDO::PARAM_STR);
    $stmt->execute();
}
// 削除
function userDelete($db, $condition)
{
    $stmt = $db->prepare("delete from users WHERE '$condition'");
    $stmt->execute();
}

// 全読み込み
function userRead($db)
{
    $stmt = $db->prepare("select * from users");
    $stmt->execute();
    $output = $stmt->fetchAll();
    return $output;
}

// 検索
function userSearch($db, $condition)
{
    $stmt = $db->prepare("SELECT * from `users` WHERE $condition");
    $stmt->execute();
    $output = $stmt->fetchAll();
    return $output;
}

