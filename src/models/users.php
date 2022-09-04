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

function uploadImg($db, $err_msgs, $tmp_path, $img_path, $name, $email,  $tel, $password, $img_name, $upload_dir){
    if (count($err_msgs) === 0) {
        //ファイルはあるかどうか
        if (is_uploaded_file($tmp_path)) {
            if (move_uploaded_file($tmp_path, $img_path)) {
                echo $img_name . 'を' . $upload_dir . 'アップしました。';
                //DBに保存する(ルーム名、画像ファイル名、画像ファイルパス、ルーム上限人数)
                $result = userCreate($db, $name, $email, $tel, $password, $img_name, $img_path);
                var_dump($result);
                if($result){
                    echo 'データベースに保存しました！';
                }else{
                    echo 'データベースへの保存が失敗しました！';
                }
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
function userUpdate($db, $name, $email, $tel, $img, $img_path, $condition)
{
    $stmt = $db->prepare("UPDATE `users` SET name=?, `email`=?, `tel`=?, `img`=? ,`img_path`=? WHERE $condition");
    $stmt->bindValue(1, $name, PDO::PARAM_STR);
    $stmt->bindValue(2, $email, PDO::PARAM_STR);
    $stmt->bindValue(3, $tel, PDO::PARAM_STR);
    $stmt->bindValue(4, $img, PDO::PARAM_STR);
    $stmt->bindValue(5, $img_path, PDO::PARAM_STR);
    $stmt->execute();
}

function editImg($db, $err_msgs, $tmp_path, $img_path, $name, $email,  $tel, $img_name, $upload_dir, $pre_img_path, $condition){
    if (count($err_msgs) === 0) {
        //ファイルはあるかどうか
        if (is_uploaded_file($tmp_path)) {
            if (move_uploaded_file($tmp_path, $img_path)) {
                unlink($pre_img_path);
                echo $img_name . 'を' . $upload_dir . 'アップしました。';
                //DBに保存する(ルーム名、画像ファイル名、画像ファイルパス、ルーム上限人数)
                $result = userUpdate($db, $name, $email, $tel, $img_name, $img_path, $condition);
                var_dump($result);
                if($result){
                    echo 'データベースに保存しました！';
                }else{
                    echo 'データベースへの保存が失敗しました！';
                }
            }else{
                echo 'ファイルが保存できませんでした。';
            }
        } else {
            echo 'ファイルが選択されていません.';
            echo '<br>';
        }
    }
}

// 削除
function userDelete($db, $condition)
{
    $stmt = $db->prepare("delete from users WHERE $condition");
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

//検索（ログイン用）
function loginSearch($db, $condition)
{
    $stmt = $db->prepare("SELECT * from `users` WHERE $condition");
    $stmt->execute();
    $output = $stmt->fetchAll();
    return $output;
}

