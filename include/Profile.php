<?php
require_once 'db_connect.php';

class Profile
{
    static function profileInsert($chat_id,$username, $name,$date){
        global $db;
        $chat_id = $db->real_escape_string($chat_id);
        $username = $db->real_escape_string($username);
        $name = $db->real_escape_string($name);
        $date = $db->real_escape_string($date);

        $checkuserexist = $db->query("SELECT * FROM `profile` WHERE `chat_id`='{$chat_id}'");
        if (mysqli_num_rows($checkuserexist) == 0) {
            $db->query("INSERT INTO `profile` (`chat_id`, `username`, `first_name`,`date`) VALUES ('{$chat_id}', '{$username}', '{$name}', '{$date}')");
        } else {
            $arr = $checkuserexist->fetch_assoc();
            $id = $arr['id'];
            $db->query("UPDATE `profile` SET `username` = '$username',`first_name` = '$name' WHERE `profile`.`id` = '$id'");
        }
    }
}