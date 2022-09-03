<?php
    function get_user($db,$user_id){
        $stmt=$db->prepare(
                "SELECT id,name,password,profile,image
                FROM user
                WHERE id = :id AND delete_flg = 0 ");
        $stmt->execute(array(':id' => $user_id));
        $output = $stmt->fetchAll();
        return $output;
    }

    function get_messages($db,$user_id,$destination_user_id){
        $stmt = $db->prepare(
            "SELECT *
            FROM message
            WHERE (user_id = :id and destination_user_id = :destination_user_id) or (user_id = :destination_user_id and destination_user_id = :id)
            ORDER BY created_at ASC"
        );
        $stmt->execute(array(':id' => $user_id,
                            ':destination_user_id' => $destination_user_id));
        return $stmt->fetchAll();
    }


    