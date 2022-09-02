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


// 読み込み
function userRead($db, $condition)
{
    $stmt = $db->prepare("select * from users WHERE '$condition'");
    $stmt->execute();
    $output = $stmt->fetchAll();
    return $output;
}
