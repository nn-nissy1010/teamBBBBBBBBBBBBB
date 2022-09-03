<?php
// 追加
function roomCreate($db,$name,$img,$limit){
    $insert_rooms_stmt = $db->prepare(

        "INSERT INTO
    `rooms` (
    `name`,
    `img`,
    `limit`
    )
    VALUES(?,?,?)");

    $insert_rooms_stmt->bindValue(1,$name, PDO::PARAM_STR);
    $insert_rooms_stmt->bindValue(2,$img, PDO::PARAM_STR);
    $insert_rooms_stmt->bindValue(3,$limit, PDO::PARAM_INT);
    $insert_rooms_stmt->execute();


}

// 編集


// 削除


// 全読み込み
function roomRead($db)
{
    $stmt = $db->prepare("select * from rooms");
    $stmt->execute();
    $allRoom = $stmt->fetchAll();
    return $allRoom;
}

// 検索
function roomSearch($db, $condition)
{
    $stmt = $db->prepare("SELECT * from `rooms` WHERE $condition");
    $stmt->execute();
    $searchedRoom = $stmt->fetchAll();
    return $searchedRoom;
}
