<?php
// 追加
function userCreate($db, $name, $email, $tel, $password, $img)
{
    $stmt = $db->prepare(
        'INSERT INTO 
`users` (
    `name`,
    `email`,
    `tel`,
    `password`,
    `img`
) 
VALUES
(?,?,?,?,?)
'
    );

    $stmt->bindValue(1, $name, PDO::PARAM_STR);
    $stmt->bindValue(2, $email, PDO::PARAM_STR);
    $stmt->bindValue(3, $tel, PDO::PARAM_STR);
    $stmt->bindValue(4, sha1($password), PDO::PARAM_STR);
    $stmt->bindValue(5, $img, PDO::PARAM_STR);
    $stmt->execute();
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
    $stmt = $db->prepare("SELECT * from `users` WHERE name=?");
    $stmt->bindValue(1, $condition, PDO::PARAM_STR);
    $stmt->execute();
    $output = $stmt->fetchAll();
    return $output;
}

//検索（ログイン用）
function loginSearch($db, $condition)
{
    $stmt = $db->prepare("SELECT * from `users` WHERE email = ?");
    $stmt->bindValue(1, $condition, PDO::PARAM_STR);
    $stmt->execute();
    $output = $stmt->rowCount();
    return $output;
}

function loginSearch2($db, $condition, $condition2)
{
    $stmt = $db->prepare("SELECT * from `users` WHERE email = ? and password = ?");
    $stmt->bindValue(1, $condition, PDO::PARAM_STR);
    $stmt->bindValue(2, $condition2, PDO::PARAM_STR);
    $stmt->execute();
    $output = $stmt->rowCount();
    return $output;
}

