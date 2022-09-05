<?php
// 追加
function roomCreate($db,$name,$img,$img_path,$limit){
    $result = False;
    try{
    $insert_rooms_stmt = $db->prepare(
        "INSERT INTO
    `rooms` (
    `name`,
    `img`,
    `img_path`,
    `limit`
    )
    VALUES(?,?,?,?)");

    $insert_rooms_stmt->bindValue(1,$name, PDO::PARAM_STR);
    $insert_rooms_stmt->bindValue(2,$img, PDO::PARAM_STR);
    $insert_rooms_stmt->bindValue(3,$img_path, PDO::PARAM_STR);
    $insert_rooms_stmt->bindValue(4,$limit, PDO::PARAM_INT);
    $insert_rooms_stmt->execute();
    }catch(\Exception $e){
        echo $e->getMessage();
        return $result;
        //ここでエラーページに飛ばしたい
        //→その際にもどるボタンで、前いたページに遷移させる
    }
}

function uploadRoomImg($db, $err_msgs, $tmp_path, $img_path, $name, $limit, $img_name, $upload_dir){
    if (count($err_msgs) === 0) {
        //ファイルはあるかどうか
        if (is_uploaded_file($tmp_path)) {
            if (move_uploaded_file($tmp_path, $img_path)) {
                // echo $img_name . 'を' . $upload_dir . 'アップしました。';
                //DBに保存する(ルーム名、画像ファイル名、画像ファイルパス、ルーム上限人数)
                $result = roomCreate($db,$name,$img_name,$img_path,$limit);
                // var_dump($result);
                if($result){
                    // echo 'データベースに保存しました！';
                }else{
                    // echo 'データベースへの保存が失敗しました！';
                }
            }else{
                // echo 'ファイルが保存できませんでした。';
            }
        } else {
            // echo 'ファイルが選択されていません.';
            // echo '<br>';
        }
    }
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
